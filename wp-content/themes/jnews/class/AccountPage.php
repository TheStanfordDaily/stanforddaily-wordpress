<?php
/**
 * @author Jegtheme
 */
namespace JNews;

/**
 * Class JNews Account Page
 */
Class AccountPage
{   
    private static $instance;

    private $endpoint;

    private $current_page;

    public static function getInstance()
    {
        if ( null === static::$instance )
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->setup_endpoint();
        $this->setup_hook();
    }

    protected function setup_hook()
    {
        add_action( 'init',                         array( $this, 'add_rewrite_rule' ) );
        add_action( 'wp_loaded',                    array( $this, 'form_handler' ), 20 );
        add_action( 'after_switch_theme',           array( $this, 'flush_rewrite_rules' ) );
        add_action( 'template_include',             array( $this, 'add_page_template' ) );
        add_action( 'jnews_account_right_content',  array( $this, 'get_right_content' ) );
        add_action( 'jnews_account_right_title',    array( $this, 'get_right_title' ) );
        add_action( 'get_avatar',                   array( $this, 'user_avatar'), 10, 6);
        add_action( 'delete_attachment',            array( $this, 'disable_delete_attachment' ) );
        add_action( 'admin_init',                   array( $this, 'prevent_admin_access' ), 5 );

        add_filter( 'document_title_parts',         array( $this, 'account_title') );
        add_filter( 'jnews_dropdown_link',          array( $this, 'dropdown_link' ) );
        add_filter( 'upload_size_limit',            array( $this, 'upload_size_limit' ) );
        add_filter( 'ajax_query_attachments_args',  array( $this, 'filter_user_media' ) );
        add_filter( 'upload_mimes',                 array( $this, 'filter_mime_types' ) );
    }

    public function filter_mime_types( $mime_types ) 
    {
        if ( $this->current_page === 'edit_account' )
        {
            return array(
                'jpg|jpeg|jpe'  => 'image/jpeg',
                'gif'           => 'image/gif',
                'png'           => 'image/png',
            );
        }

        return $mime_types;
    }

    public function load_script()
    {
        // $asset_url = apply_filters('jnews_get_asset_uri', get_parent_theme_file_uri('assets/'));

        wp_enqueue_media();

        // wp_enqueue_script( 'selectize', $asset_url . 'js/vendor/selectize.js', array( 'jquery' ), $this->get_theme_version(), true );
    }

    protected function is_account_page( $wp )
    {
        if ( is_user_logged_in() && ! is_admin() )
        {
            if ( isset( $wp->query_vars[$this->endpoint['account']['slug']] ) ) 
            {
                add_action( 'wp_enqueue_scripts', array($this, 'load_script'));

                return true;
            }
        }

        return false;
    }

    protected function setup_endpoint()
    {
        $endpoint = array(
            'account' => array(
                'slug'  => 'account',
                'label' => 'my_account',
                'title' => esc_html__( 'My Account', 'jnews' ),
            ),
            'edit_account' => array(
                'slug'  => 'edit-account',
                'label' => 'edit_account',
                'title' => esc_html__( 'Edit Account', 'jnews' )
            ),
            'change_password' => array(
                'slug'  => 'change-password',
                'label' => 'change_password',
                'title' => esc_html__( 'Change Password', 'jnews' )
            )
        );

        $this->endpoint = apply_filters( 'jnews_account_page_endpoint', $endpoint );
    }

    public function get_endpoint()
    {
        return $this->endpoint;
    }

    protected function setup_current_page( $page )
    {
        foreach ( $this->endpoint as $key => $value ) 
        {
            if ( $page == $value['slug'] ) 
            {
                $this->current_page = $key;
            }
        }
    }

    public function get_current_page()
    {
        return $this->current_page;
    }

    public function get_right_title()
    {
        if ( isset( $this->current_page ) ) 
        {
	        echo jnews_return_translation($this->endpoint[$this->current_page]['title'], 'jnews', $this->endpoint[$this->current_page]['label']);
        }
    }

    public function get_right_content()
    {
        if ( $this->current_page == 'edit_account' )
        {
            jeg_locate_template( locate_template('fragment/account/account-edit.php', false, false), true, $this->get_user_data() );
        }
        elseif ( $this->current_page == 'change_password' )
        {
            jeg_locate_template( locate_template('fragment/account/account-password.php', false, false), true );
        }
    }

    public function add_rewrite_rule()
    {
        add_rewrite_endpoint( $this->endpoint['account']['slug'] , EP_ROOT | EP_PAGES );
        add_rewrite_rule( '^' . $this->endpoint['account']['slug'] . '/page/?([0-9]{1,})/?$', 'index.php?&paged=$matches[1]&' . $this->endpoint['account']['slug'], 'top' );
    }

    public function flush_rewrite_rules()
    {
        $this->add_rewrite_rule();

        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    public function dropdown_link( $dropdown )
    {
        if ( is_user_logged_in() ) 
        {
            $item['account'] = array(
                'text' => jnews_return_translation($this->endpoint['account']['title'], 'jnews', $this->endpoint['account']['label']),
                'url'  => home_url( '/' . $this->endpoint['account']['slug'] )
            );

            if ( isset( $item ) ) 
            {
                $dropdown = array_merge( $item, $dropdown );
            }
        }

        return $dropdown;
    }

    public function add_page_template( $template )
    {
        global $wp;

        if ( $this->is_account_page( $wp ) )
        {
            $query_vars = explode('/', $wp->query_vars[$this->endpoint['account']['slug']]);

            if ( ! empty( $query_vars[0] ) ) 
            {
                $this->setup_current_page( $query_vars[0] );
            } else {
                // redirect to edit account
                // $this->setup_current_page('account');  
                wp_safe_redirect( home_url( '/' . $this->endpoint['account']['slug'] . '/' . $this->endpoint['edit_account']['slug'] ) );
            }

            $template = locate_template('fragment/account/account-page.php', false, false);
        }

        return $template;
    }

    public function account_title( $title )
    {
        global $wp;
        $split      = $title;
        $additional = '';

        if ( $this->is_account_page( $wp ) )
        {   
            if ( isset( $this->current_page ) ) 
            {
	            $additional = jnews_return_translation($this->endpoint[$this->current_page]['title'], 'jnews', $this->endpoint[$this->current_page]['label']);
            }

            $additional = apply_filters( 'jnews_account_title', $additional, $wp, $this->endpoint );

            global $wp_query;
            $split['title'] = isset( $wp_query->queried_object->post_title );

            if ( ! empty( $additional ) ) 
            {
                $title['title'] = $additional . ' ' . $split['title'] ;
            }
        }

        return $title;
    }

    public function user_avatar( $avatar, $user_id , $size, $default, $alt, $args )
    {
        $profile_picture = get_the_author_meta( 'profile_picture', $user_id );

        if ( $profile_picture ) 
        {
            $image = wp_get_attachment_image_src( $profile_picture, 'thumbnail' );

            $class = array( 'avatar', 'avatar-' . (int) $args['size'], 'photo' );

            if ( ! $args['found_avatar'] || $args['force_default'] ) 
            {
                $class[] = 'avatar-default';
            }

            if ( $args['class'] ) 
            {
                if ( is_array( $args['class'] ) ) 
                {
                    $class = array_merge( $class, $args['class'] );
                } else {
                    $class[] = $args['class'];
                }
            }

            $avatar = sprintf(
                "<img alt='%s' src='%s' srcset='%s' class='%s' height='%d' width='%d' %s/>",
                esc_attr( $args['alt'] ),
                esc_url( $image[0] ),
                esc_attr( "$image[0] 2x" ),
                esc_attr( join( ' ', $class ) ),
                (int) $args['height'],
                (int) $args['width'],
                $args['extra_attr']
            );
        }
        
        return $avatar;
    }

    protected function user_social_info()
    {
        return array(
            "facebook"      => jnews_return_translation('Facebook', 'jnews', 'facebook'),
            "twitter"       => jnews_return_translation('Twitter', 'jnews', 'twitter'),
            "googleplus"    => jnews_return_translation('Google Plus', 'jnews', 'google'),
            "linkedin"      => jnews_return_translation('Linkedin', 'jnews', 'linkedin'),
            "pinterest"     => jnews_return_translation('Pinterest', 'jnews', 'pinterest'),
            "behance"       => jnews_return_translation('Behance', 'jnews', 'behance'),
            "github"        => jnews_return_translation('Github', 'jnews', 'github'),
            "flickr"        => jnews_return_translation('Flickr', 'jnews', 'flickr'),
            "tumblr"        => jnews_return_translation('Tumblr', 'jnews', 'tumblr'),
            "dribbble"      => jnews_return_translation('Dribbble', 'jnews', 'dribbble'),
            "soundcloud"    => jnews_return_translation('Soundcloud', 'jnews', 'soundcloud'),
            "instagram"     => jnews_return_translation('Instagram', 'jnews', 'instagram'),
            "vimeo"         => jnews_return_translation('Vimeo', 'jnews', 'vimeo'),
            "youtube"       => jnews_return_translation('Youtube', 'jnews', 'youtube'),
            "reddit"        => jnews_return_translation('Reddit', 'jnews', 'reddit'),
            "vk"            => jnews_return_translation('Vk', 'jnews', 'vk'),
            "weibo"         => jnews_return_translation('Weibo', 'jnews', 'weibo'),
            "rss"           => jnews_return_translation('Rss', 'jnews', 'rss'),
        );
    }

    protected function get_user_data()
    {
        $user_id = get_current_user_id();

        $user = array(
            'user_firstname'    => trim( get_the_author_meta( 'user_firstname', $user_id ) ),
            'user_lastname'     => trim( get_the_author_meta( 'user_lastname', $user_id ) ),
            'description'       => get_the_author_meta( 'description', $user_id ),
            'photo'             => array(get_the_author_meta( 'profile_picture', $user_id ))
        );

        foreach ( $this->user_social_info() as $key => $value ) 
        {
            $user['socials'][$key] = array(
                'label' => $value,
                'value' => trim( get_the_author_meta( $key, $user_id ) )
            );
        }

        return $user;
    }

    public function form_handler()
    {
        if ( isset($_POST['jnews-action']) && ! empty($_POST['jnews-account-nonce'])  && wp_verify_nonce($_POST['jnews-account-nonce'], 'jnews-account-nonce') )
        {
            $action = $_POST['jnews-action'];

            switch ( $action ) 
            {
                case 'edit-account':
                    $this->edit_account_handler();
                    break;
                case 'change-password':
                    $this->edit_password_handler();
                    break;
            }
        }
    }

    protected function edit_account_handler()
    {
        $user_id = get_current_user_id();

        try {

            if ( empty( $_POST['fname'] ) )
            {
	            throw new \Exception( jnews_return_translation( 'First name should not be empty', 'jnews', 'first_name_required' ) );
            }

            if ( empty( $_POST['lname'] ) )
            {
	            throw new \Exception( jnews_return_translation( 'Last name should not be empty', 'jnews', 'last_name_required' ) );
            }

            wp_update_user(array(
                'ID'            => $user_id,
                'first_name'    => sanitize_text_field( $_POST['fname'] ),
                'last_name'     => sanitize_text_field( $_POST['lname'] ),
                'description'   => wp_kses_post($_POST['description'])
            ));

            foreach( $this->user_social_info() as $key => $value ) 
            {
                update_user_meta( $user_id, $key, sanitize_text_field($_POST[$key]) );
            }

            if( isset($_POST['photo'][0]) && '' != $_POST['photo'][0] )
            {
                update_user_meta($user_id, 'profile_picture', sanitize_text_field($_POST['photo'][0]));
            } else {
                delete_user_meta($user_id, 'profile_picture');
            }

	        $_POST['success-message'] = jnews_return_translation( 'You have successfully edited your account details', 'jnews', 'success_edit_account' );

        } catch(\Exception $e) {
            $_POST['error-message'] = $e->getMessage();
        }
    }

    protected function edit_password_handler()
    {
        $user_id = get_current_user_id();
        $user    = get_userdata($user_id);

        try {

            if ( ! empty( $_POST['old_password']) )
            {
                if ( ! wp_check_password( $_POST['old_password'] , $user->data->user_pass, $user_id ) )
                {
	                throw new \Exception( jnews_return_translation( 'Your old password is not valid', 'jnews', 'old_password_error' ) );
                }

                if ( empty($_POST['new_password']) || empty($_POST['confirm_password']) )
                {
	                throw new \Exception( jnews_return_translation( 'Please enter your new password', 'jnews', 'new_password_empty' ) );
                }

                if ($_POST['new_password'] !== $_POST['confirm_password'] )
                {
	                throw new \Exception( jnews_return_translation( 'New Password & Confirm Password do not match', 'jnews', 'confirm_password_error' ) );
                }

                $this->do_reset_password( $user, $_POST['new_password'] );

	            $_POST['success-message'] = jnews_return_translation( 'You have successfully changed your password', 'jnews', 'success_change_password' );
            } else {
	            throw new \Exception( jnews_return_translation( 'Please enter your old password', 'jnews', 'old_password_empty' ) );
            }
        } catch(\Exception $e) {
            $_POST['error-message'] = $e->getMessage();
        }
    }

    protected function do_reset_password ( $user, $new_pass )
    {
        do_action( 'password_reset', $user, $new_pass );

        wp_set_password( $new_pass, $user->ID );

        wp_password_change_notification( $user );
    }

    public function upload_size_limit( $size )
    {
        if ( ! current_user_can( 'manage_options' ) ) 
        {
            $size = apply_filters( 'jnews_frontend_max_upload_size', ( 2 * 1000 * 1024 ) );
        }

        return $size;
    }

    public function filter_user_media( $query ) 
    {
        if ( ! current_user_can( 'manage_options' ) ) 
        {
            $query['author'] = get_current_user_id();
        }

        return $query;
    }

    public function disable_delete_attachment()
    {
        if ( ! current_user_can('manage_options') ) 
        {
            exit();
        }
    }

    public function prevent_admin_access()
    {
        $prevent_access = false;

        if ( ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) && basename( $_SERVER["SCRIPT_FILENAME"] ) !== 'admin-post.php' && ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' )  )
        {
            $prevent_access = true;
        }

        if ( $prevent_access ) 
        {
            wp_safe_redirect( home_url('/') );
            exit;
        }
    }
}