<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;

Class PinterestWidget implements NormalWidgetInterface
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
            'type' => array(
                'title'     => esc_html__('Widget Type', 'jnews'),
                'desc'      => esc_html__('Choose type of Pinterest widget.', 'jnews'),
                'type'      => 'select',
                'default'   => 'pin',
                'options'   => array(
                    'embedPin'   => esc_html__('Pin', 'jnews'),
                    'embedUser'  => esc_html__('Profile', 'jnews'),
                    'embedBoard' => esc_html__('Board', 'jnews'),
                )
            ),
            'url' => array(
                'title'     => esc_html__('Pinterest URL', 'jnews'),
                'desc'      => esc_html__('Insert your Pinterest url that based on widget type that you choose on option above.', 'jnews'),
                'type'      => 'text',
            ),
            'size' => array(
                'title'     => esc_html__('Pin Size', 'jnews'),
                'desc'      => esc_html__('This option will work only if you choose Pin on Wiget Type option above.', 'jnews'),
                'type'      => 'select',
                'default'   => 'medium',
                'options'   => array(
                    'small'   => esc_html__('Small', 'jnews'),
                    'medium'  => esc_html__('Medium', 'jnews'),
                    'large'   => esc_html__('Large', 'jnews'),
                )
            ),
        );
    }

    public function render_widget($instance, $text_content = null)
    {
        // Extract Variable
        extract($instance);

        $type = isset( $type ) ? $type : '';
        $size = isset( $size ) ? $size : '';
        $url  = isset( $url ) ? $url : '';

        if ( !empty( $url ) ):
        ?>
            <div class="jeg_pinterest_widget">
                <a data-pin-do="<?php echo esc_attr($type); ?>" data-pin-width="<?php echo esc_attr($size); ?>" href="<?php echo esc_url($url); ?>"></a>
            </div>
        <?php
        endif;
    }
}