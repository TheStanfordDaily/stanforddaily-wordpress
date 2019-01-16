<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;

Class FacebookPageWidget implements NormalWidgetInterface
{
    /**
     * Register widget with WordPress.
     */
    public function get_options()
    {
        return array
        (
            'title' => array(
                'title'     => esc_html__('Title', 'jnews'),
                'desc'      => esc_html__('Title on widget header.', 'jnews'),
                'type'      => 'text'
            ),

            'url' => array(
                'title'     => esc_html__('Facebook Page URL', 'jnews'),
                'desc'      => esc_html__('Insert your Facebook Page url.', 'jnews'),
                'type'      => 'text'
            ),

            'appid' => array(
                'title'     => esc_html__('Facebook Application ID', 'jnews'),
                'desc'      => sprintf(__('You can create your Facebook Application ID <a href="%s" target="_blank">here</a>.', 'jnews' ), 'https://developers.facebook.com/docs/apps/register'),
                'type'      => 'text'
            ),

            'tabs' => array(
                'title'     => esc_html__('Show Info', 'jnews'),
                'desc'      => esc_html__('Choose data info that you want to show.', 'jnews'),
                'type'      => 'select',
                'default'   => 'timeline',
                'options'   => array(
                    'timeline' => esc_html__('Timeline', 'jnews'),
                    'events'   => esc_html__('Events', 'jnews'),
                    'false'    => esc_html__('None', 'jnews'),
                )
            ),

            'height' => array(
                'title'     => esc_html__('Set Height', 'jnews'),
                'desc'      => esc_html__('Set height of Facebook Page widget.', 'jnews'),
                'type'      => 'text',
                'default'   => '500',
            ),

            'cover' => array(
                'title'     => esc_html__('Cover Photo', 'jnews'),
                'desc'      => esc_html__('Cover photo of Facebook Page.', 'jnews'),
                'type'      => 'select',
                'default'   => 'false',
                'options'   => array(
                    'false'   => esc_html__('Show', 'jnews'),
                    'true'    => esc_html__('Hide', 'jnews'),
                )
            ),

            'photo' => array(
                'title'     => esc_html__('Friend\'s Profile Photo', 'jnews'),
                'desc'      => esc_html__('Show friend\'s profile photo who like this Facebook Page.', 'jnews'),
                'type'      => 'select',
                'default'   => 'true',
                'options'   => array(
                    'true'    => esc_html__('Show', 'jnews'),
                    'false'   => esc_html__('Hide', 'jnews'),
                )
            ),

            'small' => array(
                'title'     => esc_html__('Small Header', 'jnews'),
                'desc'      => esc_html__('Use small header.', 'jnews'),
                'type'      => 'checkbox',
            ),
        );
    }

    public function render_widget($instance, $text_content = null)
    {
        // Extract Variable
        extract($instance);

        $url 	= isset( $url ) ? $url : '';
        $tabs 	= isset( $tabs ) ? $tabs : '';
        $small 	= isset( $small ) ? $small : '';
        $cover 	= isset( $cover ) ? $cover : '';
        $photo 	= isset( $photo ) ? $photo : '';
        $appid 	= isset( $appid ) ? $appid : '';
        $height = isset( $height ) ? $height : '';

        if ( !empty( $url ) && !empty( $appid ) ):
        ?>
        <div class="jeg_facebook_widget">
            <div class="fb-page" data-href="<?php echo esc_url($url); ?>" data-small-header="<?php echo esc_attr($small); ?>" data-adapt-container-width="true" data-hide-cover="<?php echo esc_attr($cover); ?>" data-show-facepile="<?php echo esc_attr($photo); ?>" data-tabs="<?php echo esc_attr($tabs); ?>" data-height="<?php echo esc_attr($height); ?>" data-id="<?php echo esc_attr($appid); ?>">
            </div>
        </div>
        <?php
        endif;
    }
}