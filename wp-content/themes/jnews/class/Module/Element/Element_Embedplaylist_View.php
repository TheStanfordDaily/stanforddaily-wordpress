<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleViewAbstract;
use JNews\Util\VideoThumbnail;

Class Element_Embedplaylist_View extends ModuleViewAbstract
{
    /**
     * @var string
     */
    private $youtube_api = 'AIzaSyCaVFHOIOQufIIfJfdS0-75AFVEQuhqgzs';
    private $meta_name = 'jnews_video_cache';

    public function youtube_duration($duration)
    {
        if (!empty($duration)) {
            preg_match('/(\d+)H/', $duration, $match);
            $h = count($match) ? filter_var($match[0], FILTER_SANITIZE_NUMBER_INT) : 0;

            preg_match('/(\d+)M/', $duration, $match);
            $m = count($match) ? filter_var($match[0], FILTER_SANITIZE_NUMBER_INT) : 0;

            preg_match('/(\d+)S/', $duration, $match);
            $s = count($match) ? filter_var($match[0], FILTER_SANITIZE_NUMBER_INT) : 0;

            $duration = gmdate("H:i:s", intval($h * 3600 + $m * 60  + $s));
        }

        return $duration;
    }

    public function get_video_detail($results)
    {
        $vimeo = $youtube = $video_detail  = array();

        foreach($results as $key => $result)
        {
            $result = preg_replace('/\s+/', '', $result);
            $provider = VideoThumbnail::getInstance()->get_video_provider($result);
            $video_id = VideoThumbnail::getInstance()->get_video_id($result);

            if($provider === 'vimeo') {
                $video_detail[$video_id]['type'] = 'vimeo';
                $vimeo[$key] = $video_id;
            } else if($provider === 'youtube') {
                $video_detail[$video_id]['type'] = 'youtube';
                $youtube[$key] = $video_id;
            }

            $video_detail[$video_id]['url'] = $result;
            $video_detail[$video_id]['id'] = $video_id;
        }

        // proceed youtube
        if(!empty($youtube))
        {
            $url = 'https://www.googleapis.com/youtube/v3/videos?id=' . implode(',', $youtube) . '&part=id,contentDetails,snippet&key=' . $this->youtube_api;
            $youtube_remote = wp_remote_get($url);

            if ( ! is_wp_error( $youtube_remote ) && $youtube_remote['response']['code'] == '200' ) 
            {
                $youtube_remote = json_decode($youtube_remote['body']);

                foreach($youtube_remote->items as $item) {
                    $video_detail[$item->id]['title'] = $item->snippet->title;
                    $video_detail[$item->id]['thumbnail'] = $item->snippet->thumbnails->default->url;
                    $video_detail[$item->id]['duration'] = $this->youtube_duration($item->contentDetails->duration);
                }
            }
        }

        // proceed vimeo
        if(!empty($vimeo))
        {
            foreach($vimeo as $item) {
                $url = 'http://vimeo.com/api/v2/video/' . $item . '.php';
                $vimeo_remote = wp_remote_get($url);

                if ( ! is_wp_error( $vimeo_remote ) && $vimeo_remote['response']['code'] == '200' ) 
                {
                    $vimeo_remote = unserialize($vimeo_remote['body']);

                    $video_detail[$vimeo_remote[0]['id']]['title'] = $vimeo_remote[0]['title'];
                    $video_detail[$vimeo_remote[0]['id']]['thumbnail'] = $vimeo_remote[0]['thumbnail_medium'];
                    $video_detail[$vimeo_remote[0]['id']]['duration'] = gmdate("H:i:s", intval($vimeo_remote[0]['duration']));
                }
            }
        }

        return $video_detail;
    }

    /**
     * Build result, merge already retrieved post meta
     *
     * @param $results
     * @return array
     */
    public function build_result($results)
    {
        $post_id = $this->get_post_id();
        $video_retrieve = $video_result = array();

        /** Test purpose */
        // delete_option( $this->meta_name );

        $video_cache = get_option( $this->meta_name, array() );
        if(!$video_cache) $video_cache = array();

        foreach($results as $key => $result)
        {
            $result = trim($result);
            $video_id = VideoThumbnail::getInstance()->get_video_id($result);

            if(!array_key_exists($video_id, $video_cache))
            {
                $video_retrieve[] = $result;
            }
        }

        if(!empty($video_retrieve))
        {
            $video_detail = $this->get_video_detail($results);
            $video_cache = $video_detail + $video_cache;
            update_option( $this->meta_name, $video_detail );
        }

        foreach($results as $key => $result)
        {
            $result = trim($result);
            $video_id = VideoThumbnail::getInstance()->get_video_id($result);
            $video_result[] = $video_cache[$video_id];
        }

        return $video_result;
    }

    /**
     * Build playlist element
     *
     * @param $results
     * @return string
     */
    public function build_playlist($results)
    {
        $output = '';

        foreach($results as $key => $post) {
            $active = $key === 0 ? 'active' : '';

            if ( !isset( $post['thumbnail'] ) || !isset( $post['duration'] ) || !isset( $post['title'] ) ) continue;

            $output .=
                "<a class=\"jeg_video_playlist_item {$active}\" href=\"" . $post['url'] . "\" data-id=\"" . $key . "\">
                    <div class=\"jeg_video_playlist_thumbnail\">
                        <img src='{$post['thumbnail']}'/>
                    </div>
                    <div class=\"jeg_video_playlist_description\">
                        <h3 class=\"jeg_video_playlist_title\">" . $post['title'] . "</h3>
                        <span class=\"jeg_video_playlist_category\">" . $post['duration'] . "</span>
                    </div>
                </a>";
        }

        return $output;
    }

    /**
     * Build Video Wrapper
     *
     * @param $post_id
     * @param $result
     * @param $autoplay
     * @return string
     */
    public function get_video_wrapper($post_id, $result, $autoplay)
    {
        $output         = '';
        $autoplay       = $autoplay ? '&amp;autoplay=1;' : "";

        if ( empty( $result ) ) return false;

        $video_id = $result[$post_id]['id'];

        if( $result[$post_id]['type'] === 'youtube' )
        {

            $output .=
                "<div class=\"jeg_video_container\">
                    <iframe src=\"//www.youtube.com/embed/" . $video_id . "?showinfo=1" . $autoplay . "&amp;autohide=1&amp;rel=0&amp;wmode=opaque\" allowfullscreen=\"\" height=\"500\" width=\"700\"></iframe>
                </div>";
        } else if( $result[$post_id]['type'] === 'vimeo' )
        {
            $output .=
                "<div class=\"jeg_video_container\">
                    <iframe src=\"//player.vimeo.com/video/" . $video_id . "?wmode=opaque" . $autoplay . "\" allowfullscreen=\"\" height=\"500\" width=\"700\"></iframe>
                </div>";
        }

        return $output;
    }

    /**
     * Build data for json need. we remove ajax capability so video can load faster
     *
     * @param $results
     * @return mixed|string
     */
    public function build_data($results)
    {
        $json = array();

        foreach($results as $key => $post) {
            $json[$key] = array(
                'type' => $results[$key]['type'],
                'tag' => $this->get_video_wrapper($key, $results, true)
            );
        }

        return wp_json_encode($json);
    }

    public function explode_playlist($playlist)
    {
        $results = explode(',', $playlist);
        $videos = array();

        foreach($results as $result) {
            $result = trim($result);
            if(!empty($result)) $videos[] = $result;
        }

        return $videos;
    }

    public function render_module($attr, $column_class)
    {
        $results = $this->explode_playlist($attr['playlist']);
        $results = $this->build_result($results);
        $playlist = $this->build_playlist($results);

        $col_width_raw = $this->manager->get_current_width();
        $layout = ( $attr['layout'] === 'vertical' ) ? 'jeg_horizontal_playlist' : 'jeg_vertical_playlist';
        $schema = ( $attr['scheme'] === 'dark' ) ? 'jeg_dark_playlist' : '';
        $current_playlist_info = '';

        if ( ! empty($results[0]['url']) && ! empty($results[0]['title']) )
        {
	        $current_playlist_info = "<h2><a href='{$results[0]['url']}'>{$results[0]['title']}</a></h2>";
        }

        $output =
            "<div class=\"jeg_video_playlist jeg_col_{$col_width_raw} {$layout} {$schema} {$this->unique_id} {$this->get_vc_class_name()}\" data-unique='{$this->unique_id}'>
                <div class=\"jeg_video_playlist_wrapper\">
                    <div class=\"jeg_video_playlist_video_content\">
                        <div class=\"jeg_video_holder\">
                            {$this->get_video_wrapper(0, $results, false)}
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
                            <div class=\"jeg_video_playlist_current_info\">{$current_playlist_info}</div>
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
