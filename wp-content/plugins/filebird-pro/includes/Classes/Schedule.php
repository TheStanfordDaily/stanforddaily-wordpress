<?php
namespace FileBird\Classes;

defined('ABSPATH') || exit;

class Schedule {
  private static $_instance = null;

  public function __constructor() {
    add_action( 'filebird_remove_zip_files', array($this, 'actionRemoveZipFiles') );
  }

  public static function registerShedule() {
    if (! wp_next_scheduled ( 'filebird_remove_zip_files' )) {
      wp_schedule_event( time(), 'daily', 'filebird_remove_zip_files' );
    }
  }
  public static function clearSchedule() {
    wp_clear_scheduled_hook( 'filebird_remove_zip_files' );
  }
  public function actionRemoveZipFiles() {
    $upload_folder = WP_CONTENT_DIR . DIRECTORY_SEPERATOR . $root_folder . DIRECTORY_SEPARATOR;
    $files = scandir($upload_folder);
    foreach($files as $k => $file) {
      $created_at = filemtime($upload_folder . $file);
      if((time() - $created_at) >= (24 * 60 * 60)) {
        @unlink($upload_folder . $file);
      }
    }
  }
  public static function instance() {
    if(is_null(self::$_instance)) self::$_instance = new self;
    return self::$_instance;
  }
}