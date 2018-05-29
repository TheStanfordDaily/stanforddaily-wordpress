<?php
/**
 * This customizer plugin branch of Kirki Customizer Plugin.
 * https://github.com/aristath/kirki
 *
 * @author : Jegtheme
 */
namespace Jeg;

use Jeg\Customizer\ActiveCallback;
use Jeg\Customizer\Partial\LazyPartial;
use Jeg\Customizer\Setting\DefaultSetting;
use Jeg\Util\Font;
use Jeg\Util\Sanitize;
use Jeg\Util\StyleGenerator;

Class Customizer
{
    /**
     * @var Customizer
     */
    private static $instance;

    /**
     * An array containing all panels.
     *
     * @access private
     * @var array
     */
    private $panels = array();

    /**
     * An array containing all sections.
     *
     * @access private
     * @var array
     */
    private $sections = array();

    /**
     * An array containing all fields.
     *
     * @access private
     * @var array
     */
    private $fields = array();

    /**
     * Cached Array for faster access
     * @var array
     */
    private $cache_fields = array();

    /**
     * An array containing partial refresh
     *
     * @access private
     * @var array
     */
    private $partial_refresh = array();

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    public $endpoint = 'customizer';

    /**
     * @return Customizer
     */
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
        $this->set_version();

        add_action( 'customize_register',                   array( $this, 'register_control_types' ) );
        add_action( 'customize_register',                   array( $this, 'register_section_types' ) );
        add_action( 'customize_register',                   array( $this, 'register_panel_types' ) );
        add_action( 'customize_register',                   array( $this, 'deploy_panels' ), 97 );
        add_action( 'customize_register',                   array( $this, 'deploy_sections' ), 98 );
        add_action( 'customize_register',                   array( $this, 'deploy_fields' ), 96 );
        add_action( 'customize_register',                   array( $this, 'register_customizer'));
        add_action( 'customize_preview_init',               array( $this, 'preview_init' ), 99 );
        add_action( 'customize_controls_print_styles',      array( $this, 'customizer_styles' ), 99 );
        add_action( 'customize_controls_enqueue_scripts',   array( $this, 'register_scripts' ) );
        add_action( 'customize_controls_enqueue_scripts',   array( $this, 'enqueue_control_script' ), 11 );
        add_action( 'upload_mimes',                         array( $this, 'allow_mime' ) );
        // partial refresh
        add_filter( 'customize_partial_render',             array($this, 'partial_render'), null, 3);
        add_filter( 'customize_dynamic_partial_args',       array($this, 'filter_dynamic_partial_args'), 10, 2);
        add_filter( 'customize_dynamic_partial_class',      array($this, 'filter_dynamic_partial_class'), 10, 3);
        // handle dynamic setting save
        add_filter( 'customize_dynamic_setting_args',       array($this, 'filter_dynamic_setting_args'), 10, 2);
        add_filter( 'customize_dynamic_setting_class',      array($this, 'filter_dynamic_setting_class'), 10, 3);
        add_filter( 'query_vars',                           array($this, 'ajax_query_vars' ) );
        add_action( 'parse_request',                        array($this, 'ajax_parse_request' ) );
    }

    /**
     * Register query var for lazy section ajax request
     *
     * @param $vars
     * @return array
     */
    public function ajax_query_vars($vars)
    {
        $vars[] = $this->endpoint;
        $vars[] = 'sections';
        $vars[] = 'search';
        $vars[] = 'nonce';
        return $vars;
    }

    /**
     * handle ajax request for retrieving lazy section
     *
     * @param $wp
     */
    public function ajax_parse_request($wp)
    {
        if ( array_key_exists( $this->endpoint, $wp->query_vars ) )
        {
            add_filter('wp_doing_ajax', '__return_true');

            if(isset($wp->query_vars['nonce']) && wp_verify_nonce($wp->query_vars['nonce'], $this->endpoint))
            {
                if(isset($wp->query_vars['sections'])){
                    $section = $wp->query_vars['sections'];
                    $this->get_lazy_section_control($section);
                }

                if(isset($wp->query_vars['search'])){
                    $search = $wp->query_vars['search'];
                    $this->get_search_result($search);
                }
            }

            die();
        }
    }

    /**
     * @param $keywords
     * @param $description
     * @return int
     */
    public function match_search($keywords, $description)
    {
        preg_match_all("/\w+/i", $keywords, $words);
        $total = 0;

        foreach($words[0] as $search) {
            $found = preg_match_all( "/($search)/i", $description);

            if($found === 0) {
                return 0;
            } else {
                $total += $found;
            }
        }

        return $total;
    }

    /**
     * @param $search
     */
    public function get_search_result($search)
    {
        $fields = $this->get_all_fields();
        $results = array();

        foreach($fields as $key => $field)
        {
            $field['title'] = isset($field['title']) ? $field['title'] : '';
            $field['description'] = isset($field['description']) ? $field['description'] : '';
            $match = $this->match_search($search, implode(' ', array($field['title'], $field['description'])));

            if($match > 0)
            {
                $results[$key] = array(
                    'id'            => $field['id'],
                    'label'         => $field['label'],
                    'description'   => $field['description'],
                    'section'       => $field['section'],
                    'match'         => $match
                );
            }
        }

        wp_send_json_success($results);
    }

    /**
     * Get All Section
     *
     * @param $id
     * @return mixed
     */
    public function get_lazy_section_files($id)
    {
        $sections = $this->get_registered_lazy_section();

        if(isset($sections[$id])) {
            return $sections[$id];
        }

        return array();
    }

    /**
     * @param $options
     * @param $name
     * @return mixed
     */
    public function filter_lazy_setting($options, $name)
    {
        foreach ($options as $key => $option)
        {
            if($option['id'] === $name) {
                return $option;
            }
        }
    }

    /**
     * @param $options
     * @param $name
     * @return array
     */
    public function filter_lazy_partial_setting($options,$name)
    {
        foreach ($options as $key => $option)
        {
            if (isset($option['partial_refresh']))
            {
                $partials = $option['partial_refresh'];
                if (array_key_exists($name, $partials))
                {
                    return [
                        'setting' => $option['id'],
                        'partial' => $partials[$name],
                    ];
                }
            }
        }
    }

    /**
     * Get WP Customize Instance. if its empty then we need to create one
     *
     * @return \WP_Customize_Manager
     */
    public function wp_customize()
    {
        global $wp_customize;

        if ( empty( $wp_customize ) || ! ( $wp_customize instanceof \WP_Customize_Manager ) ) {
            require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';
            $wp_customize = new \WP_Customize_Manager();
        }

        return $wp_customize;
    }

    /**
     * @param $class
     * @param $id
     * @param $args
     * @return string
     */
    public function filter_dynamic_setting_class($class, $id, $args)
    {
        if ( preg_match(DefaultSetting::$lazy_pattern, $id, $matches) )
        {
            $option = $this->get_lazy_field($matches['section'], $matches['id'], array($this, 'filter_lazy_setting'));
            $class = $this->get_setting_class($option['type']);
        }

        return $class;
    }

    /**
     * @param $setting_args
     * @param $setting_id
     * @return mixed
     */
    public function filter_dynamic_setting_args($setting_args, $setting_id)
    {
        if ( preg_match(DefaultSetting::$lazy_pattern, $setting_id, $matches) )
        {
            $option = $this->get_lazy_field($matches['section'], $matches['id'], array($this, 'filter_lazy_setting'));
            $field = $this->filter_field($option, true);
            $setting_args = $field['setting'];
        }

        return $setting_args;
    }

    /**
     * @param $rendered
     * @param \WP_Customize_Partial $partial
     * @param $container_context
     * @return mixed|string
     */
    public function partial_render($rendered, \WP_Customize_Partial $partial, $container_context)
    {
        if ( preg_match( LazyPartial::$pattern, $partial->id, $matches ) )
        {
            $option = $this->get_lazy_field($matches['section'], $matches['id'], array($this, 'filter_lazy_partial_setting'));

            if($option)
            {
                ob_start();
                $return_render = call_user_func( $option['partial']['render_callback'], $this, $container_context );
                $ob_render = ob_get_clean();

                if ( null !== $return_render && '' !== $ob_render ) {
                    _doing_it_wrong( __FUNCTION__, __( 'Partial render must echo the content or return the content string (or array), but not both.' ), '4.5.0' );
                }

                $rendered = null !== $return_render ? $return_render : $ob_render;
            }
        }

        return $rendered;
    }

    /**
     * @param $args
     * @param $id
     * @return array
     */
    public function filter_dynamic_partial_args($args, $id)
    {
        if ( preg_match( LazyPartial::$pattern, $id, $matches ) )
        {
            $option = $this->get_lazy_field($matches['section'], $matches['id'], array($this, 'filter_lazy_partial_setting'));
            $args = array(
                'selector'              => $option['partial']['selector'],
                'settings'              => array( DefaultSetting::create_lazy_setting($matches['section'], $option['setting']) ),
                'container_inclusive'   => false,
                'fallback_refresh'      => false
            );
        }
        return $args;
    }

    public function filter_dynamic_partial_class($class, $id, $args)
    {
        if ( preg_match( LazyPartial::$pattern, $id, $matches ) )
        {
            $class = 'Jeg\Customizer\Partial\LazyPartial';
        }

        return $class;
    }

    public function get_lazy_options($file)
    {
        $options = array();

        if(is_array($file)) {
            $options = call_user_func_array($file['function'], $file['parameter']);
        } else if (file_exists($file)) {
            $options = include $file;
        }

        return $options;
    }

    /**
     * @param $section
     * @param $name
     * @param $callback
     * @return mixed
     */
    public function get_lazy_field($section, $name, $callback)
    {
        $section = $this->get_lazy_section_files($section);

        if(!empty($section)) {
            foreach($section as $file)
            {
                $options = $this->get_lazy_options($file);
                return call_user_func_array($callback, array($options, $name));
            }
        }
    }

    /**
     * @param $section
     * @param $sectionId
     * @return array
     */
    public function compose_lazy_fields($section, $sectionId)
    {
        $this->wp_customize();
        $results = array();

        foreach($section as $file)
        {
            $options = $this->get_lazy_options($file);

            foreach($options as $option) {
                $results[$option['id']] = $this->compose_lazy_option($option, $sectionId);
            }
        }

        return $results;
    }

    /**
     * @param $option
     * @param $sectionId
     * @return array
     */
    public function compose_lazy_option($option, $sectionId)
    {
        $result = array();

        // force assign section & dynamic control
        $option['section'] = $sectionId;
        $option['dynamic'] = true;
        $field = $this->filter_field($option, true);

        // Assign Setting ID
        $settingId = DefaultSetting::create_lazy_setting($sectionId, $option['id']);
        $result['settingId'] = $settingId;

        // assign setting json
        $setting = $field['setting'];
        $settingInstance = $this->do_add_setting($setting, $settingId);
        $result['setting'] = $settingInstance->json();

        // assign control json
        $control = $field['control'];
        $controlInstance = $this->do_add_control($control, $settingInstance);
        $result['control'] = $controlInstance->json();

        return $result;
    }

    /**
     * Get lazy section control control
     *
     * @param $sections
     * @throws \Exception
     */
    public function get_lazy_section_control($sections)
    {
        $results = array();

        foreach($sections as $sectionId)
        {
            $section = $this->get_lazy_section_files($sectionId);

            if(!empty($section)) {
                $results[$sectionId] = $this->compose_lazy_fields($section, $sectionId);
            }
        }

        wp_send_json_success($results);
    }

    /**
     * Get all registered section and their respective file
     *
     * @return mixed
     */
    public function get_registered_lazy_section()
    {
        $sections = apply_filters('jeg_register_lazy_section', array());
        return $sections;
    }

    /**
     *
     */
    public function set_version()
    {
        $theme = wp_get_theme();
        $this->version = $theme->get('Version');
    }

    /**
     *
     */
    public function register_customizer()
    {
        do_action('jnews_register_customizer_option', $this);
    }

    public function allow_mime($mimes)
    {
        return array_merge($mimes,array (
            'webm' => 'video/webm',
            'ico' 	=> 'image/vnd.microsoft.icon',
            'ttf'	=> 'application/octet-stream',
            'otf'	=> 'application/octet-stream',
            'woff'	=> 'application/x-font-woff',
            'svg'	=> 'image/svg+xml',
            'eot'	=> 'application/vnd.ms-fontobject',
            'ogg'   => 'audio/ogg',
            'ogv'   => 'video/ogg'
        ));
    }

    public function load_all_font()
    {
        $standard_fonts = Font::get_standard_fonts();
        $google_fonts   = Font::get_google_fonts();
        $all_variants   = Font::get_all_variants();
        $all_subsets    = Font::get_google_font_subsets();

        $standard_fonts_final = array();
        foreach ( $standard_fonts as $key => $value ) {
            $standard_fonts_final[] = array(
                'family'      => $value['stack'],
                'label'       => $value['label'],
                'subsets'     => array(),
                'is_standard' => true,
                'variants'    => array(
                    array(
                        'id'    => 'regular',
                        'label' => $all_variants['regular'],
                    ),
                    array(
                        'id'    => 'italic',
                        'label' => $all_variants['italic'],
                    ),
                    array(
                        'id'    => '700',
                        'label' => $all_variants['700'],
                    ),
                    array(
                        'id'    => '700italic',
                        'label' => $all_variants['700italic'],
                    ),
                ),
                'type'      => 'native'
            );
        }

        $google_fonts_final = array();
        foreach ( $google_fonts as $family => $args ) {
            $label    = ( isset( $args['label'] ) ) ? $args['label'] : $family;
            $variants = ( isset( $args['variants'] ) ) ? $args['variants'] : array( 'regular', '700' );
            $subsets  = ( isset( $args['subsets'] ) ) ? $args['subsets'] : array();

            $available_variants = array();
            foreach ( $variants as $variant ) {
                if ( array_key_exists( $variant, $all_variants ) ) {
                    $available_variants[] = array( 'id' => $variant, 'label' => $all_variants[ $variant ] );
                }
            }

            $available_subsets = array();
            foreach ( $subsets as $subset ) {
                if ( array_key_exists( $subset, $all_subsets ) ) {
                    $available_subsets[] = array( 'id' => $subset, 'label' => $all_subsets[ $subset ] );
                }
            }

            $google_fonts_final[] = array(
                'family'       => $family,
                'label'        => $label,
                'variants'     => $available_variants,
                'subsets'      => $available_subsets,
            );
        }

        return apply_filters('jnews_font_typography', array_merge( $standard_fonts_final, $google_fonts_final ));
    }

    /**
     * preview init
     */
    public function preview_init()
    {
        add_action( 'wp_enqueue_scripts' , array($this, 'previewer_script'));
    }

    /**
     * Add panel
     *
     * @param $panel array
     */
    public function add_panel($panel)
    {
        $this->panels[$panel['id']] = $panel;
    }

    /**
     * Add Section
     *
     * @param $section
     */
    public function add_section($section)
    {
        $this->sections[$section['id']] = $section;
    }

    /**
     * Add field
     *
     * @param $field
     */
    public function add_field($field)
    {
        $this->fields[$field['id']] = $field;

        if(isset($field['partial_refresh']))
        {
            $this->partial_refresh[$field['id']] = $field['partial_refresh'];
        }
    }

    public function get_field_path($section)
    {
        $path = '';

        if(isset($this->sections[$section]))
        {
            $section = $this->sections[$section];
            $path = $section['title'];

            if($section['panel']) {
                $panel = $this->panels[$section['panel']];
                $path = $panel['title'] . ' &raquo; ' . $path;
            }
        }

        return $path;
    }

    /**
     * deploy registered panel
     */
    public function deploy_panels()
    {
        $wp_customize = $this->wp_customize();
        $activeCallbackClass = ActiveCallback::getInstance();

        foreach($this->panels as $panel)
        {
            $panel['type'] = isset($panel['type']) ? $panel['type'] : 'default';

            switch($panel['type'])
            {
                case 'alert' :
                    $panelClass = 'Jeg\Customizer\Panel\AlertPanel';
                    break;
                default:
                    $panelClass = 'WP_Customize_Panel';
                    break;
            }

            $wp_customize->add_panel( new $panelClass($wp_customize, $panel['id'],
                    array(
                        'title'                 => $panel['title'],
                        'description'           => $panel['description'],
                        'priority'              => $panel['priority'],
                        'active_callback'   => isset($panel['active_callback']) ? function() use($panel, $activeCallbackClass){
                            return $activeCallbackClass->evaluate($panel['active_callback']);
                        } : '__return_true'
                    ) )
            );
        }
    }

    /**
     * deploy registered section
     */
    public function deploy_sections()
    {
        $wp_customize = $this->wp_customize();
        $activeCallbackClass = ActiveCallback::getInstance();

        foreach($this->sections as $section)
        {
            $section['type'] = isset($section['type']) ? $section['type'] : 'default';

            switch($section['type'])
            {
                case 'jnews-helper-section' :
                    $sectionClass = 'Jeg\Customizer\Section\HelperSection';
                    break;
                case 'jnews-lazy-section' :
                    $sectionClass = 'Jeg\Customizer\Section\LazySection';
                    break;
                default:
                    $sectionClass = 'Jeg\Customizer\Section\DefaultSection';
                    break;
            }

            $wp_customize->add_section(new $sectionClass($wp_customize, $section['id'], array(
                'title' => $section['title'],
                'panel' => $section['panel'],
                'priority' => $section['priority'],
                'dependency' => isset($section['dependency']) ? $section['dependency'] : array(),
                'active_callback' => isset($section['active_callback']) ? function () use ($section, $activeCallbackClass) {
                    return $activeCallbackClass->evaluate($section['active_callback']);
                } : '__return_true'
            )));
        }
    }

    /**
     * deploy all registered field
     */
    public function deploy_fields()
    {
        foreach($this->fields as $field)
        {
            $filtered_field = $this->filter_field($field);
            $this->do_add_setting($filtered_field['setting']);
            $this->do_add_control($filtered_field['control']);
        }

        $this->register_partial_refresh();
    }

    /**
     * setup_partial_refresh
     */
    public function register_partial_refresh()
    {
        $wp_customize = $this->wp_customize();

        if ( ! isset( $wp_customize->selective_refresh ) ) {
            return;
        }

        foreach ( $this->fields as $field_id => $args )
        {
            if ( isset( $args['partial_refresh'] ) && ! empty( $args['partial_refresh'] ) )
            {
                // Start going through each item in the array of partial refreshes.
                foreach ( $args['partial_refresh'] as $partial_refresh => $partial_refresh_args )
                {
                    // If we have all we need, create the selective refresh call.
                    if ( isset( $partial_refresh_args['render_callback'] ) && isset( $partial_refresh_args['selector'] ) )
                    {
                        $wp_customize->selective_refresh->add_partial( $partial_refresh, array(
                            'selector'              => $partial_refresh_args['selector'],
                            'settings'              => array( $args['id'] ),
                            'render_callback'       => $partial_refresh_args['render_callback'],
                            'container_inclusive'   => isset($partial_refresh_args['container_inclusive']) ? $partial_refresh_args['container_inclusive'] : false,
                            'fallback_refresh'      => false
                        ) );
                    }
                }
            }
        }
    }

    public function compose_setting($field, $dynamic)
    {
        $setting = array();

        $setting['id']               = $field['id'];
        $setting['type']             = isset($field['option_type']) ? $field['option_type'] : 'theme_mod';
        $setting['default']          = isset($field['default']) ? $field['default'] : '';
        $setting['transport']        = isset($field['transport']) ? $field['transport'] : 'refresh';
        $setting['sanitize']         = isset($field['sanitize']) ? $field['sanitize'] : $this->sanitize_handler($field['type']);
        $setting['control_type']     = $field['type'];

        return $setting;
    }

    public function compose_control($field, $dynamic)
    {
        $control = array();
        $activeCallbackClass = ActiveCallback::getInstance();

        $control['id']               = $field['id'];
        $control['type']             = $field['type'];
        $control['label']            = $field['label'];
        $control['section']          = isset($field['section']) ? $field['section'] : '';
        $control['description']      = isset($field['description']) ? $field['description'] : '';
        $control['multiple']         = isset($field['multiple']) ? $field['multiple'] : 0;
        $control['default']          = isset($field['default']) ? $field['default'] : 0;
        $control['choices']          = isset($field['choices']) ? $field['choices'] : array();
        $control['fields']           = isset($field['fields']) ? $field['fields'] : array();
        $control['row_label']        = isset($field['row_label']) ? $field['row_label'] : esc_html__('Row', 'jnews');
        $control['wrapper_class']    = isset($field['wrapper_class']) ? $field['wrapper_class'] : array();

        // additional control option
        $control['partial_refresh']  = isset($field['partial_refresh']) ? $field['partial_refresh'] : null;
        $control['active_rule']      = isset($field['active_callback']) ? $field['active_callback'] : null;
        $control['output']           = isset($field['output']) ? $field['output'] : null;
        $control['postvar']          = isset($field['postvar']) ? $field['postvar'] : [];
        $control['dynamic']          = isset($field['dynamic']) ? $field['dynamic'] : false;

        // only load active callback on normal field
        if(!$dynamic) {
            $control['active_callback']  = isset($field['active_callback']) ? function() use($field, $activeCallbackClass){
                return $activeCallbackClass->evaluate($field['active_callback']);
            } : '__return_true';
        }

        return $control;
    }

    /**
     * Create Customizer setting, control, and partial refresh
     *
     * @param $field array
     * @param $dynamic boolean
     * @return array
     */
    public function filter_field($field, $dynamic = false)
    {
        $setting = $this->compose_setting($field, $dynamic);
        $control = $this->compose_control($field, $dynamic);
        $partial = $this->setup_partial_refresh($field);

        // Hack transport to have postMessage
        if(!empty($partial)) {
            $setting['transport'] = 'postMessage';
        }

        return [
            'setting' => $setting,
            'control' => $control
        ];
    }

    /**
     * @param $field
     * @return array
     */
    public function setup_partial_refresh($field)
    {
        if(!isset( $field['partial_refresh'] )) {
            $field['partial_refresh'] = array();
        }

        foreach ( $field['partial_refresh'] as $id => $args ) {
            if ( ! is_array( $args ) || ! isset( $args['selector'] ) || ! isset( $args['render_callback'] ) || ! is_callable( $args['render_callback'] ) ) {
                unset( $this->partial_refresh[ $id ] );
                continue;
            }
        }

        return $field['partial_refresh'];
    }

    /**
     * register control type
     */
    public function register_control_types()
    {
        $wp_customize = $this->wp_customize();
        $handler = $this->get_all_control_class();

        foreach($handler as $handle)
        {
            $wp_customize->register_control_type( $handle );
        }
    }

    public function register_section_types()
    {
        $wp_customize = $this->wp_customize();

        $wp_customize->register_section_type('Jeg\Customizer\Section\HelperSection');
        $wp_customize->register_section_type('Jeg\Customizer\Section\LazySection');
        $wp_customize->register_section_type('Jeg\Customizer\Section\DefaultSection');
    }

    public function register_panel_types()
    {
        $wp_customize = $this->wp_customize();

        $wp_customize->register_control_type( 'Jeg\Customizer\Panel\AlertPanel' );
    }

    public function get_all_control_class()
    {
        $handler = [
            'jnews-alert'           => 'Jeg\Customizer\Control\Alert',
            'jnews-header'          => 'Jeg\Customizer\Control\Header',
            'jnews-color'           => 'Jeg\Customizer\Control\Color',
            'jnews-toggle'          => 'Jeg\Customizer\Control\Toggle',
            'jnews-slider'          => 'Jeg\Customizer\Control\Slider',
            'jnews-number'          => 'Jeg\Customizer\Control\Number',
            'jnews-select'          => 'Jeg\Customizer\Control\Select',
            'jnews-range-slider'    => 'Jeg\Customizer\Control\RangeSlider',
            'jnews-radio-image'     => 'Jeg\Customizer\Control\RadioImage',
            'jnews-radio-buttonset' => 'Jeg\Customizer\Control\RadioButtonSet',
            'jnews-preset'          => 'Jeg\Customizer\Control\Preset',
            'jnews-preset-image'    => 'Jeg\Customizer\Control\PresetImage',
            'jnews-text'            => 'Jeg\Customizer\Control\Text',
            'jnews-textarea'        => 'Jeg\Customizer\Control\Textarea',
            'jnews-radio'           => 'Jeg\Customizer\Control\Radio',
            'jnews-image'           => 'Jeg\Customizer\Control\Image',
            'jnews-spacing'         => 'Jeg\Customizer\Control\Spacing',
            'jnews-repeater'        => 'Jeg\Customizer\Control\Repeater',
            'jnews-typography'      => 'Jeg\Customizer\Control\Typography',
            'jnews-gradient'        => 'Jeg\Customizer\Control\Gradient',
        ];

        return $handler;
    }

    /**
     * Get control class
     *
     * @param $type
     * @return mixed
     */
    public function get_control_class($type)
    {
        $handler = $this->get_all_control_class();

        if(array_key_exists($type, $handler))
        {
            return $handler[$type];
        } else {
            throw new \InvalidArgumentException('Unrecognized Type. Please update your plugin to latest version.');
        }
    }

    /**
     * Create Control
     *
     * @param $field
     * @param \WP_Customize_Setting $setting
     * @return mixed
     */
    public function do_add_control($field, $setting = null)
    {
        $wp_customize = $this->wp_customize();
        $controlClass = $this->get_control_class($field['type']);

        if($setting !== null && $setting instanceof \WP_Customize_Setting){
            $field['settings'] = $setting->id;
        }

        /** @var \WP_Customize_Control $controlInstance */
        $controlInstance = new $controlClass($wp_customize,$field['id'],$field);
        $wp_customize->add_control($controlInstance);

        return $controlInstance;
    }


    /**
     * @param $type
     * @return array|string
     */
    public function sanitize_handler($type)
    {
        $sanitizeClass = Sanitize::getInstance();

        switch($type)
        {
            case 'checkbox' :
            case 'jnews-toggle' :
                $sanitize = array($sanitizeClass, 'sanitize_checkbox');
                break;
            case 'image' :
                $sanitize = array($sanitizeClass, 'sanitize_url');
                break;
            case 'jnews-typography' :
                $sanitize = array($sanitizeClass, 'sanitize_typography');
                break;
            case 'jnews-number' :
            case 'jnews-slider' :
                $sanitize = array($sanitizeClass, 'sanitize_number');
                break;
            case 'repeater' :
                $sanitize = array($sanitizeClass, 'by_pass');
                break;
            default :
                $sanitize = array($sanitizeClass, 'sanitize_input');
                break;
        }

        return $sanitize;
    }

    public function get_setting_class($type)
    {
        switch($type) {
            case "jnews-repeater" :
                $settingClass = 'Jeg\Customizer\Setting\RepeaterSetting';
                break;
            case "jnews-spacing" :
                $settingClass = 'Jeg\Customizer\Setting\SpacingSetting';
                break;
            default:
                $settingClass = 'Jeg\Customizer\Setting\DefaultSetting';
                break;
        }

        return $settingClass;
    }

    /**
     * Add Setting
     *
     * @param $setting
     * @param $settingId
     * @return \WP_Customize_Setting
     */
    public function do_add_setting($setting, $settingId = null)
    {
        $wp_customize = $this->wp_customize();

        if( $settingId === null ) {
            $settingId = $setting['id'];
        }

        $settingClass = $this->get_setting_class($setting['control_type']);
        /** @var \WP_Customize_Setting $settingInstance */
        $settingInstance = new $settingClass($wp_customize, $settingId, $setting);
        $wp_customize->add_setting($settingInstance);

        return $settingInstance;
    }

    /**
     * Only Normal Field
     *
     * @return array
     */
    public function get_fields()
    {
        return $this->fields;
    }


    /**
     * get all registered lazy fields
     *
     * @return array
     */
    public function get_lazy_fields()
    {
        $fields = array();
        $sections = $this->get_registered_lazy_section();

        foreach($sections as $key => $section) {
            foreach($section as $file) {
                $options = $this->get_lazy_options($file);
                foreach($options as $option) {
                    $fields[$option['id']] = $option;
                    $fields[$option['id']]['section'] = $key;
                }
            }
        }

        return $fields;
    }

    /**
     * Get both normal & lazy loaded fields
     * @todo Optimize fungsi ini biar penggunaan memory minimal
     *
     * @param $extract
     * @return array
     */
    public function get_all_fields($extract = null)
    {
        $extract        = is_callable($extract) ? $extract : array($this, 'extract_fields');
        $cache_key      = $extract[1];

        if(!isset($this->cache_fields[$cache_key]))
        {
            $lazy_fields    = $this->get_lazy_fields();
            $normal_fields  = $this->get_fields();
            $fields         = array_merge($normal_fields, $lazy_fields);
            $results        = array();

            foreach($fields as $key => $field)
            {
                $result = call_user_func_array($extract, array($field, $key));
                if($result) $results[$key] = $result;
            }

            $this->cache_fields[$cache_key] = $results;
        }

        return $this->cache_fields[$cache_key];
    }

    /**
     * Return Fields without Partial Refresh
     *
     * @param $field
     * @return mixed
     */
    public function extract_fields($field)
    {
        unset($field['partial_refresh']);
        return $field;
    }

    /**
     * @return array
     */
    public function get_sections()
    {
        return $this->sections;
    }

    /**
     * @return array
     */
    public function get_panels()
    {
        return $this->panels;
    }


    /**
     * Register scripts for Jeg Customizer.
     */
    public function register_scripts()
    {
        $wp_scripts = wp_scripts();

        $handle = 'jnews-extend-widget';
        $src = JEG_URL . '/assets/js/customizer/widget-extend.js';
        $deps = array( 'jquery', 'customize-widgets' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'selectize';
        $src = JEG_URL . '/assets/js/vendor/selectize.js';
        $deps = array( 'jquery' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'serialize-js';
        $src = JEG_URL . '/assets/js/vendor/serialize.js';
        $deps = array();
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'wp-color-picker-alpha';
        $src = JEG_URL . '/assets/js/vendor/wp-color-picker-alpha.js';
        $deps = array('wp-color-picker');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'codemirror';
        $src = JEG_URL . '/assets/js/vendor/codemirror/lib/codemirror.js';
        $deps = array('jquery', 'jquery-ui-core', 'jquery-ui-button');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-validate-css';
        $src = JEG_URL . '/assets/js/customizer/validate-css-value.js';
        $deps = array('jquery');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-active-callback';
        $src = JEG_URL . '/assets/js/customizer/active-callback.js';
        $deps = array('underscore');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-search-customizer';
        $src = JEG_URL . '/assets/js/customizer/search-control.js';
        $deps = array('jquery', 'underscore');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-customizer-late-init';
        $src = JEG_URL . '/assets/js/customizer/late-init-customizer.js';
        $deps = array('jquery');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'ion-range-slider';
        $src = JEG_URL . '/assets/js/vendor/ion.rangeSlider.min.js';
        $deps = array('jquery');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-set-setting-value';
        $src = JEG_URL . '/assets/js/customizer/set-setting-value.js';
        $deps = array('jquery');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        // ... Control
        $handle = 'jnews-default-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-default.js';
        $deps = array('customize-controls', 'underscore');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-alert-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-alert.js';
        $deps = array('jnews-default-control');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-header-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-header.js';
        $deps = array( 'jnews-default-control' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-color-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-color.js';
        $deps = array(
            'jquery',
            'customize-controls',
            'wp-color-picker-alpha',
            'jnews-default-control'
        );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-toggle-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-toggle.js';
        $deps = array( 'jquery', 'jnews-default-control' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-slider-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-slider.js';
        $deps = array( 'jquery', 'jnews-default-control' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-number-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-number.js';
        $deps = array( 'jquery', 'jnews-default-control', 'jquery-ui-spinner' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-select-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-select.js';
        $deps = array( 'jquery', 'jnews-default-control', 'selectize' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-range-slider-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-range-slider.js';
        $deps = array( 'jquery', 'jnews-default-control', 'ion-range-slider' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-radio-image-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-radio-image.js';
        $deps = array( 'jquery', 'jnews-default-control' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-radio-buttonset-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-radio-buttonset.js';
        $deps = array( 'jquery', 'jnews-default-control' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-preset-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-preset.js';
        $deps = array( 'jquery', 'jnews-default-control' , 'jnews-set-setting-value' );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-preset-image-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-preset-image.js';
        $deps = array( 'jquery', 'jnews-default-control', 'selectize');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-text-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-text.js';
        $deps = array('jnews-default-control');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-textarea-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-textarea.js';
        $deps = array('jnews-default-control');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-radio-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-radio.js';
        $deps = array('jnews-default-control');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-image-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-image.js';
        $deps = array('jnews-default-control');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-spacing-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-spacing.js';
        $deps = array('jnews-default-control', 'jnews-validate-css');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-repeater-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-repeater.js';
        $deps = array(
            'jnews-default-control',
            'jquery-ui-sortable',
            'wp-color-picker',
            'selectize',
            'serialize-js'
        );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-typography-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-typography.js';
        $deps = array('jnews-default-control', 'selectize', 'wp-color-picker-alpha');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-gradient-control';
        $src = JEG_URL . '/assets/js/customizer-control/control-gradient.js';
        $deps = array('jnews-default-control', 'selectize', 'wp-color-picker-alpha');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        // ... Section
        $handle = 'jnews-default-section';
        $src = JEG_URL . '/assets/js/customizer-section/default-section.js';
        $deps = array('jquery');
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-lazy-section';
        $src = JEG_URL . '/assets/js/customizer-section/lazy-section.js';
        $deps = array(
            'jquery',
            'underscore',
            'jnews-default-section',
            'jnews-alert-control',
            'jnews-header-control',
            'jnews-color-control',
            'jnews-toggle-control',
            'jnews-slider-control',
            'jnews-number-control',
            'jnews-select-control',
            'jnews-range-slider-control',
            'jnews-radio-image-control',
            'jnews-radio-buttonset-control',
            'jnews-preset-control',
            'jnews-preset-image-control',
            'jnews-text-control',
            'jnews-textarea-control',
            'jnews-radio-control',
            'jnews-image-control',
            'jnews-spacing-control',
            'jnews-repeater-control',
            'jnews-typography-control',
            'jnews-gradient-control',
        );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        // ... Connect To Previewer
        $handle = 'jnews-previewer-sync';
        $src = JEG_URL . '/assets/js/customizer/previewer-sync.js';
        $deps = array(
            'underscore',
            'customize-controls',
        );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );
    }

    /**
     * Load css on Customizer Panel
     */
    public function customizer_styles()
    {
        wp_enqueue_style( 'jnews-customizer-css', JEG_URL . '/assets/css/customizer.css', null );
        wp_enqueue_style( 'codemirror', JEG_URL . '/assets/js/vendor/codemirror/lib/codemirror.css', null );
        wp_enqueue_style( 'font-awesome', JEG_URL . '/fonts/font-awesome/font-awesome.min.css', null);

        wp_enqueue_style( 'jnews-ion-range-slider', JEG_URL . '/assets/css/ion.rangeSlider.css' );
        wp_enqueue_style( 'jnews-ion-range-slider-skin', JEG_URL . '/assets/css/ion.rangeSlider.skinFlat.css' );

        if(is_rtl()) {
            wp_enqueue_style( 'jnews-customizer-css-rtl', JEG_URL . '/assets/css/customizer-rtl.css', null );
        }
    }

    /**
     * load script on Customizer Panel
     */
    public function enqueue_control_script()
    {
        wp_enqueue_script( 'jnews-customizer-late-init' );
        wp_enqueue_script( 'jnews-active-callback' );
        wp_enqueue_script( 'jnews-previewer-sync' );
        wp_enqueue_script( 'jnews-lazy-section' );
        wp_enqueue_script( 'jnews-search-customizer' );
        wp_enqueue_script( 'jnews-extend-widget' );

        wp_localize_script( 'jnews-typography-control', 'jnewsAllFonts',
            $this->load_all_font()
        );

        wp_localize_script( 'jnews-lazy-section', 'lazySetting', array(
            'ajaxUrl' => add_query_arg( array( $this->endpoint => 'jnews' ), home_url('/') ),
            'nonce' => wp_create_nonce( $this->endpoint )
        ));

        wp_localize_script( 'jnews-search-customizer', 'searchSetting', array(
            'ajaxUrl' => add_query_arg( array( $this->endpoint => 'jnews' ), home_url('/') ),
            'nonce' => wp_create_nonce( $this->endpoint )
        ));

        wp_localize_script( 'jnews-previewer-sync', 'partialSetting', array(
            'patternTemplate' => LazyPartial::js_pattern_template()
        ));
    }

    public function get_excluded_font()
    {
        return apply_filters('jnews_not_google_font', array());
    }

    /**
     * load script at Customizer Preview
     */
    public function previewer_script()
    {
        $wp_scripts = wp_scripts();

        // ... Customizer Preview Script
        $handle = 'jnews-customizer-preview';
        $src = JEG_URL . '/assets/js/customizer/customizer-preview.js';
        $deps = array(
            'underscore',
            'customize-preview'
        );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-customizer-output-preview';
        $src = JEG_URL . '/assets/js/customizer/style-output-preview.js';
        $deps = array(
            'jquery',
            'underscore',
            'customize-preview'
        );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        $handle = 'jnews-customizer-partial-preview';
        $src = JEG_URL . '/assets/js/customizer/partial-refresh-preview.js';
        $deps = array(
            'jquery',
            'underscore',
            'customize-preview'
        );
        $in_footer = 1;
        $wp_scripts->add( $handle, $src, $deps, $this->version, $in_footer );

        // enqueue script
        wp_enqueue_script(  'jnews-customizer-preview' );
        wp_enqueue_script(  'jnews-customizer-output-preview');
        wp_enqueue_script(  'jnews-customizer-partial-preview' );

        wp_localize_script( 'jnews-customizer-output-preview', 'outputSetting', array(
            'excludeFont' => $this->get_excluded_font(),
            'settingPattern' => DefaultSetting::$lazy_js_pattern,
            'inlinePrefix' => StyleGenerator::$inline_prefix
        ));
    }
}