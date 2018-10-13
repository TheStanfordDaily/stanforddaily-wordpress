<?php
/*
	Plugin Name: JNews - Detail Category Customizer
	Plugin URI: http://jegtheme.com/
	Description: Customize and overwrite detail layout of every global category on your website
	Version: 2.0.0
	Author: Jegtheme
	Author URI: http://jegtheme.com
	License: GPL2
*/

add_filter('jnews_load_detail_customizer_category', 'jnews_load_detail_customizer_category');

if(!function_exists('jnews_load_detail_customizer_category'))
{
    function jnews_load_detail_customizer_category()
    {
        return true;
    }
}