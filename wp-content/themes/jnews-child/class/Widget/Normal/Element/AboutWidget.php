<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Widget\Normal\NormalWidgetInterface;

Class AboutWidget implements NormalWidgetInterface
{
    /**
     * @return array
     */
    public function get_options()
    {
        return array (
            'title'     => array(
                'title'     => esc_html__('Title', 'jnews'),
                'desc'      => esc_html__('Title on widget header.', 'jnews'),
                'type'      => 'text'
            ),
            'aboutimg'   => array(
                'title'     => esc_html__('About Image', 'jnews'),
                'desc'      => esc_html__('Display your profile picture or site logo.', 'jnews'),
                'type'      => 'image'
            ),
            'aboutimgretina'   => array(
                'title'     => esc_html__('About Image: Retina', 'jnews'),
                'desc'      => esc_html__('Retina version (2x size) of your about image.', 'jnews'),
                'type'      => 'image'
            ),
            'aboutname'   => array(
                'title'     => esc_html__('Name', 'jnews'),
                'desc'      => esc_html__('Display your name (for blog).', 'jnews'),
                'type'      => 'text'
            ),
            'aboutoccupation'   => array(
                'title'     => esc_html__('Occupation', 'jnews'),
                'desc'      => esc_html__('Display your occupation (for blog).', 'jnews'),
                'type'      => 'text'
            ),
            'aboutusername'   => array(
                'title'     => esc_html__('Username', 'jnews'),
                'desc'      => esc_html__('List your WP username.', 'jnews'),
                'type'      => 'text'
            ),
            'align' => array(
                'title'     => esc_html__('Centered Content', 'jnews'),
                'desc'      => esc_html__('Set content text align center.', 'jnews'),
                'type'      => 'checkbox',
                'default'   => false,
            ),
        );
    }

    public function get_image($id)
    {
        if(!empty($id)) {
            $image = wp_get_attachment_image_src($id, 'full');
            return $image[0];
        } else {
            return null;
        }
    }

    public function render_widget($instance, $text_content = null)
    {
        // Extract Widget
        extract( $instance );

        if ( isset( $aboutimg ) )
        {
            $aboutimg = wp_get_attachment_image_src($aboutimg, 'full');
            $aboutimg = $aboutimg[0];
        } else {
            $aboutimg = '';
        }

        if ( isset( $aboutimgretina ) )
        {
            $aboutimgretina = wp_get_attachment_image_src($aboutimgretina, 'full');
            $aboutimgretina = $aboutimgretina[0];
        } else {
            $aboutimgretina = '';
        }

        $aboutname = isset($aboutname) ? $aboutname : '';
        $aboutusername = isset($aboutusername) ? $aboutusername : '';
        $aboutoccupation = isset($aboutoccupation) ? $aboutoccupation : '';
        $align = isset($align) && $align ? 'jeg_aligncenter' : '';

?>
        <div class="jeg_about <?php echo esc_attr($align) ?>">
            <?php if ( !empty( $aboutimg ) || !empty( $aboutimgretina ) ) : ?>
                <a class="footer_logo" href="<?php echo esc_url(home_url('/author/' . $aboutusername . '/')); ?>">
                    <img src="<?php echo esc_url($aboutimg) ?>" srcset="<?php echo esc_url($aboutimg) ?> 1x, <?php echo esc_url($aboutimgretina) ?> 2x" alt="<?php bloginfo('name'); ?>" data-pin-no-hover="true">
                </a>
            <?php endif ?>
            <?php if (!empty($aboutname)) : ?><h2 class="jeg_about_name"><?php echo wp_kses( $aboutname, wp_kses_allowed_html() ) ?></h2><?php endif; ?>
            <?php if (!empty($aboutoccupation)) : ?><p class="jeg_about_title"><?php echo wp_kses( $aboutoccupation, wp_kses_allowed_html() ) ?></p><?php endif; ?>
        </div>
<?php
    }
}
