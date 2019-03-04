<?php
/*
Plugin Name: Admiral Ad Block Analytics
Plugin URI: http://getadmiral.com/wordpress
Description: Admiral is an advanced adblock analytics and revenue recovery platform.
Author: Admiral <support@getadmiral.com>
Version: 1.7.0
Author URI: http://getadmiral.com/
*/

// block direct access to this plugin
defined("ABSPATH") or die("");

require_once("AdmiralAdBlockAnalytics.php");

\wp\AdmiralAdBlockAnalytics::setClientIDSecret("41c528e5f0d2c6b4cc93", "2y41c528e5f0d2c6b4cc930001912b9ea79d22eaadaeed70b7183d99ff0cfc2f7f652c1336");

function admiraladblock_load_settings()
{
    try {
        $didInitialize = \wp\AdmiralAdBlockAnalytics::initialize("wp", "1.7.0", "Admiral AdBlock Analytics");
        if($didInitialize && (!function_exists('is_admin') || !is_admin())){
            add_action('wp_print_scripts', function(){
                \wp\AdmiralAdBlockAnalytics::printEmbedScripts();
            });
        } else if(!$didInitialize) {
            \wp\AdmiralAdBlockAnalytics::createNewProperty("");
        }
    } catch (Exception $e) {
        error_log("Error loading settings: " . $e->getMessage());
    }
}

admiraladblock_load_settings();

// always include the admin section
require('adminHooks.php');

/* EOF */
