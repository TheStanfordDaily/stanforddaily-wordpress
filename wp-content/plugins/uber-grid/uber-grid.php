<?php /*
Plugin Name: Uber Grid
Plugin URI: http://codecanyon.net
Description: Powerful grid plugin for WordPress
Author: Nikolay Karev
Version: 2.9.2
*/

require_once(ABSPATH . "/wp-admin/includes/plugin.php");
load_plugin_textdomain('uber-grid', false, dirname(plugin_basename(__FILE__)) . '/languages/');
$ubergrid_plugin_data = get_plugin_data(__FILE__);
define('UBERGRID_VERSION', $ubergrid_plugin_data['Version']);
define('UBERGRID_MAIN', __FILE__);
define('UBERGRID_REQUIRED_WP', '4.0');
define('UBERGRID_PATH', dirname(__FILE__) . "/");
define('UBERGRID_URL', trailingslashit(plugins_url(basename(dirname((__FILE__))))));
define('UBERGRID_TIMTHUMB_URL', UBERGRID_URL . "timthumb.php");
define('UBERGRID_POST_TYPE', 'uber-grid');

require(UBERGRID_PATH . "admin/support.class.php");
require(UBERGRID_PATH . "admin/environment.class.php");

function ubergrid_add_thumbnail_size($sizes) {
  $sizes['ubergrid_thumbnail'] = 'UberGrid thumbnail';
  return $sizes;
}
add_image_size('ubergrid_thumbnail', 800, 600, false);
add_filter('image_size_names_choose', 'ubergrid_add_thumbnail_size');

global $ubergrid_environment;
$ubergrid_environment = new UberGrid_Environment();
function ubergrid_require_array($files) {
  foreach ($files as $file) {
    require (UBERGRID_PATH . $file);
  }
}
if ($ubergrid_environment->load_requirements_met()){
  ubergrid_require_array(array(
    'functions.php',
    'post-types.php',
    'array-helper.class.php',
    'grid.class.php',
    'cell.class.php',
    'templated-cell.class.php',
    'shortcodes.php',
    'widgets.php'
  ));
  if (is_admin()) {
    require(UBERGRID_PATH . 'ajax.php');
    require(UBERGRID_PATH . 'admin/grid-editor.php');
    require(UBERGRID_PATH . 'admin/grid-list.php');
    require(UBERGRID_PATH . 'admin/settings.class.php');
    require(UBERGRID_PATH . 'admin/pointers.php');
  }
}
