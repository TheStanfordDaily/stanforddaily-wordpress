<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;

Class GooglePlusWidget implements NormalWidgetInterface
{
    /**
     * Register widget with WordPress.
     */
    public function get_options()
    {
        return array (
            'title' => array(
                'title'     => esc_html__('Title', 'jnews'),
                'desc'      => esc_html__('Title on widget header.', 'jnews'),
                'type'      => 'text'
            ),
            'page' => array(
                'title'     => esc_html__('Page Type', 'jnews'),
                'desc'      => esc_html__('Choose type of Google+ badge.', 'jnews'),
                'type'      => 'select',
                'default'   => 'profile',
                'options'   => array(
                    'person'   => esc_html__('Profile', 'jnews'),
                    'page'      => esc_html__('Page', 'jnews'),
                    'community' => esc_html__('Community', 'jnews'),
                )
            ),
            'url' => array(
                'title'     => esc_html__('Google+ URL', 'jnews'),
                'desc'      => esc_html__('Insert your Google+ url that based on page type that you choose above.', 'jnews'),
                'type'      => 'text',
            ),
            'fit' => array(
                'title'     => esc_html__('Custom Width', 'jnews'),
                'desc'      => esc_html__('Enable custom width for your badge.', 'jnews'),
                'type'      => 'checkbox',
                'default'   => false
            ),
            'width' => array(
                'title'     => esc_html__('Set Width', 'jnews'),
                'desc'      => esc_html__('Set your badge width.', 'jnews'),
                'type'      => 'text',
                'dependency' => array(
                    array(
                        'field' => 'fit',
                        'operator' => '==',
                        'value' => true
                    )
                )
            ),
            'color' => array(
                'title'     => esc_html__('Color Scheme', 'jnews'),
                'desc'      => esc_html__('Choose color scheme of the badge.', 'jnews'),
                'type'      => 'select',
                'default'   => 'light',
                'options'   => array(
                    'light'  => esc_html__('Light', 'jnews'),
                    'dark'   => esc_html__('Dark', 'jnews'),
                )
            ),
            'layout' => array(
                'title'     => esc_html__('Layout Type', 'jnews'),
                'desc'      => esc_html__('Set the orientation of the badge.', 'jnews'),
                'type'      => 'select',
                'default'   => 'portrait',
                'options'   => array(
                    'portrait'  => esc_html__('Portrait', 'jnews'),
                    'landscape' => esc_html__('Landscape', 'jnews'),
                )
            ),
            'cover' => array(
                'title'     => esc_html__('Cover Photo', 'jnews'),
                'desc'      => esc_html__('Your Google+ cover photo.', 'jnews'),
                'type'      => 'select',
                'default'   => 'true',
                'options'   => array(
                    'true'  => esc_html__('Show', 'jnews'),
                    'false'   => esc_html__('Hide', 'jnews'),
                )
            ),
            'tagline' => array(
                'title'     => esc_html__('Tagline', 'jnews'),
                'desc'      => esc_html__('Your Google+ tagline.', 'jnews'),
                'type'      => 'select',
                'default'   => 'true',
                'options'   => array(
                    'true'  => esc_html__('Show', 'jnews'),
                    'false'   => esc_html__('Hide', 'jnews'),
                )
            ),
        );
    }

    public function render_widget($instance, $text_content = null)
    {
        // Extract Variable
        extract($instance);

        $fit     = isset( $fit ) ? 'false' : 'true';
        $url     = isset( $url ) ? $url : '';
        $page    = isset( $page ) ? $page : '';
        $width   = isset( $width ) ? $width : '';
        $color   = isset( $color ) ? $color : '';
        $cover   = isset( $cover ) ? $cover : '';
        $layout  = isset( $layout ) ? $layout : '';
        $tagline = isset( $tagline ) ? $tagline : '';
        ?>
        <div class="jeg_google_plus_widget">
            <div class="g-<?php echo esc_attr($page); ?>" data-width="<?php echo esc_attr($width); ?>" data-href="<?php echo esc_url($url); ?>" data-layout="<?php echo esc_attr($layout); ?>" data-theme="<?php echo esc_attr($color); ?>" data-showtagline="<?php echo esc_attr($tagline); ?>" data-showcoverphoto="<?php echo esc_attr($cover); ?>" data-fit="<?php echo esc_attr($fit); ?>"></div>
        </div>
        <?php
    }
}