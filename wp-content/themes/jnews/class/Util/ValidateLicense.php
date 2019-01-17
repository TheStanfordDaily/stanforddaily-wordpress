<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Util;

Class ValidateLicense
{
    /**
     * @var array
     *
     * Contain array of menu slug
     */
    private $menu;

    /**
     * @var string
     */
    private $optionname = 'jnews_license';

    /**
     * @var ValidateLicense
     */
    private static $instance;

    /**
     * @return ValidateLicense
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->setup_hook();
        $this->menu = apply_filters('jnews_get_admin_slug', '');
    }

    public function setup_hook()
    {
        add_action('admin_notices', array(&$this, 'validate_notice'));
        add_action('admin_init', array(&$this, 'do_validate_license'));

        add_filter('pre_set_site_transient_update_themes', array($this, 'update_themes'));
        add_filter('pre_set_transient_update_themes', array($this, 'update_themes'));

        add_filter('jnews_check_is_license_validated', array($this, 'is_license_validated'));
        add_action('upgrader_package_options', array($this, 'maybe_deferred_download'), 99);

        add_action( 'wp_ajax_dismiss_license_notice', array($this, 'dismiss_license_notice') );
        add_action( 'wp_ajax_nopriv_dismiss_license_notice', array($this, 'dismiss_license_notice') );
    }

    public function dismiss_license_notice()
    {
        update_option( 'jnews_dismiss_license_notice', true );
    }

    public function maybe_deferred_download($options)
    {
        $package = $options['package'];
        if (false !== strrpos($package, 'deferred_download') && false !== strrpos($package, 'item_id')) {
            parse_str(parse_url($package, PHP_URL_QUERY), $vars);
            if ($vars['item_id']) {
                $options['package'] = $this->get_download_url($vars['item_id']);
            }
        }
        return $options;
    }


    public function update_themes($transient)
    {
        if (isset($transient->checked))
        {
            if($this->check_themes())
            {
                $option = get_option($this->optionname);

                $premium = $option['item'];
                $slug = $premium['slug'];
                $theme = wp_get_theme($slug);

                if ($theme->exists() && version_compare($theme->get('Version'), $premium['version'], '<')) {
                    $transient->response[$slug] = array(
                        'theme' => $slug,
                        'new_version' => $premium['version'],
                        'url' => $premium['url'],
                        'package' => $this->deferred_download_url($premium['id'])
                    );
                }
            }
        }

        return $transient;
    }

    public function deferred_download_url($id)
    {
        $args = array(
            'deferred_download' => true,
            'item_id' => $id,
        );
        return add_query_arg($args, esc_url($this->license_url()));
    }

    public function license_url()
    {
        static $url;
        $adminslug = apply_filters('jnews_get_admin_slug', '');

        if (!isset($url)) {
            $parent = 'jnews';
            if (false === strpos($parent, '.php')) {
                $parent = 'admin.php';
            }
            $url = add_query_arg(
                array(
                    'page' => urlencode($adminslug['dashboard']),
                ),
                self_admin_url($parent)
            );
        }

        return $url;
    }

    public function check_purchase_wordpress_themes($token)
    {
        $url = 'https://api.envato.com/v2/market/buyer/list-purchases?filter_by=wordpress-themes';
        $response = $this->request($url, $token, array());

        if( ! is_wp_error( $response ) )
        {
            if ($response && isset($response['results']))
            {
                foreach ($response['results'] as $key => $item)
                {
                    unset($item['item']['description']);
                    if ($item['item']['id'] === JNEWS_THEME_ID)
                    {
                        return $this->normalize_themes($item['item']);
                    }
                }
            }
        }

        return false;
    }

    public function get_token($token = null)
    {
        if ($token === null || empty($token)) {
            if ($this->is_license_validated()) {
                $option = get_option($this->optionname);
                $token = $option['token'];
            } else {
                return false;
            }
        }

        return $token;
    }

    public function get_download_url($id, $token = null)
    {
        $token = $this->get_token($token);

        if ($token) {
            $url = 'https://api.envato.com/v2/market/buyer/download?item_id=' . $id . '&shorten_url=true';
            $response = $this->request($url, $token, array());

            if(!is_wp_error( $response ) ) {
                return $response['wordpress_theme'];
            } else {
                return false;
            }
        }

        return false;
    }

    public function check_themes($token = null)
    {
        $token = $this->get_token($token);

        if ($token)
        {
            $result = $this->check_purchase_wordpress_themes($token);

            if ( $result )
            {
                update_option($this->optionname, array(
                    'validated' => true,
                    'token' => $token,
                    'item' => $result
                ));

                return true;
            } else {
                update_option($this->optionname, array(
                    'validated' => false,
                    'token' => null,
                    'item' => null
                ));
                return false;
            }
        }

        return false;
    }

    public function request($url, $token, $args)
    {
        $defaults = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $token,
                'User-Agent' => 'JNews WordPress Themes',
            ),
            'timeout' => 20,
        );
        $args = wp_parse_args($args, $defaults);

        $token = trim(str_replace('Bearer', '', $args['headers']['Authorization']));
        if (empty($token)) {
            return new \WP_Error('api_token_error', esc_html__('An API token is required.', 'jnews'));
        }

        // Make an API request.
        $response = wp_remote_get(esc_url_raw($url), $args);

        // Check the response code.
        $response_code = wp_remote_retrieve_response_code($response);
        $response_message = wp_remote_retrieve_response_message($response);

        if (200 !== $response_code && !empty($response_message)) {
            return new \WP_Error($response_code, $response_message);
        } elseif (200 !== $response_code) {
            return new \WP_Error($response_code, esc_html__('An unknown API error occurred.', 'jnews'));
        } else {
            $return = json_decode(wp_remote_retrieve_body($response), true);
            if (null === $return) {
                return new \WP_Error('api_error', esc_html__('An unknown API error occurred.', 'jnews'));
            }
            return $return;
        }
    }

    public function do_validate_license()
    {
        if (!isset($_POST['envato_token']))
            return;

        $token = trim(sanitize_text_field($_POST['envato_token']));
        $adminslug = apply_filters('jnews_get_admin_slug', '');

        if (isset($_POST['jnews-validate-license']) && 'validate-license' === $_POST['jnews-validate-license'])
        {
            check_admin_referer($adminslug['dashboard']);
            $result = $this->check_themes($token);
            if (!$result) add_action('admin_notices', array(&$this, 'print_validate_failed'));
        }
    }

    public function normalize_themes($theme)
    {
        $item = array(
            'id' => $theme['id'],
            'name' => (!empty($theme['wordpress_theme_metadata']['theme_name']) ? $theme['wordpress_theme_metadata']['theme_name'] : ''),
            'author' => (!empty($theme['wordpress_theme_metadata']['author_name']) ? $theme['wordpress_theme_metadata']['author_name'] : ''),
            'version' => (!empty($theme['wordpress_theme_metadata']['version']) ? $theme['wordpress_theme_metadata']['version'] : ''),
            'description' => $this->remove_non_unicode($theme['wordpress_theme_metadata']['description']),
            'url' => (!empty($theme['url']) ? $theme['url'] : ''),
            'author_url' => (!empty($theme['author_url']) ? $theme['author_url'] : ''),
            'thumbnail_url' => (!empty($theme['thumbnail_url']) ? $theme['thumbnail_url'] : ''),
        );

        $item['slug'] = $this->get_theme_slug($item);
        return $item;
    }

    public function get_theme_slug($item)
    {
        $slug = '';

        foreach (wp_get_themes() as $theme) {
            $template = $theme->get_template();
            $title = $theme->get('Name');
            $author = $theme->get('Author');

            if ($this->normalize($item['name']) === $this->normalize($title)
                && $this->normalize($item['author']) === $this->normalize($author)
            ) {
                return $template;
            }
        }

        return $slug;
    }

    public function normalize($string)
    {
        return strtolower(html_entity_decode(wp_strip_all_tags($string)));
    }

    static private function remove_non_unicode($retval)
    {
        return preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $retval);
    }

    public function validate_notice()
    {
        if (isset($_GET['page']) && $_GET['page'] === $this->menu['dashboard']) {
            // do nothing
        } else {
            if ( ! $this->is_license_validated() && ! get_option( 'jnews_dismiss_license_notice', false ) ) 
            {
                $this->print_validate_notice();
            }
        }
    }

    public function is_license_validated()
    {
        $option = get_option($this->optionname);
        if ($option) {
            return $option['validated'];
        }
        return false;
    }

    public function print_validate_failed()
    {
        ?>
        <div class="notice notice-error">
            <p><?php esc_html_e('Failed to validate license, please check if required access is granted when token created, also please check to make sure if your account already bought the item', 'jnews'); ?></p>
        </div>
        <?php
    }

    public function print_validate_success()
    {
        ?>
        <div class="notice notice-success">
            <p><?php esc_html_e('Thank you, your license has been validated.', 'jnews'); ?></p>
        </div>
        <?php
    }

    public function print_validate_notice()
    {
        ?>
        <div class="notice notice-error">
            <p>
                <?php
                printf(
                    wp_kses(
                        __('<span class="jnews-notice-heading">Action Required</span>
                            
                            <span style="display: block;">Please activate your copy of JNews to receive <strong>theme updates and full benefit of this theme</strong>. Click button bellow to activate:</span>

                            <span class="jnews-notice-button">
                                <a href="%s" class="button-primary">Activate Now</a>
                            </span>

                            ', 'jnews'),
                        array(
                            'strong' => array(),
                            'span' => array('style' => true, 'class' => true),
                            'a' => array('href' => true, 'class' => true)
                        )
                    ),
                    esc_url(menu_page_url($this->menu['dashboard'], false))
                );
                ?>
            </p>
            <span class="close-button"><i class="fa fa-times"></i></span>
        </div>
        <?php
    }
}

