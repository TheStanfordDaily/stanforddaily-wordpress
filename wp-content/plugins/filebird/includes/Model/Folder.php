<?php
namespace FileBird\Model;

defined('ABSPATH') || exit;

class Folder {

  private static $folder_table = 'fbv';
  private static $relation_table = 'fbv_attachment_folder';
  
  public static function allFolders($select = '*', $prepend_default = null, $order_by = null) {
    //TODO need to convert ord to number using +0
    global $wpdb;
    
    $where = apply_filters('fbv_getting_folders_where', array('created_by' => '0'));
    if(\is_null($order_by)) $order_by = 'ord+0, id, name';
    $order_by = apply_filters('fbv_order_by', $order_by);

    $conditions = array('1 = 1');
    foreach ( $where as $field => $value ) {
			$conditions[] = "`$field` = " . $value;
    }
    $conditions = implode( ' AND ', $conditions );
    $sql = "SELECT $select FROM " . self::getTable(self::$folder_table) . " WHERE ".$conditions." ORDER BY " . $order_by;

    $folders = $wpdb->get_results($sql);
    if(is_array($prepend_default)) {
      $all = new \stdClass();
      $all->{$prepend_default[0]} = -1;
      $all->{$prepend_default[1]} = __('All Folders', 'filebird');

      $uncategorized = new \stdClass();
      $uncategorized->{$prepend_default[0]} = 0;
      $uncategorized->{$prepend_default[1]} = __('Uncategorized', 'filebird');

      array_unshift($folders, $all, $uncategorized);
    }
    return $folders;
  }
  public static function countFolder() {
    global $wpdb;
    return $wpdb->get_var("SELECT count(*) as c FROM " . self::getTable(self::$folder_table));
  }
  public static function getRelations() {
    global $wpdb;
    $query = "SELECT `attachment_id`, GROUP_CONCAT(`folder_id`) as folders FROM `{$wpdb->prefix}fbv_attachment_folder` GROUP BY `attachment_id`";
    $relations = $wpdb->get_results($query);
    $res = array();
    foreach($relations as $k => $v) {
      $res[$v->attachment_id] = array_map('intval', explode(',', $v->folders));
    }
    return $res;
  }
  public static function updateOrdAndParent($id, $new_ord, $new_parent) {
    global $wpdb;
    $wpdb->update(
      self::getTable(self::$folder_table),
      array(
        'parent' => $new_parent,
        'ord' => $new_ord
      ),
      array('id' => $id),
      array('%d', '%d'),
      array('%d')
    );
  }
  public static function rawInsert($query) {
    global $wpdb;
    $wpdb->query('INSERT INTO ' . self::getTable(self::$folder_table) . ' ' . $query);
  }
  public static function getFoldersOfPost($post_id) {
    global $wpdb;
    return $wpdb->get_col("SELECT `folder_id` FROM " . self::getTable(self::$relation_table) . " WHERE `attachment_id` = " . (int)$post_id . " GROUP BY `folder_id`");
  }
  public static function setFoldersForPosts($post_ids, $folder_ids, $has_action = true) {
    global $wpdb;
    if(!is_array($post_ids)) $post_ids = array($post_ids);
    if(!is_array($folder_ids)) $folder_ids = array($folder_ids);

    foreach($folder_ids as $k => $folder_id) {
      foreach($post_ids as $k2 => $post_id) {
        // if($delete_first) {
        //   $wpdb->delete(
        //     self::getTable(self::$relation_table),
        //     array('attachment_id' => $post_id),
        //     array('%d')
        //   );
        // }
        do_action('fbv_before_setting_folder', (int)$post_id, (int)$folder_id);
        if($folder_id > 0) {
          $wpdb->insert(
            self::getTable(self::$relation_table),
            array(
              'attachment_id' => (int)$post_id,
              'folder_id' => (int)$folder_id
            ),
            array('%d', '%d')
          );
        }
        if($has_action === true) {
          do_action('fbv_after_set_folder', $post_id, $folder_id);
        }
      }
    }
  }
  public static function detail($name, $parent, $select = 'id') {
    global $wpdb;
    
    $query = "SELECT * FROM " . self::getTable(self::$folder_table) . " WHERE `name` = '".$name."' AND `parent` = '".(int)$parent."'";

    $user_has_own_folder = get_option('njt_fbv_folder_per_user', '0') === '1';
    if($user_has_own_folder) {
      $query .= " AND `created_by` = " . get_current_user_id();
    } else {
      $query .= " AND `created_by` = 0";
    }
    return $wpdb->get_row($query);
  }
  public static function findById($folder_id) {
    global $wpdb;
    $query = "SELECT `id` FROM " . self::getTable(self::$folder_table) . " WHERE `id` = '".(int)$folder_id."'";
    return $wpdb->get_row($query);
  }
  public static function updateFolderName($new_name, $parent, $folder_id) {
    global $wpdb;
    $check_name = $wpdb->get_row("SELECT * FROM " . self::getTable(self::$folder_table) . " WHERE `id` != '".$folder_id."' AND `name` = '".$new_name."' AND `parent` = '".(int)$parent."'");
    
    if(\is_null($check_name)) {
      $wpdb->update(
        self::getTable(self::$folder_table),
        array('name' => $new_name),
        array('id' => $folder_id),
        array('%s'),
        array('%d')
      );
      return true;
    }
    return false;
  }
  public static function updateParent($folder_id, $new_parent) {
    global $wpdb;
    $wpdb->update(
      self::getTable(self::$folder_table),
      array('parent' => $new_parent),
      array('id' => $folder_id),
      array('%d'),
      array('%d')
    );
  }
  public static function deleteAll() {
    global $wpdb;
    $wpdb->query("DELETE FROM " . self::getTable(self::$folder_table));
    $wpdb->query("DELETE FROM " . self::getTable(self::$relation_table));
  }
  public static function deleteFolderAndItsChildren($id) {
    global $wpdb;
    $wpdb->delete(self::getTable(self::$folder_table), array('id' => $id), array('%d'));
    $wpdb->delete(self::getTable(self::$relation_table), array('folder_id' => $id), array('%d'));

    //delete it's children
    $children = $wpdb->get_col("SELECT `id` FROM ".self::getTable(self::$folder_table)." WHERE `parent` = '".(int)$id."'");
    foreach($children as $k => $child) {
      self::deleteFolderAndItsChildren($child);
    }
  }
  public static function newFolder($name, $parent = 0) {
    global $wpdb;
    $data = apply_filters('fbv_data_before_inserting_folder', array(
      'name' => $name,
      'parent' => $parent,
      'type' => 0
    ));
    $wpdb->insert(self::getTable(self::$folder_table), $data);
    return $wpdb->insert_id;
  }
  public static function newOrGet($name, $parent, $return_id_if_exist = true) {
    $check = self::detail($name, $parent);
    if(is_null($check)) {
      return self::newFolder($name, $parent);
    } else {
      return $return_id_if_exist ? (int)$check->id : false;
    }
  }
  public static function deleteFoldersOfPost($post_id) {
    global $wpdb;
    $wpdb->delete(
      self::getTable(self::$relation_table),
      array('attachment_id' => $post_id),
      array('%d')
    );
  }
  public static function getInAndNotInIds($fbv, $allow_filter = false) {
    global $wpdb;
    $query = array(
      'post__not_in' => array(),
      'post__in' => array()
    );

    $select = apply_filters("fbv_in_not_in_select_query", "SELECT `attachment_id` FROM " . self::getTable(self::$relation_table), $fbv, self::getTable(self::$folder_table), self::getTable(self::$relation_table));
    $where_arr = array('1 = 1');
    if($fbv !== -1) {//skip if fbv == -1 (load all)
      if($fbv === 0) {
        //load uncategorized folder
        $where_arr[] = apply_filters(
          'fbv_in_not_in_uncategorized_where',
          "`folder_id` IN (SELECT `id` FROM ".self::getTable(self::$folder_table)." WHERE `created_by` = '0')",
          self::getTable(self::$folder_table)
        );
        $query['post__not_in'] = $wpdb->get_col($select. " WHERE " . implode(' AND ', apply_filters('fbv_in_not_in_where_query', $where_arr, $fbv)));
      } else {
        if(apply_filters('fbv_can_get_in_not_in', true, $fbv)) {
          if( ! is_array($fbv)) {
            $fbv = array($fbv);
          }
          $where_arr[] = "`folder_id` IN (".implode(',', $fbv).")";
          $query['post__in'] = $wpdb->get_col($select. " WHERE " . implode(' AND ', apply_filters('fbv_in_not_in_where_query', $where_arr, $fbv)));
          
          if(count($query['post__in']) == 0) {
            $query['post__in'] = array(-1);
          }
        }
      }
    }
    //for performance reasons, we will have a check here
    return $allow_filter ? apply_filters('fbv_in_not_in', $query) : $query;
  }
  public static function getAuthor($folder_id) {
    global $wpdb;
    return (int)$wpdb->get_var($wpdb->prepare('SELECT `created_by` FROM %1$s WHERE `id` = %2$d', self::getTable(self::$folder_table), $folder_id));
  }

  private static function getTable($table) {
    global $wpdb;
    return $wpdb->prefix . $table;
  }
}