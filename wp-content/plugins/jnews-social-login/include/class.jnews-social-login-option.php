<?php
/**
 * @author : Jegtheme
 */

/**
 * Class Theme JNews Option
 */
Class JNews_Social_Login_Option
{
    /**
     * @var JNews_Social_Login_Option
     */
    private static $instance;

    /**
     * @var Jeg\Customizer
     */
    private $customizer;

    /**
     * @return JNews_Social_Login_Option
     */
    public static function getInstance()
    {
        if ( null === static::$instance )
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * JNews_Social_Login_Option constructor
     */
    private function __construct()
    {
        if(class_exists('Jeg\Customizer'))
        {
            $this->customizer = Jeg\Customizer::getInstance();

            $this->set_section();
        }
    }

    /**
     * Social login section
     */
    public function set_section()
    {
        $this->customizer->add_section(array(
            'id'       => 'jnews_social_login_section',
            'title'    => esc_html__('Social Login Setting', 'jnews-social-login'),
            'panel'    => 'jnews_social_panel',
            'priority' => 253,
            'type' => 'jnews-lazy-section',
        ));
    }

}
