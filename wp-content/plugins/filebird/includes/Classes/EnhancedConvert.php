<?php
namespace FileBird\Classes;

use FileBird\Model\Folder as FolderModel;

defined('ABSPATH') || exit;

class EnhancedConvert {

    protected static $instance = null;

    public function __construct() {
        add_action('rest_api_init', array($this, 'registerRestFields'));
    }
    
    public function registerRestFields() {
        register_rest_route(NJFB_REST_URL,
            'convert-from-enhanced',
            array(
              'methods' => 'POST',
              'callback' => array($this, 'ajaxConvertFromEnhanced'),
              'permission_callback' => array($this, 'resPermissionsCheck'),
            )
        );
    }
    public function resPermissionsCheck() {
        return current_user_can("upload_files");
    }
    public static function getInstance() {
        if (null == self::$instance) {
          self::$instance = new self;
        }
        
        return self::$instance;
    }

    public function ajaxConvertFromEnhanced() {
        global $wpdb;
       
        //check_ajax_referer('fbv_nonce', 'nonce', true);
        if(get_option('njt_fbv_updated_from_enhanced', '0') == '1') {
            wp_send_json_success(array(
                'mess' => __('Already Updated', 'filebird')
            ));
        }
        $folders = $this->getOldFolders();
        $this->insertFolderAndItsAtt($folders);
        $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'njt_new_term_id_%'");

        update_option('njt_fbv_updated_from_enhanced', 1);
        wp_send_json_success(array(
            'mess' => __('Updated', 'filebird')
        ));
    }

    public function insertFolderAndItsAtt($folders) {
        global $wpdb;
        foreach ($folders as $k => $folder) {            
            //insert folder first
            $inserted = FolderModel::newOrGet($folder->name, $folder->parent);
            update_option('njt_new_term_id_' . $folder->term_id, $inserted);
            if($folder->parent > 0) {
                $new_parent = get_option('njt_new_term_id_' . $folder->parent);
                FolderModel::updateParent($inserted, $new_parent);
            }
            $atts = $this->getAttOfFolder($folder);
            FolderModel::setFoldersForPosts($atts, $inserted);
            if(isset($folder->children)) {
                $this->insertFolderAndItsAtt($folder->children);
            }
        }
    }

    public function getOldFolders($parent = 0) {
        global $wpdb;
        $folders = $wpdb->get_results($wpdb->prepare('SELECT t.term_id, t.name, tt.term_taxonomy_id FROM %1$s as t  INNER JOIN %2$s as tt ON (t.term_id = tt.term_id) WHERE tt.taxonomy = \'media_category\' AND tt.parent = %3$d', $wpdb->terms, $wpdb->term_taxonomy, $parent));
        foreach ($folders as $k => $folder) {
            $folders[$k]->children = $this->getOldFolders($folder->term_id);
            $folders[$k]->parent = $parent;
        }
        return $folders;
    }

    public function getAttOfFolder($folder) {
        global $wpdb;
        return $wpdb->get_col($wpdb->prepare('SELECT object_id FROM %1$s WHERE term_taxonomy_id = %2$d', $wpdb->term_relationships, $folder->term_taxonomy_id));
    }

}
