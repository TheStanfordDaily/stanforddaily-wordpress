<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JNews_SEO_Option
 */
Class JNews_JSONLD_Option
{

    /**
     * @var JNews_JSONLD_Option
     */
    private static $instance;

    /**
     * @var JNews_Customizer
     */
    private $customizer;

    /**
     * @return JNews_JSONLD_Option
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function __construct()
    {
        if(class_exists('Jeg\Customizer'))
        {
            $this->customizer = Jeg\Customizer::getInstance();

            $this->set_panel();
            $this->set_section();
        }
    }

    public function set_panel()
    {
        $this->customizer->add_panel(array(
            'id' => 'jnews_global_seo',
            'title' => esc_html__('JNews : JSON LD Schema Setting', 'jnews-jsonld'),
            'description' => esc_html__('JSON LD Schema setting.', 'jnews-jsonld'),
            'priority' => 196
        ));
    }

    public function set_section()
    {
        $this->customizer->add_section(array(
            'id' => 'jnews_schema_setting',
            'title' => esc_html__('Schema Setting', 'jnews-jsonld'),
            'panel' => 'jnews_global_seo',
            'priority' => 250,
            'type' => 'jnews-lazy-section',
        ));

        $this->customizer->add_section(array(
            'id' => 'jnews_main_schema',
            'title' => esc_html__('Home Page Schema', 'jnews-jsonld'),
            'panel' => 'jnews_global_seo',
            'priority' => 250,
            'type' => 'jnews-lazy-section',
        ));

        $this->customizer->add_section(array(
            'id' => 'jnews_article_schema',
            'title' => esc_html__('Post Schema', 'jnews-jsonld'),
            'panel' => 'jnews_global_seo',
            'priority' => 250,
            'type' => 'jnews-lazy-section',
        ));
    }
}