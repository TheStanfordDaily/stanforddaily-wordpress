<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Util;

/**
 * Cache Variable for Plugin
 */
Class Cache
{

    public static function cache_term($terms)
    {
        foreach($terms as $term)
        {
            wp_cache_add( $term->term_id, $term, 'terms' );
        }
    }

    /**
     * @return array
     */
    public static function get_users()
    {
        if(!$users = wp_cache_get('users', 'jnews'))
        {
            $users = get_users();
            wp_cache_set('users', $users, 'jnews');
        }

        return $users;
    }

	/**
	 * @return array
	 */
	public static function get_count_users()
	{
		if(!$count = wp_cache_get('count_users', 'jnews'))
		{
			$count = count_users();
			wp_cache_set('count_users', $count, 'jnews');
		}

		return $count;
	}

    /**
     * @return array
     */
    public static function get_categories()
    {
        if(!$categories = wp_cache_get('categories', 'jnews'))
        {
            $categories = get_categories(array('hide_empty' => 0 ));
            wp_cache_set('categories', $categories, 'jnews');
            self::cache_term($categories);
        }

        return $categories;
    }

    /**
     * @return array
     */
    public static function get_tags()
    {
        if(!$tags = wp_cache_get('tags', 'jnews'))
        {
            $tags = get_tags(array('hide_empty' => 0 ));
            wp_cache_set('tags', $tags, 'jnews');
            self::cache_term($tags);
        }

        return $tags;
    }

    /**
     * @return array
     */
    public static function get_post_type()
    {
        if(!$post_type = wp_cache_get('post_type', 'jnews'))
        {
            $post_type = get_post_types(array(
                'public' => true,
                'show_ui' => true
            ));
            wp_cache_set('post_type', $post_type, 'jnews');
        }

        return $post_type;
    }

    /**
     * @return array
     */
    public static function get_menu()
    {
        if(!$menu = wp_cache_get('menu', 'jnews'))
        {
            $menu = wp_get_nav_menus();
            wp_cache_set('menu', $menu, 'jnews');
        }

        return $menu;
    }
}