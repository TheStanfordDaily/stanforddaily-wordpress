<?php
/**
 * @author : Jegtheme
 */

/**
 * Class Theme JNews Option
 */
Class JNews_Social_Meta_Option
{
    /**
     * @var JNews_Social_Meta_Option
     */
    private static $instance;

    /**
     * @var Jeg\Customizer
     */
    private $customizer;

    /**
     * @return JNews_Social_Meta_Option
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        if(class_exists('Jeg\Customizer'))
        {
            $this->customizer = Jeg\Customizer::getInstance();

            $this->set_section();
        }
    }

    public function set_section()
    {
        $this->customizer->add_section(array(
            'id'       => 'jnews_social_meta_section',
            'title'    => esc_html__('Social Meta Setting', 'jnews-meta-header'),
            'panel'    => 'jnews_social_panel',
            'priority' => 252,
            'type' => 'jnews-lazy-section',
        ));
    }
}
