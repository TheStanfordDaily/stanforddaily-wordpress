<?php
defined('ABSPATH') || exit;

use FileBird\Classes\TabActive;
use FileBird\Classes\Helpers;
use FileBird\Classes\Tree;

$countEnhancedFolder = count($helpers::foldersFromEnhanced(0, true));
$countWpmlfFolder = count($helpers::foldersFromWpmlf(0, true));
$countWpmfFolder = count($helpers::foldersFromWpmf(0, true));
$countRealMediaFolder = count($helpers::foldersFromRealMedia(-1, true));

$allFolders = Tree::getFolders(null, true, 0, true);

$tabs = array(
  array(
    'id' => 'settings',
    'name' => __('Settings', 'filebird'),
    'content' => Helpers::view('pages/settings/tab-settings', array(
      'allFolders' => $allFolders
    ))
  ),
  array(
    'id' => 'update-db',
    'name' => __('Update Database', 'filebird'),
    'content' => Helpers::view('pages/settings/tab-update-database')
  ),
  array(
    'id' => 'api',
    'name' => __('API', 'filebird'),
    'content' => Helpers::view('pages/settings/tab-api')
  ),
  array(
    'id' => 'uninstall',
    'name' => __('Uninstall', 'filebird'),
    'content' => Helpers::view('pages/settings/tab-uninstall')
  ),
  // array(
  //   'id' => 'active',
  //   'name' => __('Active', 'filebird'),
  //   'content' => TabActive::renderHtml(false)
  // ),
);
$current_tab = (isset($_GET['tab']) ? $_GET['tab'] : $tabs[0]['id']);
if(($countEnhancedFolder + $countWpmlfFolder + $countWpmfFolder + $countRealMediaFolder) > 0) {
  $tabs[] = array(
    'id' => 'import',
    'name' => __('Import', 'filebird'),
    'content' => Helpers::view('pages/settings/tab-import', array(
      'countEnhancedFolder' =>  $countEnhancedFolder,
      'countWpmlfFolder' => $countWpmlfFolder,
      'countWpmfFolder' => $countWpmfFolder,
      'countRealMediaFolder' => $countRealMediaFolder
    ))
  );
}
?>
<div class="wrap">
  <h1><?php _e('FileBird Settings'); ?></h1>
  <form action="options.php" method="POST" id="post" autocomplete="off">
    <?php settings_fields('njt_fbv'); ?>
    <?php do_settings_sections('njt_fbv'); ?>
    <nav class="nav-tab-wrapper">
      <?php
      foreach($tabs as $k => $tab) {
        $active = ($tab['id'] == $current_tab) ? 'nav-tab-active' : '';
        echo sprintf('<a data-id="%s" href="#" class="nav-tab fbv-tab-name %s">%s</a>', $tab['id'], $active, $tab['name']);
      }
      ?>
    </nav>
    <?php
    foreach($tabs as $k => $tab) {
      $class = ($tab['id'] == $current_tab) ? '' : 'hidden';
      echo sprintf('<div id="fbv-settings-tab-%s" class="fbv-tab-content %s">%s</div>', $tab['id'], $class, $tab['content']);
    }
    ?>
  </form>
</div>
<script>
    jQuery(document).ready(function($){
      jQuery('.fbv-tab-name').on('click', function(){
        var $this = jQuery(this)

        jQuery('.fbv-tab-name').removeClass('nav-tab-active');
        $this.addClass('nav-tab-active');

        jQuery('.fbv-tab-content').addClass('hidden');
        jQuery('#fbv-settings-tab-' + $this.attr('data-id')).removeClass('hidden')

        return false;
      })
    })
  </script>
<?php
if(isset($_GET['autorun']) && ($_GET['autorun'] == 'true')) {
  ?>
  <script>
    var njt_auto_run_import = true;
    var njt_fb_settings_page = '<?php echo add_query_arg(array('page' => 'filebird-settings', 'tab' => 'update-db'), admin_url('options-general.php')); ?>';
    jQuery(document).ready(function($){
      jQuery('.njt_fbv_import_from_old_now').click();
    })
  </script>
  <?php
}
?>