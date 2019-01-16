<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Documentation;

/**
 * Class VideoDocumentation
 */
Class VideoDocumentation
{
    /**
     * @var VideoDocumentation
     */
    private static $instance;

    private $video = array();

    /**
     * @return VideoDocumentation
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }


    private function __construct()
    {
        $this->populate_video();

        add_action('init', array($this, 'load_video_helper'));
    }

    public function populate_video()
    {
        $this->video = array(
            '1Yl_cAe2Egk' => array(
                'name'  => esc_html__('How to Install JNews via WordPress', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/1Yl_cAe2Egk/hqdefault.jpg',
            ),
            'FP3gq-DbdoQ' => array(
                'name' => 'How to Install JNews via FTP',
                'thumb' => 'https://i.ytimg.com/vi/FP3gq-DbdoQ/hqdefault.jpg',
            ),
            'JO6N-CCrw2k' => array(
                'name'  => esc_html__('How to Update JNews via WordPress', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/JO6N-CCrw2k/hqdefault.jpg',
            ),
            'aIX6N4E9a5A' => array(
                'name'  => esc_html__('How to Update JNews via FTP', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/aIX6N4E9a5A/hqdefault.jpg',
            ),
            'HSwh51SKBRo' => array(
                'name'  => esc_html__('JNews System Status', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/HSwh51SKBRo/hqdefault.jpg',
            ),
            'ky2PhVM_jJA' => array(
                'name'  => esc_html__('How to Install Plugin with JNews', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/ky2PhVM_jJA/hqdefault.jpg',
            ),
            'bNfdYHJ4Hw4' => array(
                'name'  => esc_html__('How to Setup JNews Translation', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/bNfdYHJ4Hw4/hqdefault.jpg',
            ),
            'sCr8KohYmxQ' => array(
                'name'  => esc_html__('How to Setup JNews Font', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/sCr8KohYmxQ/hqdefault.jpg',
            ),
            '2eIhfdD9uJU' => array(
                'name'  => esc_html__('How to Setup Comments', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/2eIhfdD9uJU/hqdefault.jpg',
            ),
            '1dmOsQTW9Vo' => array(
	            'name'  => esc_html__('How to Setup JNews Split Post', 'jnews'),
	            'thumb' => 'https://i.ytimg.com/vi/1dmOsQTW9Vo/hqdefault.jpg',
            ),
            'OvBhTVAhRwE' => array(
	            'name'  => esc_html__('How to Setup JNews Breadcrumb', 'jnews'),
	            'thumb' => 'https://i.ytimg.com/vi/OvBhTVAhRwE/hqdefault.jpg',
            ),
            'R-rL2FIrQVg' => array(
                'name'  => esc_html__('How to Setup JNews Auto Load Post', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/R-rL2FIrQVg/hqdefault.jpg',
            ),
            'oo0hsUJrtHU' => array(
                'name'  => esc_html__('How to Setup JNews Like Post', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/oo0hsUJrtHU/hqdefault.jpg',
            ),
            'GXMvvZDM50E' => array(
                'name'  => esc_html__('How to Setup JNews Review Post', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/GXMvvZDM50E/hqdefault.jpg',
            ),
            'd5rNUB6qDu0' => array(
                'name'  => esc_html__('How to Setup JNews Page Loop', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/d5rNUB6qDu0/hqdefault.jpg',
            ),
            'mldLr8W5m7U' => array(
                'name'  => esc_html__('How to Manage JNews Widget', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/mldLr8W5m7U/hqdefault.jpg',
            ),
            'DskABsDtVi0' => array(
                'name'  => esc_html__('How to Setup JNews Gallery', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/DskABsDtVi0/hqdefault.jpg',
            ),
            'Z5pI6ReOqlM' => array(
                'name'  => esc_html__('How to Manage JNews Menu Locations', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/Z5pI6ReOqlM/hqdefault.jpg',
            ),
            'BGoIxGggsfc' => array(
                'name'  => esc_html__('JNews Import Demo & Style', 'jnews'),
                'thumb' => 'https://i.ytimg.com/vi/BGoIxGggsfc/hqdefault.jpg',
            )
        );
    }

    public function load_video_helper()
    {
        if($this->can_render())
        {
            add_action('admin_enqueue_scripts', array($this, 'admin_script'));
            add_action('admin_footer', array($this, 'render_video_helper'));
        }
    }

    public function can_render()
    {
        return apply_filters('jnews_show_video_helper', true);
    }

    public function get_related_video_page()
    {
        $current_screen = get_current_screen();
        $current_screen = $current_screen->id;
        
        $related_video  = array();

        switch ( $current_screen ) 
        {
            case 'toplevel_page_jnews':
                $related_video = array( '1Yl_cAe2Egk', 'FP3gq-DbdoQ', 'JO6N-CCrw2k', 'aIX6N4E9a5A', 'ky2PhVM_jJA' );
                break;

            case 'jnews_page_jnews_plugin':
	        case 'appearance_page_jnews-install-plugins':
	        case 'plugin-install':
	        case 'plugin-editor':
	        case 'plugins':
                $related_video = array( 'ky2PhVM_jJA', 'HSwh51SKBRo' );
                break;

            case 'jnews_page_jnews_import':
                $related_video = array( 'HSwh51SKBRo', 'BGoIxGggsfc' );
                break;
                
            case 'jnews_page_jnews_documentation':
                $related_video = array( '1Yl_cAe2Egk', 'FP3gq-DbdoQ', 'JO6N-CCrw2k', 'aIX6N4E9a5A', 'ky2PhVM_jJA' );
                break;

            case 'jnews_page_jnews_system':
                $related_video = array( 'HSwh51SKBRo' );
                break;

            case 'jnews_page_jnews_translation':
                $related_video = array( 'ky2PhVM_jJA' );
                break;

	        case 'edit-page':
	        case 'page' :
	        	$related_video = array( 'd5rNUB6qDu0', 'DskABsDtVi0', 'BGoIxGggsfc', '2eIhfdD9uJU', 'sCr8KohYmxQ', 'bNfdYHJ4Hw4' );
	        	break;
                
            case 'post':
            case 'edit-post':
                $related_video = array( 'DskABsDtVi0', 'BGoIxGggsfc', 'OvBhTVAhRwE', 'GXMvvZDM50E', 'oo0hsUJrtHU', '1dmOsQTW9Vo', 'R-rL2FIrQVg', '2eIhfdD9uJU', 'sCr8KohYmxQ', 'bNfdYHJ4Hw4' );
                break;

	        case 'edit-comments':
	        case 'comments' :
	        	$related_video = array( '2eIhfdD9uJU' );
	        	break;

	        case 'widgets' :
	        	$related_video = array( 'mldLr8W5m7U' );
	        	break;

	        case 'nav-menus' :
	        	$related_video = array( 'Z5pI6ReOqlM' );
	        	break;

	        case 'theme-editor':
	        case 'themes' :
	        	$related_video = array( '1Yl_cAe2Egk', 'FP3gq-DbdoQ', 'JO6N-CCrw2k', 'aIX6N4E9a5A', 'ky2PhVM_jJA' );
	        	break;
        }

        return $related_video;
    }

    public function generate_playlist()
    {
        $html = '';

        $related_video = $this->get_related_video_page();

        if(!empty($related_video))
        {
            $html .= "<h2>" . esc_html__('Video Related to this page', 'jnews') . "</h2>";

            foreach ($related_video as $key)
            {
                $video = $this->video[$key];
                $html .=
                    "<a href='https://www.youtube.com/watch?v=" . esc_url( $key ) . "' data-id='" . esc_attr( $key ) . "'>
                    <i class='fa fa-play'></i>
                    <h3>{$video['name']}</h3>
                </a>";
            }
        }


        $html .= "<h2>" . esc_html__('Video Documentation', 'jnews') . "</h2>";

        foreach($this->video as $key => $video)
        {
            $html .=
                "<a href='https://www.youtube.com/watch?v=" . esc_url( $key ) . "' data-id='" . esc_attr( $key ) . "'>
                    <i class='fa fa-play'></i>
                    <h3>{$video['name']}</h3>
                </a>";
        }

        return $html;
    }

    public function render_video_helper()
    {
        $video_playlist = $this->generate_playlist();

        $html =
            "<div class='video-documentation-overlay'></div>
            <div class='video-documentation-wrapper'>
                <div class='video-documentation-close'><i class='fa fa-times'></i></div>
                <div class='video-documentation-holder'></div>
                <div class='video-documentation-list'>
                    {$video_playlist}
                </div>
            </div>
            <div class='video-documentation'>
                <i class='fa-lightbulb-o fa'></i><span>" . esc_html__('Video Documentation', 'jnews') . "</span>
            </div>";
        echo jnews_sanitize_output($html);
    }

    public function admin_script()
    {
        wp_enqueue_style('jnews-video-helper', get_parent_theme_file_uri('assets/css/admin/video-helper.css'), null, null);
        wp_enqueue_script( 'jnews-video-helper', get_parent_theme_file_uri('assets/js/admin/video.helper.js'), null, null, true );
        wp_localize_script('jnews-video-helper', 'jnews_video', $this->video_rule());
    }

    public function video_rule()
    {
        $video = array();
        $video['index'] = 'page';
        return $video;
    }
}