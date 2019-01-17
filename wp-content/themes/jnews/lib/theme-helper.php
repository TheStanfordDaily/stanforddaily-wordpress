<?php
/**
 * @author : Jegtheme
 */

if(!function_exists('jnews_load_resource_limit'))
{
    function jnews_load_resource_limit()
    {
        return apply_filters('jnews_load_resource_limit', 25);
    }
}

/*** Vafpress whitelist function **/

VP_Security::instance()->whitelist_function('jnews_get_categories_selectize');

if(!function_exists('jnews_get_categories_selectize '))
{
    function jnews_get_categories_selectize ()
    {
        $result = array();

        $categories = get_categories(array(
            'hide_empty' => false,
            'hierarchical' => true
        ));

        $walker = new \JNews\Walker\SelectizeWalker();
        $walker->walk($categories, 3);

        foreach($walker->cache as $value){
            $result[] = array(
                'value' => $value['id'],
                'label' => array($value['title'], $value['depth']),
            );
        }

        return $result;
    }
}

VP_Security::instance()->whitelist_function('jnews_get_categories');

if(!function_exists('jnews_get_categories'))
{
    function jnews_get_categories ()
    {
        $result = array();

        $categories = get_categories(array(
            'hide_empty' => false,
            'hierarchical' => true
        ));

        $walker = new \JNews\Walker\CategoryMetaboxWalker();
        $walker->walk($categories, 3);

        foreach($walker->cache as $value){
            $result[] = array(
                'value' => $value['id'],
                'label' => $value['title']
            );
        }

        return $result;
    }
}


VP_Security::instance()->whitelist_function('jnews_get_sidebar');

if(!function_exists('jnews_get_sidebar '))
{
    function jnews_get_sidebar ()
    {
        $result = array();

        $all_sidebar = apply_filters('jnews_get_sidebar_widget', null);

        if($all_sidebar) {
            foreach($all_sidebar as $key => $value){
                $result[] = array(
                    'value' => $key,
                    'label' => $value
                );
            }
        }

        return $result;
    }
}


VP_Security::instance()->whitelist_function('jnews_get_all_author_loop');

if(!function_exists('jnews_get_all_author_loop'))
{
    function jnews_get_all_author_loop()
    {
        $result = array();

	    if ( is_admin() )
	    {
		    if ( $users = JNews\Util\Cache::get_users() )
		    {
			    $count = JNews\Util\Cache::get_count_users();
			    $limit = jnews_load_resource_limit();

			    if ( $count['total_users'] <= $limit )
			    {
				    foreach($users as $user)
				    {
					    $result[] = array(
						    'value' => $user->ID,
						    'label' => $user->display_name
					    );
				    }
			    }
		    }
	    }
	    return $result;
    }
}


VP_Security::instance()->whitelist_function('jnews_get_all_tag_loop');

if(!function_exists('jnews_get_all_tag_loop'))
{
    function jnews_get_all_tag_loop()
    {
        $result = array();
        $count  = wp_count_terms( 'post_tag' );
        $limit = jnews_load_resource_limit();

        if ( (int) $count <= $limit )
        {
            if($terms = JNews\Util\Cache::get_tags())
            {
                foreach($terms as $term)
                {
                    $result[$term->name] = $term->term_id;
                    $result[] = array(
                        'value' => $term->term_id,
                        'label' => $term->name
                    );
                }
            }
        }

        return $result;
    }
}


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


if(!function_exists('jnews_categories_drop'))
{
    function jnews_categories_drop ()
    {
        $result = array();

        $categories = get_categories(array(
            'hide_empty' => false,
            'hierarchical' => true
        ));

        $walker = new \JNews\Walker\CategoryMetaboxWalker();
        $walker->walk($categories, 3);

        $result[] = '';

        foreach($walker->cache as $value){
            $result[$value['id']] = $value['title'];
        }

        return $result;
    }
}

/**
 * @param $post_id
 * @return string
 */
if(!function_exists('jnews_generate_rating'))
{
    function jnews_generate_rating($post_id, $class = null)
    {
        return apply_filters('jnews_review_generate_rating', '', $post_id, $class);
    }
}

/**
 * @param $post_id
 * @return bool
 */
if(!function_exists('jnews_is_review'))
{
    function jnews_is_review($post_id)
    {
        return apply_filters('jnews_review_enable_review', false, $post_id);
    }
}


/**
 * Encode URL by Post ID
 *
 * @param $post_id
 * @return string
 */
if(!function_exists('jnews_encode_url'))
{
    function jnews_encode_url($post_id)
    {
        $url = get_permalink($post_id);
        return urlencode($url);
    }
}

/**
 * Format Number
 *
 * @param $total
 * @return string
 */
if(!function_exists('jnews_number_format'))
{
    function jnews_number_format( $total )
    {
        if( $total > 1000000 )
        {
            $total = round( $total / 1000000, 1 ) . 'M';
        } elseif( $total > 1000 ) {
            $total = round( $total / 1000, 1 ) . 'k';
        }
        return $total;
    }
}


if(!function_exists('jnews_get_shortcode_name_from_option'))
{
    function jnews_get_shortcode_name_from_option($class)
    {
        $mod = explode('\\', $class);

        if(isset($mod[3])) {
            $module = str_replace('_Option', '', $mod[0] . '_' . $mod[3]);
        } else {
            $module = $class;
        }

        $module = strtolower($module);

        return apply_filters('jnews_get_shortcode_name_from_option', $module, $class);
    }
}


if(!function_exists('jnews_get_option_class_from_shortcode'))
{
    function jnews_get_option_class_from_shortcode($name)
    {
        $mod = explode('_', $name);
        $class = 'JNews\\Module\\' . ucfirst($mod[1]) . '\\' . ucfirst($mod[1]) . '_' . $mod[2] . '_Option';

        return apply_filters('jnews_get_option_class_from_shortcode', $class, $name);
    }
}

if(!function_exists('jnews_get_shortcode_name_from_view'))
{
    function jnews_get_shortcode_name_from_view($class)
    {
        $mod = explode('\\', $class);

        if(isset($mod[3])) {
            $module = str_replace('_View', '', $mod[0] . '_' . $mod[3]);
        } else {
            $module = $class;
        }

        $module = strtolower($module);

        return apply_filters('jnews_get_shortcode_name_from_view', $module, $class);
    }
}

if(!function_exists('jnews_get_view_class_from_shortcode'))
{
    function jnews_get_view_class_from_shortcode($name)
    {
        $mod = explode('_', $name);
        $class = 'JNews\\Module\\' . ucfirst($mod[1]) . '\\' . ucfirst($mod[1]) . '_' . ucfirst($mod[2]) . '_View';

        return apply_filters('jnews_get_view_class_from_shortcode', $class, $name);
    }
}




/*** Plugin Helper ***/
if(!function_exists('jlog'))
{
    function jlog($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}

/**
 * Primary category
 */
add_filter('jnews_get_primary_category_filter', 'jnews_get_primary_category_filter', null, 2);

if(!function_exists('jnews_get_primary_category_filter'))
{
    function jnews_get_primary_category_filter($out, $post_id)
    {
        return jnews_get_primary_category($post_id);
    }
}

/**
 * Get primary category ceremony
 *
 * @param $post_id
 * @return mixed|void
 */
if(!function_exists('jnews_get_primary_category'))
{
    function jnews_get_primary_category($post_id)
    {
        $category_id = null;

        if(get_post_type($post_id) === 'post')
        {
            $category = vp_metabox('jnews_primary_category.id', null, $post_id );

            if( ! empty( $category ) )
            {
                $category_id = $category;
            } else {
                $categories = array_slice(get_the_category($post_id), 0, 1);
                if(empty($categories)) return null;
                $category = array_shift($categories);
                $category_id = $category->term_id;
            }
        }

        return apply_filters('jnews_primary_category', $category_id, $post_id);
    }
}


/**
 * Get all category
 *
 * @return array
 */
if(!function_exists('jnews_get_all_category'))
{
    function jnews_get_all_category()
    {
        $result = array();

        if(is_admin())
        {
            if($terms = JNews\Util\Cache::get_categories())
            {
                foreach($terms as $term)
                {
                    $result[$term->name] = $term->term_id;
                }
            }
        }

        return $result;
    }
}

/**
 * All Author
 */
if(!function_exists('jnews_get_all_author'))
{
    function jnews_get_all_author()
    {
        $result = array();

        if ( is_admin() )
        {
            if ( $users = JNews\Util\Cache::get_users() )
            {
                $count = JNews\Util\Cache::get_count_users();
                $limit = jnews_load_resource_limit();

                if ( $count['total_users'] <= $limit )
                {
                    foreach($users as $user)
                    {
                        $result[$user->display_name] = $user->ID;
                    }
                }
            }
        }
        return $result;
    }
}



/**
 * All Author
 */
if(!function_exists('jnews_get_all_menu'))
{
    function jnews_get_all_menu()
    {
        $result = array();

        if(is_admin())
        {
            if($menus = JNews\Util\Cache::get_menu())
            {
                foreach($menus as $menu)
                {
                    $result[$menu->name] = $menu->term_id;
                }
            }
        }

        return $result;
    }
}

/**
 * All Tag
 */
if(!function_exists('jnews_get_all_tag'))
{
    function jnews_get_all_tag()
    {
        $result = array();
        if(is_admin())
        {
            if($terms = JNews\Util\Cache::get_tags())
            {
                $count  = wp_count_terms( 'post_tag' );
                $limit = jnews_load_resource_limit();

                if ( (int) $count <= $limit )
                {
                    foreach($terms as $term){
                        $result[$term->name] = $term->term_id;
                    }
                }
            }
        }

        return $result;
    }
}

if(!function_exists('jnews_get_mega_menu_tag'))
{
    function jnews_get_mega_menu_tag()
    {
        $tags = array();
        $count = wp_count_terms( 'post_tag' );
        $limit = jnews_load_resource_limit();

        if ( (int) $count <= $limit )
        {
            foreach ( jnews_get_all_tag() as $key => $value )
            {
                $tags[$value] = $key;
            }
        }

        return $tags;
    }
}


/**
 * @return array
 */
if(!function_exists('jnews_get_all_post_type'))
{
    function jnews_get_all_post_type()
    {
        $result = array();

        if(is_admin())
        {
            if($post_type = JNews\Util\Cache::get_post_type()) {
                foreach($post_type as $type)
                {
                    if($type !== 'attachment')
                    {
                        $type_uc = ucfirst($type);
                        $result[$type_uc] = $type;
                    }
                }
            }
        }

        return $result;
    }
}

/**
 * @return false|string
 */
if(!function_exists('jnews_get_theme_version'))
{
    function jnews_get_theme_version()
    {
        $theme = wp_get_theme();
        return $theme->get('Version');
    }
}


/**
 * Generate Social Icon
 *
 * @param bool|true $echo
 * @return string
 */
if(!function_exists('jnews_generate_social_icon'))
{
    function jnews_generate_social_icon($echo = true)
    {
        /** @var array $socials */
        $socials = get_theme_mod('jnews_social_icon', array (
            array (
                'social_icon' => 'facebook',
                'social_url' => 'http://facebook.com',
            ),
            array (
                'social_icon' => 'twitter',
                'social_url' => 'http://twitter.com',
            ),
        ));
        $socialstring = array();

        foreach($socials as $social)
        {
            switch($social['social_icon'])
            {
                case "facebook" :
                    $icon = 'fa fa-facebook';
                    break;
                case "twitter" :
                    $icon = 'fa fa-twitter';
                    break;
                case "linkedin" :
                    $icon = 'fa fa-linkedin';
                    break;
                case "googleplus" :
                    $icon = 'fa fa-google-plus';
                    break;
                case "pinterest" :
                    $icon = 'fa fa-pinterest';
                    break;
                case "behance" :
                    $icon = 'fa fa-behance';
                    break;
                case "github" :
                    $icon = 'fa fa-github';
                    break;
                case "flickr" :
                    $icon = 'fa fa-flickr';
                    break;
                case "tumblr" :
                    $icon = 'fa fa-tumblr';
                    break;
                case "dribbble" :
                    $icon = 'fa fa-dribbble';
                    break;
                case "soundcloud" :
                    $icon = 'fa fa-soundcloud';
                    break;
                case "instagram" :
                    $icon = 'fa fa-instagram';
                    break;
                case "vimeo" :
                    $icon = 'fa fa-vimeo';
                    break;
                case "youtube" :
                    $icon = 'fa fa-youtube-play';
                    break;
                case "vk" :
                    $icon = 'fa fa-vk';
                    break;
                case "reddit" :
                    $icon = 'fa fa-reddit';
                    break;
                case "rss" :
                    $icon = 'fa fa-rss';
                    break;
                case "weibo" :
                    $icon = 'fa fa-weibo';
                    break;
                default  :
                    $icon = '';
                    break;
            }

            if(!empty($icon))
            {
                $social_url = !empty($social['social_url']) ? $social['social_url'] : "";
                $socialstring[] = "<li><a href=\"{$social_url}\" target='_blank'><i class=\"{$icon}\"></i></a></li>";
            }
        }

        if($echo) {
            echo implode("", $socialstring);
        } else {
            return implode("", $socialstring);
        }
    }
}

/**
 * Generate Social Icon Block
 *
 * @param bool|true $echo
 * @param bool|false $withtitle
 * @return string
 */
if(!function_exists('jnews_generate_social_icon_block'))
{
    function jnews_generate_social_icon_block($echo = true, $withtitle = false)
    {

        $socials = get_theme_mod('jnews_social_icon', array (
            array (
                'social_icon' => 'facebook',
                'social_url' => 'http://facebook.com',
            ),
            array (
                'social_icon' => 'twitter',
                'social_url' => 'http://twitter.com',
            ),
        ));
        $socialstring = array();

        foreach($socials as $social)
        {
            switch($social['social_icon'])
            {
                case "facebook" :
                    $icon = 'fa fa-facebook';
                    $class = 'jeg_facebook';
                    $title = jnews_return_translation('Facebook', 'jnews', 'facebook');
                    break;
                case "twitter" :
                    $icon = 'fa fa-twitter';
                    $class = 'jeg_twitter';
                    $title = jnews_return_translation('Twitter', 'jnews', 'twitter');
                    break;
                case "linkedin" :
                    $icon = 'fa fa-linkedin';
                    $class = 'jeg_linkedin';
                    $title = jnews_return_translation('LinkedIn', 'jnews', 'linkedin');
                    break;
                case "googleplus" :
                    $icon = 'fa fa-google-plus';
                    $class = 'jeg_google-plus';
                    $title = jnews_return_translation('Google+', 'jnews', 'google');
                    break;
                case "pinterest" :
                    $icon = 'fa fa-pinterest';
                    $class = 'jeg_pinterest';
                    $title = jnews_return_translation('Pinterest', 'jnews', 'pinterest');
                    break;
                case "behance" :
                    $icon = 'fa fa-behance';
                    $class = 'jeg_behance';
                    $title = jnews_return_translation('Behance', 'jnews', 'behance');
                    break;
                case "github" :
                    $icon = 'fa fa-github';
                    $class = 'jeg_github';
                    $title = jnews_return_translation('Github', 'jnews', 'github');
                    break;
                case "flickr" :
                    $icon = 'fa fa-flickr';
                    $class = 'jeg_flickr';
                    $title = jnews_return_translation('Flirk', 'jnews', 'flickr');
                    break;
                case "tumblr" :
                    $icon = 'fa fa-tumblr';
                    $class = 'jeg_tumblr';
                    $title = jnews_return_translation('Tumblr', 'jnews', 'tumblr');
                    break;
                case "dribbble" :
                    $icon = 'fa fa-dribbble';
                    $class = 'jeg_dribbble';
                    $title = jnews_return_translation('Dribbble', 'jnews', 'dribbble');
                    break;
                case "soundcloud" :
                    $icon = 'fa fa-soundcloud';
                    $class = 'jeg_soundcloud';
                    $title = jnews_return_translation('Soundcloud', 'jnews', 'soundcloud');
                    break;
                case "instagram" :
                    $icon = 'fa fa-instagram';
                    $class = 'jeg_instagram';
                    $title = jnews_return_translation('Instagram', 'jnews', 'instagram');
                    break;
                case "vimeo" :
                    $icon = 'fa fa-vimeo';
                    $class = 'jeg_vimeo';
                    $title = jnews_return_translation('Vimeo', 'jnews', 'vimeo');
                    break;
                case "youtube" :
                    $icon = 'fa fa-youtube-play';
                    $class = 'jeg_youtube';
                    $title = jnews_return_translation('Youtube', 'jnews', 'youtube');
                    break;
                case "twitch" :
                    $icon = 'fa fa-twitch';
                    $class = 'jeg_twitch';
                    $title = jnews_return_translation('Twitch', 'jnews', 'youtube');
                    break;
                case "vk" :
                    $icon = 'fa fa-vk';
                    $class = 'jeg_vk';
                    $title = jnews_return_translation('VK', 'jnews', 'vk');
                    break;
                case "reddit" :
                    $icon = 'fa fa-reddit';
                    $class = 'jeg_reddit';
                    $title = jnews_return_translation('Reddit', 'jnews', 'reddit');
                    break;
                case "weibo" :
                    $icon = 'fa fa-weibo';
                    $class = 'jeg_weibo';
                    $title = jnews_return_translation('Weibo', 'jnews', 'weibo');
                    break;
                case "stumbleupon" :
                    $icon = 'fa fa-stumbleupon';
                    $class = 'jeg_stumbleupon';
                    $title = jnews_return_translation('StumbleUpon', 'jnews', 'stumbleupon');
                    break;
	            case "telegram" :
		            $icon = 'fa fa-telegram';
		            $class = 'jeg_telegram';
		            $title = jnews_return_translation('Telegram', 'jnews', 'telegram');
		            break;
                case "rss" :
                    $icon = 'fa fa-rss';
                    $class = 'jeg_rss';
                    $title = jnews_return_translation('RSS', 'jnews', 'rss');
                    break;
                default  :
                    $icon = '';
                    break;
            }

            if(!empty($icon))
            {
                $title_string = $withtitle ? "<span>{$title}</span>" : "";
                $social_url = !empty($social['social_url']) ? $social['social_url'] : "";
                $socialstring[] = "<a href=\"{$social_url}\" target='_blank' class=\"{$class}\"><i class=\"{$icon}\"></i> {$title_string}</a>";
            }
        }

        if($echo) {
            echo implode("", $socialstring);
        }

        return implode("", $socialstring);
    }
}

if(!function_exists('jnews_generate_logo_text'))
{
    /**
     * Generate Logo Text
     *
     * @param $logo_text
     * @param $echo
     * @return string
     */
    function jnews_generate_logo_text($logo_text, $echo)
    {
        $logo = $logo_text;
        $logo_text = apply_filters('jnews_generate_logo_text', $logo, $logo_text);

        if($echo) {
            echo $logo_text;
        }

        return $logo_text;
    }
}

/**
 * Generate Header Logo
 *
 * @param bool|true $echo
 * @return string
 */
if(!function_exists('jnews_generate_header_logo'))
{
    function jnews_generate_header_logo($echo = true)
    {
        if(get_theme_mod('jnews_header_logo_type', 'image') === 'image')
        {
            $logo           = get_theme_mod('jnews_header_logo', get_parent_theme_file_uri('assets/img/logo.png'));
            $logo_retina    = get_theme_mod('jnews_header_logo_retina', get_parent_theme_file_uri('assets/img/logo@2x.png'));
            $alt            = get_theme_mod('jnews_header_logo_alt', get_bloginfo('name'));

            return JNews\Image\Image::generate_image_retina($logo, $logo_retina, $alt, $echo);
        } else {
            $logo_text      = get_theme_mod('jnews_header_logo_text', 'Logo');

            return jnews_generate_logo_text($logo_text, $echo);
        }
    }
}

/**
 * Generate Sticky Logo
 *
 * @param bool|true $echo
 * @return string
 */
if(!function_exists('jnews_generate_sticky_logo'))
{
    function jnews_generate_sticky_logo($echo = true)
    {
        if(get_theme_mod('jnews_sticky_logo_type', 'image') === 'image')
        {
            $logo           = get_theme_mod('jnews_sticky_menu_logo', get_parent_theme_file_uri('assets/img/sticky_logo.png'));
            $logo_retina    = get_theme_mod('jnews_sticky_menu_logo_retina', get_parent_theme_file_uri('assets/img/sticky_logo@2x.png'));
            $alt            = get_theme_mod('jnews_sticky_menu_alt', get_bloginfo('name'));

            return JNews\Image\Image::generate_image_retina($logo, $logo_retina, $alt, $echo);
        } else {
            $logo_text          = get_theme_mod('jnews_sticky_logo_text', 'Logo');

            return jnews_generate_logo_text($logo_text, $echo);
        }
    }
}

/**
 * Generate Mobile Logo
 *
 * @param bool|true $echo
 * @return string
 */
if(!function_exists('jnews_generate_mobile_logo'))
{
    function jnews_generate_mobile_logo($echo = true)
    {
        if(get_theme_mod('jnews_mobile_logo_type', 'image') === 'image')
        {
            $logo           = get_theme_mod('jnews_mobile_logo', get_parent_theme_file_uri('assets/img/logo_mobile.png'));
            $logo_retina    = get_theme_mod('jnews_mobile_logo_retina', get_parent_theme_file_uri('assets/img/logo_mobile@2x.png'));
            $alt            = get_theme_mod('jnews_mobile_logo_alt', get_bloginfo('name'));

            return JNews\Image\Image::generate_image_retina($logo, $logo_retina, $alt, $echo);
        } else {
            $logo_text          = get_theme_mod('jnews_mobile_logo_text', 'Logo');

            return jnews_generate_logo_text($logo_text, $echo);
        }
    }
}

/**
 * Generate Footer 7 Logo
 *
 * @param bool|true $echo
 * @return string
 */
if(!function_exists('jnews_generate_footer_7_logo'))
{
    function jnews_generate_footer_7_logo($echo = true)
    {
        $logo           = get_theme_mod('jnews_footer_logo', get_parent_theme_file_uri('assets/img/logo.png'));
        $logo_retina    = get_theme_mod('jnews_footer_logo_retina', get_parent_theme_file_uri('assets/img/logo@2x.png'));
        $alt            = get_theme_mod('jnews_footer_logo_alt', get_bloginfo('name'));

        return JNews\Image\Image::generate_image_retina($logo, $logo_retina, $alt, $echo);
    }
}

/**
 * Sanitize with allowed html
 *
 * @param $value
 * @return string
 */
if(!function_exists('jnews_sanitize_allowed_tag'))
{
    function jnews_sanitize_allowed_tag( $value )
    {
        return wp_kses($value, wp_kses_allowed_html());
    }
}

/**
 * Sanitize output with allowed html
 *
 * @param $value
 * @return string
 */
if(!function_exists('jnews_sanitize_output'))
{
    function jnews_sanitize_output( $value )
    {
        return $value;
    }
}

/**
 * Format Number
 *
 * @param $total
 * @return string
 */
if(!function_exists('jnews_format_number'))
{
    function jnews_format_number( $total )
    {
        if( $total > 1000000 )
        {
            $total = round( $total / 1000000, 1 ) . 'M';
        } elseif( $total > 1000 ) {
            $total = round( $total / 1000, 1 ) . 'k';
        }
        return $total;
    }
}

/**
 * Check youtube URL
 *
 * @param $url
 * @return string
 */
if(!function_exists('jnews_check_video_type'))
{
    function jnews_check_video_type($url)
    {
        if (strpos($url, 'youtube') > 0 || strpos($url, 'youtu.be') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }
}

/**
 * Get Image Src
 *
 * @param $id
 * @param string $size
 * @return bool
 */
if(!function_exists('jnews_get_image_src'))
{
    function jnews_get_image_src($id, $size = 'full')
    {
        if (!empty($id) && (ctype_digit($id) || is_int($id)) )
        {
            $image = wp_get_attachment_image_src($id, $size);
            return $image[0];
        }
        return false;
    }
}

/**
 * Get Image Dimension by Name
 *
 * @param $name
 * @return float
 */
if(!function_exists('jnews_get_image_dimension_by_name'))
{
    function jnews_get_image_dimension_by_name($name)
    {
        $size = explode('-', $name);
        $size = explode('x', $size[1]);
        return jnews_get_image_dimension_by_size($size[0], $size[1]);
    }
}

/**
 * Get Image Dimension by Size
 *
 * @param $width
 * @param $height
 * @return float
 */
if(!function_exists('jnews_get_image_dimension_by_size'))
{
    function jnews_get_image_dimension_by_size($width, $height)
    {
        return round( $height / $width  * 1000 );
    }
}


/**
 * get single post current page
 *
 * @return mixed
 */
if(!function_exists('jnews_get_post_current_page'))
{
    function jnews_get_post_current_page()
    {
        $page = get_query_var('page') ? get_query_var('page') : 1;
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        return max($page, $paged);
    }
}

/**
 * @return bool
 */
if(!function_exists('jnews_show_breadcrumb'))
{
    function jnews_show_breadcrumb()
    {
        if(is_single()) {
            return get_theme_mod('jnews_breadcrumb_show_post', true);
        } else if(is_category()) {
            return get_theme_mod('jnews_breadcrumb_show_category', true);
        } else if(is_search()) {
            return get_theme_mod('jnews_breadcrumb_show_search', true);
        } else if(is_author()) {
            return get_theme_mod('jnews_breadcrumb_show_author', true);
        } else if(is_archive()) {
            return get_theme_mod('jnews_breadcrumb_show_archive', true);
        }

        return true;
    }
}

/**
 * Render Breadcrumb
 *
 * @return mixed|string|void
 */
if(!function_exists('jnews_render_breadcrumb'))
{
    function jnews_render_breadcrumb()
    {
        $type = get_theme_mod('jnews_breadcrumb', 'native');
        $output = '';

        if(jnews_show_breadcrumb())
        {
            if($type === 'native')
            {
                $output = jnews_native_breadcrumb();
            } else if($type === 'navxt')
            {
                $output = jnews_render_navxt_breadcrumb();
            } else if($type === 'yoast')
            {
                $output = jnews_render_yoast();
            }
        }

        return $output;
    }
}

/**
 * @return bool
 */
if(!function_exists('jnews_can_render_breadcrumb'))
{
    function jnews_can_render_breadcrumb()
    {
        $type = get_theme_mod('jnews_breadcrumb', 'native');

        if($type === 'native' && class_exists('JNews_Breadcrumb'))
        {
            return true;
        }

        if($type === 'navxt' && function_exists('bcn_display'))
        {
            return true;
        }

        if($type === 'yoast' && function_exists('yoast_breadcrumb'))
        {
            return true;
        }

        return false;
    }
}


/**
 * Call Native Breadcrumb
 *
 * @return mixed|void
 */
if(!function_exists('jnews_native_breadcrumb'))
{
    function jnews_native_breadcrumb()
    {
        return apply_filters('jnews_breadcrumb', '');
    }
}

/**
 * Navxt Breadcrumb
 *
 * @return string
 */
if(!function_exists('jnews_render_navxt_breadcrumb'))
{
    function jnews_render_navxt_breadcrumb()
    {
        $output = "<p id=\"breadcrumbs\" typeof=\"BreadcrumbList\" vocab=\"http://schema.org/\">";
        if(function_exists('bcn_display'))
        {
            $output .= bcn_display(true);
        }
        $output .= "</p>";

        return $output;
    }
}

/**
 * Yoast Breadcrumb
 *
 * @return string
 */
if(!function_exists('jnews_render_yoast'))
{
    function jnews_render_yoast()
    {
        $output = '';

        if ( function_exists('yoast_breadcrumb') )
        {
            ob_start();
            yoast_breadcrumb("<p id=\"breadcrumbs\">","</p>", true);
            $output = ob_get_contents();
            ob_end_clean();
        }

        return $output;
    }
}

/**
 * Generate sidebar, but before it, we need to setup those width on module manager first
 *
 * @param $sidebar_name
 * @param int $width
 */
if(!function_exists('jnews_widget_area'))
{
    function jnews_widget_area($sidebar_name, $width = 4)
    {
        if(is_active_sidebar($sidebar_name))
        {
            do_action('jnews_module_set_width', $width);
            dynamic_sidebar( $sidebar_name );
        }
    }
}

/**
 * Copyright Default Text
 * @return string
 */
if(!function_exists('jnews_get_footer_copyright_text'))
{
    function jnews_get_footer_copyright_text()
    {
        return '&copy; '. date('Y') .' <a href="http://jegtheme.com" title="Premium WordPress news &amp; magazine theme">JNews</a> - Premium WordPress news &amp; magazine theme by <a href="http://jegtheme.com" title="Jegtheme">Jegtheme</a>.';
    }
}

/**
 * Footer copyright
 */
if(!function_exists('jnews_get_footer_copyright'))
{
    function jnews_get_footer_copyright()
    {
        $copyright = wp_kses( get_theme_mod( 'jnews_footer_copyright', jnews_get_footer_copyright_text() ), wp_kses_allowed_html() );

        if ( defined('POLYLANG_VERSION') )
        {
            $copyright  = jnews_return_polylang( $copyright );
        }

        if ( function_exists('icl_t') ) 
        {
            $copyright = icl_t( 'jnews', $copyright, $copyright );
        }
        
        return $copyright;
    }
}

/**
 * Footer menu title
 */
if(!function_exists('jnews_get_footer_menu_title'))
{
    function jnews_get_footer_menu_title()
    {
        $menu_title = wp_kses( get_theme_mod( 'jnews_footer_menu_title', 'Navigate Site' ), wp_kses_allowed_html() );

        if ( defined('POLYLANG_VERSION') )
        {
            $menu_title  = jnews_return_polylang( $menu_title );
        }

        if ( function_exists('icl_t') ) 
        {
            $menu_title = icl_t( 'jnews', $menu_title, $menu_title );
        }
        
        return $menu_title;
    }
}

/**
 * Footer social title
 */
if(!function_exists('jnews_get_footer_social_title'))
{
    function jnews_get_footer_social_title()
    {
        $social_title = wp_kses( get_theme_mod( 'jnews_footer_social_title', 'Follow Us' ), wp_kses_allowed_html() );

        if ( defined('POLYLANG_VERSION') )
        {
            $social_title  = jnews_return_polylang( $social_title );
        }

        if ( function_exists('icl_t') ) 
        {
            $social_title = icl_t( 'jnews', $social_title, $social_title );
        }
        
        return $social_title;
    }
}

/**
 * Polylang Integration
 */
if(!function_exists('jnews_return_polylang')) 
{
    function jnews_return_polylang( $text )
    {
        return apply_filters('jnews_translate_polylang', $text);
    }
}

/**
 * Post Class
 */
if(!function_exists('jnews_post_class'))
{
    function jnews_post_class( $class = '', $post_id = null ) {
        // Separates classes with a single space, collates classes for post DIV
        return 'class="' . join( ' ', get_post_class( $class, $post_id ) ) . '"';
    }
}


/**
 * Footer 4 text
 * @return string
 */
if(!function_exists('jnews_footer_text'))
{
    function jnews_footer_text()
    {
        return __('<strong> Call us: +1 234 JEG THEME </strong>', 'jnews');
    }
}

/**
 * @return array|string
 */
if(!function_exists('jnews_paging_navigation'))
{
    function jnews_paging_navigation($args)
    {
        global $wp_query, $wp_rewrite;

        // Setting up default values based on the current URL.
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $url_parts    = explode( '?', $pagenum_link );

        // Get max pages and current page out of the current query, if available.
        $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
        $current = jnews_get_post_current_page();

        // Append the format placeholder to the base URL.
        $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

        // URL base depends on permalink settings.
        $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

        $defaults = array(
            'base' => $pagenum_link,
            'format' => $format,
            'total' => $total,
            'current' => $current,
            'show_all' => false,
            'prev_next' => true,
            'prev_text' => jnews_return_translation('Previous', 'jnews', 'previous'),
            'next_text' => jnews_return_translation('Next', 'jnews', 'next'),
            'end_size' => 1,
            'mid_size' => 1,
            'type' => 'plain',
            'add_args' => array(), // array of query args to add
            'add_fragment' => '',
            'before_page_number' => '',
            'after_page_number' => ''
        );

        $args = wp_parse_args( $args, $defaults );

        if ( ! is_array( $args['add_args'] ) ) {
            $args['add_args'] = array();
        }

        // Merge additional query vars found in the original URL into 'add_args' array.
        if ( isset( $url_parts[1] ) ) {
            // Find the format argument.
            $format_args = $url_query_args = array();
            $format = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
            $format_query = isset( $format[1] ) ? $format[1] : '';
            wp_parse_str( $format_query, $format_args );

            // Find the query args of the requested URL.
            wp_parse_str( $url_parts[1], $url_query_args );

            // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
            foreach ( $format_args as $format_arg => $format_arg_value ) {
                unset( $url_query_args[ $format_arg ] );
            }

            $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
        }

        // Who knows what else people pass in $args
        $total = (int) $args['total'];
        if ( $total < 2 ) {
            return;
        }
        $current  = (int) $args['current'];
        $end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
        if ( $end_size < 1 ) {
            $end_size = 1;
        }
        $mid_size = (int) $args['mid_size'];
        if ( $mid_size < 0 ) {
            $mid_size = 2;
        }
        $add_args = $args['add_args'];
        $r = '';
        $page_links = array();
        $dots = false;

        if ( $args['prev_next'] && $current && 1 < $current ) :
            $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
            $link = str_replace( '%#%', $current - 1, $link );
            if ( $add_args )
                $link = add_query_arg( $add_args, $link );
            $link .= $args['add_fragment'];

            /**
             * Filters the paginated links for the given archive pages.
             *
             * @since 3.0.0
             *
             * @param string $link The paginated link URL.
             */
            $page_links[] = '<a class="page_nav prev" data-id="' . ( $current - 1 ) . '" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '"><span class="navtext">' . $args['prev_text'] . '</span></a>';
        endif;
        for ( $n = 1; $n <= $total; $n++ ) :
            if ( $n == $current ) :
                $page_links[] = "<span class='page_number active'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</span>";
                $dots = true;
            else :
                if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                    $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                    $link = str_replace( '%#%', $n, $link );
                    if ( $add_args )
                        $link = add_query_arg( $add_args, $link );
                    $link .= $args['add_fragment'];

                    /** This filter is documented in wp-includes/general-template.php */
                    $page_links[] = "<a class='page_number' data-id='{$n}' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a>";
                    $dots = true;
                elseif ( $dots && ! $args['show_all'] ) :
                    $page_links[] = '<span class="page_number dots">' . __( '&hellip;' , 'jnews' ) . '</span>';
                    $dots = false;
                endif;
            endif;
        endfor;
        if ( $args['prev_next'] && $current && ( $current < $total || -1 == $total ) ) :
            $link = str_replace( '%_%', $args['format'], $args['base'] );
            $link = str_replace( '%#%', $current + 1, $link );
            if ( $add_args )
                $link = add_query_arg( $add_args, $link );
            $link .= $args['add_fragment'];

            /** This filter is documented in wp-includes/general-template.php */
            $page_links[] = '<a class="page_nav next" data-id="' . ( $current + 1 ) . '" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '"><span class="navtext">' . $args['next_text'] . '</span></a>';
        endif;

        switch ( $args['type'] ) {
            case 'array' :
                return $page_links;

            case 'list' :
                $r .= "<ul class='page-numbers'>\n\t<li>";
                $r .= join("</li>\n\t<li>", $page_links);
                $r .= "</li>\n</ul>\n";
                break;

            default :
                $nav_class = 'jeg_page' . $args['pagination_mode'];
                $nav_align = 'jeg_align' . $args['pagination_align'];
                $nav_text = $args['pagination_navtext'] ? '' : 'no_navtext';
                $nav_info = $args['pagination_pageinfo'] ? '' : 'no_pageinfo';

                $paging_text = sprintf(jnews_return_translation('Page %s of %s', 'jnews', 'page_s_of_s'), $current, $total);

                $r = join("\n", $page_links);
                $r = "<div class=\"jeg_navigation jeg_pagination {$nav_class} {$nav_align} {$nav_text} {$nav_info}\">
                    <span class=\"page_info\">{$paging_text}</span>
                    {$r}
                </div>";
                break;
        }

        return $r;
    }
}


if(!function_exists('jnews_excerpt_more '))
{
    function jnews_excerpt_more () { return " ..."; }
}

if(!function_exists('jnews_excerpt_length '))
{
    function jnews_excerpt_length () { return 30; }
}

if(!function_exists('jnews_woo_content_width'))
{
    function jnews_woo_content_width()
    {
	    $layout = jnews_can_render_woo_widget();

	    switch ($layout)
	    {
		    case 'right-sidebar':
		    case 'left-sidebar':
			    return 8;
			    break;

		    case 'right-sidebar-narrow':
		    case 'left-sidebar-narrow':
			    return 9;
			    break;

		    case 'double-sidebar':
		    case 'double-right-sidebar':
			    return 6;
			    break;
	    }

	    return 12;
    }
}

if(!function_exists('jnews_can_render_woo_widget'))
{
    function jnews_can_render_woo_widget()
    {
        if(is_archive()) {
            return get_theme_mod('jnews_woocommerce_archive_page_layout', 'right-sidebar');
        }

        if(is_single()) {
            return get_theme_mod('jnews_woocommerce_single_page_layout', 'right-sidebar');
        }
        return 'right-sidebar';
    }
}

if(!function_exists('jnews_get_woo_widget'))
{
    function jnews_get_woo_widget()
    {
        if(is_archive()) {
            return get_theme_mod('jnews_woocommerce_archive_sidebar', 'default-sidebar');
        }

        if(is_single()) {
            return get_theme_mod('jnews_woocommerce_single_sidebar', 'default-sidebar');
        }

        return 'default-sidebar';
    }
}

if(!function_exists('jnews_get_woo_second_widget'))
{
	function jnews_get_woo_second_widget()
	{
		if(is_archive()) {
			return get_theme_mod('jnews_woocommerce_archive_second_sidebar', 'default-sidebar');
		}

		if(is_single()) {
			return get_theme_mod('jnews_woocommerce_single_second_sidebar', 'default-sidebar');
		}

		return 'default-sidebar';
	}
}

if(!function_exists('jnews_get_woo_sticky_sidebar'))
{
    function jnews_get_woo_sticky_sidebar()
    {
        if ( is_archive() ) 
        {
            if ( get_theme_mod('jnews_woocommerce_sticky_sidebar', true) ) 
            {
                return 'jeg_sticky_sidebar';
            }
        }

        if ( is_single() ) 
        {
            if ( get_theme_mod('jnews_woocommerce_single_sticky_sidebar', true) ) 
            {
                return 'jeg_sticky_sidebar';
            }
        }

        return false;
    }
}

if ( ! function_exists('jnews_get_woo_main_class') )
{
	function jnews_get_woo_main_class()
	{
		$layout = jnews_can_render_woo_widget();

		switch ($layout)
		{
			case 'left-sidebar' :
			case 'left-sidebar-narrow' :
				echo "jeg_sidebar_left";
				break;

			case 'double-sidebar' :
				echo "jeg_double_sidebar";
				break;

			case 'double-right-sidebar' :
				echo "jeg_double_right_sidebar";
				break;

			default :
				break;
		}
	}
}

if(!function_exists('jnews_bbpress_content_width'))
{
	function jnews_bbpress_content_width()
	{
		$layout = jnews_get_bbpress_page_layout();

		switch ($layout)
		{
			case 'right-sidebar':
			case 'left-sidebar':
				return 8;
				break;

			case 'right-sidebar-narrow':
			case 'left-sidebar-narrow':
				return 9;
				break;

			case 'double-sidebar':
			case 'double-right-sidebar':
				return 6;
				break;
		}

		return 12;
	}
}

if ( ! function_exists('jnews_get_bbpress_main_class') )
{
	function jnews_get_bbpress_main_class()
	{
		$layout = jnews_get_bbpress_page_layout();

		switch ($layout)
		{
			case 'left-sidebar' :
			case 'left-sidebar-narrow' :
				echo "jeg_sidebar_left";
				break;

			case 'double-sidebar' :
				echo "jeg_double_sidebar";
				break;

			case 'double-right-sidebar' :
				echo "jeg_double_right_sidebar";
				break;

			default :
				break;
		}
	}
}

if ( ! function_exists( 'jnews_get_bbpress_page_layout' ) )
{
    function jnews_get_bbpress_page_layout()
    {
	    return get_theme_mod('jnews_bbpress_page_layout', 'default-sidebar');
    }
}

if ( ! function_exists('jnews_bbpress_render_sidebar') )
{
	function jnews_bbpress_render_sidebar()
	{
		$layout = jnews_get_bbpress_page_layout();

		if ( $layout !== 'no-sidebar' )
		{
			$sidebar = array(
				'content-sidebar'   => get_theme_mod('jnews_bbpress_sidebar', 'default-sidebar'),
				'sticky-sidebar'    => jnews_bbpress_get_sticky_sidebar(),
				'width-sidebar'     => jnews_bbpress_get_sidebar_width(),
				'position-sidebar'  => 'left'
			);

			set_query_var( 'sidebar', $sidebar );
			get_template_part('fragment/archive-sidebar');

			if($layout === 'double-right-sidebar' || $layout === 'double-sidebar')
			{
				$sidebar['second-sidebar'] = get_theme_mod('jnews_bbpress_second_sidebar', 'default-sidebar');
				$sidebar['position-sidebar'] = 'right';
				set_query_var( 'sidebar', $sidebar );
				get_template_part('fragment/archive-sidebar');
			}
		}
	}
}

if ( ! function_exists('jnews_bbpress_get_sticky_sidebar') )
{
	function jnews_bbpress_get_sticky_sidebar()
	{
		if ( get_theme_mod('jnews_bbpress_sticky_sidebar', true) )
		{
			return 'jeg_sticky_sidebar';
		}
		return false;
	}
}

if ( ! function_exists('jnews_bbpress_get_sidebar_width') )
{
	function jnews_bbpress_get_sidebar_width()
	{
		$layout = jnews_get_bbpress_page_layout();

		if($layout === 'left-sidebar' || $layout === 'right-sidebar')
		{
			return 4;
		}

		return 3;
	}
}

if ( ! function_exists('jnews_get_woo_sidebar_width') )
{
    function jnews_get_woo_sidebar_width()
    {
	    $layout = jnews_can_render_woo_widget();

	    if($layout === 'left-sidebar' || $layout === 'right-sidebar')
	    {
		    return 4;
	    }

	    return 3;
    }
}

if(!function_exists('jnews_background_ads'))
{
    function jnews_background_ads()
    {
        $html = "";
        $url = esc_url(get_theme_mod('jnews_background_ads_url'));

        if(!empty($url))
        {
            $new_tab = get_theme_mod('jnews_background_ads_open_tab', false) ? "_blank" : "";
            $html = "<div class=\"bgads\"><a href=\"$url\" target='{$new_tab}'></a></div>";
        }

        echo jnews_sanitize_output($html);
    }
}

if(!function_exists('jnews_remove_protocol'))
{
    function jnews_remove_protocol($url)
    {
        $disallowed = array('http://', 'https://');
        foreach($disallowed as $d) {
            if(strpos($url, $d) === 0) {
                return str_replace($d, '//', $url);
            }
        }
        return $url;
    }
}



if(!function_exists('jnews_recursive_category'))
{
    function jnews_recursive_category($categories, &$result)
    {
        foreach($categories as $category)
        {
            $result[] = $category;
            $children = get_categories ( array( 'parent' => $category->term_id ) );

            if( ! empty( $children ) ) {
                jnews_recursive_category($children, $result);
            }
        }
    }
}

if(!function_exists('jnews_get_youtube_vimeo_id'))
{
    function jnews_get_youtube_vimeo_id($video_url)
    {
        $video_type = jnews_check_video_type($video_url);
        $video_id = '';

        if ( $video_type == 'youtube' ) {
            $regexes = array(
                '#(?:https?:)?//www\.youtube(?:\-nocookie|\.googleapis)?\.com/(?:v|e|embed)/([A-Za-z0-9\-_]+)#', // Comprehensive search for both iFrame and old school embeds
                '#(?:https?(?:a|vh?)?://)?(?:www\.)?youtube(?:\-nocookie)?\.com/watch\?.*v=([A-Za-z0-9\-_]+)#', // Any YouTube URL. After http(s) support a or v for Youtube Lyte and v or vh for Smart Youtube plugin
                '#(?:https?(?:a|vh?)?://)?youtu\.be/([A-Za-z0-9\-_]+)#', // Any shortened youtu.be URL. After http(s) a or v for Youtube Lyte and v or vh for Smart Youtube plugin
                '#<div class="lyte" id="([A-Za-z0-9\-_]+)"#', // YouTube Lyte
                '#data-youtube-id="([A-Za-z0-9\-_]+)"#' // LazyYT.js
            );

            foreach ( $regexes as $regex ) {
                if ( preg_match( $regex, $video_url, $matches ) ) {
                    $video_id = $matches[1];
                }
            }
        }

        if ( $video_type == 'vimeo' ) {
            $regexes = array(
                '#<object[^>]+>.+?http://vimeo\.com/moogaloop.swf\?clip_id=([A-Za-z0-9\-_]+)&.+?</object>#s', // Standard Vimeo embed code
                '#(?:https?:)?//player\.vimeo\.com/video/([0-9]+)#', // Vimeo iframe player
                '#\[vimeo id=([A-Za-z0-9\-_]+)]#', // JR_embed shortcode
                '#\[vimeo clip_id="([A-Za-z0-9\-_]+)"[^>]*]#', // Another shortcode
                '#\[vimeo video_id="([A-Za-z0-9\-_]+)"[^>]*]#', // Yet another shortcode
                '#(?:https?://)?(?:www\.)?vimeo\.com/([0-9]+)#', // Vimeo URL
                '#(?:https?://)?(?:www\.)?vimeo\.com/channels/(?:[A-Za-z0-9]+)/([0-9]+)#' // Channel URL
            );

            foreach ( $regexes as $regex ) {
                if ( preg_match( $regex, $video_url, $matches ) ) {
                    $video_id = $matches[1];
                }
            }
        }

        return $video_id;
    }
}

/**
 * Fallback main navigation
 */
if(!function_exists('jnews_fallback_cb_navigation'))
{
    function jnews_fallback_cb_navigation(){
        return
            "<ul class='jeg_menu jeg_main_menu jeg_menu_style_4'>
                    <li><a href='" . admin_url('/nav-menus.php?action=locations') . "' class='empty-menu'>" . wp_kses(__('Setup menu at Appearance &raquo; Menus and assign menu to <strong>Main Navigation</strong>', 'jnews'), array('strong' => array())) . "</a></li>
            </ul>";
    }
}


/**
 * Fallback top navigation
 */
if(!function_exists('jnews_fallback_cb_top_navigation'))
{
    function jnews_fallback_cb_top_navigation(){
        $element =
            "<ul class='jeg_menu jeg_top_menu'>
                <li><a href='" . admin_url('/nav-menus.php?action=locations') . "' class='empty-menu'>" . wp_kses(__('Setup menu at Appearance &raquo; Menus and assign menu to <strong>Top Bar Navigation</strong>', 'jnews'), array('strong' => array())) . "</a></li>
            </ul>";

        echo jnews_sanitize_output($element);
    }
}

/**
 * Fallback footer navigation
 */
if(!function_exists('jnews_fallback_cb_footer_navigation'))
{
    function jnews_fallback_cb_footer_navigation(){
        $element =
            "<ul class='jeg_menu_footer'>
                <li><a href='" . admin_url('/nav-menus.php?action=locations') . "' class='empty-menu'>" . wp_kses(__('Setup menu at Appearance &raquo; Menus and assign menu to <strong>Footer Navigation</strong>', 'jnews'), array('strong' => array())) . "</a></li>
            </ul>";

        echo jnews_sanitize_output($element);
    }
}

/**
 * Fallback mobile navigation
 */
if(!function_exists('jnews_fallback_cb_mobile_navigation'))
{
    function jnews_fallback_cb_mobile_navigation(){
        // do nothing
    }
}

/**
 * Generate header unique style
 */
if(!function_exists('jnews_header_styling'))
{
    function jnews_header_styling($attr, $unique_class)
    {
        $type   = isset($attr['header_type']) ? $attr['header_type'] : 'heading_1';
        $style  = '';

        switch($type) {
            case "heading_1" :
                if(isset($attr['header_background']) && !empty($attr['header_background']))
                    $style .= ".{$unique_class}.jeg_block_heading_1 .jeg_block_title span { background: {$attr['header_background']}; }";

                if(isset($attr['header_text_color']) && !empty($attr['header_text_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_1 .jeg_block_title span, .{$unique_class}.jeg_block_heading_1 .jeg_block_title i { color: {$attr['header_text_color']}; }";

                if(isset($attr['header_line_color']) && !empty($attr['header_line_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_1 { border-color: {$attr['header_line_color']}; }";

                break;
            case "heading_2" :
                if(isset($attr['header_background']) && !empty($attr['header_background']))
                    $style .= ".{$unique_class}.jeg_block_heading_2 .jeg_block_title span { background: {$attr['header_background']}; }";

                if(isset($attr['header_text_color']) && !empty($attr['header_text_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_2 .jeg_block_title span, .{$unique_class}.jeg_block_heading_2 .jeg_block_title i { color: {$attr['header_text_color']}; }";

                if(isset($attr['header_secondary_background']) && !empty($attr['header_secondary_background']))
                    $style .= ".{$unique_class}.jeg_block_heading_2 { background-color: {$attr['header_secondary_background']}; }";

                break;
            case "heading_3" :
                if(isset($attr['header_background']) && !empty($attr['header_background']))
                    $style .= ".{$unique_class}.jeg_block_heading_3 { background: {$attr['header_background']}; }";

                if(isset($attr['header_text_color']) && !empty($attr['header_text_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_3 .jeg_block_title span, .{$unique_class}.jeg_block_heading_3 .jeg_block_title i { color: {$attr['header_text_color']}; }";

                break;
            case "heading_4" :
                if(isset($attr['header_background']) && !empty($attr['header_background']))
                    $style .= ".{$unique_class}.jeg_block_heading_4 .jeg_block_title span { background: {$attr['header_background']}; }";

                if(isset($attr['header_text_color']) && !empty($attr['header_text_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_4 .jeg_block_title span, .{$unique_class}.jeg_block_heading_4 .jeg_block_title i { color: {$attr['header_text_color']}; }";

                break;
            case "heading_5" :
                if(isset($attr['header_background']) && !empty($attr['header_background']))
                    $style .= ".{$unique_class}.jeg_block_heading_5 .jeg_block_title span, .{$unique_class}.jeg_block_heading_5 .jeg_subcat { background: {$attr['header_background']}; }";;

                if(isset($attr['header_text_color']) && !empty($attr['header_text_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_5 .jeg_block_title span, .{$unique_class}.jeg_block_heading_5 .jeg_block_title i { color: {$attr['header_text_color']}; }";

                if(isset($attr['header_line_color']) && !empty($attr['header_line_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_5:before { border-color: {$attr['header_line_color']}; }";

                break;
            case "heading_6" :
                if(isset($attr['header_text_color']) && !empty($attr['header_text_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_6 .jeg_block_title span, .{$unique_class}.jeg_block_heading_6 .jeg_block_title i { color: {$attr['header_text_color']}; }";

                if(isset($attr['header_line_color']) && !empty($attr['header_line_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_6 { border-color: {$attr['header_line_color']}; }";

                if(isset($attr['header_accent_color']) && !empty($attr['header_accent_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_6:after { background-color: {$attr['header_accent_color']}; }";

                break;
            case "heading_7" :
                if(isset($attr['header_text_color']) && !empty($attr['header_text_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_7 .jeg_block_title span, .{$unique_class}.jeg_block_heading_7 .jeg_block_title i { color: {$attr['header_text_color']}; }";

                if(isset($attr['header_accent_color']) && !empty($attr['header_accent_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_7 .jeg_block_title span { border-color: {$attr['header_accent_color']}; }";

                break;
            case "heading_8" :
                if(isset($attr['header_text_color']) && !empty($attr['header_text_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_8 .jeg_block_title span, .{$unique_class}.jeg_block_heading_8 .jeg_block_title i { color: {$attr['header_text_color']}; }";
                break;
            case "heading_9" :
                if(isset($attr['header_text_color']) && !empty($attr['header_text_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_9 .jeg_block_title span, .{$unique_class}.jeg_block_heading_9 .jeg_block_title i { color: {$attr['header_text_color']}; }";

                if(isset($attr['header_line_color']) && !empty($attr['header_line_color']))
                    $style .= ".{$unique_class}.jeg_block_heading_9 { border-color: {$attr['header_line_color']}; }";
                break;
        }

        return $style;
    }
}

if(!function_exists('jnews_module_custom_color'))
{
    function jnews_module_custom_color($attr, $unique_class)
    {
        $unique_class = trim($unique_class);
        $style  = '';

        if(isset($attr['title_color']) && !empty($attr['title_color']))
        {
            $style .= ".{$unique_class} .jeg_post_title a, .{$unique_class}.jeg_postblock .jeg_subcat_list > li > a, .{$unique_class} .jeg_pl_md_card .jeg_post_category a:hover { color: {$attr['title_color']} }";
        }

        if(isset($attr['accent_color']) && !empty($attr['accent_color']))
        {
            $style .= ".{$unique_class} .jeg_meta_author a, .{$unique_class} .jeg_post_title a:hover { color: {$attr['accent_color']} }";
            $style .= ".{$unique_class} .jeg_readmore:hover { border-color: {$attr['accent_color']}; }";
        }

        if(isset($attr['alt_color']) && !empty($attr['alt_color']))
        {
            $style .= ".{$unique_class} .jeg_post_meta, .{$unique_class} .jeg_post_meta .fa, .{$unique_class} .jeg_readmore:hover, .{$unique_class}.jeg_postblock .jeg_subcat_list > li > a:hover, .{$unique_class} .jeg_pl_md_card .jeg_post_category a, .{$unique_class}.jeg_postblock .jeg_subcat_list > li > a.current { color: {$attr['alt_color']} }";
        }

        if(isset($attr['excerpt_color']) && !empty($attr['excerpt_color']))
        {
            $style .= ".{$unique_class} p { color: {$attr['excerpt_color']} }";
        }

        if(isset($attr['block_background']) && !empty($attr['block_background']))
        {
            $style .= ".{$unique_class}.jeg_postblock .jeg_pl_md_card .jeg_postblock_content, .{$unique_class}.jeg_postblock .jeg_pl_lg_card .jeg_postblock_content { background: {$attr['block_background']} }";
        }

        return $style;
    }
}

/**
 * @return Jeg\Customizer
 */
if(!function_exists('jnews_customizer'))
{
    function jnews_customizer()
    {
        return Jeg\Customizer::getInstance();
    }
}

/** Translate */

if(!function_exists('jnews_language_switcher'))
{
    function jnews_language_switcher()
    {
        if ( function_exists('pll_the_languages') )
        {
            $parameter = apply_filters('jnews_top_lang_param', array(
                'dropdown'               => 0,
                'echo'                   => 0,
                'hide_if_empty'          => 1,
                'menu'                   => 0,
                'show_flags'             => 1,
                'show_names'             => 1,
                'display_names_as'       => 'name',
                'force_home'             => 0,
                'hide_if_no_translation' => 0,
                'hide_current'           => 1,
                'post_id'                => null,
                'raw'                    => 0,
            ));

            echo "<ul class='jeg_nav_item jeg_top_lang_switcher'>".
                    pll_the_languages($parameter) .
                 "</ul>";
        } else if ( function_exists('icl_get_languages') ) {
            
            $languages = icl_get_languages('skip_missing=0&orderby=code');

            if ( !empty( $languages ) ) 
            {
                $output = '';

                foreach ( $languages as $language ) 
                {
                    $output .= "<li class=\"avalang\">
                                    <a href=\"" . esc_url( $language['url'] ) . "\" data-tourl=\"false\">
                                        <img src=\"" . esc_url( $language['country_flag_url'] ) . "\" title=\"{$language['native_name']}\" alt=\"{$language['code']}\" data-pin-no-hover=\"true\">
                                        <span>{$language['native_name']}</span>
                                    </a>
                                </li>";
                }

                echo "<ul class='jeg_top_lang_switcher'>{$output}</ul>";
            }
        }
    }
}


/** Print Translation */

if(!function_exists('jnews_print_translation'))
{
    function jnews_print_translation($string, $domain, $name)
    {
        do_action('jnews_print_translation', $string, $domain, $name);
    }
}

if(!function_exists('jnews_print_main_translation'))
{
    add_action('jnews_print_translation', 'jnews_print_main_translation', 10, 2);

    function jnews_print_main_translation($string, $domain)
    {
        call_user_func_array('esc_html_e', array($string, $domain));
    }
}

/** Return Translation */

if(!function_exists('jnews_return_translation'))
{
    function jnews_return_translation($string, $domain, $name, $escape = true)
    {
        return apply_filters('jnews_return_translation', $string, $domain, $name, $escape);
    }
}

if(!function_exists('jnews_return_main_translation'))
{
    add_filter('jnews_return_translation', 'jnews_return_main_translation', 10, 4);

    function jnews_return_main_translation($string, $domain, $name, $escape = true)
    {
        if($escape)
        {
            return call_user_func_array('esc_html__', array($string, $domain));
        } else {
            return call_user_func_array('__', array($string, $domain));
        }

    }
}

if(!function_exists('jnews_the_author_link'))
{
    function jnews_the_author_link($author = null)
    {
        printf('<a href="%1$s">%2$s</a>',
            esc_url( get_author_posts_url( get_the_author_meta('ID', $author) ) ),
            get_the_author_meta('display_name', $author));
    }
}


if(!function_exists('jnews_get_respond_link'))
{
    function jnews_get_respond_link($post_id = null)
    {
        $permalink = get_the_permalink($post_id);

        $comment_type = get_theme_mod( 'jnews_comment_type', 'wordpress' );

        if ( $comment_type !== 'wordpress' ) 
        {
            $permalink .= "#comments";
        } else {
            $permalink .= "#respond";
        }

        return $permalink;
    }
}

/**
 * Edit Post
 */
if(!function_exists('jnews_edit_post'))
{
   function jnews_edit_post( $post_id, $position = "left" )
   {
        if ( current_user_can('edit_posts') && ! defined('JNEWS_SANDBOX_URL') )
        {
            $url  = get_edit_post_link( $post_id );
            
            return "<a class=\"jnews-edit-post {$position}\" href=\"{$url}\" target=\"_blank\">
                        <i class=\"fa fa-pencil\"></i>
                        <span>" . esc_html__('edit post', 'jnews') . "</span>
                    </a>";
        }

        return false;
   }
}

/**
 * Menu Instance Shorthand
 */
if(!function_exists('jnews_menu'))
{
    function jnews_menu()
    {
        return JNews\Menu\Menu::getInstance();
    }
}

/**
 * Get Mobile Menu Content
 */
if ( ! function_exists('jnews_render_mobile_menu_content') ) 
{
    add_action( 'jnews_mobile_menu_cotent', 'jnews_render_mobile_menu_content' );

    function jnews_render_mobile_menu_content()
    {
        get_template_part('fragment/header/mobile-menu-content');
    }
}

/**
 * Comment Number
 */
if ( !function_exists('jnews_get_comments_number') )
{
    function jnews_get_comments_number( $post_id = 0 )
    {
        $comment         = JNews\Comment\CommentNumber::getInstance();
        $comments_number = $comment->comments_number( $post_id );

        return apply_filters( 'jnews_get_comments_number', $comments_number, $post_id );
    }
}

if( !function_exists('jnews_sanitize_by_pass') )
{
    function jnews_sanitize_by_pass($value)
    {
        return $value;
    }
}


if( !function_exists('jnews_create_button') )
{
    function jnews_create_button($value)
    {
        $button_link = get_theme_mod('jnews_header_button_' . $value . '_link', '#');
        $button_icon = get_theme_mod('jnews_header_button_' . $value . '_icon', 'fa fa-envelope');
        $button_text = get_theme_mod('jnews_header_button_' . $value . '_text', 'Your text');
        $button_form = get_theme_mod('jnews_header_button_' . $value . '_form', 'default');
        $button_target = get_theme_mod('jnews_header_button_' . $value . '_target', '_blank');
    ?>
        <a href="<?php echo esc_attr($button_link) ?>" class="btn <?php echo esc_attr($button_form); ?>" target="<?php echo esc_attr($button_target) ?>">
            <i class="<?php echo esc_attr($button_icon) ?>"></i>
            <?php echo esc_html($button_text) ?>
        </a>
    <?php
    }
}

if( !function_exists('jnews_can_render_header'))
{
    function jnews_can_render_header($device, $row)
    {
        $columns = array();
        $can_render = false;

        if($device === 'desktop' || $device === 'desktop_sticky')
        {
            $columns = array('left', 'center', 'right');
        }

        if($device === 'mobile')
        {
            if($row === 'top')
            {
                $columns = array('center');
            } else {
                $columns = array('left', 'center', 'right');
            }
        }

        foreach ($columns as $column)
        {
            if($device === 'desktop_sticky') $device = 'sticky';

            $setting_element = "jnews_hb_element_{$device}_{$row}_{$column}";
            $default_element = get_theme_mod($setting_element, jnews_header_default("{$device}_element_{$row}_{$column}"));

            if(!empty($default_element) && is_array($default_element)) {
                $can_render = true;
                break;
            }
        }

        return $can_render;
    }
}

if(!function_exists('jnews_get_module_instance'))
{
    function jnews_get_module_instance($name)
    {
        return call_user_func(array($name, 'getInstance'));
    }
}


if(!function_exists('jnews_rand_color'))
{
    function jnews_rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}

if(!function_exists('jnews_ago_time'))
{
    function jnews_ago_time($time)
    {
        return esc_html(
            sprintf(
                jnews_return_translation('%s ago', 'jnews', 'sago'),
                $time
            )
        );
    }
}

if(!function_exists('jnews_random_class'))
{
    function jnews_random_class()
    {
        return 'jnews' . '_' . uniqid();
    }
}

if( !function_exists('jnews_header_default') )
{
    function jnews_header_default($option)
    {
        $default = '';

        switch ($option) {

            /** DISPLAY */
            case 'desktop_display_top_left' :
            case 'desktop_display_mid_right' :
            case 'desktop_display_bottom_left' :
            case 'sticky_display_mid_left' :
            case 'mobile_display_mid_center' :
                $default = 'grow';
                break;
            case 'desktop_display_top_center' :
            case 'desktop_display_top_right' :
            case 'desktop_display_mid_left' :
            case 'desktop_display_mid_center' :
            case 'desktop_display_bottom_center' :
            case 'desktop_display_bottom_right' :
            case 'sticky_display_mid_center' :
            case 'sticky_display_mid_right' :
            case 'mobile_display_mid_left' :
            case 'mobile_display_mid_right' :
                $default = 'normal';
                break;

            /** ELEMENT */
            case 'desktop_element_top_left' :
                $default = array('top_bar_menu');
                break;
            case 'desktop_element_top_right' :
                $default = array();
                break;
            case 'desktop_element_mid_left' :
            case 'mobile_element_mid_center' :
                $default = array('logo');
                break;
            case 'desktop_element_bottom_left' :
            case 'sticky_element_mid_left' :
                $default = array('main_menu');
                break;
            case 'desktop_element_bottom_right' :
            case 'sticky_element_mid_right' :
            case 'mobile_element_mid_right' :
                $default = array('search_icon');
                break;
            case 'mobile_element_mid_left' :
                $default = array('nav_icon');
                break;
            case 'drawer_element_top' :
                $default = array('search_form', 'mobile_menu');
                break;
            case 'drawer_element_bottom' :
                $default = array('social_icon', 'footer_copyright');
                break;
        }


        return $default;
    }
}

if ( ! function_exists('jeg_get_author_name') ) 
{
    function jeg_get_author_name( $author_id = '' )
    {
        $author_name = trim( get_the_author_meta( 'user_firstname', $author_id ) .' '. get_the_author_meta( 'user_lastname', $author_id ) );
        return empty( $author_name ) ? get_the_author_meta('user_nicename', $author_id) : $author_name;
    }
}

if ( ! function_exists('jeg_locate_template') ) 
{
    function jeg_locate_template( $template, $load = false, $args = array() ) 
    {
        if ( $args && is_array( $args ) ) 
        {
            extract( $args );
        }

        if ( ( true == $load ) && ! empty( $template ) )
        {
            include $template;
        }

        return $template;
    }
}

if(!function_exists('jeg_get_normal_widget_class_name_from_module'))
{
    function jeg_get_normal_widget_class_name_from_module($name)
    {
        $name = str_replace('JNews\Module\Widget\Widget_', '', $name);
        $name = str_replace('_Option', '', $name);
        $name = str_replace('_View', '', $name);

        return "\\JNews\\Widget\\Normal\\Element\\" . $name . "Widget";
    }
}

if ( ! function_exists( 'jeg_theme_version_log' ) )
{
    add_action( 'switch_theme', 'jeg_theme_version_log' );

    function jeg_theme_version_log()
    {
        if ( is_admin() )
        {
            $log_version     = get_option('jnews_theme_version_log');
            $current_version = wp_get_theme('jnews')->get('Version');

            if ( ! empty( $log_version ) )
            {
                if ( version_compare($current_version, $log_version['current_version'], '>'))
                {
	                update_option('jnews_theme_version_log', array('current_version' => $current_version, 'old_version' => $log_version['current_version']));
                }
            } else {
	            update_option('jnews_theme_version_log', array('current_version' => $current_version, 'old_version' => false));
            }
        }
    }
}