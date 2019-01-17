<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;

Class TwitterWidget implements NormalWidgetInterface
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

            'username' => array(
                'title'     => esc_html__('Twitter Username', 'jnews'),
                'desc'      => esc_html__('Insert your Twitter username.', 'jnews'),
                'type'      => 'text',
            ),

            'limit' => array(
                'title'     => esc_html__('Tweet Limit', 'jnews'),
                'desc'      => esc_html__('Insert the limit number of tweet.', 'jnews'),
                'type'      => 'text',
            ),

            'height' => array(
                'title'     => esc_html__('Widget Height', 'jnews'),
                'desc'      => esc_html__('Height setting will work if Tweet Limit is set empty.', 'jnews'),
                'type'      => 'text',
                'default'   => '500',
            ),

            'theme' => array(
                'title'     => esc_html__('Widget Theme', 'jnews'),
                'desc'      => esc_html__('Choose Twitter widget theme.', 'jnews'),
                'type'      => 'select',
                'default'   => 'light',
                'options'   => array(
                    'light' => esc_html__('Light', 'jnews'),
                    'dark' => esc_html__('Dark', 'jnews'),
                )
            ),

            'color'   => array(
                'title'     => esc_html__('Link Color', 'jnews'),
                'desc'      => esc_html__('Color of url link.', 'jnews'),
                'type'      => 'color',
                'default'   => '#1da1f2'
            ),

            'header' => array(
                'title'     => esc_html__('Show Header', 'jnews'),
                'desc'      => esc_html__('Show Twitter header.', 'jnews'),
                'type'      => 'select',
                'default'   => 'true',
                'options'   => array(
                    'true'  => esc_html__('Show', 'jnews'),
                    'false'   => esc_html__('Hide', 'jnews'),
                )
            ),

            'footer' => array(
                'title'     => esc_html__('Show Footer', 'jnews'),
                'desc'      => esc_html__('Show Twitter footer.', 'jnews'),
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
        extract($instance);
        $style = '';

        if ( isset( $header ) && $header === 'false' )
        {
            $style .= ' noheader';
        }

        if ( isset( $footer ) && $footer === 'false' )
        {
            $style .= ' nofooter';
        }

        $limit    = isset( $limit ) ? $limit : '';
        $theme 	  = isset( $theme ) ? $theme : '';
        $color    = isset( $color ) ? $color : '';
        $height   = isset( $height ) ? $height : '';
        $username = isset( $username ) ? $username : '';

        ?>
        <div class="jeg_twitter_widget">
            <a class="twitter-timeline" height="<?php echo esc_attr($height); ?>" href="https://twitter.com/<?php echo esc_attr($username); ?>" data-screen-name="<?php echo esc_attr($username); ?>" data-show-replies="false" data-theme="<?php echo esc_attr($theme); ?>" data-link-color="<?php echo esc_attr($color); ?>" data-tweet-limit="<?php echo esc_attr($limit); ?>" data-chrome="<?php echo esc_attr($style); ?>"></a>
        </div>
        <?php
    }
}