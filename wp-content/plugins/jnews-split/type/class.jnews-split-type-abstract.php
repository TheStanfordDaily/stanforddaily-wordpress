<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Theme JNews_Split_Type_Abstract
 */
abstract class JNews_Split_Type_Abstract
{
    /**
     * @var JNews_Split_Tool
     */
    protected $splitter;

    /**
     * @var int
     */
    protected $current_page;

    /**
     * @var int
     */
    protected $index;

    /**
     * @var int
     */
    protected $max_page;

    /**
     * @var String
     */
    protected $numbering;

    /**
     * All Title
     *
     * @var String
     */
    protected $all_title;

    /**
     * Current Content
     *
     * @var array
     */
    protected $content;

    /**
     * @var string
     */
    protected $before_content;

    /**
     * @var string
     */
    protected $load_mode;

    /**
     * JNews_Post_Split_Abstract constructor.
     *
     * @param $splitter
     * @param $page
     * @param $numbering
     * @param $mode
     */
    public function __construct($splitter, $page, $numbering, $mode)
    {
        // splitter variable
        $this->splitter         = $splitter;
        $this->max_page         = $this->splitter->get_total_split() + 1;
        $this->current_page     = min($page, $this->max_page);
        $this->index            = $this->current_page - 1;
        $this->before_content   = $this->splitter->get_before_content();
        $this->all_title        = $this->splitter->get_all_title();
        $this->content          = $this->splitter->get_paged_content( $this->index );
        $this->numbering        = $numbering;
        $this->load_mode        = $mode;
    }


    /**
     * Build Title
     *
     * @return string
     */
    public function current_title()
    {
        $current = $this->page_span($this->index);
        return "<h3 class=\"current_title\"><strong>{$current}</strong></h3>";
    }

    /**
     * Create Page Span
     *
     * @param $index
     * @return string
     */
    public function page_span($index)
    {
        $title = $this->all_title[$index];
        $number = $this->get_page_number($index + 1);
        return "<span class=\"pagenum\">" . $number . ".</span> " . $title . "</a>";
    }

    /**
     * Split Post Navigation Drop
     *
     * @return string
     */
    public function split_post_nav()
    {
        $nav = "<ul class=\"jeg_splitpost_nav\">";

        foreach($this->all_title as $id => $title)
        {
            $current = ( $id === $this->index ) ? "current" : "";
            $nav .= "<li class=\"{$current}\"><a href=\"" . $this->get_page_link_url($id + 1) . "\" data-id=\"{$id}\">" . $this->page_span($id) . "</a></li>";
        }

        $nav .= "</ul>";

        return $nav;
    }

    /**
     * Get page number
     *
     * @param null $current_page
     * @return mixed
     */
    public function get_page_number($current_page = null)
    {
        if($current_page === null)
        {
            $current_page = $this->current_page;
            $index = $this->index;
        } else {
            $index = $current_page - 1;
        }


        if($this->numbering === 'asc')
        {
            return min($current_page, $this->max_page);
        } else {
            return max(1, $this->max_page - $index);
        }
    }

    /**
     * Get page link
     *
     * @param $i
     * @return false|string
     */
    public function get_page_link_url($i)
    {
        if($i <= 0 || $i > $this->max_page)
        {
            return "#";
        } else {
            global $wp_rewrite;
            $post = get_post();
            $query_args = array();

            if ( 1 == $i ) {
                $url = get_permalink();
            } else {
                if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
                    $url = add_query_arg( 'page', $i, get_permalink() );
                elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
                    $url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
                else
                    $url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
            }

            if ( is_preview() ) {

                if ( ( 'draft' !== $post->post_status ) && isset( $_GET['preview_id'], $_GET['preview_nonce'] ) ) {
                    $query_args['preview_id'] = wp_unslash( $_GET['preview_id'] );
                    $query_args['preview_nonce'] = wp_unslash( $_GET['preview_nonce'] );
                }

                $url = get_preview_post_link( $post, $query_args, $url );
            }

            if($this->load_mode === 'normal') {
                return $url . "#" . JNews_Split_Tool::$split_begin_flag;
            } else {
                return $url;
            }
        }
    }

    /**
     * @return null|string
     */
    public function render_content()
    {
        $output = null;

        if($this->load_mode === 'all')
        {
            $contents = $this->splitter->get_all_result();
            $contents = $contents['content'];

            foreach($contents as $id => $content) {
                $active  = $this->index === $id ? 'active' : '';
                $output .= "<div class='split-wrapper {$active}' data-id='{$id}'>";
                $output .= apply_filters('jnews_split_content_description',$content['description'], $id, $this->max_page);
                $output .= "</div>";
            }
        } else if($this->load_mode === 'ajax'){

            $output .= "<div class='split-wrapper active'>";
            $output .= apply_filters('jnews_split_content_description',$this->content['description'], $this->index, $this->max_page);
            $output .= "</div>";
        } else {
            $output .= apply_filters('jnews_split_content_description',$this->content['description'], $this->index, $this->max_page);
        }

        $loader = jnews_get_option('split_loader', 'dot');
        $loader_html =
            "<div class='split-overlay'>
                <div class='preloader_type preloader_{$loader}'>
                    <div class=\"split-preloader jeg_preloader dot\">
                        <span></span><span></span><span></span>
                    </div>
                    <div class=\"split-preloader jeg_preloader circle\">
                        <div class=\"jnews_preloader_circle_outer\">
                            <div class=\"jnews_preloader_circle_inner\"></div>
                        </div>
                    </div>
                    <div class=\"split-preloader jeg_preloader square\">
                        <div class=\"jnews-cube-grid\">
                            <div class=\"jnews-cube jnews-cube1\"></div>
                            <div class=\"jnews-cube jnews-cube2\"></div>
                            <div class=\"jnews-cube jnews-cube3\"></div>
                            <div class=\"jnews-cube jnews-cube4\"></div>
                          </div>
                    </div>
                </div>
            </div>";

        $split_var = 'jnews_split_' . uniqid();
        $script_json = wp_json_encode($this->js_variable());
        $script = "<script> var {$split_var} = {$script_json} </script>";

        $output =
            "<div class='split-container' data-id='{$split_var}'>
                {$output}
                {$loader_html}
                {$script}
            </div>";
        return $output;
    }

    public function js_variable()
    {
        $split_variable = array();
        $split_variable['mode']         = $this->load_mode;
        $split_variable['type']         = $this->get_split_type();
        $split_variable['index']        = $this->index;
        $split_variable['max']          = $this->splitter->get_total_split();
        $split_variable['page_text']    = sprintf(jnews_return_translation("Page %s of %s", 'jnews-split', 'page_s_of_s'), "{page}", $this->max_page);
        $split_variable['post_id']      = get_the_ID();

        if($this->load_mode === 'all' || $this->load_mode === 'ajax')
        {
            $content = array();
            foreach($this->all_title as $index => $title)
            {
                add_filter('document_title_parts', function($page_title) use ($index){
                    $all_title = array();
                    foreach($page_title as $key => $value) {
                        if($key === 'tagline' || $key === 'site') {
                            $all_title['page'] = $index > 0 ? sprintf( jnews_return_translation('Page %s', 'jnews-split', 'page_s' ), $index + 1 ) : "";
                        }
                        $all_title[$key] = $value;
                    }
                    return $all_title;
                });

                $page_title = wp_get_document_title();

                $content[$index] = array(
                    'id'            => $index,
                    'title'         => wp_strip_all_tags($title),
                    'page_title'    => html_entity_decode($page_title, ENT_NOQUOTES, 'UTF-8'),
                    'page'          => $this->get_page_number($index + 1),
                    'url'           => $this->get_page_link_url($index + 1),
                );
            }
            $split_variable['content'] = $content;
        }

        return $split_variable;
    }
    /**
     * @return mixed
     */
    abstract public function render();
    abstract public function get_split_type();
}
