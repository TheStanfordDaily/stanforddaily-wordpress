<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Category;

use JNews\Archive\ArchiveAbstract;
use JNews\Module\ModuleManager;
use JNews\Module\Hero;

/**
 * Abstract Class TermAbstract
 */
abstract Class CategoryAbstract extends ArchiveAbstract
{
    /**
     * @var \WP_Term
     */
    protected $term;

    public function __construct($term = null)
    {
        if($term === null) {
            $term = get_queried_object();
        }
        $this->term = $term;
        $this->set_hero_class();
    }

    public function render_hero()
    {
        if($this->show_hero())
        {
            ModuleManager::getInstance()->set_width(array(12));

            $attr = array(
                'hero_style' => $this->get_hero_style(),
                'hero_margin' => $this->get_hero_margin(),
                'date_format' => $this->get_hero_date(),
                'date_format_custom' => $this->get_hero_date_custom(),
                'paged' => 1,
                'number_post' => $this->hero_instance->get_number_post(),
                'include_category' => $this->term->term_id,
                'sort_by' => 'latest',
                'push_archive' => true
            );

            /** @var Hero\HeroViewAbstract */
            $this->hero_instance->set_attribute($attr);
            $this->offset = $this->hero_instance->get_number_post();

            /** Render Item */
            return $this->hero_instance->build_module($attr);
        }
        return null;
    }


    public function render_content()
    {
        $content_width = array($this->get_content_width());
        ModuleManager::getInstance()->set_width($content_width);

        $post_per_page = get_option( 'posts_per_page' );

        $attr = array(
            'date_format' => $this->get_content_date(),
            'date_format_custom' => $this->get_content_date_custom(),
            'excerpt_length' => $this->get_content_excerpt(),
            'pagination_number_post' => $post_per_page,
            'number_post' => $post_per_page,
            'post_offset' => $this->offset,
            'include_category' => $this->term->term_id,
            'sort_by' => 'latest',
            'pagination_mode' => $this->get_content_pagination(),
            'pagination_scroll_limit' => $this->get_content_pagination_limit(),
            'paged' => jnews_get_post_current_page(),
            'pagination_align' => $this->get_content_pagination_align(),
            'pagination_navtext' => $this->get_content_pagination_navtext(),
            'pagination_pageinfo' => $this->get_content_pagination_pageinfo(),
            'push_archive' => true
        );

        if ( get_theme_mod('jnews_ads_inline_module_enable', false) ) 
        {
            $ads_option = array(
                'ads_type'              => get_theme_mod('jnews_ads_inline_module_type', 'googleads'),
                'ads_position'          => get_theme_mod('jnews_ads_inline_module_paragraph', 2),
                'ads_random'            => get_theme_mod('jnews_ads_inline_module_paragraph_random', false),
                'ads_image'             => get_theme_mod('jnews_ads_inline_module_image', ''),
                'ads_image_link'        => get_theme_mod('jnews_ads_inline_module_link', ''),
                'ads_image_alt'         => get_theme_mod('jnews_ads_inline_module_text', ''),
                'ads_image_new_tab'     => get_theme_mod('jnews_ads_inline_module_open_tab', true),
                'google_publisher_id'   => get_theme_mod('jnews_ads_inline_module_google_publisher', ''),
                'google_slot_id'        => get_theme_mod('jnews_ads_inline_module_google_id', ''),
                'google_desktop'        => get_theme_mod('jnews_ads_inline_module_google_desktop', 'auto'),
                'google_tab'            => get_theme_mod('jnews_ads_inline_module_google_tab', 'auto'),
                'google_phone'          => get_theme_mod('jnews_ads_inline_module_google_phone', 'auto'),
                'code'                  => get_theme_mod('jnews_ads_inline_module_code', ''),
                'ads_class'             => 'inline_module'
            );

            $attr = array_merge($attr, $ads_option);
        }

        $name = jnews_get_view_class_from_shortcode ( 'JNews_Block_' . $this->get_content_type() );
        $this->content_instance = jnews_get_module_instance($name);
        return $this->content_instance->build_module($attr);
    }

    public function header_style()
    {
        $image = $this->get_header_image();
        $background = $this->get_header_background();
        $style = '';

        if(!empty($image)){
            $style .= "background-image: url('{$image}');";
        }

        if(!empty($background)) {
            $style .= "background-color: {$background};";
        }

        return $style;
    }

    public function archive_header_1()
    {
        $subtitle   = !empty($this->term->description) ? "<h2 class=\"jeg_cat_subtitle\">{$this->term->description}</h2>" : "";
        $breadcrumb = jnews_can_render_breadcrumb() ? "<div class=\"jeg_breadcrumbs jeg_breadcrumb_category jeg_breadcrumb_container\">{$this->render_breadcrumb()}</div>" : "";
        $subscribe  = apply_filters( 'jnews_push_notification_single_category', '', $this->term );

        $output =
            "<div class=\"jeg_cat_header jeg_cat_header_1\">
                {$breadcrumb}
                <h1 class=\"jeg_cat_title\">{$this->term->name}</h1>
                {$subtitle}
                {$subscribe}
            </div>";

        return $output;
    }

    public function archive_header_2()
    {
        $subtitle   = !empty($this->term->description) ? "<h2 class=\"jeg_cat_subtitle\">{$this->term->description}</h2>" : "";
        $breadcrumb = jnews_can_render_breadcrumb() ? "<div class=\"jeg_breadcrumbs jeg_breadcrumb_category jeg_breadcrumb_container\">{$this->render_breadcrumb()}</div>" : "";
        $subscribe  = apply_filters( 'jnews_push_notification_single_category', '', $this->term );

        if ( !empty( $subscribe ) ) 
        {
            $subscribe = "<div class=\"container\">
                            {$subscribe}
                        </div>";
        }

        $output =
            "<div class=\"jeg_cat_header jeg_cat_header_2\">
                <div class=\"container\">
                    {$breadcrumb}
                    <h1 class=\"jeg_cat_title\">{$this->term->name}</h1>
                    {$subtitle}
                </div>
            </div>
            {$subscribe}";

        return $output;
    }

    public function archive_header_3()
    {
        $style  = $this->get_header_style();
        $subtitle   = !empty($this->term->description) ? "<h2 class=\"jeg_cat_subtitle\">{$this->term->description}</h2>" : "";
        $breadcrumb = jnews_can_render_breadcrumb() ? "<div class=\"jeg_breadcrumbs jeg_breadcrumb_category jeg_breadcrumb_container\"> {$this->render_breadcrumb()} </div>" : "";
        $subscribe  = apply_filters( 'jnews_push_notification_single_category', '', $this->term );

        if ( !empty( $subscribe ) ) 
        {
            $subscribe = "<div class=\"container\">
                            {$subscribe}
                        </div>";
        }

        $output =
            "<div class=\"jeg_cat_header jeg_cat_header_3\">
                <div class=\"jeg_cat_overlay {$style}\">
                    <div class=\"jeg_cat_bg\" style=\"{$this->header_style()}\"></div>

                    <div class=\"container\">
                        {$breadcrumb}
                        <div class=\"jeg_title_wrap\">
                            <h1 class=\"jeg_cat_title\">{$this->term->name}</h1>
                            {$subtitle}
                        </div>
                    </div>
                </div>
            </div>
            {$subscribe}";

        return $output;
    }

    public function archive_header_4()
    {
        $style  = $this->get_header_style();
        $subtitle   = !empty($this->term->description) ? "<h2 class=\"jeg_cat_subtitle\">{$this->term->description}</h2>" : "";
        $breadcrumb = jnews_can_render_breadcrumb() ?
            "<div class=\"jeg_breadcrumbs\"> 
                <div class=\"container jeg_breadcrumb_category jeg_breadcrumb_container\"> 
                    {$this->render_breadcrumb()} 
                </div> 
            </div>" : "";

        $subscribe  = apply_filters( 'jnews_push_notification_single_category', '', $this->term );

        if ( !empty( $subscribe ) ) 
        {
            $subscribe = "<div class=\"container\">
                            {$subscribe}
                        </div>";
        }

        $output =
            "<div class=\"jeg_cat_header jeg_cat_header_4\">
                <div class=\"jeg_cat_overlay {$style}\">
                    <div class=\"jeg_cat_bg jeg_parallax_bg\" style=\"{$this->header_style()}\"></div>

                    <div class=\"container\">
                        <div class=\"jeg_title_wrap\">
                            <h1 class=\"jeg_cat_title\">{$this->term->name}</h1>
                            {$subtitle}
                        </div>
                    </div>
                </div>
                {$breadcrumb}
            </div>
            {$subscribe}";

        return $output;
    }

    public function render_header($position)
    {
        $header_type = $this->get_header_type();

        if($position === 'top' && ( $header_type === '2' || $header_type === '3' || $header_type === '4' ))
        {
            switch($header_type) {
                case '2' :
                    return $this->archive_header_2();
                case '3' :
                    return $this->archive_header_3();
                case '4' :
                    return $this->archive_header_4();
            }
        } else if($position === 'bottom' && $header_type === '1')
        {
            return $this->archive_header_1();
        }

        return null;
    }

    public function set_hero_class()
    {
        $name = jnews_get_view_class_from_shortcode ( 'JNews_Hero_' . $this->get_hero_type() );
        $this->hero_instance = jnews_get_module_instance($name);
    }



    // header
    abstract public function get_header_type();
    abstract public function get_header_background();
    abstract public function get_header_image();
    abstract public function get_header_style();

    // hero
    abstract public function show_hero();
    abstract public function get_hero_type();
    abstract public function get_hero_style();
    abstract public function get_hero_margin();
    abstract public function get_hero_date();
    abstract public function get_hero_date_custom();
}