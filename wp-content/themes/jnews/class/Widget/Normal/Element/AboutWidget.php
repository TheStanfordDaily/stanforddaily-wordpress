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
            'aboutdesc'   => array(
                'title'     => esc_html__('About Description', 'jnews'),
                'desc'      => esc_html__('You may use standard HTML tags and attributes.', 'jnews'),
                'type'      => 'textarea'
            ),
            'signature'   => array(
                'title'     => esc_html__('Signature', 'jnews'),
                'desc'      => esc_html__('Put signature at the bottom of content.', 'jnews'),
                'type'      => 'image'
            ),
            'signatureretina'   => array(
                'title'     => esc_html__('Signature: Retina', 'jnews'),
                'desc'      => esc_html__('Retina version (2x size) of your signature image.', 'jnews'),
                'type'      => 'image'
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

        if($text_content !== null)
        {
            $aboutdesc = $text_content;
        }

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

        if ( isset( $signature ) )
        {
            $signature = wp_get_attachment_image_src($signature, 'full');
            $signature = $signature[0];
        } else {
            $signature = '';
        }

        if ( isset( $signatureretina ) )
        {
            $signatureretina = wp_get_attachment_image_src($signatureretina, 'full');
            $signatureretina = $signatureretina[0];
        } else {
            $signatureretina = '';
        }

        $aboutname = isset($aboutname) ? $aboutname : '';
        $aboutoccupation = isset($aboutoccupation) ? $aboutoccupation : '';
        $aboutdesc = isset($aboutdesc) ? $aboutdesc : '';
        $align = isset($align) && $align ? 'jeg_aligncenter' : '';
        
?>
        <div class="jeg_about <?php echo esc_attr($align) ?>">
            <?php if ( !empty( $aboutimg ) || !empty( $aboutimgretina ) ) : ?>
                <a class="footer_logo" href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url($aboutimg) ?>" srcset="<?php echo esc_url($aboutimg) ?> 1x, <?php echo esc_url($aboutimgretina) ?> 2x" alt="<?php bloginfo('name'); ?>" data-pin-no-hover="true">
                </a>
            <?php endif ?>
            <?php if (!empty($aboutname)) : ?><h2 class="jeg_about_name"><?php echo wp_kses( $aboutname, wp_kses_allowed_html() ) ?></h2><?php endif; ?>
            <?php if (!empty($aboutoccupation)) : ?><p class="jeg_about_title"><?php echo wp_kses( $aboutoccupation, wp_kses_allowed_html() ) ?></p><?php endif; ?>
            <p><?php echo str_replace(PHP_EOL,"<br>", do_shortcode($aboutdesc)) ; ?></p>

            <?php if ( !empty( $signature ) || !empty( $signatureretina ) ) : ?>
                <div class="jeg_about_autograph">
                    <img src="<?php echo esc_url($signature) ?>" srcset="<?php echo esc_url($signature) ?> 1x, <?php echo esc_url($signatureretina) ?> 2x" alt="<?php echo esc_attr($aboutname) ?>">
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}
