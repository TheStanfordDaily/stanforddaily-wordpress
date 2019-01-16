<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleQuery;
use JNews\Module\ModuleViewAbstract;
use JNews\Util\VideoThumbnail;

Class Element_Videoplaylist_View extends ModuleViewAbstract
{
    public function build_playlist($results)
    {
        $output = '';

        foreach($results as $key => $post) {
            $category = jnews_get_primary_category($post->ID);
            $thumbnail = $this->get_thumbnail($post->ID, 'jnews-120x86');
            $active = $key === 0 ? 'active' : '';

            $output .=
                "<a class=\"jeg_video_playlist_item {$active}\" href=\"" . get_the_permalink($post) . "\" data-id=\"" . $post->ID . "\">
                    <div class=\"jeg_video_playlist_thumbnail\">
                        {$thumbnail}
                    </div>
                    <div class=\"jeg_video_playlist_description\">
                        <h3 class=\"jeg_video_playlist_title\">" . get_the_title($post) . "</h3>
                        <span class=\"jeg_video_playlist_category\">" . get_cat_name($category) . "</span>
                    </div>
                </a>";
        }

        return $output;
    }

    public function get_video_wrapper($post_id, $autoplay)
    {
        $output         = '';
        $video_url      = get_post_meta( $post_id, '_format_video_embed', true );
        $video_format   = strtolower( pathinfo( $video_url, PATHINFO_EXTENSION ) );
        $featured_img   = get_the_post_thumbnail_url($post_id, 'full');
        $video_type     = VideoThumbnail::getInstance()->get_video_provider($video_url);
        $autoplay       = $autoplay ? '&amp;autoplay=1;' : "";

        if( $video_type === 'youtube' )
        {

            $video_id = VideoThumbnail::getInstance()->get_video_id($video_url);
            $output .=
                "<div class=\"jeg_video_container\">
                    <iframe src=\"//www.youtube.com/embed/" . $video_id . "?showinfo=1" . $autoplay . "&amp;autohide=1&amp;rel=0&amp;wmode=opaque\" allowfullscreen=\"\" height=\"500\" width=\"700\"></iframe>
                </div>";
        } else if( $video_type === 'vimeo' )
        {
            $video_id = VideoThumbnail::getInstance()->get_video_id($video_url);
            $output .=
                "<div class=\"jeg_video_container\">
                    <iframe src=\"//player.vimeo.com/video/" . $video_id . "?wmode=opaque" . $autoplay . "\" allowfullscreen=\"\" height=\"500\" width=\"700\"></iframe>
                </div>";
        } else if( $video_format == 'mp4' )
        {
            $output .=
                "<video width=\"640\" height=\"360\" style=\"width: 100%; height: 100%;\" poster=\"" . esc_attr( $featured_img ) . "\" preload=\"none\">
                    <source type=\"video/mp4\" src=\"" . esc_url( $video_url ) . "\">
                </video>";
        } else if ( wp_oembed_get( $video_url ) )
        {
            $output .= "<div class=\"jeg_video_container\">" . wp_oembed_get( $video_url ) . "</div>";
        }

        return $output;
    }

    public function build_data($results)
    {
        $json = array();

        foreach($results as $key => $post) {
            $video_url      = get_post_meta( $post->ID, '_format_video_embed', true );
            $video_format   = strtolower( pathinfo( $video_url, PATHINFO_EXTENSION ) );
            $video_type     = ( $video_format === 'mp4' ) ? 'mediaplayer' : '';

             $json[$post->ID] = array(
                'type' => $video_type,
                'tag' => $this->get_video_wrapper($post->ID, true)
            );
        }

        return wp_json_encode($json);
    }

    public function render_module($attr, $column_class)
    {
        $attr['pagination_number_post'] = 1;
        $attr['video_only'] = true;
        $results = ModuleQuery::do_query($attr);
        $results = $results['result'];
        $playlist = $this->build_playlist($results);

        $col_width_raw = $this->manager->get_current_width();
        $layout = ( $attr['layout'] === 'vertical' ) ? 'jeg_vertical_playlist' : 'jeg_horizontal_playlist';
        $schema = ( $attr['scheme'] === 'dark' ) ? 'jeg_dark_playlist' : '';

        $output =
            "<div class=\"jeg_video_playlist jeg_col_{$col_width_raw} {$layout} {$schema} {$this->unique_id} {$this->get_vc_class_name()}\" data-unique='{$this->unique_id}'>
                <div class=\"jeg_video_playlist_wrapper\">
                    <div class=\"jeg_video_playlist_video_content\">
                        <div class=\"jeg_video_holder\">
                            " . $this->get_video_wrapper($results[0]->ID, false) . "
                        </div>
                    </div><!-- jeg_video_playlist_video_content -->

                    <div class=\"jeg_video_playlist_list_wrapper\">
                        <div class=\"jeg_video_playlist_current\">
                            <div class=\"jeg_video_playlist_play\">
                                <div class=\"jeg_video_playlist_play_icon\">
                                    <i class=\"fa fa-play\"></i>
                                </div>
                                <span>" . jnews_return_translation('Currently Playing', 'jnews', 'currently_playing') . "</span>
                            </div>
                            <div class=\"jeg_video_playlist_current_info\">
                                <h2>" . get_the_title($results[0]) . "</h2>
                            </div>
                        </div>
                        <div class=\"jeg_video_playlist_list_inner_wrapper\">
                            {$playlist}
                        </div>
                    </div><!-- jeg_video_playlist_list_wrapper -->
                    <div style=\"clear: both;\"></div>
                </div><!-- jeg_video_playlist_wrapper -->
                <script> var {$this->unique_id} = {$this->build_data($results)}; </script>
            </div>";

        return $output;

    }

    public function render_column_alt($result, $column_class) {}
    public function render_column($result, $column_class) {}
}