<?php
namespace FileBird\Controller;

defined('ABSPATH') || exit;

use FileBird\Model\Folder as FolderModel;

class FolderUser extends Controller {
  protected static $instance = null;

  private $is_enabled;
  private $current_user_id;

  public function __construct() {
    $this->is_enabled = $this->isEnabled();
    $this->current_user_id = get_current_user_id();

    if($this->is_enabled) {
      add_filter('fbv_data_before_inserting_folder', array($this, 'filterDataBeforeInsertingFolder')); 
      add_filter('fbv_getting_folders_where', array($this, 'filterGettingFoldersWhere'));
      add_filter('fbv_can_get_in_not_in', array($this, 'filterCanGetInNotIn'), 10, 2);
      add_filter('fbv_in_not_in_uncategorized_where', array($this, 'filterUncategorizedWhere'), 10, 2);
    }
    add_action('fbv_before_setting_folder', array($this, 'actionBeforeSettingFolder'), 10, 2);
  }
  
  public function filterDataBeforeInsertingFolder($data) {
    $data['created_by'] = $this->current_user_id;
    return $data;
  }
  public function filterGettingFoldersWhere($where) {
    $where['created_by'] = $this->current_user_id;
    return $where;
  }
  public function filterCanGetInNotIn($can, $folder) {
    if ( false === ( $author = get_transient( 'fbv_transient_' . $folder ) ) ) {
      $author = FolderModel::getAuthor($folder);
      set_transient( 'fbv_transient_' . $folder, $author, (3600 * 365) );//1 year
    }
    $author = FolderModel::getAuthor($folder);
    return (int)$author === $this->current_user_id;
  }
  public function filterUncategorizedWhere($where, $folder_table) {
    return sprintf('`folder_id` IN (SELECT `id` FROM %1$s WHERE `created_by` = %2$d)', $folder_table, $this->current_user_id);
  }

  public function actionBeforeSettingFolder($post_id, $folder_id) {
    global $wpdb;
    if($this->is_enabled) {
      $query = sprintf('DELETE FROM %1$sfbv_attachment_folder WHERE `attachment_id` = %2$d AND `folder_id` IN (SELECT `id` FROM %1$sfbv WHERE `created_by` = %3$d)', $wpdb->prefix, $post_id, $this->current_user_id);
      $wpdb->query($query);
    } else {
      $wpdb->query(sprintf('DELETE FROM %1$sfbv_attachment_folder WHERE `attachment_id` = %2$d AND `folder_id` IN (SELECT `id` FROM %1$sfbv WHERE `created_by` = 0)', $wpdb->prefix, $post_id));
    }
  }
  private function isEnabled() {
    return get_option('njt_fbv_folder_per_user', '0') === '1';
  }
  public static function getInstance() {
    if (null == self::$instance) {
      self::$instance = new self;
    }
    return self::$instance;
  }
}
