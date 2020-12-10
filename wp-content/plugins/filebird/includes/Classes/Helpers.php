<?php
namespace FileBird\Classes;

defined('ABSPATH') || exit;

use FileBird\Model\Folder as FolderModel;

class Helpers {
    protected static $instance = null;
    
    public static function getInstance() {
        if (null == self::$instance) {
          self::$instance = new self;
        }
        return self::$instance;
    }

    public static function foldersFromEnhanced($parent = 0, $flat = false) {
        global $wpdb;
        $folders = $wpdb->get_results($wpdb->prepare('SELECT t.term_id as id, t.name as title, tt.term_taxonomy_id FROM %1$s as t  INNER JOIN %2$s as tt ON (t.term_id = tt.term_id) WHERE tt.taxonomy = \'media_category\' AND tt.parent = %3$d', $wpdb->terms, $wpdb->term_taxonomy, $parent));
        foreach ($folders as $k => $folder) {
          $folders[$k]->parent = $parent;
        }
        if($flat) {
          foreach ($folders as $k => $folder) {
            $children = self::foldersFromEnhanced($folder->id, $flat);
            foreach($children as $k2 => $v2) {
              $folders[] = $v2;
            }
          }
        } else {
          foreach ($folders as $k => $folder) {
            $folders[$k]->children = self::foldersFromEnhanced($folder->id, $flat);
          }
        }
        return $folders;
    }
    public static function foldersFromWpmlf($parent = 0, $flat = false) {
        global $wpdb;
        $table_name = $wpdb->base_prefix.'mgmlp_folders';
        $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
        if ( ! $wpdb->get_var( $query ) == $table_name ) {
            return array();
        }

        $folders = $wpdb->get_results($wpdb->prepare('select p.ID as id, p.post_title as title, mlf.folder_id as parent from %1$s as p LEFT JOIN %2$s as mlf ON(p.ID = mlf.post_id) where p.post_type = \'mgmlp_media_folder\' and mlf.folder_id = \'%3$s\' order by mlf.folder_id', $wpdb->posts, $wpdb->prefix . 'mgmlp_folders', $parent));
        
        if($flat) {
        foreach ($folders as $k => $folder) {
            $children = self::foldersFromWpmlf($folder->id, $flat);
            foreach($children as $k2 => $v2) {
            $folders[] = $v2;
            }
        }
        } else {
        foreach ($folders as $k => $folder) {
            $folders[$k]->children = self::foldersFromWpmlf($folder->id, $flat);
        }
        }
        return $folders;
    }
    public static function foldersFromWpmf($parent = 0, $flat = false) {
      global $wpdb;
      $folders = $wpdb->get_results($wpdb->prepare('SELECT t.term_id as id, t.name as title, tt.term_taxonomy_id FROM %1$s as t  INNER JOIN %2$s as tt ON (t.term_id = tt.term_id) WHERE tt.taxonomy = \'wpmf-category\' AND tt.parent = %3$d', $wpdb->terms, $wpdb->term_taxonomy, $parent));
      foreach ($folders as $k => $folder) {
        $folders[$k]->parent = $parent;
      }
      if($flat) {
        foreach ($folders as $k => $folder) {
          $children = self::foldersFromWpmf($folder->id, $flat);
          foreach($children as $k2 => $v2) {
            $folders[] = $v2;
          }
        }
      } else {
        foreach ($folders as $k => $folder) {
          $folders[$k]->children = self::foldersFromWpmf($folder->id, $flat);
        }
      }
      return $folders;
  }
  public static function foldersFromRealMedia($parent = 0, $flat = false){
    global $wpdb;
    $table_name = $wpdb->base_prefix.'realmedialibrary';
    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );
    if ( ! $wpdb->get_var( $query ) == $table_name ) {
        return array();
    }

    $folders = $wpdb->get_results($wpdb->prepare('select r.id as id, r.name as title, r.parent as parent from %1$s as r where r.parent = %2$d order by r.ord', $table_name, $parent));
    
    if($flat) {
    foreach ($folders as $k => $folder) {
        $children = self::foldersFromRealMedia($folder->id, $flat);
        foreach($children as $k2 => $v2) {
        $folders[] = $v2;
        }
    }
    } else {
    foreach ($folders as $k => $folder) {
        $folders[$k]->children = self::foldersFromRealMedia($folder->id, $flat);
    }
    }
    return $folders;
  }

  public static function sanitize_array($var)
  {
      if (is_array($var)) {
          return array_map('self::sanitize_array', $var);
      } else {
          return is_scalar($var) ? sanitize_text_field($var) : $var;
      }
  }
  public static function getAttachmentIdsByFolderId($folder_id) {
    global $wpdb;
    return $wpdb->get_col("SELECT `attachment_id` FROM " . $wpdb->prefix . "fbv_attachment_folder WHERE `folder_id` = " . (int)$folder_id);
  }
  public static function view($path, $data = array()) {
    extract($data);
    ob_start();
    include_once NJFB_PLUGIN_PATH . 'views/'.$path.'.php';
    return ob_get_clean();
  }
  public static function getDefaultSelectedFolder() {
    $folder_id = get_user_meta(get_current_user_id(), '_njt_fbv_default_folder', true);
    $folder_id = (int)$folder_id;

    if($folder_id == 0) {
      $folder_id = -1;
    } elseif($folder_id > 0) {
      if(is_null(FolderModel::findById($folder_id))) {
        $folder_id = -1;
      }
    }
    return $folder_id;
  }
  public static function setDefaultSelectedFolder($value) {
    $value = (int)$value;
    if($value <= 0) $value = -1;
    update_user_meta(get_current_user_id(), '_njt_fbv_default_folder', $value);
  }
}