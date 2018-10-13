<?php
/**
* Plugin Name: Insert Headers and Footers
* Plugin URI: http://www.wpbeginner.com/
* Version: 1.4.3
* Author: WPBeginner
* Author URI: http://www.wpbeginner.com/
* Description: Allows you to insert code or text in the header or footer of your WordPress blog
* License: GPL2
*/

/*  Copyright 2016 WPBeginner

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
* Insert Headers and Footers Class
*/
class InsertHeadersAndFooters {
	/**
	* Constructor
	*/
	public function __construct() {

		// Plugin Details
        $this->plugin               = new stdClass;
        $this->plugin->name         = 'insert-headers-and-footers'; // Plugin Folder
        $this->plugin->displayName  = 'Insert Headers and Footers'; // Plugin Name
        $this->plugin->version      = '1.4.2';
        $this->plugin->folder       = plugin_dir_path( __FILE__ );
        $this->plugin->url          = plugin_dir_url( __FILE__ );
        $this->plugin->db_welcome_dismissed_key = $this->plugin->name . '_welcome_dismissed_key';

        // Check if the global wpb_feed_append variable exists. If not, set it.
        if ( ! array_key_exists( 'wpb_feed_append', $GLOBALS ) ) {
              $GLOBALS['wpb_feed_append'] = false;
        }

		// Hooks
		add_action( 'admin_init', array( &$this, 'registerSettings' ) );
        add_action( 'admin_menu', array( &$this, 'adminPanelsAndMetaBoxes' ) );
        add_action( 'wp_feed_options', array( &$this, 'dashBoardRss' ), 10, 2 );
        add_action( 'admin_notices', array( &$this, 'dashboardNotices' ) );
        add_action( 'wp_ajax_' . $this->plugin->name . '_dismiss_dashboard_notices', array( &$this, 'dismissDashboardNotices' ) );

        // Frontend Hooks
        add_action( 'wp_head', array( &$this, 'frontendHeader' ) );
		add_action( 'wp_footer', array( &$this, 'frontendFooter' ) );

		// Filters
		add_filter( 'dashboard_secondary_items', array( &$this, 'dashboardSecondaryItems' ) );
	}

    /**
     * Number of Secondary feed items to show
     */
	function dashboardSecondaryItems() {
		return 6;
	}

    /**
     * Update the planet feed to add the WPB feed
     */
    function dashboardRss( $feed, $url ) {
        // Return early if not on the right page.
        global $pagenow;
        if ( 'admin-ajax.php' !== $pagenow ) {
            return;
        }

        // Return early if not on the right feed.
        if ( strpos( $url, 'planet.wordpress.org' ) === false ) {
            return;
        }

        // Only move forward if this action hasn't been done already.
        if ( ! $GLOBALS['wpb_feed_append'] ) {
            $GLOBALS['wpb_feed_append'] = true;
            $urls = array( 'http://www.wpbeginner.com/feed/', $url );
            $feed->set_feed_url( $urls );
        }
    }

    /**
     * Show relevant notices for the plugin
     */
    function dashboardNotices() {
        global $pagenow;

        if ( !get_option( $this->plugin->db_welcome_dismissed_key ) ) {
        	if ( ! ( $pagenow == 'options-general.php' && isset( $_GET['page'] ) && $_GET['page'] == 'insert-headers-and-footers' ) ) {
	            $setting_page = admin_url( 'options-general.php?page=' . $this->plugin->name );
	            // load the notices view
                include_once( $this->plugin->folder . '/views/dashboard-notices.php' );
        	}
        }
    }

    /**
     * Dismiss the welcome notice for the plugin
     */
    function dismissDashboardNotices() {
    	check_ajax_referer( $this->plugin->name . '-nonce', 'nonce' );
        // user has dismissed the welcome notice
        update_option( $this->plugin->db_welcome_dismissed_key, 1 );
        exit;
    }

	/**
	* Register Settings
	*/
	function registerSettings() {
		register_setting( $this->plugin->name, 'ihaf_insert_header', 'trim' );
		register_setting( $this->plugin->name, 'ihaf_insert_footer', 'trim' );
	}

	/**
    * Register the plugin settings panel
    */
    function adminPanelsAndMetaBoxes() {
    	add_submenu_page( 'options-general.php', $this->plugin->displayName, $this->plugin->displayName, 'manage_options', $this->plugin->name, array( &$this, 'adminPanel' ) );
	}

    /**
    * Output the Administration Panel
    * Save POSTed data from the Administration Panel into a WordPress option
    */
    function adminPanel() {
		// only admin user can access this page
		if ( !current_user_can( 'administrator' ) ) {
			echo '<p>' . __( 'Sorry, you are not allowed to access this page.', $this->plugin->name ) . '</p>';
			return;
		}

    	// Save Settings
        if ( isset( $_REQUEST['submit'] ) ) {
        	// Check nonce
			if ( !isset( $_REQUEST[$this->plugin->name.'_nonce'] ) ) {
	        	// Missing nonce
	        	$this->errorMessage = __( 'nonce field is missing. Settings NOT saved.', $this->plugin->name );
        	} elseif ( !wp_verify_nonce( $_REQUEST[$this->plugin->name.'_nonce'], $this->plugin->name ) ) {
	        	// Invalid nonce
	        	$this->errorMessage = __( 'Invalid nonce specified. Settings NOT saved.', $this->plugin->name );
        	} else {
	        	// Save
				// $_REQUEST has already been slashed by wp_magic_quotes in wp-settings
				// so do nothing before saving
	    		update_option( 'ihaf_insert_header', $_REQUEST['ihaf_insert_header'] );
	    		update_option( 'ihaf_insert_footer', $_REQUEST['ihaf_insert_footer'] );
	    		update_option( $this->plugin->db_welcome_dismissed_key, 1 );
				$this->message = __( 'Settings Saved.', $this->plugin->name );
			}
        }

        // Get latest settings
        $this->settings = array(
			'ihaf_insert_header' => esc_html( wp_unslash( get_option( 'ihaf_insert_header' ) ) ),
			'ihaf_insert_footer' => esc_html( wp_unslash( get_option( 'ihaf_insert_footer' ) ) ),
        );

    	// Load Settings Form
        include_once( WP_PLUGIN_DIR . '/' . $this->plugin->name . '/views/settings.php' );
    }

    /**
	* Loads plugin textdomain
	*/
	function loadLanguageFiles() {
		load_plugin_textdomain( $this->plugin->name, false, $this->plugin->name . '/languages/' );
	}

	/**
	* Outputs script / CSS to the frontend header
	*/
	function frontendHeader() {
		$this->output( 'ihaf_insert_header' );
	}

	/**
	* Outputs script / CSS to the frontend footer
	*/
	function frontendFooter() {
		$this->output( 'ihaf_insert_footer' );
	}

	/**
	* Outputs the given setting, if conditions are met
	*
	* @param string $setting Setting Name
	* @return output
	*/
	function output( $setting ) {
		// Ignore admin, feed, robots or trackbacks
		if ( is_admin() || is_feed() || is_robots() || is_trackback() ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - both headers and footers via filters
		if ( apply_filters( 'disable_ihaf', false ) ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - footer only via filters
		if ( 'ihaf_insert_footer' == $setting && apply_filters( 'disable_ihaf_footer', false ) ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - header only via filters
		if ( 'ihaf_insert_header' == $setting && apply_filters( 'disable_ihaf_header', false ) ) {
			return;
		}

		// Get meta
		$meta = get_option( $setting );
		if ( empty( $meta ) ) {
			return;
		}
		if ( trim( $meta ) == '' ) {
			return;
		}

		// Output
		echo wp_unslash( $meta );
	}
}

$ihaf = new InsertHeadersAndFooters();