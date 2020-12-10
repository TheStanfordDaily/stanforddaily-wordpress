<?php
namespace FileBird\Controller;

use FileBird\Model\Folder as FolderModel;

defined('ABSPATH') || exit;

class CompatiblePolylang extends Controller {
  protected static $instance = null;

  private $active;
  private $total;
  private $table_filebird_polylang;
  public $delete_process_id;
  private $lang;

  public function __construct() {
    global $wpdb, $polylang;

    $this->total = 0;
    $this->delete_process_id = null;

    $this->active = function_exists("pll_get_post_translations");
    if ($this->active) {
      if ($polylang->options['media_support'] == 1)
      {
        $this->lang = PLL()->model->get_language( get_user_meta( get_current_user_id(), 'pll_filter_content', true ) );
        add_action('pll_translate_media', array($this, 'duplicateAttachmentToFolder'), 10, 3);
        //add_filter( 'pll_filter_query_excluded_query_vars', array($this, 'excludedQueryVars'), 10, 3);
        // add_filter('fbv_in_not_in_select_query', array($this, 'inNotInSelectQuery'), 10, 4);
        // add_filter('fbv_in_not_in_where_query', array($this, 'inNotInWhereQuery'), 10, 2);
        add_filter('fbv_count_args', array($this, 'countArgs'));
      }
    }
  }

  public function duplicateAttachmentToFolder($post_id, $tr_id, $lang_slug) {
    $folders_of_source = FolderModel::getFoldersOfPost($post_id);
    FolderModel::setFoldersForPosts($tr_id, $folders_of_source);
  }
  public function excludedQueryVars($excludes, $query, $lang) {
    if(isset($query->query['fbv_count']) && $query->query_vars['post_type'] == 'attachment' ) {
      $excludes = array_values(array_diff($excludes, array('post__in', 'post__not_in')));
    }
    return $excludes;
  }
  public function inNotInSelectQuery($query, $fbv, $fbv_table, $fbv_relation_table) {
    global $wpdb;
    if($fbv !== 0 && is_object($this->lang)) {
      $query = "SELECT `attachment_id` FROM " . 
      $fbv_relation_table .
      " JOIN ".$wpdb->prefix."term_relationships ON " .
      $fbv_relation_table . ".attachment_id = ".$wpdb->prefix."term_relationships.object_id ";
    }
    return $query;
  }
  public function inNotInWhereQuery($where, $fbv) {
    if($fbv !== 0 && is_object($this->lang)) {
      $where[] = 'term_taxonomy_id = ' . $this->lang->term_taxonomy_id;
    }
    return $where;
  }
  public function countArgs($args) {
    if(is_object($this->lang)) {
      $args['lang'] = $this->lang->slug;
    }
    
    return $args;
  }
  public static function getInstance() {
    if (null == self::$instance) {
      self::$instance = new self;
    }
    return self::$instance;
  }
}
