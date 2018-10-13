<?php

class Pico_Setup {

    /**
    * Add key to DB
    * @return [type] [description]
    */
    public static function add_publisher_info($publisher_id, $api_key) {
        global $wpdb;

        $wpdb->insert(($wpdb->prefix). 'pico', array(
            'status' => true,
            'publisher_id' => $publisher_id,
            'api_key' => $api_key
        ));
        return true;
    }

    /**
    * After clicking the deactivate button, it removes the key
    * from the wp_pico table as well as the cached transient
    * @return [type] [description]
    */
    public static function deactivate_key() {
        global $wpdb;
        $wpdb->delete(($wpdb->prefix). 'pico',
            array('status' => true)
        );

        delete_transient( 'pico_publisher_id');

        return true;
    }

    /**
    * Gets API
    * @return [string] API endpoint
    */
    public static function get_api_endpoint() {
        return defined('PP_API_ENDPOINT') ? PP_API_ENDPOINT : 'https://api.pico.tools';
    }

    /**
    * Gets widget endpoint
    * @return [string] widget endpoint
    */
    public static function get_widget_endpoint() {
        return defined('PP_WIDGET_ENDPOINT') ? PP_WIDGET_ENDPOINT : 'https://widget.pico.tools';
    }

    /**
     * Gets the publisher id
     *
     * @return [string || array| The publisher id
     */
    public static function get_publisher_id($include_key = false) {

        // Do we have this information in our transients already?
        $publisher_id_transient = get_transient( 'pico_publisher_id' );
        $api_key_transient = get_transient( 'pico_api_key ');


        if ($include_key) {
            if ( !empty($publisher_id_transient) && !empty($api_key_transient) ) {
                $key_included_array = array(
                    'api_key' => $api_key_transient,
                    'publisher_id' => $publisher_id_transient
                );
            } else {
                global $wpdb;
                $pico_table = ($wpdb->prefix) . 'pico';
                $result = $wpdb->get_results("SELECT publisher_id, api_key FROM " .($pico_table). " WHERE status = true LIMIT 1");
                if (count($result) > 0) {
                    $res = $result[0];
                    $key_included_array = array(
                        "api_key" => $res->api_key,
                        "publisher_id" => $res->publisher_id
                    );
                    // Save the version so we don't have to call again for an hour
                    set_transient( 'pico_publisher_id', $res->publisher_id, 3600);
                    set_transient( 'pico_api_key', $res->api_key, 3600);
                } else {
                    $key_included_array = null;
                }
            }
            // The function will return here the first time it is run
            // and each time the transient expires
            return $key_included_array;
        } else {
            if ( !empty($publisher_id_transient) ) {
                return $publisher_id_transient;
            } else {
                global $wpdb;
                $pico_table = ($wpdb->prefix) . 'pico';
                $result = $wpdb->get_results("SELECT publisher_id FROM " .($pico_table). " WHERE status = true LIMIT 1");
                if (count($result) > 0) {
                    $res = $result[0];
                    $publisher_id = $res->publisher_id;
                } else {
                    $publisher_id = null;
                }
                // Save the version so we don't have to call again for an hour
                // The function will return here the first time it is run
                // and each time the transient expires
                set_transient( 'pico_publisher_id', $publisher_id, 3600);
                return $publisher_id;
            }
        }
    }

    /**
     * Setting the version of the read-more.js to the etag of the widget code
     * in case publishers are using caching plugins
     *
     * @return string The version to use.
     */
    public static function get_widget_version_info() {

        // Do we have this information in our transients already?
        $transient = get_transient( 'pico_widget_version' );
        $publisher_id = self::get_publisher_id(false);
        $widget_endpoint = self::get_widget_endpoint();
        if( !empty($transient) ) {
            // The function will return here every time after the first time it is run, until the transient expires.
            return $transient;
        } else {
            $url = $widget_endpoint . '/static/js/bundle.js?client_id=' . $publisher_id;

            // Get the widget code and grab the etag from the header.
            $response = wp_remote_get( $url );

            // default version is the current time
            $version = date('m.d.y.H.i');

            if (is_array($response) && isset($response['headers']['etag'])) {
                // remove quotes and W/ from etag
                $version = str_replace('"', '', str_replace('W/', '', $response['headers']['etag']));
            }

            // Save the version so we don't have to call again for 10 minutes (600 seconds)
            set_transient( 'pico_widget_version', $version, 600);

            // The function will return here the first time it is run
            // and each time the transient expires
            return $version;
        }
    }

    public static function create_table() {
        global $wpdb;
        $pico_table = $wpdb->prefix . 'pico';
        $charset_collate = $wpdb->get_charset_collate();
        if( $wpdb->get_var( "show tables like '{$pico_table}'" ) != $pico_table ) {
            $sql = "CREATE TABLE $pico_table (
                id int(11) NOT NULL AUTO_INCREMENT,
                publisher_id varchar(1000) NOT NULL,
                api_key varchar(1000) NOT NULL,
                status boolean NOT NULL,
                UNIQUE KEY id (id)
            ) $charset_collate;";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    /**
	 * Attached to activate_{ plugin_basename( __FILES__ ) } by register_activation_hook()
	 * @static
	 */
	public static function plugin_activation($network_wide) {
		if ( version_compare( $GLOBALS['wp_version'], PICO__MINIMUM_WP_VERSION, '<' ) ) {
            wp_die(sprintf('Pico %s requires WordPress %s or higher.', PICO_VERSION, PICO__MINIMUM_WP_VERSION ) . sprintf('Please <a href="%1$s">upgrade WordPress</a> to a current version.', 'https://codex.wordpress.org/Upgrading_WordPress'));
        } elseif (is_multisite() && $network_wide) {
            wp_die('Pico can not be enabled as a network wide plugin. Please enable for individual sites within your network.', 'Network Activate is not supported', array('back_link'=>true));
        } elseif (is_multisite() && !$network_wide) {
            // create table for the current blog
            self::create_table();
        } else {
            // not multisite, just go ahead as usual
            self::create_table();
        }
	}

	/**
	 * Removes all connection options
	 * @static
	 */
	public static function plugin_deactivation( ) {
        delete_transient('pico_publisher_id');
        delete_transient('pico_widget_version');
        return self::deactivate_key();
    }

	/**
	 * Removes pico table
	 */
	public static function plugin_uninstall( ) {
        global $wpdb;
        $pico_table = $wpdb->prefix . 'pico';

        $sql = "DROP TABLE IF EXISTS " . $pico_table;
        $wpdb->query($sql);
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    }
    /**
	 * Wrapper for uninstall that will check whether the uninstall is happening on the network view
	 * @static
     * https://surniaulula.com/2013/10/24/wordpress-multisite-activate-deactivate-and-uninstall/
	 */
    public static function network_uninstall() {
        self::do_multisite( array( __CLASS__, 'plugin_uninstall' ) );
    }

    private static function do_multisite( $method, $args = array() ) {
        // checks that the wordpress install is multisite and the page this is happening on is the network plugin view
        if ( is_multisite() && is_network_admin() ) {
            global $wpdb, $blog_id;
            $dbquery = 'SELECT blog_id FROM '.$wpdb->blogs;
            $ids = $wpdb->get_col( $dbquery );
            foreach ( $ids as $id ) {
                switch_to_blog( $id );
                call_user_func_array( $method, array( $args ) );
            }
            switch_to_blog( $blog_id );
        } else {
            // call the original method on the current blog
            call_user_func_array( $method, array( $args ) );
        }
    }
}
?>
