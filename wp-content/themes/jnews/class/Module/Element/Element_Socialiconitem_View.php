<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleViewAbstract;

Class Element_Socialiconitem_View extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
	    global $social_inline_css, $social_vertical;
	    
	    $output  = '';

	    if ( !empty( $attr['social_url'] ) )
	    {
		    switch ( $attr['social_icon'] )
		    {
			    case 'facebook':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Facebook', 'jnews', 'facebook') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_facebook">
                                <i class="fa fa-facebook" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'twitter':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Twitter', 'jnews', 'twitter') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_twitter">
                                <i class="fa fa-twitter" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'linkedin':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('LinkedIn', 'jnews', 'linkedin') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_linkedin">
                                <i class="fa fa-linkedin" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'googleplus':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Google+', 'jnews', 'google') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_google-plus">
                                <i class="fa fa-google-plus" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'pinterest':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Pinterest', 'jnews', 'pinterest') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_pinterest">
                                <i class="fa fa-pinterest" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'behance':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Behance', 'jnews', 'behance') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_behance">
                                <i class="fa fa-behance" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'github':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Github', 'jnews', 'github') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_github">
                                <i class="fa fa-github" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'flickr':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Flickr', 'jnews', 'flickr') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_flickr">
                                <i class="fa fa-flickr" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'tumblr':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Tumblr', 'jnews', 'tumblr') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_tumblr">
                                <i class="fa fa-tumblr" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'dribbble':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Dribbble', 'jnews', 'dribbble') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_dribbble">
                                <i class="fa fa-dribbble" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'soundcloud':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Soundcloud', 'jnews', 'soundcloud') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_soundcloud">
                                <i class="fa fa-soundcloud" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'instagram':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Instagram', 'jnews', 'instagram') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_instagram">
                                <i class="fa fa-instagram" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'vimeo':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Vimeo', 'jnews', 'vimeo') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_vimeo">
                                <i class="fa fa-vimeo-square" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'youtube':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Youtube', 'jnews', 'youtube') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_youtube">
                                <i class="fa fa-youtube-play" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'vk':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('VK', 'jnews', 'vk') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_vk">
                                <i class="fa fa-vk" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'twitch':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Twitch', 'jnews', 'twitch') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_twitch">
                                <i class="fa fa-twitch" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'reddit':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Reddit', 'jnews', 'reddit') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_reddit">
                                <i class="fa fa-reddit" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'weibo':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('Weibo', 'jnews', 'weibo') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_weibo">
                                <i class="fa fa-weibo" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;

			    case 'rss':
				    $label = ! empty( $social_vertical ) ? '<span>' . jnews_return_translation('RSS', 'jnews', 'rss') . '</span>' : '';

				    $output .=   '<a href="' . $attr['social_url'] . '" target="_blank" class="jeg_rss">
                                <i class="fa fa-rss" '. $social_inline_css .'></i>
                                '. $label .'
                            </a>';
				    break;
		    }
	    }
			    
	    return $output;
    }
}