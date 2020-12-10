<?php
namespace FileBird\Classes;

use FileBird\Controller\Convert as ConvertController;
use FileBird\Model\Folder as FolderModel;

defined('ABSPATH') || exit;

class Convert {

    protected static $instance = null;

    public function __construct() {
        add_action( 'admin_notices', array($this, 'adminNotice') );
        add_action('rest_api_init', array($this, 'registerRestFields'));
    }
    public function registerRestFields() {
      register_rest_route(NJFB_REST_URL,
          'fb-import',
          array(
            'methods' => 'POST',
            'callback' => array($this, 'ajaxImport'),
            'permission_callback' => array($this, 'resPermissionsCheck'),
          )
      );
      register_rest_route(NJFB_REST_URL,
          'fb-import-insert-folder',
          array(
            'methods' => 'POST',
            'callback' => array($this, 'ajaxImportInsertFolder'),
            'permission_callback' => array($this, 'resPermissionsCheck'),
          )
      );
      register_rest_route(NJFB_REST_URL,
          'fb-import-after-inserting',
          array(
            'methods' => 'POST',
            'callback' => array($this, 'ajaxImportAfterInserting'),
            'permission_callback' => array($this, 'resPermissionsCheck'),
          )
      );
      register_rest_route(NJFB_REST_URL,
          'fb-no-thanks',
          array(
            'methods' => 'POST',
            'callback' => array($this, 'ajaxNoThanks'),
            'permission_callback' => array($this, 'resPermissionsCheck'),
          )
      );
      //get old data
      register_rest_route(NJFB_REST_URL,
          'fb-get-old-data',
          array(
            'methods' => 'POST',
            'callback' => array($this, 'ajaxGetOldData'),
            'permission_callback' => array($this, 'resPermissionsCheck'),
          )
      );
      //insert old data
      register_rest_route(NJFB_REST_URL,
          'fb-insert-old-data',
          array(
            'methods' => 'POST',
            'callback' => array($this, 'ajaxInsertOldData'),
            'permission_callback' => array($this, 'resPermissionsCheck'),
          )
      );
      //wipe old data
      register_rest_route(NJFB_REST_URL,
          'fb-wipe-old-data',
          array(
            'methods' => 'POST',
            'callback' => array($this, 'ajaxWipeOldData'),
            'permission_callback' => array($this, 'resPermissionsCheck'),
          )
      );
      //wipe old data
      register_rest_route(NJFB_REST_URL,
          'fb-wipe-clear-all-data',
          array(
            'methods' => 'POST',
            'callback' => array($this, 'ajaxClearAllData'),
            'permission_callback' => array($this, 'resPermissionsCheck'),
          )
      );
    }
    public function resPermissionsCheck() {
      return current_user_can("upload_files");
    }
    public function adminNotice() {
        global $pagenow;
        $oldEnhancedFolders = $this->getOldFolders('enhanced', true);
        $oldWpmlfFolders = $this->getOldFolders('wpmlf', true);
        $oldWpmfFolders = $this->getOldFolders('wpmf', true);
        $oldRealMediaFolders = $this->getOldFolders('realmedia', true);
        $newFolders = [];
        
        $sites = array();
        if($pagenow !== 'upload.php' || count($newFolders) > 10) {
          return;
        }
        if(!$this->isUpdated('enhanced') && !$this->isNoThanks('enhanced') && count($oldEnhancedFolders) > 3) {
          $sites[] = array('site' => 'enhanced', 'title' => 'Enhanced Media Library');
        }
        if(!$this->isUpdated('wpmlf') && !$this->isNoThanks('wpmlf') && count($oldWpmlfFolders) > 3) {
          $sites[] = array('site' => 'wpmlf', 'title' => 'Media Library Folders');
        }
        if(!$this->isUpdated('wpmf') && !$this->isNoThanks('wpmf') && count($oldWpmfFolders) > 3) {
          $sites[] = array('site' => 'wpmf', 'title' => 'WP Media folder');
        }
        if(!$this->isUpdated('realmedia') && !$this->isNoThanks('realmedia') && count($oldRealMediaFolders) > 3) {
          $sites[] = array('site' => 'realmedia', 'title' => 'WP Real Media Library');
        }
        foreach($sites as $k => $site) :
          $c = 0;
          if($site['site'] == 'enhanced') {
            $c = count($oldEnhancedFolders);
          } else if($site['site'] == 'wpmlf') {
            $c = count($oldWpmlfFolders);
          } else if($site['site'] == 'wpmf') {
            $c = count($oldWpmfFolders);
          } else if($site['site'] == 'realmedia') {
            $c = count($oldRealMediaFolders);
          }
          ?>
          <div class="njt notice notice-warning <?php echo esc_attr($site['site']); ?> is-dismissible">
            <p>
              <strong><?php _e('Import categories to FileBird', 'filebird'); ?></strong>
            </p>
            <p>
              <?php _e(sprintf(__('We found you have %1$s categories you created from <strong>%2$s</strong> plugin. Would you like to import it to <strong>FileBird</strong>?', 'filebird'), $c, $site['title'])); ?>
            </p>
            <p>
              <a target="_blank" href="<?php echo esc_url(add_query_arg(array('page' => 'filebird-settings', 'tab' => 'import'), admin_url('options-general.php'))); ?>" class="button button-primary"><?php _e('Import Now', 'filebird'); ?></a> 
              <button class="button njt_fb_no_thanks_btn" data-site="<?php echo esc_attr($site['site']); ?>"><?php _e('No, thanks', 'filebird') ?></button> 
            </p>
          </div>
        <?php endforeach; ?>
          <?php
          //import from old version
          /*
          $imported_from_old_version = get_option('fbv_imported_from_old_version', '0');
          if($imported_from_old_version !== '1') {
            ?>
            <div class="njt notice notice-warning is-dismissible">
              <p>
                <strong><?php _e('Import old data to FileBird'); ?></strong>
              </p>
              <p>
                <?php _e(sprintf('Would you like to import old folders from old version to <strong>FileBird</strong>?', $c, $site['title'])); ?>
              </p>
              <p>
                <a target="_blank" href="<?php echo esc_url(add_query_arg(array('page' => 'filebird-settings', 'tab' => 'update-db'), admin_url('options-general.php'))); ?>" class="button button-primary"><?php _e('Import Now'); ?></a> 
              </p>
            </div>
            <?php
          }
          */
      }
      public function ajaxNoThanks() {
        $site = isset($_POST['site'])? sanitize_text_field($_POST['site']) : '';
        // if ( ! wp_verify_nonce( $nonce, 'fbv_nonce' ) ){
        //   wp_send_json_error(array('mess' => __('Nonce error')));
        //   exit();
        // }
        if($site == 'enhanced') {
          update_option('njt_fb_enhanced_no_thanks', '1');
        } else if($site == 'wpmlf') {
          update_option('njt_fb_wpmlf_no_thanks', '1');
        } else if($site == 'wpmf') {
          update_option('njt_fb_wpmf_no_thanks', '1');
        } else if($site == 'realmedia') {
          update_option('njt_fb_realmedia_no_thanks', '1');
        }
        
        wp_send_json_success(array(
          'mess' => __('Success', 'filebird')
        ));
      }

      public function ajaxGetOldData() {
        $folders = ConvertController::getOldFolers();
        $folders_chunk = array_chunk($folders, 20);
        wp_send_json_success(array(
          'folders' => $folders_chunk
        ));
      }
      public function ajaxInsertOldData($request) {
        $folders = isset($request) ? $request->get_params()['folders'] : '';
        if($folders != '') {
          ConvertController::insertToNewTable($folders);
          update_option('fbv_old_data_updated_to_v4', '1');
          wp_send_json_success(array('mess' => __('success', 'filebird')));
        } else {
          wp_send_json_error(array('mess' => __('validation failed', 'filebird')));
        }
      }

      public function ajaxWipeOldData() {
        global $wpdb;
        $queries = array(
          "DELETE FROM ".$wpdb->prefix."termmeta WHERE `term_id` IN (SELECT `term_id` FROM ".$wpdb->prefix."term_taxonomy WHERE `taxonomy` = 'nt_wmc_folder')",
          "DELETE FROM ".$wpdb->prefix."term_relationships WHERE `term_taxonomy_id` IN (SELECT `term_taxonomy_id` FROM ".$wpdb->prefix."term_taxonomy WHERE `taxonomy` = 'nt_wmc_folder')",
          "DELETE FROM ".$wpdb->prefix."terms WHERE `term_id` IN (SELECT `term_id` FROM ".$wpdb->prefix."term_taxonomy WHERE `taxonomy` = 'nt_wmc_folder')",
          "DELETE FROM ".$wpdb->prefix."term_taxonomy WHERE `taxonomy` = 'nt_wmc_folder'"
        );
        foreach ($queries as $k => $query) {
          $wpdb->query($query);
        }
        wp_send_json_success(array(
          'mess' => __('Successfully wiped.', 'filebird')
        ));
      }
      public function ajaxClearAllData() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'fbv';
        if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) ) ) == $table_name ) {
          FolderModel::deleteAll();

          update_option('njt_fb_updated_from_enhanced', '0');
          update_option('njt_fb_updated_from_wpmlf', '0');
          update_option('njt_fb_updated_from_wpmf', '0');
          update_option('njt_fb_updated_from_realmedia', '0');
          wp_send_json_success(array(
            'mess' => __('Successfully cleared.', 'filebird')
          ));
        } else {
          wp_send_json_error(array(
            'mess' => __('Please try again.', 'filebird')
          ));
        }
        
      }
      public function isUpdated($site) {
          global $wpdb;
          $is = false;
          if($site == 'enhanced') {
            $is = get_option('njt_fb_updated_from_enhanced', '0') === '1';
          } else if($site == 'wpmlf') {
            $is = get_option('njt_fb_updated_from_wpmlf', '0') === '1';
          } else if($site == 'wpmf') {
            $is = get_option('njt_fb_updated_from_wpmf', '0') === '1';
          } else if($site == 'realmedia') {
            $is = get_option('njt_fb_updated_from_realmedia', '0') === '1';
          }

          return $is;
      }
      public function isNoThanks($site) {
        global $wpdb;
        if($site == 'enhanced') {
          return get_option('njt_fb_enhanced_no_thanks', '0') === '1';
        } else if($site == 'wpmlf') {
          return get_option('njt_fb_wpmlf_no_thanks', '0') === '1';
        } else if($site == 'wpmf') {
          return get_option('njt_fb_wpmf_no_thanks', '0') === '1';
        } else if($site == 'realmedia') {
          return get_option('njt_fb_realmedia_no_thanks', '0') === '1';
        }
      }
    // public function ajaxImport() {
    //     global $wpdb;
    //     $nonce = isset($_POST['nonce'])? sanitize_text_field($_POST['nonce']) : '';
    //     $site = isset($_POST['site']) ? sanitize_text_field($_POST['site']) : '';
    //     $count = isset($_POST['count']) ? sanitize_text_field($_POST['count']) : '';
    //     $this->beforeGettingNewFolders($site);
    //     $folders = $this->getOldFolders($site);
    //     $this->insertFolderAndItsAtt($site, $folders);
    //     $this->afterInsertingNewFolders($site);
    //     $this->updateUpdated($site);

    //     $mess = sprintf(__('Congratulations! We imported successfully %1$s folders into <strong>FileBird.</strong>'), $count);
    //     wp_send_json_success(array(
    //         'mess' => $mess
    //     ));
    //     exit();
    // }
    public function ajaxImport($request) {
      global $wpdb;
      $site = isset($request) ? sanitize_text_field($request->get_params()['site']) : '';
      //$count = isset($request) ? sanitize_text_field($request->get_params()['count']) : '';

      $this->beforeGettingNewFolders($site);
      $folders = $this->getOldFolders($site, true);
      $count = count($folders);
      $folders = array_chunk($folders, 20);

      wp_send_json_success(array(
        'folders' => $folders,
        'count' => $count,
        'site' => $site
      ));
      exit();
    }
    public function ajaxImportInsertFolder($request) {
      global $wpdb;

      $site = isset($request) ? sanitize_text_field($request->get_params()['site']) : '';
      $folders = isset($request) ? $this->sanitize_arr($request->get_params()['folders']) : '';

      $this->insertFolderAndItsAtt($site, $folders);

      wp_send_json_success();
      exit();
    }
    public function ajaxImportAfterInserting($request) {
      global $wpdb;
      $site = isset($request) ? sanitize_text_field($request->get_params()['site']) : '';
      $count = isset($request) ? sanitize_text_field($request->get_params()['count']) : '';
      $this->afterInsertingNewFolders($site);
      $this->updateUpdated($site);

      $mess = sprintf(__('Congratulations! We imported successfully %d folders into <strong>FileBird.</strong>', 'filebird'), $count);
      wp_send_json_success(array(
          'mess' => $mess
      ));
      exit();
    }
    private function beforeGettingNewFolders($site) {
        if($site == 'enhanced') {
          if(get_option('njt_fb_updated_from_enhanced', '0') == '1') {
            wp_send_json_success(array(
                'mess' => __('Already Updated', 'filebird')
            ));
            exit();
          }
        } else if($site == 'wpmlf') {
          if(get_option('njt_fb_updated_from_wpmlf', '0') == '1') {
            wp_send_json_success(array(
                'mess' => __('Already Updated', 'filebird')
            ));
            exit();
          }
        } else if($site == 'wpmf') {
          if(get_option('njt_fb_updated_from_wpmf', '0') == '1') {
            wp_send_json_success(array(
                'mess' => __('Already Updated', 'filebird')
            ));
            exit();
          }
        } else if($site == 'realmedia') {
          if(get_option('njt_fb_updated_from_realmedia', '0') == '1') {
            wp_send_json_success(array(
                'mess' => __('Already Updated', 'filebird')
            ));
            exit();
          }
        }
    }
    public function getOldFolders($site, $flat = false) {
        global $wpdb;
        $folders = array();
        if($site == 'enhanced') {
          $folders = Helpers::foldersFromEnhanced(0, $flat);
        } else if($site == 'wpmlf') {
          $folders = Helpers::foldersFromWpmlf(0, $flat);
        } else if($site == 'wpmf') {
          $folders = Helpers::foldersFromWpmf(0, $flat);
        } else if($site == 'realmedia') {
          $folders = Helpers::foldersFromRealMedia(-1, $flat);
          foreach($folders as $k => $folder) {
            $folders[$k]->parent = $folder->parent == '-1' ? 0 : $folder->parent;
          }
        }
        return $folders;
    }
    public function insertFolderAndItsAtt($site, $folders) {
        global $wpdb;
        foreach ($folders as $k => $folder) {  
          if(\is_array($folder)) {
            $folder = json_decode(json_encode($folder));
          }
            //insert folder first
            $inserted = FolderModel::newOrGet($folder->title, $folder->parent);
            update_option('njt_new_term_id_' . $folder->id, $inserted);
            if($folder->parent > 0) {
                $new_parent = get_option('njt_new_term_id_' . $folder->parent);
                FolderModel::updateParent($inserted, $new_parent);
            }
            $atts = $this->getAttOfFolder($site, $folder);
            FolderModel::setFoldersForPosts($atts, $inserted);
        }
    }
    public function getAttOfFolder($site, $folder) {
        global $wpdb;
        $att = array();
        if(is_array($folder)) {
          $folder = json_decode(json_encode($folder));
        }

        if($site == 'enhanced') {
          $att = $wpdb->get_col($wpdb->prepare('SELECT object_id FROM %1$s WHERE term_taxonomy_id = %2$d', $wpdb->term_relationships, $folder->term_taxonomy_id));
        } else if($site == 'wpmlf') {
          $folder_table = $wpdb->prefix . 'mgmlp_folders';
          $sql = "select ID from {$wpdb->prefix}posts 
          LEFT JOIN $folder_table ON({$wpdb->prefix}posts.ID = $folder_table.post_id)
          LEFT JOIN {$wpdb->prefix}postmeta AS pm ON (pm.post_id = {$wpdb->prefix}posts.ID) 
          where post_type = 'attachment' 
          and folder_id = '$folder->id'
          AND pm.meta_key = '_wp_attached_file' 
          order by post_date desc";
          $att = $wpdb->get_col($sql);
        } else if($site == 'wpmf') {
          $att = $wpdb->get_col($wpdb->prepare('SELECT object_id FROM %1$s WHERE term_taxonomy_id = %2$d', $wpdb->term_relationships, $folder->term_taxonomy_id));
        } else if($site == 'realmedia') {
          $folder_table = $wpdb->prefix . 'realmedialibrary_posts';
          $att = $wpdb->get_col($wpdb->prepare('SELECT attachment FROM %1$s WHERE fid = %2$d', $folder_table, $folder->id));
        }
        return $att;
    }
    private function afterInsertingNewFolders($site) {
        global $wpdb;
        $wpdb->delete($wpdb->termmeta, array('meta_key' => 'njt_old_term_id'));
    }
    private function updateUpdated($site) {
        if($site == 'enhanced') {
            update_option('njt_fb_updated_from_enhanced', '1');
        } else if($site == 'wpmlf') {
            update_option('njt_fb_updated_from_wpmlf', '1');
        } else if($site == 'wpmf') {
            update_option('njt_fb_updated_from_wpmf', '1');
        } else if($site == 'realmedia') {
            update_option('njt_fb_updated_from_realmedia', '1');
        }
    }
    public static function getInstance() {
        if (null == self::$instance) {
          self::$instance = new self;
        }
        return self::$instance;
    }
    private function sanitize_arr($arr) {
      if(is_array($arr)) {
        return array_map(array($this, 'sanitize_arr'), $arr);
      } else {
        return sanitize_text_field($arr);
      }
    }
}
