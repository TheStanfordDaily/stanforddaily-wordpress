<?php
/*
	Plugin Name: JNews - View Counter
	Plugin URI: http://jegtheme.com/
	Description: Custom view counter for JNews
	Version: 2.0.1
	Author: Jegtheme
	Author URI: http://jegtheme.com
	Network: false
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'JNEWS_VIEW_COUNTER_VERSION' )  	or define( 'JNEWS_VIEW_COUNTER_VERSION', '2.0.1' );
defined( 'JNEWS_VIEW_COUNTER_DB_DATA' )  	or define( 'JNEWS_VIEW_COUNTER_DB_DATA', 'popularpostsdata' );
defined( 'JNEWS_VIEW_COUNTER_DB_SUMMARY' )  or define( 'JNEWS_VIEW_COUNTER_DB_SUMMARY', 'popularpostssummary' );

require "class.jnews-view-counter.php";

/**
 * Get jnews option
 *
 * @param $setting
 * @param $default
 * @return mixed
 */
if(!function_exists('jnews_get_option'))
{
    function jnews_get_option($setting, $default = null)
    {
        $options = get_option( 'jnews_option', array() );
        $value = $default;
        if ( isset( $options[ $setting ] ) ) {
            $value = $options[ $setting ];
        }
        return $value;
    }
}

/**
 * Activation hook
 */
register_activation_hook( __FILE__, array( JNews_View_Counter::getInstance(), 'plugin_activation' ) );