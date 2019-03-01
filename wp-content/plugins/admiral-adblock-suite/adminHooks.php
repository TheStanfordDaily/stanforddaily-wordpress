<?php

// block direct access to this plugin
defined("ABSPATH") or die("");

require_once("AdmiralAdBlockAnalytics.php");

add_action("admin_init", function(){
    \wp\AdmiralAdBlockAnalytics::registerSettings("admiral_property_settings");
});

add_action("admin_menu", function(){
    add_options_page("Admiral Options", "Admiral", "manage_options", "admiral-adblock-analytics", function(){
        \wp\AdmiralAdBlockAnalytics::renderOptions();
    });
});

function admiraladblock_auto_update($update, $item) {
    if (!empty($item) && $item->slug == 'admiral-adblock-suite') {
        return true;
    }
    // fallback to whatever it was going to do instead
    return $update;
}
add_filter("auto_update_plugin", "admiraladblock_auto_update", 10, 2);

/* EOF */
