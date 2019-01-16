<?php

if( defined('VP_VERSION') )
	return;

//////////////////////////
// Include Constants    //
//////////////////////////
require_once 'constant.php';

//////////////////////////
// Include Autoloader   //
//////////////////////////
require_once 'autoload.php';

//////////////////////////
// Setup FileSystem     //
//////////////////////////
$vpfs = VP_FileSystem::instance();
$vpfs->add_directories('views'   , VP_VIEWS_DIR);
$vpfs->add_directories('config'  , VP_CONFIG_DIR);
$vpfs->add_directories('data'    , VP_DATA_DIR);
$vpfs->add_directories('includes', VP_INCLUDE_DIR);

//////////////////////////
// Include Data Source  //
//////////////////////////
foreach (glob(VP_DATA_DIR . "/*.php") as $datasource)
{
	require_once($datasource);
}

//////////////////////////
// TGMPA Unsetting      //
//////////////////////////
add_action('after_setup_theme', 'vp_tgm_ac_check');

if( !function_exists('vp_tgm_ac_check') )
{
	function vp_tgm_ac_check()
	{
		add_action('tgmpa_register', 'vp_tgm_ac_vafpress_check');
	}
}

if( !function_exists('vp_tgm_ac_vafpress_check') )
{
	function vp_tgm_ac_vafpress_check()
	{
		if( defined('VP_VERSION') and class_exists('TGM_Plugin_Activation') )
		{
			foreach (TGM_Plugin_Activation::$instance->plugins as $key => &$plugin)
			{
				if( $plugin['name'] === 'Vafpress Framework Plugin' )
				{
					unset(TGM_Plugin_Activation::$instance->plugins[$key]);
				}
			}
		}
	}
}

//////////////////////////
// Ajax Definition      //
//////////////////////////
add_action('wp_ajax_vp_ajax_wrapper', 'vp_ajax_wrapper');

if( !function_exists('vp_ajax_wrapper') )
{
	function vp_ajax_wrapper()
	{
		$function = $_POST['func'];
		$params   = $_POST['params'];

		if( VP_Security::instance()->is_function_whitelisted($function) )
		{
			if(!is_array($params))
				$params = array($params);

			try {
				$result['data']    = call_user_func_array($function, $params);
				$result['status']  = true;
				$result['message'] = "Successful";
			} catch (Exception $e) {
				$result['data']    = '';
				$result['status']  = false;
				$result['message'] = $e->getMessage();
			}
		}
		else
		{
			$result['data']    = '';
			$result['status']  = false;
			$result['message'] = "Unauthorized function";
		}

		if (ob_get_length()) ob_clean();
		header('Content-type: application/json');
		echo json_encode($result);
		die();
	}
}

/////////////////////////////////
// Pool and Dependencies Init  //
/////////////////////////////////
add_action( 'init'                 , 'vp_metabox_enqueue' );
add_action( 'init'                 , 'vp_sg_enqueue' );
add_action( 'admin_enqueue_scripts', 'vp_enqueue_scripts' );
add_action( 'current_screen'       , 'vp_sg_init_buttons' );

if( !function_exists('vp_metabox_enqueue') )
{
	function vp_metabox_enqueue()
	{
		if( VP_WP_Admin::is_post_or_page() and VP_Metabox::pool_can_output() )
		{
			$loader = VP_WP_Loader::instance();
			$loader->add_main_js( 'vp-metabox' );
			$loader->add_main_css( 'vp-metabox' );
		}
	}
}

if( !function_exists('vp_sg_enqueue') )
{
	function vp_sg_enqueue()
	{
		if( VP_ShortcodeGenerator::pool_can_output() )
		{
			// enqueue dummy js
			$localize = VP_ShortcodeGenerator::build_localize();
			wp_register_script( 'vp-sg-dummy', VP_PUBLIC_URL . '/js/dummy.js', array(), '', false );
			wp_localize_script( 'vp-sg-dummy', 'vp_sg', $localize );
			wp_enqueue_script( 'vp-sg-dummy' );

			$loader = VP_WP_Loader::instance();
			$loader->add_main_js( 'vp-shortcode' );
			$loader->add_main_css( 'vp-shortcode' );
		}
	}
}

add_action('admin_footer', 'vp_post_dummy_editor');

if( !function_exists('vp_post_dummy_editor') )
{
	function vp_post_dummy_editor()
	{
		/**
		 * If we're in post edit page, and the post type doesn't support `editor`
		 * we need to echo out a dummy editor to load all necessary js and css
		 * to be used in our own called wp editor.
		 */
		$loader = VP_WP_Loader::instance();
		$types  = $loader->get_types();
		$dummy  = false;

		if( VP_WP_Admin::is_post_or_page() )
		{
			$types = array_unique( array_merge( $types['metabox'], $types['shortcodegenerator'] ) );
			if( in_array('wpeditor', $types ) )
			{
				if( !VP_ShortcodeGenerator::pool_supports_editor() and !VP_Metabox::pool_supports_editor() )
					$dummy = true;
			}
		}
		else
		{
			$types = $types['option'];
			if( in_array('wpeditor', $types ) )
				$dummy = true;
		}

		if( $dummy )
		{
			echo '<div style="display: none">';
			add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );
			wp_editor ( '', 'vp_dummy_editor' );
			echo '</div>';
		}
	}
}

if( !function_exists('vp_sg_init_buttons') )
{
	function vp_sg_init_buttons()
	{
		if( VP_ShortcodeGenerator::pool_can_output() )
		{
			VP_ShortcodeGenerator::init_buttons();
		}
	}
}

if( !function_exists('vp_enqueue_scripts') )
{
	function vp_enqueue_scripts()
	{
		$loader = VP_WP_Loader::instance();
		$loader->build();
	}
}

/**
 * Easy way to get metabox values using dot notation
 * example:
 *
 * vp_metabox('meta_name.field_name')
 * vp_metabox('meta_name.group_name')
 * vp_metabox('meta_name.group_name.0.field_name')
 *
 */

if( !function_exists('vp_metabox') )
{
	function vp_metabox($key, $default = null, $post_id = null)
	{
		global $post;

		$vp_metaboxes = VP_Metabox::get_pool();

		if(!is_null($post_id))
		{
			$the_post = get_post($post_id);
			if ( empty($the_post) ) $post_id = null;
		}

		if(is_null($post) and is_null($post_id))
			return apply_filters('jeg_vp_metabox',$default);

		$keys = explode('.', $key);
		$temp = NULL;

		foreach ($keys as $idx => $key)
		{
			if($idx == 0)
			{
				if(array_key_exists($key, $vp_metaboxes))
				{
					$temp = $vp_metaboxes[$key];
					if(!is_null($post_id))
						$temp->the_meta($post_id);
					else
						$temp->the_meta();
				}
				else
				{
					return apply_filters('jeg_vp_metabox', $default );
				}
			}
			else
			{
				if(is_object($temp) and get_class($temp) === 'VP_Metabox')
				{
					$temp = $temp->get_the_value($key);
				}
				else
				{
					if(is_array($temp) and array_key_exists($key, $temp))
					{
						$temp = $temp[$key];
					}
					else
					{
						return apply_filters('jeg_vp_metabox', $default );
					}
				}
			}
		}
		return apply_filters('jeg_vp_metabox', $temp );
	}
}

/**
 * Easy way to get option values using dot notation
 * example:
 *
 * vp_option('option_key.field_name')
 *
 */

if( !function_exists('vp_option') )
{
	function vp_option($key, $default = null)
	{
		$vp_options = VP_Option::get_pool();

		if(empty($vp_options))
			return apply_filters('jeg_vp_option', $default);

		$keys = apply_filters('vp_get_option_key', explode('.', $key));
		$temp = NULL;

		foreach ($keys as $idx => $key)
		{
			if($idx == 0)
			{
				if(array_key_exists($key, $vp_options))
				{
					$temp = $vp_options[$key];
					$temp = $temp->get_options();
				}
				else
				{
					return apply_filters('jeg_vp_option',$default);
				}
			}
			else
			{
				if(is_array($temp) and array_key_exists($key, $temp))
				{
					$temp = $temp[$key];
				}
				else
				{
					return apply_filters('jeg_vp_option',$default );
				}
			}
		}
		return apply_filters('jeg_vp_option', $temp );
	}
}



add_action('wp_ajax_vp_send_link_to_editor'				, 'vp_send_link_to_editor');
add_action('wp_ajax_nopriv_vp_send_link_to_editor'		, 'vp_send_link_to_editor');

if(!function_exists('vp_send_link_to_editor')) 
{
	function vp_send_link_to_editor() {
		global $post, $wp_embed;

		check_ajax_referer( 'media-send-to-editor', 'nonce' );

		if ( ! $src = wp_unslash( $_POST['src'] ) )
			wp_send_json_error();

		if ( ! strpos( $src, '://' ) )
			$src = 'http://' . $src;

		if ( ! $src = esc_url_raw( $src ) )
			wp_send_json_error();

		if ( ! $title = trim( wp_unslash( $_POST['title'] ) ) )
			$title = wp_basename( $src );

		$post = get_post( isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0 );

		// Ping WordPress for an embed.
		$check_embed = $wp_embed->run_shortcode( '[embed]'. $src .'[/embed]' );

		// Fallback that WordPress creates when no oEmbed was found.
		$fallback = $wp_embed->maybe_make_link( $src );

		if ( $check_embed !== $fallback ) {
			// TinyMCE view for [embed] will parse this
			$html = '<a href="' . esc_url( $src ) . '">' . $title . '</a>';
		} elseif ( $title ) {
			$html = '<a href="' . esc_url( $src ) . '">' . $title . '</a>';
		} else {
			$html = '';
		}

		// Figure out what filter to run:
		$type = 'file';
		if ( ( $ext = preg_replace( '/^.+?\.([^.]+)$/', '$1', $src ) ) && ( $ext_type = wp_ext2type( $ext ) )
			&& ( 'audio' == $ext_type || 'video' == $ext_type ) )
			$type = $ext_type;

		/** This filter is documented in wp-admin/includes/media.php */
		$html = apply_filters( $type . '_send_to_editor_url', $html, $src, $title );

		wp_send_json_success( $html );
	}
}


add_action( 'wp_ajax_vp_find_ajax_post', 'vp_find_ajax_post');
add_action( 'wp_ajax_nopriv_vp_find_ajax_post', 'vp_find_ajax_post');

function vp_find_ajax_post()
{
    add_filter( 'posts_where', 'vp_posts_search_where', 10, 2 );
    $query = new WP_Query(
        array (
            'post_type'        => array('post', 'page'),
            'posts_per_page'   => '15',
            'post_status'      => 'publish',
            'orderby'          => 'date',
            'order'            => 'DESC',
        )
    );

    $result = array();

    if ( $query->have_posts() ) {
        while ($query->have_posts()) {
            $query->the_post();

            $post_id = get_the_ID();
            $result[] = array(
                'value' => get_the_ID(),
                'text' => get_the_title()
            );
        }
    }

    remove_filter('posts_where', 'vp_posts_search_where');

    wp_reset_postdata();

    wp_send_json($result);
}

function vp_posts_search_where($where, &$wp_query)
{
    global $wpdb;
    if ( isset( $_REQUEST[ 'string' ] ) && ! empty( $_REQUEST[ 'string' ] ) ) 
    {
        $string = $_REQUEST[ 'string' ];

        $where .= $wpdb->prepare("
            AND {$wpdb->posts}.post_title LIKE '%%%s%%'",
            $string
        );
    }
    return $where;
}

if ( ! function_exists('vp_sanitize_output') ) 
{
	function vp_sanitize_output( $value )
	{
		return $value;
	}
}

add_action( 'wp_ajax_vp_find_ajax_post_tag', 'vp_find_ajax_post_tag');
add_action( 'wp_ajax_nopriv_vp_find_ajax_post_tag', 'vp_find_ajax_post_tag');

function vp_find_ajax_post_tag()
{
	if ( isset( $_REQUEST[ 'string' ] ) && ! empty( $_REQUEST[ 'string' ] ) ) 
    {
        $string = $_REQUEST[ 'string' ];
    } else {
    	return false;
    }

    $args = array(
	    'taxonomy'      => array( 'post_tag' ),
	    'orderby'       => 'id', 
	    'order'         => 'ASC',
	    'hide_empty'    => true,
	    'fields'        => 'all',
	    'name__like'    => $string
	); 

	$terms = get_terms( $args );

    $result = array();

    if ( count($terms) > 0 ) 
    {
    	foreach ( $terms as $term ) 
    	{
    		$result[] = array(
                'value' => $term->term_id,
                'text' 	=> $term->name
            );
    	}
    }

    wp_send_json($result);
}

add_action( 'wp_ajax_vp_find_ajax_author', 'vp_find_ajax_author');
add_action( 'wp_ajax_nopriv_vp_find_ajax_author', 'vp_find_ajax_author');

function vp_find_ajax_author()
{
	if ( isset( $_REQUEST[ 'string' ] ) && ! empty( $_REQUEST[ 'string' ] ) ) 
    {
        $string = esc_attr( trim( $_REQUEST[ 'string' ] ) );
    } else {
    	return false;
    }

    $users = new WP_User_Query( array(
	    'search'         => "*{$string}*",
	    'search_columns' => array(
	        'user_login',
	        'user_nicename',
	        'user_email',
	        'user_url',
	    ),
	    'meta_query' => array(
	        'relation' => 'OR',
	        array(
	            'key'     => 'first_name',
	            'value'   => $string,
	            'compare' => 'LIKE'
	        ),
	        array(
	            'key'     => 'last_name',
	            'value'   => $string,
	            'compare' => 'LIKE'
	        )
	    )
	) );
	$users_found = $users->get_results();

    $result = array();

    if ( count($users_found) > 0 ) 
    {
    	foreach ( $users_found as $user ) 
    	{
    		$result[] = array(
                'value' => $user->ID,
                'text' 	=> $user->display_name
            );
    	}
    }

    wp_send_json($result);
}

/**
 * EOF
 */