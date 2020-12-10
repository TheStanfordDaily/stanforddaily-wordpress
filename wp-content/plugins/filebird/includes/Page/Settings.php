<?php
namespace FileBird\Page;

use FileBird\Model\Folder as FolderModel;
use FileBird\Classes\Helpers as Helpers;

defined('ABSPATH') || exit;
/**
 * Settings Page
 */
class Settings {
  protected static $instance = null;
  
  public static function getInstance() {
    if (null == self::$instance) {
      self::$instance = new self;
    }
    
    return self::$instance;
  }

  private $pageId = null;

  private function __construct() {
    add_action('admin_menu', array($this, 'settingsMenu'));
    add_action('admin_enqueue_scripts', array($this, 'enqueueAdminScripts'));

    add_filter('plugin_action_links_' . NJFB_PLUGIN_BASE_NAME, array($this, 'addActionLinks'));
    add_filter('plugin_row_meta', array($this, 'plugin_row_meta'), 10, 2);
    add_action('admin_init', array($this, 'registerSettings'));
  }

  public function settingsMenu() {
    add_submenu_page(
      'options-general.php',
      __('FileBird', 'filebird'),
      __('FileBird', 'filebird'),
      'manage_options',
      $this->getPageId(),
      array($this, 'settingsPage')
    );
  }

  public function settingsPage() {
    $helpers = new Helpers();
    $viewPath = NJFB_PLUGIN_PATH . 'views/pages/html-settings.php';
    include_once $viewPath;
  }

  public function plugin_row_meta($links, $file){
    if ( strpos( $file, 'filebird.php' ) !== false ) {
      $new_links = array(
        'doc' => '<a href="https://ninjateam.gitbook.io/filebird/" target="_blank">'. __("Documentation", "filebird") .'</a>'
      );
      
      $links = array_merge( $links, $new_links );
    }
    
    return $links;
  }

  public function addActionLinks($links) {
    $settingsLinks = array(
      '<a href="' . admin_url('options-general.php?page=' . $this->getPageId()) . '">Settings</a>',
    );

    $links[] = '<a target="_blank" href="https://1.envato.market/FileBirdPro" style="color: #43B854; font-weight: bold">' . __('Go Pro', 'filebird') . '</a>';
    return array_merge($settingsLinks, $links);
  }

  public function enqueueAdminScripts($screenId) {
    $allowed_pages = array('upload.php', 'settings_page_filebird');
    if (in_array($screenId, $allowed_pages)) {
    }
  }

  public function getPageId() {
    if (null == $this->pageId) {
      $this->pageId = NJFB_PREFIX . '-settings';
    }

    return $this->pageId;
  }
  public function registerSettings()
  {
    $settings = array(
        'njt_fbv_folder_per_user',
        'njt_fbv_default_folder'
    );
    foreach ($settings as $k => $v) {
        register_setting('njt_fbv', $v);
    }
  }
}
