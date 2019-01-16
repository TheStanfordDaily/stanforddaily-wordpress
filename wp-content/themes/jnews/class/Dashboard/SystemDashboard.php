<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Dashboard;

use Jeg\Template;
use JNews\Util\ValidateLicense;

Class SystemDashboard
{
    /**
     * @var Template
     */
    private $template;

    public function __construct($template)
    {
        $this->set_template($template);

        add_action('jnews_system_status_theme_info',           array(&$this, 'theme_info'), null, 1);
        add_action('jnews_system_status_wordpress_enviroment', array(&$this, 'wordpress_enviroment'), null, 1);
        add_action('jnews_system_status_server_enviroment',    array(&$this, 'server_enviroment'), null, 1);
        add_action('jnews_system_status_plugin',               array(&$this, 'active_plugin'), null, 1);
    }

    public function set_template($template)
    {
        $this->template = $template;
    }

    public function let_to_num($size)
    {
        $l   = substr( $size, -1 );
        $ret = substr( $size, 0, -1 );
        switch ( strtoupper( $l ) ) {
            case 'P':
                $ret *= 1024;
            case 'T':
                $ret *= 1024;
            case 'G':
                $ret *= 1024;
            case 'M':
                $ret *= 1024;
            case 'K':
                $ret *= 1024;
        }
        return $ret;
    }

    public function status_flag($code)
    {
        $string = '';
        switch($code) {
            case "green" :
                $string = esc_html__('Everything is Good','jnews');
                break;
            case "yellow" :
                $string = esc_html__('This setting may not affect your website entirely, but it will cause some of the features not working as expected.','jnews');
                break;
            case "red" :
                $string = esc_html__('You will need to fix this setting to make themes & plugin work as expected.','jnews');
                break;
        }
        return "<div class='tooltip flag-item flag-{$code}' title='{$string}'></div>";
    }

    public function status_render($options, $html)
    {
        if($html)
        {
            foreach ($options as $option)
            {
                $option['self'] = $this;
                if ($option['type'] === 'status') {
                    $this->template->render('system-status-help', $option, true);
                } else if ($option['type'] === 'flag') {
                    $this->template->render('system-status-flag', $option, true);
                }
            }
        } else {
            foreach ($options as $option)
            {
                $option['self'] = $this;
                $this->template->render('system-status-text', $option, true);
            }
        }
    }

    public function active_plugin($html = true)
    {
        $active_plugin = array();

        $plugins = array_merge(
            array_flip( (array) get_option( 'active_plugins', array() ) ),
            (array) get_site_option( 'active_sitewide_plugins', array() )
        );

        if ( $plugins = array_intersect_key( get_plugins(), $plugins ) )
        {
            foreach($plugins as $plugin) {
                $item                   = array();
                $item['uri']            = isset( $plugin['PluginURI'] ) ? esc_url( $plugin['PluginURI'] ) : '#';
                $item['name']           = isset( $plugin['Name'] ) ? $plugin['Name'] : __( 'unknown', 'jnews' );
                $item['author_uri']     = isset( $plugin['AuthorURI'] ) ? esc_url( $plugin['AuthorURI'] ) : '#';
                $item['author_name']    = isset( $plugin['Author'] ) ? $plugin['Author'] : __( 'unknown', 'jnews' );
                $item['version']        = isset( $plugin['Version'] ) ? $plugin['Version'] : __( 'unknown', 'jnews' );

                if($html) {
                    $content = esc_html__('by', 'jnews') . " " . "<a href='{$item['author_uri']}'>" . $item['author_name'] . "</a>" . " - " . $item['version'];
                } else {
                    $content = esc_html__('by', 'jnews') . " " . $item['author_name'] . " - " . $item['version'];
                }

                array_push($active_plugin, array(
                    'type' => 'status',
                    'title' => $item['name'],
                    'content' => $content
                ));
            }
        }

        $this->status_render($active_plugin, $html);
    }

    public function server_enviroment($html = true)
    {
        $server = array();

        array_push($server, array(
            'type' => 'status',
            'title' => esc_html__('Server Info', 'jnews'),
            'tooltip' => esc_html__('Information about the web server that is currently hosting your site', 'jnews'),
            'content' => $_SERVER['SERVER_SOFTWARE']
        ));

        if (function_exists('phpversion')) {
            $php_version = phpversion();

            if (version_compare($php_version, '5.4', '<')) {

                $content = '<mark class="error">' . sprintf(__('%s - We recommend a minimum PHP version of 5.4. See: %s', 'jnews'), esc_html($php_version), esc_html($php_version)) . '</mark>';

                if(!$html) {
                    $content = sprintf(__('%s - We recommend a minimum PHP version of 5.4. See: %s', 'jnews'), esc_html($php_version));
                }

                array_push($server, array(
                    'type' => 'flag',
                    'title' => esc_html__('PHP Version', 'jnews'),
                    'flag' => 'red',
                    'content' => $content
                ));
            } else {
                $content =  '<mark class="yes">' . esc_html($php_version) . '</mark>';

                if(!$html) {
                    $content = esc_html($php_version);
                }

                array_push($server, array(
                    'type' => 'flag',
                    'title' => esc_html__('PHP Version', 'jnews'),
                    'flag' => 'green',
                    'content' => $content
                ));
            }
        } else {
            array_push($server, array(
                'type' => 'flag',
                'title' => esc_html__('PHP Version', 'jnews'),
                'flag' => 'red',
                'content' => esc_html__("Couldn't determine PHP version because phpversion() doesn't exist", 'jnews')
            ));
        }

        if (function_exists('ini_get')) {

            array_push($server, array(
                'type' => 'status',
                'title' => esc_html__('PHP Post Max Size', 'jnews'),
                'tooltip' => esc_html__('The largest filesize that can be contained in one post', 'jnews'),
                'content' => size_format($this->let_to_num(ini_get('post_max_size')))
            ));

            $maxtime = ini_get('max_execution_time');
            $maxtimelimit = 3000;

            if ($maxtime >= $maxtimelimit) {
                array_push($server, array(
                    'type' => 'flag',
                    'title' => esc_html__('PHP Time Limit', 'jnews'),
                    'flag' => 'green',
                    'content' => $maxtime
                ));
            } else {
                array_push($server, array(
                    'type' => 'flag',
                    'title' => esc_html__('PHP Time Limit', 'jnews'),
                    'flag' => 'yellow',
                    'content' => $maxtime,
                    'small' => sprintf(esc_html__('max_execution_time should be bigger than %s, otherwise import process may not finished as expected', 'jnews'), $maxtimelimit)
                ));
            }

            $maxinput = ini_get('max_input_vars');
            $maxinputlimit = 2000;

            if ($maxinput >= $maxinputlimit) {
                array_push($server, array(
                    'type' => 'flag',
                    'title' => esc_html__('PHP Max Input Vars', 'jnews'),
                    'flag' => 'green',
                    'content' => $maxinput
                ));
            } else {
                array_push($server, array(
                    'type' => 'flag',
                    'title' => esc_html__('PHP Max Input Vars', 'jnews'),
                    'flag' => 'yellow',
                    'content' => $maxinput,
                    'small' => sprintf(esc_html__('max_input_vars should be bigger than %s, otherwise you may not able to save setting on option panel', 'jnews'), $maxinputlimit)
                ));
            }

            array_push($server, array(
                'type' => 'status',
                'title' => esc_html__('SUHOSIN Installed', 'jnews'),
                'tooltip' => esc_html__('Suhosin is an advanced protection system for PHP installations. It was designed to protect your servers on the one hand against a number of well known problems in PHP applications and on the other hand against potential unknown vulnerabilities within these applications or the PHP core itself. If enabled on your server, Suhosin may need to be configured to increase its data submission limits.', 'jnews'),
                'content' => extension_loaded('suhosin') ? '&#10004;' : '&ndash;'
            ));
        }

        // WP Remote Get
        $response = @wp_remote_get( 'http://api.wordpress.org/plugins/update-check/1.1/' );

        if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
            $wp_remote_get          = true;
            $wp_remote_get_error    = '';
            $wp_remote_get_flag     = 'green';
        } else {
            $wp_remote_get          = false;
            $wp_remote_get_error    = $response['response']['code'] . ' - ' . $response['response']['message'];
            $wp_remote_get_flag     = 'yellow';
        }

        array_push($server, array(
            'type' => 'status',
            'title' => esc_html__('WP Remote Get', 'jnews'),
            'flag' => $wp_remote_get_flag,
            'tooltip' => esc_html__('Some features of JNews need WP remote to be installed properly. Including demo importer and validated license.', 'jnews'),
            'content' => $wp_remote_get ? '&#10004;' : $wp_remote_get_error
        ));

        /** check if GD or Imagick installed */

        $gd_installed = extension_loaded('gd') && function_exists('gd_info');
        $imagick_installed = extension_loaded('imagick');

        if ( $gd_installed || $imagick_installed ) {
            array_push($server, array(
                'type' => 'flag',
                'title' => esc_html__('PHP Image library installed ', 'jnews'),
                'flag' => 'green',
                'content' => '&#10004;'
            ));
        } else {
            array_push($server, array(
                'type' => 'flag',
                'title' => esc_html__('PHP Image library installed ', 'jnews'),
                'flag' => 'yellow',
                'content' => esc_html__('Please install PHP image library ( GD or Image Magic ) ', 'jnews'),
            ));
        }

        /** check if CURL Installed */

        $curl_installed = extension_loaded('curl') && function_exists('curl_version');

        if ( $curl_installed ) {
            array_push($server, array(
                'type' => 'flag',
                'title' => esc_html__('CURL Installed ', 'jnews'),
                'flag' => 'green',
                'content' => '&#10004;'
            ));
        } else {
            array_push($server, array(
                'type' => 'flag',
                'title' => esc_html__('CURL Installed ', 'jnews'),
                'flag' => 'yellow',
                'content' => esc_html__('Please install CURL PHP library', 'jnews'),
            ));
        }

        $this->status_render($server, $html);
    }

    /**
     * Print status flag
     *
     * @param $code
     * @return string
     */
    public function system_status_flag($code)
    {
        $string = '';
        switch($code) {
            case "green" :
                $string = esc_html__('Everything is Good','jnews');
                break;
            case "yellow" :
                $string = esc_html__('This setting may not affect your website entirely, but it will cause some of the features not working as expected.','jnews');
                break;
            case "red" :
                $string = esc_html__('You will need to fix this setting to make themes & plugin work as expected.','jnews');
                break;
        }
        return "<div class='tooltip flag-item flag-{$code}' title='{$string}'></div>";
    }

    public function wordpress_enviroment($html = true)
    {
        $wpenviroment = array();

        array_push($wpenviroment, array(
            'type' => 'status',
            'title' => esc_html__('Home URL', 'jnews'),
            'tooltip' => esc_html__('The URL of your site\'s homepage', 'jnews'),
            'content' => home_url()
        ));

        array_push($wpenviroment, array(
            'type' => 'status',
            'title' => esc_html__('Site URL', 'jnews'),
            'tooltip' => esc_html__('The root URL of your site', 'jnews'),
            'content' => site_url()
        ));

        array_push($wpenviroment, array(
            'type' => 'status',
            'title' => esc_html__('Login URL', 'jnews'),
            'tooltip' => esc_html__('your website login url', 'jnews'),
            'content' => wp_login_url()
        ));

        array_push($wpenviroment, array(
            'type' => 'status',
            'title' => esc_html__('WP Version', 'jnews'),
            'tooltip' => esc_html__('The version of WordPress installed on your site', 'jnews'),
            'content' => get_bloginfo('version', 'display')
        ));

        array_push($wpenviroment, array(
            'type' => 'status',
            'title' => esc_html__('WP Multisite', 'jnews'),
            'tooltip' => esc_html__('Whether or not you have WordPress Multisite enabled', 'jnews'),
            'content' => is_multisite() ? '&#10004;' : '&ndash;'
        ));

        if ((defined('WP_DEBUG') && WP_DEBUG)) {
            array_push($wpenviroment, array(
                'type' => 'flag',
                'title' => esc_html__('WP Debug Mode', 'jnews'),
                'flag' => 'yellow',
                'content' => esc_html__('Enabled', 'jnews'),
                'small' => esc_html__('Only enable WP DEBUG if you are on development server, once on production server, you will need to disable WP Debug', 'jnews')
            ));
        } else {
            array_push($wpenviroment, array(
                'type' => 'flag',
                'title' => esc_html__('WP Debug Mode', 'jnews'),
                'flag' => 'green',
                'content' => esc_html__('Disabled', 'jnews'),
                'small' => esc_html__('Only enable WP DEBUG if you are on development server, once on production server, you will need to disable WP Debug', 'jnews')
            ));
        }


        $memory = $this->let_to_num(WP_MEMORY_LIMIT);
        $minmemorylimit = 134217728;

        if (function_exists('memory_get_usage'))
        {
            $system_memory = $this->let_to_num(@ini_get('memory_limit'));

            if ($system_memory >= $minmemorylimit)
            {
                $content = '<mark class="yes">' . size_format($system_memory) . '</mark>';
                if(!$html) $content  = size_format($system_memory);
                $color = 'green';
            } else {
                $content = '<mark class="error">' . sprintf(__('%s - We recommend setting memory to at least 128MB. See: %s', 'jnews'), size_format($system_memory), '<a href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">' . esc_html__('Increasing memory allocated to PHP', 'jnews') . '</a>') . '</mark>';
                if(!$html) $content  = sprintf(__('%s - We recommend setting memory to at least 128MB.', 'jnews'), size_format($system_memory));
                $color = 'yellow';
            }

            array_push($wpenviroment, array(
                'type' => 'flag',
                'title' => esc_html__('PHP Memory Limit', 'jnews'),
                'flag' => $color,
                'content' => $content
            ));
        }


        if ($memory >= $minmemorylimit)
        {
            $content = '<mark class="yes">' . size_format($memory) . '</mark>';
            if(!$html) $content  = size_format($memory);
            $color = 'green';
        } else {
            $content = '<mark class="error">' . sprintf(__('%s - We recommend setting memory to at least 128MB. See: %s', 'jnews'), size_format($memory), '<a href="http://support.jegtheme.com/documentation/system-status/#memory-limit" target="_blank">' . esc_html__('Increasing the WordPress Memory Limit', 'jnews') . '</a>') . '</mark>';
            if(!$html)  $content  = sprintf(__('%s - We recommend setting memory to at least 128MB.', 'jnews'), size_format($memory));
            $color = 'yellow';
        }

        array_push($wpenviroment, array(
            'type' => 'flag',
            'title' => esc_html__('WP Memory Limit', 'jnews'),
            'flag' => $color,
            'content' => $content
        ));


        array_push($wpenviroment, array(
            'type' => 'status',
            'title' => esc_html__('WP Language', 'jnews'),
            'flag' => 'green',
            'content' => get_locale(),
            'tooltip' => esc_html__('Default Language of your WordPress Installation', 'jnews'),
        ));

        $wp_upload_dir = wp_upload_dir();

        array_push($wpenviroment, array(
            'type' => 'status',
            'title' => esc_html__('WP Upload Directory', 'jnews'),
            'flag' => 'green',
            'content' => wp_is_writable( $wp_upload_dir['basedir'] ) ? '&#10004;' : '&ndash;',
            'tooltip' => esc_html__('Determine if upload directory is writable', 'jnews'),
        ));

        array_push($wpenviroment, array(
            'type' => 'status',
            'title' => esc_html__('Number of Category', 'jnews'),
            'flag' => 'green',
            'content' => wp_count_terms( 'category' ),
            'tooltip' => esc_html__('The current number of post category on your site', 'jnews'),
        ));

        array_push($wpenviroment, array(
            'type' => 'status',
            'title' => esc_html__('Number of Tag', 'jnews'),
            'flag' => 'green',
            'content' => wp_count_terms( 'post_tag' ),
            'tooltip' => esc_html__('The current number of post tag on your site', 'jnews'),
        ));

        $this->status_render($wpenviroment, $html);
    }

    public function theme_info($html = true)
    {
        $themeinfo     = array();
        $theme         = wp_get_theme();
        $theme_license = ValidateLicense::getInstance()->is_license_validated();

        // theme name
        array_push($themeinfo, array(
            'type' => 'status',
            'title' => esc_html__('Themes Name', 'jnews'),
            'tooltip' => esc_html__('Themes currently installed & activated', 'jnews'),
            'content' => $theme->get('Name')
        ));

        // theme version
        array_push($themeinfo, array(
            'type' => 'status',
            'title' => esc_html__('Themes Version', 'jnews'),
            'tooltip' => esc_html__('Current theme version', 'jnews'),
            'content' => $theme->get('Version')
        ));

        // theme parent
        if ( is_child_theme() )
        {
	        array_push($themeinfo, array(
		        'type' => 'status',
		        'title' => esc_html__('Themes Parent', 'jnews'),
		        'tooltip' => esc_html__('Current parent theme version', 'jnews'),
		        'content' => wp_get_theme('jnews')->get('Version')
	        ));
        }

        // theme license
        array_push($themeinfo, array(
            'type' => 'status',
            'title' => esc_html__('Themes License', 'jnews'),
            'tooltip' => esc_html__('Theme license registration', 'jnews'),
            'content' => $theme_license ? '&#10004;' : '&ndash;'
        ));

        // theme license
        array_push($themeinfo, array(
            'type' => 'status',
            'title' => esc_html__('License Code', 'jnews'),
            'tooltip' => esc_html__('Theme License Code', 'jnews'),
            'content' => ValidateLicense::getInstance()->get_token()
        ));

        $this->status_render($themeinfo, $html);
    }

    public function system_status()
    {
        $this->template->render('system-status', null, true);
    }

    public function backend_status( )
    {
            ?>

            <pre>### THEME INFO ###

<?php do_action('jnews_system_status_theme_info', false); ?>


### WordPress Enviroment ###

<?php do_action('jnews_system_status_wordpress_enviroment', false); ?>


### Server Enviroment ###

<?php do_action('jnews_system_status_server_enviroment', false); ?>


### Active Plugins ###

<?php do_action('jnews_system_status_plugin', false); ?>

### End ###</pre>

            <?php
            exit;
    }
}
