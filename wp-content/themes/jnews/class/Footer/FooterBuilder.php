<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Footer;

use JNews\Single\SinglePost;

/**
 * Class JNews Footer Builder
 */
Class FooterBuilder
{
    /**
     * @var FooterBuilder
     */
    private static $instance;

    private $category = 'footer_template';

    private $number_column = 3;

    private $on_footer = false;

    /**
     * @return FooterBuilder
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function is_on_footer()
    {
        $post_id = get_the_ID();
        $post_type = get_post_type($post_id);
        return $this->on_footer || ( $post_type === 'footer' );
    }

    public function set_on_footer()
    {
        $this->on_footer = true;
    }

    public function remove_filter()
    {
        // remove related post
        remove_filter('the_content', array(SinglePost::getInstance(), 'render_inline_related_post'), 10);
    }

    public function render_footer()
    {
        // need to remove the filter first
        $this->remove_filter();

        // Render Footer
        global $post;
        $post = get_post($this->get_footer_page_id());
        setup_postdata($post);
        $this->render_elementor_style($post);
        the_content();
        wp_reset_postdata();
    }

    public function render_elementor_style($post)
    {
    	if ( get_post_meta($post->ID, '_elementor_edit_mode', true) === 'builder' )
	    {
	    	$style = get_post_meta($post->ID, '_elementor_page_settings', true);

	    	if ( ! empty($style['custom_css']) )
		    {
		    	echo "<style type=\"text/css\" data-type=\"elementor_custom-css\">" . $style['custom_css'] . "</style>";
		    }
	    }
    }

    public function not_on_footer()
    {
        $this->on_footer = false;
    }

    private function __construct()
    {
        add_action( 'init', array($this, 'footer_post_type'));

        if(is_admin())
        {
            // Footer Template on VC
            add_filter('jnews_rendered_element_group', array($this, 'header_group'));
            add_filter('vc_get_all_templates', array($this, 'footer_template'));
            add_filter('vc_templates_render_category', array($this, 'footer_template_render'));

            // Render Template for backend
            add_filter('vc_templates_render_backend_template', array($this, 'ajax_template_backend'), null, 2);
        } else {
            add_action( 'wp_head', array($this,'footer_css'), 999);
            add_action( 'init', array($this, 'force_load_css'), 1);

            // Render Template for Frontend
            add_filter('vc_templates_render_frontend_template', array($this, 'ajax_template_frontend'), null, 2);
        }

        add_action('init', array($this, 'footer_vc_row'));
        add_filter( 'post_row_actions', array( $this, 'footer_row_action'), null, 2 );
    }

    public function footer_row_action($actions, $post)
    {
        if($post->post_type === 'footer')
        {
            unset($actions['view']);
            unset($actions['inline hide-if-no-js']);
        }

        return $actions;
    }

    public function footer_template_render($category)
    {
        $category['output'] = '';

        if ( 'footer_template' === $category['category'] )
        {
            $category['output'] .= '
            <div class="vc_footer_template">
                <div class="vc_column vc_col-sm-12">
                    <div class="vc_ui-template-list vc_templates-list-my_templates vc_ui-list-bar">';

            if ( ! empty( $category['templates'] ) )
            {
                $arrays = array_chunk($category['templates'], $this->number_column);

                foreach($arrays as $templates)
                {
                    $category['output'] .= '<div class="vc_row">';
                    foreach($templates as $template)
                    {
                        $category['output'] .= $this->render_item_list($template);
                    }
                    $category['output'] .= '</div>';
                }
            }

            $category['output'] .= '
				    </div>
			    </div>
			</div>';
        }

        return $category;
    }

    public function render_item_list( $template )
    {
        $name = isset( $template['name'] ) ? esc_html( $template['name'] ) : esc_html( __( 'No title', 'js_composer' ) );
        $template_id = esc_attr( $template['unique_id'] );
        $template_id_hash = md5( $template_id ); // needed for jquery target for TTA
        $template_name = esc_html( $name );
        $template_name_lower = esc_attr( vc_slugify( $template_name ) );
        $template_type = esc_attr( isset( $template['type'] ) ? $template['type'] : 'custom' );
        $custom_class = esc_attr( isset( $template['custom_class'] ) ? $template['custom_class'] : '' );
        $column = 12 / $this->number_column;

        $template_item = $this->render_single_item( $name, $template );

        $output = "<div class='vc_col-sm-{$column}'>
                        <div class='vc_ui-template vc_templates-template-type-{$template_type} {$custom_class}'
                            data-template_id='{$template_id}'
                            data-template_id_hash='{$template_id_hash}'
                            data-category='{$template_type}'
                            data-template_unique_id='{$template_id}'
                            data-template_name='{$template_name_lower}'
                            data-template_type='{$template_type}'
                            data-vc-content='.vc_ui-template-content'>
                            <div class='vc_ui-list-bar-item'>
                                {$template_item}        
                            </div>
                            <div class='vc_ui-template-content' data-js-content>
                            </div>
                        </div>
                    </div>";

        return $output;
    }

    protected function render_single_item( $name, $data )
    {
        $template_name = esc_html( $name );
        $template_image = esc_attr( $data['image_path'] );

        return "<div class='jnews_template_vc_item' data-template-handler=''>
                    <img src='{$template_image}'/>
                    <div class='vc_ui-list-bar-item-trigger'>
			            <h3>{$template_name}</h3>
			        </div>
                </div>";
    }


    public function footer_template($data)
    {
        $data[] = array(
            'category' => $this->category,
            'category_name' => esc_html__('Footer Template', 'jnews'),
            'category_description' => esc_html__('Footer Template for JNews', 'jnews'),
            'category_weight' => 9,
            'templates' => $this->library()
        );

        return $data;
    }

    public function force_load_css()
    {
        if($this->is_footer_custom())
        {
            add_filter('jnews_vc_force_load_style', '__return_true');
        }
    }

    /**
     * Remove Footer option from option
     *
     * @param $groups
     * @return mixed
     */
    public function header_group($groups)
    {
        $post_type = get_post_type($_REQUEST['post_id']);
        if($post_type !== 'footer') {
            foreach($groups as $key => $group) {
                if($group === 'Footer Option') {
                    unset($groups[$key]);
                }
            }
        }
        return $groups;
    }

    public function is_footer_custom()
    {
        $footer_style = get_theme_mod('jnews_footer_style', '1');
        return $footer_style === 'custom';
    }

    public function get_footer_page_id()
    {
        return get_theme_mod('jnews_footer_custom_layout', null);
    }

    public function footer_css()
    {
        if($this->is_footer_custom())
        {
            $footer_page_id = $this->get_footer_page_id();

            $this->add_page_custom_css($footer_page_id);
            $this->add_shortcode_custom_css($footer_page_id);
        }
    }

    public function add_page_custom_css($post_id)
    {
        $post_custom_css = get_post_meta( $post_id, '_wpb_post_custom_css', true );

        if ( ! empty( $post_custom_css ) ) {
            $post_custom_css = strip_tags( $post_custom_css );
            echo '<style type="text/css" data-type="vc_custom-css">';
            echo $post_custom_css;
            echo '</style>';
        }
    }

    public function add_shortcode_custom_css($post_id)
    {
        $shortcodes_custom_css = get_post_meta( $post_id, '_wpb_shortcodes_custom_css', true );

        if ( ! empty( $shortcodes_custom_css ) ) {
            $shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
            echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
            echo $shortcodes_custom_css;
            echo '</style>';
        }
    }

    public function footer_vc_row()
    {
        if(function_exists('vc_add_param'))
        {
            vc_add_param('vc_row', array(
                'type' => 'dropdown',
                'param_name' => 'footer_scheme',
                'heading' => esc_html__('Footer Scheme', 'jnews'),
                'description'   => esc_html__('choose footer option you want to use', 'jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
                'std' => 'light',
                'value' => array(
                    esc_html__('Light', 'jnews') => 'light',
                    esc_html__('Dark', 'jnews') => 'dark',
                )
            ));

            vc_add_param('vc_row', array(
                'type' => 'colorpicker',
                'param_name' => 'footer_text_color',
                'heading' => esc_html__('Text Color','jnews'),
                'description'   => esc_html__('Footer text color','jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
            ));

            vc_add_param('vc_row', array(
                'type' => 'colorpicker',
                'param_name' => 'footer_link_color',
                'heading' => esc_html__('Link Color','jnews'),
                'description'   => esc_html__('Footer link text color','jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
            ));

            vc_add_param('vc_row', array(
                'type' => 'colorpicker',
                'param_name' => 'footer_linkhover_color',
                'heading' => esc_html__('Link Hover Color','jnews'),
                'description'   => esc_html__('Footer link hover text color','jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
            ));

            vc_add_param('vc_row', array(
                'type' => 'colorpicker',
                'param_name' => 'footer_widget_title_color',
                'heading' => esc_html__('Widget Title Color','jnews'),
                'description'   => esc_html__('Footer widget title text color','jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
            ));

            vc_add_param('vc_row', array(
                'type' => 'colorpicker',
                'param_name' => 'footer_form_bg',
                'heading' => esc_html__('Input Form Background','jnews'),
                'description'   => esc_html__('Footer input form background color','jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
            ));

            vc_add_param('vc_row', array(
                'type' => 'colorpicker',
                'param_name' => 'footer_form_color',
                'heading' => esc_html__('Input Text Color','jnews'),
                'description'   => esc_html__('Footer input form text color','jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
            ));

            vc_add_param('vc_row', array(
                'type' => 'colorpicker',
                'param_name' => 'footer_button_bg',
                'heading' => esc_html__('Button Background','jnews'),
                'description'   => esc_html__('Footer background color','jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
            ));


            vc_add_param('vc_row', array(
                'type' => 'colorpicker',
                'param_name' => 'footer_tags_bg',
                'heading' => esc_html__('Widget: Tag Cloud Background','jnews'),
                'description'   => esc_html__('Widget Tag Cloud on footer background color','jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
            ));

            vc_add_param('vc_row', array(
                'type' => 'colorpicker',
                'param_name' => 'footer_tags_color',
                'heading' => esc_html__('Widget: Tag Cloud Text Color','jnews'),
                'description'   => esc_html__('Widget Tag Cloud on footer text color','jnews'),
                'group' => esc_html__('Footer Style', 'jnews'),
            ));
        }
    }

    public function is_frontend_vc()
    {
        return function_exists('vc_is_page_editable') && vc_is_page_editable();
    }

    public function is_frontend_elementor()
    {
        if(defined('ELEMENTOR_VERSION'))
        {
            return true;
        }
    }

    public function footer_post_type()
    {
        if(is_admin() || $this->is_frontend_vc() || $this->is_frontend_elementor())
        {
            register_post_type( 'footer', array(
                'labels' 	=>
                    array(
                        'name' 				=> esc_html__( 'Footer Builder', 'jnews' ),
                        'singular_name' 	=> esc_html__( 'Footer Builder', 'jnews' ),
                        'menu_name'         => esc_html__( 'Footer Builder', 'jnews' ),
                        'add_new'			=> esc_html__( 'Build Footer', 'jnews' ),
                        'add_new_item' 		=> esc_html__( 'Build Custom Footer', 'jnews' ),
                        'edit_item' 		=> esc_html__( 'Edit Footer Builder', 'jnews' ),
                        'new_item' 			=> esc_html__( 'New Footer Entry', 'jnews' ),
                        'view_item' 		=> esc_html__( 'View Custom Footer', 'jnews' ),
                        'search_items' 		=> esc_html__( 'Search Footer Builder', 'jnews' ),
                        'not_found' 		=> esc_html__( 'No entry found', 'jnews' ),
                        'not_found_in_trash'=> esc_html__( 'No Custom Footer in Trash', 'jnews' ),
                        'parent_item_colon' => ''
                    ),
                'description'			=> esc_html__( 'Footer Builder', 'jnews' ),
                'public' 				=> true,
                'show_ui' 				=> true,
                'menu_position'			=> 6,
                'capability_type' 		=> 'post',
                'hierarchical' 			=> false,
                'supports' 				=> array('title' , 'editor'),
                'rewrite' 				=> array(
                    'slug'	=>	'footer'
                )
            ));
        }
    }

    public function ajax_template_backend($template_id, $template_type)
    {
        if($template_type === 'footer_template')
        {
            $content = $this->get_template($template_id);
            return $content;
        }

        return $template_id;
    }

    public function ajax_template_frontend($template_id, $template_type)
    {
        if($template_type === 'footer_template')
        {
            $saved_templates = $this->get_template($template_id);
            vc_frontend_editor()->setTemplateContent( $saved_templates );
            vc_frontend_editor()->enqueueRequired();
            vc_include_template( 'editors/frontend_template.tpl.php', array(
                'editor' => vc_frontend_editor(),
            ) );
            die();
        }
        return $template_id;
    }

    public function get_template($template_id)
    {
        ob_start();
        include "template/" . $template_id . ".txt";
        return ob_get_clean();
    }

    public function library()
    {
        $template = array();

        for($i = 1; $i <= 6; $i++) {
            $data                   = array();
            $data['name']           = 'Footer ' . $i;
            $data['unique_id']      = 'footer_' . $i;
            $data['image_path']     = get_template_directory_uri() . '/assets/img/admin/footer/footer-' . $i . '.jpg';
            $data['type']           = $this->category;

            $template[] = $data;
        }

        return $template;
    }
}