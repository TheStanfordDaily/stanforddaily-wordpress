<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module;

use JNews\Walker\VCategoryWalker;

/**
 * Class JNews VC Integration
 */
Class ModuleVC
{
    /**
     * @var ModuleVC
     */
    private static $instance;

    /**
     * @return ModuleVC
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * ModuleVC constructor.
     */
    private function __construct()
    {
        $this->add_param();
        $this->setup_hook();
    }

    public function add_param()
    {
        if(function_exists('vc_add_param'))
        {
            /** row */

            vc_add_param('vc_row', array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Row Overlay', 'jnews'),
                'param_name'    => 'enable_overlay',
                'group'         => esc_html__('Additional', 'jnews'),
                'description'   => esc_html__('Enable overlay on your row. You can implement this option if you use video background or Image background to clarify your content.', 'jnews'),
                'value'         => array( esc_html__('Enable Overlay', 'jnews') => 'yes' )
            ));

            vc_add_param('vc_row', array(
                'type'          => 'colorpicker',
                'heading'       => esc_html__('Overlay Color', 'jnews'),
                'param_name'    => 'overlay_color',
                'group'         => esc_html__('Additional', 'jnews'),
                'dependency'    => Array('element' => "enable_overlay", 'value' => array('yes'))
            ));


            vc_add_param('vc_row', array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Enable top ribon', 'jnews'),
                'param_name'    => 'enable_top_ribon',
                'group'         => esc_html__('Additional', 'jnews'),
                'description'   => esc_html__('you can create ribon effect row, element height will be automatically calculated and will repeate x axis', 'jnews'),
                'value'         => array( esc_html__('Enable Top Ribon', 'jnews') => 'yes' )
            ));

            vc_add_param('vc_row', array(
                'type'          => 'attach_image',
                'heading'       => esc_html__('Top Ribon Background', 'jnews'),
                'param_name'    => 'top_ribon_bg',
                'group'         => esc_html__('Additional', 'jnews'),
                'dependency'    => Array('element' => "enable_top_ribon", 'value' => array('yes'))
            ));

            vc_add_param('vc_row', array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Enable bottom ribon', 'jnews'),
                'param_name'    => 'enable_bottom_ribon',
                'group'         => esc_html__('Additional', 'jnews'),
                'description'   => esc_html__('you can create ribon effect row, element height will be automatically calculated and will repeate x axis', 'jnews'),
                'value'         => array( esc_html__('Enable Bottom Ribon', 'jnews') => 'yes' )
            ));

            vc_add_param('vc_row', array(
                'type'          => 'attach_image',
                'heading'       => esc_html__('Bottom Ribon Background', 'jnews'),
                'param_name'    => 'bottom_ribon_bg',
                'group'         => esc_html__('Additional', 'jnews'),
                'dependency'    => Array('element' => "enable_bottom_ribon", 'value' => array('yes'))
            ));


            vc_add_param('vc_row', array(
                'type'          => 'alert',
                'param_name'    => 'vc_row_background',
                'heading'       => esc_html__('Additional Background Option', 'jnews'),
                'description'   => esc_html__('To use this setup, please choose Theme Defaults on background option above', 'jnews'),
                'group'         => esc_html__('Design Options', 'jnews'),
                'std'           => 'warning'
            ));

            vc_add_param('vc_row', array(
                'type'          => 'dropdown',
                'param_name'    => 'background_repeat',
                'heading'       => esc_html__('Background Repeat', 'jnews'),
                'group'         => esc_html__('Design Options', 'jnews'),
                'std'           => '',
                'value'         => array(
                    ''                                              => '',
                    esc_html__('Repeat Horizontal', 'jnews')        => 'repeat-x',
                    esc_html__('Repeat Vertical', 'jnews')          => 'repeat-y',
                    esc_html__('Repeat Image', 'jnews')             => 'repeat',
                    esc_html__('No Repeat', 'jnews')                => 'no-repeat',
                )
            ));

            vc_add_param('vc_row', array(
                'type'          => 'dropdown',
                'param_name'    => 'background_position',
                'heading'       => esc_html__('Background Position', 'jnews'),
                'group'         => esc_html__('Design Options', 'jnews'),
                'std'           => '',
                'value'         => array(
                    ''                                      => '',
                    esc_html__('Left Top', 'jnews')         => 'left top',
                    esc_html__('Left Center', 'jnews')      => 'left center',
                    esc_html__('Left Bottom', 'jnews')      => 'left bottom',
                    esc_html__('Center Top', 'jnews')       => 'center top',
                    esc_html__('Center Center', 'jnews')    => 'center center',
                    esc_html__('Center Bottom', 'jnews')    => 'center bottom',
                    esc_html__('Right Top', 'jnews')        => 'right top',
                    esc_html__('Right Center', 'jnews')     => 'right center',
                    esc_html__('Right Bottom', 'jnews')     => 'right bottom',
                )
            ));

            vc_add_param('vc_row', array(
                'type'          => 'dropdown',
                'param_name'    => 'background_attachment',
                'heading'       => esc_html__('Background Attachment', 'jnews'),
                'group'         => esc_html__('Design Options', 'jnews'),
                'std'           => '',
                'value'         => array(
                    ''                                  => '',
                    esc_html__('Fixed', 'jnews')        => 'fixed',
                    esc_html__('Scroll', 'jnews')       => 'scroll',
                )
            ));

            vc_add_param('vc_row', array(
                'type'          => 'dropdown',
                'param_name'    => 'background_size',
                'heading'       => esc_html__('Background Size', 'jnews'),
                'group'         => esc_html__('Design Options', 'jnews'),
                'std'           => '',
                'value'         => array(
                    ''                                   => '',
                    esc_html__('Cover', 'jnews')         => 'cover',
                    esc_html__('Contain', 'jnews')       => 'contain',
                    esc_html__('Initial', 'jnews')       => 'initial',
                    esc_html__('Inherit', 'jnews')       => 'inherit',
                )
            ));



            /** column */

            vc_add_param('vc_column', array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Enable Sticky Sidebar', 'jnews'),
                'param_name'    => 'sticky_sidebar',
                'value'         => array( esc_html__('Enable', 'jnews') => 'yes' ),
            ));

            vc_add_param('vc_column', array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Add Sidebar Margin', 'jnews'),
                'param_name'    => 'set_as_sidebar',
                'value'         => array( esc_html__('Add margin', 'jnews') => 'yes' ),
                'description'   => esc_html__('Set this column as sidebar. By using this column as sidebar, margin and padding of this column will be set to adapt sidebar setting.', 'jnews'),
            ));
        }
    }

    /**
     * Setup Hook
     */
    public function setup_hook()
    {
        add_filter( 'vc_check_post_type_validation' ,   array($this, 'vc_post_type'), null, 2);
        add_action( 'after_setup_theme',                array($this, 'integrate_vc'));

        add_action( 'init' ,                            array($this, 'additional_element') , 98 );
        add_action( 'admin_enqueue_scripts',            array($this, 'admin_script'));

        add_action( 'wp_ajax_jeg_find_post',            array($this, 'find_ajax_post'));
        add_action( 'wp_ajax_nopriv_jeg_find_post',     array($this, 'find_ajax_post'));

        add_action( 'wp_ajax_jeg_find_post_tag',        array($this, 'find_ajax_post_tag'));
        add_action( 'wp_ajax_nopriv_jeg_find_post_tag', array($this, 'find_ajax_post_tag'));

        add_action( 'wp_ajax_jeg_find_author',          array($this, 'find_ajax_author'));
        add_action( 'wp_ajax_nopriv_jeg_find_author',   array($this, 'find_ajax_author'));

        add_action( 'wp_ajax_jeg_find_tag',             array($this, 'find_ajax_tag'));
        add_action( 'wp_ajax_nopriv_jeg_find_tag',      array($this, 'find_ajax_tag'));
    }

    function find_ajax_author()
    {
        if ( isset( $_REQUEST[ 'string' ] ) && ! empty( $_REQUEST[ 'string' ] ) )
        {
            $string = esc_attr( trim( $_REQUEST[ 'string' ] ) );
        } else {
            return false;
        }

        $users = new \WP_User_Query( array(
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
                    'text'  => $user->display_name
                );
            }
        }

        wp_send_json($result);
    }

    public function find_ajax_tag()
    {
        $result = array();

        if ( isset( $_REQUEST[ 'string' ] ) && ! empty( $_REQUEST[ 'string' ] ) )
        {
            $terms = get_terms(array(
                'taxonomy' => 'post_tag',
                'hide_empty' => false,
                'search' => $_REQUEST['string']
            ));

            if($terms)
            {
                foreach ($terms as $term) {
                    $result[] = array(
                        'value' => $term->term_id,
                        'text' => $term->name
                    );
                }
            }
        }

        wp_send_json($result);
    }

    public function find_ajax_post()
    {
        add_filter( 'posts_where', array($this, 'posts_search_where'), 10, 2 );
        $query = new \WP_Query(
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

        remove_filter('posts_where', array($this, 'posts_search_where'));

        wp_reset_postdata();

        wp_send_json($result);
    }

    public function find_ajax_post_tag()
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
                    'text'  => $term->name
                );
            }
        }

        wp_send_json($result);
    }

    public function posts_search_where($where, &$wp_query)
    {
        global $wpdb;

        if ( isset( $_REQUEST[ 'string' ] ) && ! empty( $_REQUEST[ 'string' ] ) ) {
            $string = $_REQUEST[ 'string' ];

            $where .= $wpdb->prepare("
                AND {$wpdb->posts}.post_title LIKE '%%%s%%'",
                $string
            );
        }

        return $where;
    }

    public function admin_script()
    {
        wp_enqueue_style('global-admin',        JNEWS_THEME_URL . '/assets/css/admin/vc-admin.css');
        wp_enqueue_style('selectize',           JNEWS_THEME_URL . '/assets/css/admin/selectize.default.css');
        wp_enqueue_style('select2',             JNEWS_THEME_URL . '/assets/css/admin/select2.min.css');

        wp_enqueue_script('jquery-ui-spinner');
        wp_enqueue_script('selectize',          JNEWS_THEME_URL . '/assets/js/vendor/selectize.js');
        wp_enqueue_script('select2',            JNEWS_THEME_URL . '/assets/js/vendor/select2.min.js');
    }

    public function vc_post_type($value, $type)
    {
        if($type === 'page' || $type === 'footer') {
            return true;
        } else {
            return false;
        }
    }

    public function integrate_vc()
    {
        if(function_exists('vc_set_as_theme'))
        {
            vc_set_as_theme();
        }
    }

    public function additional_element()
    {
        if (class_exists('WPBakeryVisualComposerAbstract'))
        {
            $params = array(
                array('alert' ,        array($this, 'vc_alert')),
                array('multipost' ,    array($this, 'vc_multipost'),       JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('multitag' ,     array($this, 'vc_multitag'),        JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('multiauthor' ,  array($this, 'vc_multiauthor'),     JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('number' ,       array($this, 'vc_number'),          JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('checkblock' ,   array($this, 'vc_checkblock'),      JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('multiselect' ,  array($this, 'vc_multiselect'),     JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('multicategory', array($this, 'vc_multi_category'),  JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('radioimage' ,   array($this, 'vc_radioimage'),      JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('slider' ,       array($this, 'vc_slider'),          JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('attach_file' ,  array($this, 'vc_attach_file'),     JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('sectionid' ,    array($this, 'vc_sectionid'),       JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
                array('fontawesome' ,  array($this, 'vc_fontawesome'),     JNEWS_THEME_URL . '/assets/js/vc/vc.script.js'),
            );

            foreach($params as $param) {
                do_action('jnews_vc_element_parame', $param);
            }
        }
    }

    /**
     * VC ALERT
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_alert($settings, $value)
    {
        return
            "<div class=\"alert-wrapper\" data-field=\"{$settings['std']}\">
                <input name='{$settings['param_name']}' class='wpb_vc_param_value {$settings['param_name']} {$settings['type']}_field' type='hidden'/>
                <div class=\"vc-alert-element alert-{$settings['std']}\">
                    <strong>{$settings['heading']}</strong>
                    <div class=\"alert-description\">{$settings['description']}</div>
                </div>
            </div>";
    }

    /**
     * VC MULTIPOST
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_multipost($settings, $value)
    {
        $values = explode(',', $value);

        $options = array();
        foreach($values as $val) {
            $options[] = array(
                'value' => $val,
                'text' => get_the_title($val)
            );
        }

        $options = json_encode($options);

        return
            "<div class='multipost-input-wrapper'>
                <input name='{$settings['param_name']}' class='wpb_vc_param_value wpb-input input-sortable {$settings['param_name']} {$settings['type']}_field' type='text' value='{$value}'/>
                <div class=\"data-option\" style=\"display: none;\">
                    {$options}
                </div>
            </div>";
    }

    /**
     * VC MULTITAG
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_multitag($settings, $value)
    {
        $options = array();;
        $ajax_class = '';

        if ( empty( $settings['value'] ) )
        {
            $values = explode(',', $value);
            $ajax_class = 'jeg-ajax-load';

            foreach ( $values as $val )
            {
                if ( ! empty( $val ) )
                {
                    $term = get_term( $val, 'post_tag' );
                    $options[] = array(
                        'value' => $val,
                        'text'  => $term->name
                    );

                }
            }
        } else {
            foreach( $settings['value'] as $key => $val)
            {
                if ( ! empty( $key ) )
                {
                    $options[] = array(
                        'value'         => $val,
                        'text'          => $key,
                        'class'         => ''
                    );
                }
            }
        }

        $options = json_encode($options);

        return
            "<div class='multitag-input'>
                <input name='{$settings['param_name']}'  type=\"text\" id=\"input-sortable\" class=\"input-sortable wpb_vc_param_value {$ajax_class} wpb-input{$settings['param_name']} {$settings['type']}_field\" value=\"{$value}\">
                <div class=\"data-option\" style=\"display: none;\">
                    {$options}
                </div>
            </div>";
    }

    /**
     * VC MULTIAUTHOR
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_multiauthor($settings, $value)
    {
        $options = array();;
        $ajax_class = '';

        if ( empty( $settings['value'] ) )
        {
            $values = explode(',', $value);
            $ajax_class = 'jeg-ajax-load';

            foreach ( $values as $val )
            {
                if ( ! empty( $val ) )
                {
                    $user = get_userdata( $val );
                    $options[] = array(
                        'value' => $val,
                        'text'  => $user->display_name
                    );
                }
            }
        } else {
            foreach( $settings['value'] as $key => $val)
            {
                if ( ! empty( $key ) )
                {
                    $options[] = array(
                        'value'         => $val,
                        'text'          => $key,
                        'class'         => ''
                    );
                }
            }
        }

        $options = json_encode($options);

        return
            "<div class='multiauthor-input'>
                <input name='{$settings['param_name']}'  type=\"text\" id=\"input-sortable\" class=\"input-sortable wpb_vc_param_value {$ajax_class} wpb-input{$settings['param_name']} {$settings['type']}_field\" value=\"{$value}\">
                <div class=\"data-option\" style=\"display: none;\">
                    {$options}
                </div>
            </div>";
    }

    /**
     * VC NUMBER
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_number($settings, $value)
    {
        return
            "<div class='number-input-wrapper'>
                <input name='{$settings['param_name']}'
                    class='wpb_vc_param_value wpb-input {$settings['param_name']} {$settings['type']}_field'
                    type='text'
                    min='{$settings['min']}'
                    max='{$settings['max']}'
                    step='{$settings['step']}'
                    value='{$value}'/>
            </div>";
    }


    /**
     * Check Block
     *
     * @param $setting
     * @param $value
     * @return string
     */
    public function vc_checkblock($setting, $value) {
        $option = '';
        $valuearr = explode(',',$value);

        $option .= "<input name='" . $setting['param_name'] . "' class='wpb_vc_param_value wpb-input " . $setting['param_name'] . " " . $setting['type'] . "_field' type='hidden' value='" . $value ."' />";
        foreach($setting['value'] as $key => $val) {
            $checked = in_array($val, $valuearr) ? "checked='checked'" : "";
            $option .= '<label><input ' . $checked .' class="checkblock" value="' . $val . '" type="checkbox">' . $key . '</label>';
        }

        return
            '<div class="wp-tab-panel vc_checkblock">
                <div>' . $option . '</div>
            </div>';
    }


    /**
     * Multi Select
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_multiselect($settings, $value)
    {
        $options = array();
        foreach($settings['value'] as $key => $val) {
            $options[] = array(
                'value'         => $val,
                'text'          => $key,
                'class'         => ''
            );
        }

        $options = json_encode($options);

        return
            "<div class='mulitselect-input'>
                <input name='{$settings['param_name']}'  type=\"text\" id=\"input-sortable\" class=\"input-sortable wpb_vc_param_value wpb-input{$settings['param_name']} {$settings['type']}_field\" value=\"{$value}\">
                <div class=\"data-option\" style=\"display: none;\">
                    {$options}
                </div>
            </div>";
    }


    /**
     * Multi Category
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_multi_category($settings, $value)
    {
        $options = array();

        $categories = get_categories(array(
            'hide_empty' => false,
            'hierarchical' => true
        ));

        $walker = new VCategoryWalker();
        $walker->walk($categories, 3);

        foreach($walker->cache as $val)
        {
            $options[] = array(
                'value'     => $val['id'],
                'text'      => $val['title'],
                'class'     => 'indent_' . $val['depth']
            );
        }

        $options = json_encode($options);

        return
            "<div class='mulitselect-input'>
                <input name='{$settings['param_name']}'  type=\"text\" id=\"input-sortable\" class=\"input-sortable wpb_vc_param_value wpb-input{$settings['param_name']} {$settings['type']}_field\" value=\"{$value}\">
                <div class=\"data-option\" style=\"display: none;\">
                    {$options}
                </div>
            </div>";
    }


    /**
     * VC Radio Image
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_radioimage($settings, $value)
    {
        $radio_option = '';
        $radio_input = "<input type='hidden' name='{$settings['param_name']}' value='{$value}' class='wpb_vc_param_value wpb-input{$settings['param_name']}'/>";

        foreach($settings['value'] as $key => $val) {
            $checked = ( $value === $val ) ? "checked" : "";
            $radio_option .=
                "<label>
                <input {$checked} type='radio' name='{$settings['param_name']}_field' value='{$val}' class='{$settings['type']}_field'/>
                <img src='{$key}' class='wpb_vc_radio_image'/>
            </label>";
        }

        return
            "<div class='radio-image-wrapper'>
                {$radio_input}
                {$radio_option}
            </div>";
    }


    /**
     * VC Slider
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_slider($settings, $value)
    {
        return
            "<div class='slider-input-wrapper'>
                <input name='{$settings['param_name']}'
                    class='wpb_vc_param_value wpb-input {$settings['param_name']} {$settings['type']}_field'
                    type='range'
                    min='{$settings['min']}'
                    max='{$settings['max']}'
                    step='{$settings['step']}'
                    value='{$value}'
                    data-reset_value='{$value}'/>
                <div class=\"jnews_range_value\">
                    <span class=\"value\">{$value}</span>
                </div>
                <div class=\"jnews-slider-reset\">
                  <span class=\"dashicons dashicons-image-rotate\"></span>
                </div>
            </div>";
    }


    /**
     * VC Attach File
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_attach_file($settings, $value)
    {
        return
            "<div class='input-uploadfile'>
                <input name='" . $settings['param_name'] . "' class='wpb_vc_param_value wpb-input" . $settings['param_name'] . " " . $settings['type'] . "_field' type='text' value='$value' />
                <div class='buttons'>
                    <input type='button' value='" . esc_html__( 'Select File', 'jnews' ) . "' class='selectfileimage btn'/>
                </div>
            </div>";
    }


    /**
     * VC Section ID
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_sectionid($settings, $value)
    {
        return
            "<div class='sectionid-input'>
                <input name='" . $settings['param_name'] . "' class='wpb_vc_param_value wpb-input" . $settings['param_name'] . " " . $settings['type'] . "_field' type='text' value='$value' />
            </div>";
    }


    /**
     * VC Font Awesome
     *
     * @param $settings
     * @param $value
     * @return string
     */
    public function vc_fontawesome($settings, $value)
    {
        $fontawesomelist = $this->get_fontawesome_icons();
        $fontlisttext = '';

        foreach($fontawesomelist as $fontid) {
            if($value == $fontid['value']) {
                $fontlisttext .= "<option selected value='{$fontid['value']}'>{$fontid['value']}</option>";
            } else {
                $fontlisttext .= "<option value='{$fontid['value']}'>{$fontid['value']}</option>";
            }
        }

        return
            "<div class='sectionid-input'>
                <select name='" . $settings['param_name'] . "' class='wpb_vc_param_value wpb-input" . $settings['param_name'] . " " . $settings['type'] . "_field'>
                    " . $fontlisttext . "
                </select>
            </div>";
    }

    /**
     * @return font awesome
     */
    public function get_fontawesome_icons()
    {
        global $wp_filesystem;

        if (empty($wp_filesystem)) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        if( false === ( $icons  = get_transient( 'jnews_fontawesome_icons' ) ) )
        {
            $pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s*{\s*content/';
            $subject = $wp_filesystem->get_contents(JNEWS_THEME_DIR . '/assets/css/font-awesome.min.css');

            preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

            $icons = array();

            foreach($matches as $match)
            {
                $icons[] = array('value' => $match[1], 'label' => $match[1]);
            }
            set_transient( 'jnews_fontawesome_icons', $icons, 60 * 60 * 24 );
        }

        return $icons;
    }
}