<?php
namespace JNews\Elementor\Normal;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class SocialIcon extends Widget_Base
{
	public function get_name()
    {
		return 'socialicon';
	}

	public function get_title()
    {
		return esc_html__( 'Social Icon', 'jnews' );
	}

	public function get_icon()
    {
		return 'jnews_element_socialiconwrapper';
	}

	public function get_categories()
    {
		return [ 'jnews-element' ];
	}

	protected function _register_controls()
    {
		$this->start_controls_section(
			'section',
			[
				'label' => esc_html__( 'Social Icon', 'jnews' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'         => esc_html__( 'Style', 'jnews' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'nobg',
				'options'       => array(
					'square'        => esc_html__('Square', 'jnews'),
					'rounded'       => esc_html__('Rounded', 'jnews'),
					'circle'        => esc_html__('Circle', 'jnews'),
					'nobg'          => esc_html__('No background', 'jnews'),
                ),
				'label_block'   => true,
				'description'   => esc_html__( 'Choose your social icon style.', 'jnews' )
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'         => esc_html__( 'Icon Color', 'jnews' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'description'   => esc_html__( 'Set global social icon color. Ignore it to use default icon color.', 'jnews' ),
				'condition'     => array(
                    'style!' => array('nobg')
                ),
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label'         => esc_html__( 'Background Color', 'jnews' ),
				'type'          => Controls_Manager::COLOR,
				'default'       => '',
				'label_block'   => true,
				'description'   => esc_html__( 'Set global social icon background color. Ignore it to use default background color.', 'jnews' ),
				'condition'     => array(
					'style!' => array('nobg')
				),
			]
		);

		$this->add_control(
			'vertical',
			[
				'label'         => esc_html__( 'Vertical Social', 'jnews' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => '',
				'description'   => esc_html__( 'Align social icon vertical.', 'jnews' ),
			]
		);

		$this->add_control(
			'align',
			[
				'label'         => esc_html__( 'Centered Content', 'jnews' ),
				'type'          => Controls_Manager::SWITCHER,
				'default'       => false,
				'description'   => esc_html__( 'Enable centered content for social icon.', 'jnews' ),
				'condition'     => array(
					'vertical' => ''
				),
			]
		);

		$this->add_control(
			'beforesocial',
			[
				'label'         => esc_html__( 'Before Social Text', 'jnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => '',
				'description'   => esc_html__( 'Allowed tag : a, b, strong, em.', 'jnews' ),
			]
		);

		$this->add_control(
			'aftersocial',
			[
				'label'         => esc_html__( 'After Social Text', 'jnews' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => '',
				'description'   => esc_html__( 'Allowed tag : a, b, strong, em.', 'jnews' ),
			]
		);

		$this->add_control(
			'account',
			[
				'label'         => esc_html__( 'Social Icon', 'jnews' ),
				'description'   => esc_html__( 'Add icon for each of your social account.', 'jnews' ),
				'type'          => Controls_Manager::REPEATER,
				'default' => [
					[
						'social_icon'   => 'facebook',
						'social_url'    => 'https://www.facebook.com/jegtheme/'
					],
					[
						'social_icon'   => 'twitter',
						'social_url'    => 'https://twitter.com/jegtheme'
					],
				],
				'fields' => [
					[
						'name'          => 'social_icon',
						'label'         => esc_html__( 'Social Icon', 'jnews' ),
						'description'   => esc_html__( 'Choose your social account.', 'jnews' ),
						'type'          => Controls_Manager::SELECT,
						'options'       => array(
							''              => esc_attr__( 'Choose Icon', 'jnews' ),
							'facebook'      => esc_attr__( 'Facebook', 'jnews' ),
							'twitter'       => esc_attr__( 'Twitter', 'jnews' ),
							'linkedin'      => esc_attr__( 'Linkedin', 'jnews' ),
							'googleplus'    => esc_attr__( 'Google+', 'jnews' ),
							'pinterest'     => esc_attr__( 'Pinterest', 'jnews' ),
							'behance'       => esc_attr__( 'Behance', 'jnews' ),
							'github'        => esc_attr__( 'Github', 'jnews' ),
							'flickr'        => esc_attr__( 'Flickr', 'jnews' ),
							'tumblr'        => esc_attr__( 'Tumblr', 'jnews' ),
							'dribbble'      => esc_attr__( 'Dribbble', 'jnews' ),
							'soundcloud'    => esc_attr__( 'Soundcloud', 'jnews' ),
							'instagram'     => esc_attr__( 'Instagram', 'jnews' ),
							'vimeo'         => esc_attr__( 'Vimeo', 'jnews' ),
							'youtube'       => esc_attr__( 'Youtube', 'jnews' ),
							'twitch'        => esc_attr__( 'Twitch', 'jnews' ),
							'vk'            => esc_attr__( 'Vk', 'jnews' ),
							'reddit'        => esc_attr__( 'Reddit', 'jnews' ),
							'weibo'         => esc_attr__( 'Weibo', 'jnews' ),
							'rss'           => esc_attr__( 'RSS', 'jnews' ),
						),
						'default'       => '',
						'label_block'   => true,
					],
					[
						'name'          => 'social_url',
						'label'         => esc_html__( 'Social URL', 'jnews' ),
						'description'   => esc_html__( 'Insert your social account url.', 'jnews' ),
						'type'          => Controls_Manager::TEXT,
						'default'       => '',
						'label_block'   => true,
					],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
    {
		$settings = $this->get_settings();

		extract( $settings );

		/**
		 * @var $style
		 * @var $icon_color
		 * @var $bg_color
		 * @var $vertical
		 * @var $align
		 * @var $beforesocial
		 * @var $aftersocial
		 * @var $account
		 */

		$style  = isset( $style ) ? $style : '';
		$output = '';

		$bg_color   = ($style != 'nobg') && !empty($bg_color) ? 'background-color:'. $bg_color .';' : '';
		$icon_color = !empty($icon_color) ? 'color:'. $icon_color .';' : '';
		$inline_css = !empty($bg_color) || !empty($icon_color) ? 'style="'. $bg_color . $icon_color .'"' : '';

		$vertical   = ! empty( $vertical ) ? true : false;

		if ( ! $vertical )
        {
            $align = ! empty( $align ) ? 'jeg_aligncenter' : '';
        }
        

		if ( isset( $account ) && !empty( $account ) )
		{
			if ( is_array( $account ) )
			{
				foreach ( $account as $social )
				{
					if ( !empty( $social['social_url'] ) )
					{
						switch ( $social['social_icon'] )
						{
							case 'facebook':
								$label = $vertical ? '<span>' . jnews_return_translation('Facebook', 'jnews', 'facebook') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_facebook">
                                            <i class="fa fa-facebook" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'twitter':
								$label = $vertical ? '<span>' . jnews_return_translation('Twitter', 'jnews', 'twitter') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_twitter">
                                            <i class="fa fa-twitter" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'linkedin':
								$label = $vertical ? '<span>' . jnews_return_translation('LinkedIn', 'jnews', 'linkedin') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_linkedin">
                                            <i class="fa fa-linkedin" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'googleplus':
								$label = $vertical ? '<span>' . jnews_return_translation('Google+', 'jnews', 'google') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_google-plus">
                                            <i class="fa fa-google-plus" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'pinterest':
								$label = $vertical ? '<span>' . jnews_return_translation('Pinterest', 'jnews', 'pinterest') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_pinterest">
                                            <i class="fa fa-pinterest" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'behance':
								$label = $vertical ? '<span>' . jnews_return_translation('Behance', 'jnews', 'behance') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_behance">
                                            <i class="fa fa-behance" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'github':
								$label = $vertical ? '<span>' . jnews_return_translation('Github', 'jnews', 'github') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_github">
                                            <i class="fa fa-github" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'flickr':
								$label = $vertical ? '<span>' . jnews_return_translation('Flickr', 'jnews', 'flickr') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_flickr">
                                            <i class="fa fa-flickr" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'tumblr':
								$label = $vertical ? '<span>' . jnews_return_translation('Tumblr', 'jnews', 'tumblr') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_tumblr">
                                            <i class="fa fa-tumblr" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'dribbble':
								$label = $vertical ? '<span>' . jnews_return_translation('Dribbble', 'jnews', 'dribbble') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_dribbble">
                                            <i class="fa fa-dribbble" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'soundcloud':
								$label = $vertical ? '<span>' . jnews_return_translation('Soundcloud', 'jnews', 'soundcloud') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_soundcloud">
                                            <i class="fa fa-soundcloud" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'instagram':
								$label = $vertical ? '<span>' . jnews_return_translation('Instagram', 'jnews', 'instagram') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_instagram">
                                            <i class="fa fa-instagram" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'vimeo':
								$label = $vertical ? '<span>' . jnews_return_translation('Vimeo', 'jnews', 'vimeo') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_vimeo">
                                            <i class="fa fa-vimeo-square" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'youtube':
								$label = $vertical ? '<span>' . jnews_return_translation('Youtube', 'jnews', 'youtube') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_youtube">
                                            <i class="fa fa-youtube-play" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'vk':
								$label = $vertical ? '<span>' . jnews_return_translation('VK', 'jnews', 'vk') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_vk">
                                            <i class="fa fa-vk" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'twitch':
								$label = $vertical ? '<span>' . jnews_return_translation('Twitch', 'jnews', 'twitch') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_twitch">
                                            <i class="fa fa-twitch" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'reddit':
								$label = $vertical ? '<span>' . jnews_return_translation('Reddit', 'jnews', 'reddit') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_reddit">
                                            <i class="fa fa-reddit" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'weibo':
								$label = $vertical ? '<span>' . jnews_return_translation('Weibo', 'jnews', 'weibo') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_weibo">
                                            <i class="fa fa-weibo" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;

							case 'rss':
								$label = $vertical ? '<span>' . jnews_return_translation('RSS', 'jnews', 'rss') . '</span>' : '';

								$output .=   '<a href="' . $social['social_url'] . '" target="_blank" class="jeg_rss">
                                            <i class="fa fa-rss" '. $inline_css .'></i>
                                            '. $label .'
                                        </a>';
								break;
						}
					}
				}
			}
		}

		?>

        <div class="jeg_social_wrap <?php echo esc_attr($align) ?>">
			<?php if (isset($beforesocial) && !empty($beforesocial)): ?>
                <p>
					<?php echo wp_kses($beforesocial, wp_kses_allowed_html());?>
                </p>
			<?php endif; ?>

            <div class="socials_widget <?php echo $vertical ? "vertical_social" : ""; ?>  <?php echo esc_attr($style); ?>">
				<?php echo jnews_sanitize_output($output); ?>
            </div>

			<?php if (isset($aftersocial) && !empty($aftersocial)): ?>
                <p>
					<?php echo wp_kses($aftersocial, wp_kses_allowed_html());?>
                </p>
			<?php endif; ?>
        </div>

		<?php
	}

	protected function _content_template() {}
}
