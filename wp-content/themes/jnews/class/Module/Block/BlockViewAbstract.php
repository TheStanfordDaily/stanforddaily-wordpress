<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

use Jeg\Customizer\Control\Preset;
use JNews\Module\ModuleViewAbstract;
use JNews\Util\Cache;

abstract Class BlockViewAbstract extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
        $heading        = $this->render_header($attr);
        $style_output   = jnews_header_styling($attr, $this->unique_id . ' ');
        $style_output   .=  jnews_module_custom_color($attr, $this->unique_id . ' ');
        $content        = $this->render_output($attr, $column_class);
        $style          = !empty($style_output) ? "<style scoped>{$style_output}</style>" : "";
        $script         = $this->render_script($attr, $column_class);
        $name           = str_replace('jnews_block_','',$this->class_name);

        $output =
            "<div class=\"jeg_postblock_{$name} jeg_postblock jeg_module_hook jeg_pagination_{$attr['pagination_mode']} {$column_class} {$this->unique_id} {$this->get_vc_class_name()} {$this->color_scheme()}\" data-unique=\"{$this->unique_id}\">
                {$heading}
                {$content}
                {$style}
                {$script}
            </div>";
        return $output;
    }

    public function render_module_out_call($result, $column_class)
    {
        $name = str_replace('jnews_block_','',$this->class_name);

        if(!empty($result)) {
            $content = $this->render_column($result, $column_class);
        } else {
            $content = $this->empty_content();
        }

        $output =
            "<div class=\"jeg_postblock_{$name} jeg_postblock {$column_class}\">
                <div class=\"jeg_block_container\">
                    {$content}
                </div>
            </div>";
        return $output;

    }

    public function get_content_before($attr)
    {
        return apply_filters('jnews_module_block_container_extend_before', '', $attr);
    }

    public function get_content_after($attr)
    {
        return apply_filters('jnews_module_block_container_extend_after', '', $attr);
    }

    public function get_navigation_before($attr)
    {
        return apply_filters('jnews_module_block_navigation_extend_before', '', $attr);
    }

    public function get_navigation_after($attr)
    {
        return apply_filters('jnews_module_block_navigation_extend_after', '', $attr);
    }

    public function get_current_page()
    {
        $page = get_query_var('page') ? get_query_var('page') : 1;
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        return max($page, $paged);
    }

    /**
     * Render Navigation
     *
     * @param $attr
     * @param bool|false $next
     * @param bool|false $prev
     * @param int $total_page
     * @return string
     */
    public function render_navigation($attr, $next = false, $prev = false, $total_page = 1)
    {
        $output = '';
        $additional_class = $next || $prev ? "" : "inactive";

        if($attr['pagination_mode'] === 'nextprev')
        {
            $next = $next ? "" : "disabled";
            $prev = $prev ? "" : "disabled";

            $output =
                "<div class=\"jeg_block_nav {$additional_class}\">
                    <a href=\"#\" class=\"prev {$prev}\"><i class=\"fa fa-angle-left\"></i></a>
                    <a href=\"#\" class=\"next {$next}\"><i class=\"fa fa-angle-right\"></i></a>
                </div>";
        }

        if($attr['pagination_mode'] === 'loadmore' || $attr['pagination_mode'] === 'scrollload')
        {
            $next = $next ? "" : "disabled";
            $output =
                "<div class=\"jeg_block_loadmore {$additional_class}\">
                    <a href=\"#\" class='{$next}' data-load='" . jnews_return_translation('Load More', 'jnews', 'load_more') . "' data-loading='" . jnews_return_translation('Loading...', 'jnews', 'loading') . "'> " . jnews_return_translation('Load More', 'jnews', 'load_more') . "</a>
                </div>";
        }

        // this is only for default link method
        if($attr['pagination_mode'] === 'nav_1' || $attr['pagination_mode'] === 'nav_2' || $attr['pagination_mode'] === 'nav_3')
        {
            if($total_page > 1)
            {
                $page = $this->get_current_page();
                $output = $this->render_normal_navigation($attr, $total_page, $page);
            }
        }

        $output = apply_filters('jnews_module_block_search_navigation', $output, $attr, $next, $prev, $total_page);

        return $output;
    }

    /**
     * Render Normal Navigation
     *
     * @param $args
     * @param $total
     * @param int $current
     * @return string
     */
    public function render_normal_navigation($args, $total, $current = 1)
    {
        global $wp_rewrite;

        // Setting up default values based on the current URL.
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $url_parts    = explode( '?', $pagenum_link );


        // Append the format placeholder to the base URL.
        $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

        // URL base depends on permalink settings.
        $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

        $defaults = array(
            'base' => $pagenum_link,
            'format' => $format,
            'total' => $total,
            'current' => $current,
            'show_all' => false,
            'prev_next' => true,
            'prev_text' => jnews_return_translation('Prev', 'jnews', 'prev'),
            'next_text' => jnews_return_translation('Next', 'jnews', 'next'),
            'end_size' => 1,
            'mid_size' => 1,
            'type' => 'plain',
            'add_args' => array(), // array of query args to add
            'add_fragment' => '',
            'before_page_number' => '',
            'after_page_number' => ''
        );

        $args = wp_parse_args( $args, $defaults );

        if ( ! is_array( $args['add_args'] ) ) {
            $args['add_args'] = array();
        }

        // Merge additional query vars found in the original URL into 'add_args' array.
        if ( isset( $url_parts[1] ) ) {
            // Find the format argument.
            $format_args = $url_query_args = array();
            $format = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
            $format_query = isset( $format[1] ) ? $format[1] : '';
            wp_parse_str( $format_query, $format_args );

            // Find the query args of the requested URL.
            wp_parse_str( $url_parts[1], $url_query_args );

            // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
            foreach ( $format_args as $format_arg => $format_arg_value ) {
                unset( $url_query_args[ $format_arg ] );
            }

            $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
        }

        // Who knows what else people pass in $args
        $total = (int) $args['total'];
        if ( $total < 2 ) {
            return;
        }
        $current  = (int) $args['current'];
        $end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
        if ( $end_size < 1 ) {
            $end_size = 1;
        }
        $mid_size = (int) $args['mid_size'];
        if ( $mid_size < 0 ) {
            $mid_size = 2;
        }
        $add_args = $args['add_args'];
        $r = '';
        $page_links = array();
        $dots = false;

        if ( $args['prev_next'] && $current && 1 < $current ) :
            $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
            $link = str_replace( '%#%', $current - 1, $link );
            if ( $add_args )
                $link = add_query_arg( $add_args, $link );
            $link .= $args['add_fragment'];

            /**
             * Filters the paginated links for the given archive pages.
             *
             * @since 3.0.0
             *
             * @param string $link The paginated link URL.
             */
            $page_links[] = '<a class="page_nav prev" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '"><span class="navtext">' . $args['prev_text'] . '</span></a>';
        endif;
        for ( $n = 1; $n <= $total; $n++ ) :
            if ( $n == $current ) :
                $page_links[] = "<span class='page_number active'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</span>";
                $dots = true;
            else :
                if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                    $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                    $link = str_replace( '%#%', $n, $link );
                    if ( $add_args )
                        $link = add_query_arg( $add_args, $link );
                    $link .= $args['add_fragment'];

                    /** This filter is documented in wp-includes/general-template.php */
                    $page_links[] = "<a class='page_number' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a>";
                    $dots = true;
                elseif ( $dots && ! $args['show_all'] ) :
                    $page_links[] = '<span class="page_number dots">' . '&hellip;' . '</span>';
                    $dots = false;
                endif;
            endif;
        endfor;
        if ( $args['prev_next'] && $current && ( $current < $total || -1 == $total ) ) :
            $link = str_replace( '%_%', $args['format'], $args['base'] );
            $link = str_replace( '%#%', $current + 1, $link );
            if ( $add_args )
                $link = add_query_arg( $add_args, $link );
            $link .= $args['add_fragment'];

            /** This filter is documented in wp-includes/general-template.php */
            $page_links[] = '<a class="page_nav next" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '"><span class="navtext">' . $args['next_text'] . '</span></a>';
        endif;

        switch ( $args['type'] ) {
            case 'array' :
                return $page_links;

            case 'list' :
                $r .= "<ul class='page-numbers'>\n\t<li>";
                $r .= join("</li>\n\t<li>", $page_links);
                $r .= "</li>\n</ul>\n";
                break;

            default :
                $nav_class = 'jeg_page' . $args['pagination_mode'];
                $nav_align = 'jeg_align' . $args['pagination_align'];
                $nav_text = $args['pagination_navtext'] ? '' : 'no_navtext';
                $nav_info = $args['pagination_pageinfo'] ? '' : 'no_pageinfo';

                $paging_text = sprintf(jnews_return_translation('Page %s of %s', 'jnews', 'page_s_of_s'), $current, $total);

                $r = join("\n", $page_links);
                $r = "<div class=\"jeg_navigation jeg_pagination {$nav_class} {$nav_align} {$nav_text} {$nav_info}\">
                <span class=\"page_info\">{$paging_text}</span>
                {$r}
            </div>";
                break;
        }

        return $r;
    }

    /**
     * Get page link url
     *
     * @param $i
     * @return string
     */
    public function get_page_link_url($i)
    {
        global $wp_rewrite;
        $pagenum_link = html_entity_decode( get_pagenum_link() );

        if(1 == $i) {
            $url = $pagenum_link;
        } else {
            if ( '' == get_option('permalink_structure') ) {
                $url = add_query_arg( 'paged', $i, $pagenum_link);
            } else {
                $url = trailingslashit($pagenum_link) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
            }
        }

        return $url;
    }

    /**
     * @param $attr
     * @return string
     */
    public function render_header($attr)
    {
        if ( defined('POLYLANG_VERSION') )
        {
            $attr['first_title'] = jnews_return_polylang($attr['first_title']);
            $attr['second_title'] = jnews_return_polylang($attr['second_title']);
            $attr['header_filter_text'] = jnews_return_polylang($attr['header_filter_text']);
        }

        // Heading
        $subtitle       = ! empty($attr['second_title']) ? "<strong>{$attr['second_title']}</strong>"  : "";
        $header_class   = "jeg_block_{$attr['header_type']}";
        $heading_title  = $attr['first_title'] . $subtitle;

        if(!empty($heading_title))
        {
            $heading_icon   = empty($attr['header_icon']) ? "" : "<i class='{$attr['header_icon']}'></i>";
            $heading_title  = "<span>{$heading_icon}{$attr['first_title']}{$subtitle}</span>";
            $heading_title  = ! empty($attr['url']) ? "<a href='{$attr['url']}'>{$heading_title}</a>" : $heading_title;
            $heading_title  = "<h3 class=\"jeg_block_title\">{$heading_title}</h3>";
        }

        // Sub Cat Filtering
        $sub_cat        = '';

        // filter category
        $categories = trim($attr['header_filter_category']);
        if(!empty($categories))
        {
            $categories = explode(',', $categories);
            $categories = is_array($categories) ? $categories : array($categories);

            // Need to cache category first
            Cache::get_categories();

            foreach($categories as $category) {
                $cat = get_category(trim($category));
                $sub_cat .= "<li><a class=\"subclass-filter\" href=\"" . get_category_link($cat->term_id) . "\" data-type='category' data-id='{$cat->term_id}'>{$cat->name}</a></li>";
            }
        }

        // filter author
        $authors = trim($attr['header_filter_author']);
        if(!empty($authors))
        {
            $authors = explode(',', $authors);
            $authors = is_array($authors) ? $authors : array($authors);

            foreach($authors as $author) {
                $author_id = trim($author);
                $author_url = get_author_posts_url($author_id);
                $author_name = get_the_author_meta('display_name', $author_id);
                $sub_cat .= "<li><a class=\"subclass-filter\" href=\"{$author_url}\" data-type='author' data-id='{$author_id}'>{$author_name}</a></li>";
            }
        }

        // filter tag
        $tags = trim($attr['header_filter_tag']);
        if(!empty($tags))
        {
            $tags = explode(',', $tags);
            $tags = is_array($tags) ? $tags : array($tags);

            // Need to cache tag first
            Cache::get_tags();

            foreach($tags as $tag) {
                $tag_object = get_tag(trim($tag));
                $sub_cat .= "<li><a class=\"subclass-filter\" href=\"" . get_tag_link($tag_object->term_id) . "\" data-type='tag' data-id='{$tag_object->term_id}'>{$tag_object->name}</a></li>";
            }
        }

        if(!empty($sub_cat))
        {
            $sub_cat = "<li><a class=\"subclass-filter current\" href=\"#\" data-type='all' data-id='0'>{$attr['header_filter_text']}</a></li>" . $sub_cat;
            $sub_cat =
                "<div class=\"jeg_subcat\">
                    <ul class=\"jeg_subcat_list\">
                        {$sub_cat}
                    </ul>
                </div>";
        }

        // Now Render Output
        if(empty($heading_title) && empty($sub_cat)) {
            $output = '';
        } else {
            $output =
                "<div class=\"jeg_block_heading {$header_class} jeg_subcat_right\">
                    {$heading_title}
                    {$sub_cat}
                </div>";
        }

        return $output;
    }

    /**
     * Render script
     *
     * @param $attr
     * @param $column_class
     * @return string
     */
    public function render_script($attr, $column_class)
    {
        // need to retrieve attribute from source
        $attr = $this->attribute;

        $attr['paged'] = 1;
        $attr['column_class'] = $column_class;
        $attr['class'] = $this->class_name;
        $json_attr = wp_json_encode($attr);

        $output = "<script>var {$this->unique_id} = {$json_attr};</script>";

        return $output;
    }

    /**
     * Handle Ajax Request for Module
     */
    public function ajax_request()
    {
        $attr               = $_REQUEST['data'];
        $column_class       = $attr['attribute']['column_class'];
        $query_param        = $this->build_ajax_query($attr);
        $results            = $this->build_query($query_param);
        $this->set_attribute($attr['attribute']);

        if(!empty($results['result']))
        {
            if($attr['attribute']['pagination_mode'] === 'loadmore' || $attr['attribute']['pagination_mode'] === 'scrollload')
            {
                if($attr['current_page'] == 1) {
                    $content = $this->render_column($results['result'], $column_class);
                } else {
                    $content = $this->render_column_alt($results['result'], $column_class);
                }
            } else {
                $content = $this->render_column($results['result'], $column_class);
            }
        } else {
            $content = $this->empty_content();
        }

        wp_send_json(array(
            'content'   => $content,
            'next'      => $results['next'],
            'prev'      => $results['prev'],
        ));
    }

    /**
     * Build Ajax Query
     *
     * @param $attr
     * @return array
     */
    public function build_ajax_query( $attr )
    {
        $args = $attr['attribute'];
        $args['paged'] = $attr['current_page'];

        if(!empty($attr['filter_type']) && $attr['filter_type'] !== 'all')
        {
            switch($attr['filter_type'])
            {
                case 'category' :
                    $args['include_category'] = $attr['filter'];
                    break;
                case 'author' :
                    $args['include_author'] = $attr['filter'];
                    break;
                case 'tag' :
                    $args['include_tag'] = $attr['filter'];
                    break;
            }

            $args['sort_by'] = 'latest';
            $args['paged'] = $attr['current_page'];
        }

        $args['number_post'] = $attr['attribute']['number_post'];

        if(is_array($attr['attribute']['pagination_number_post']))
        {
            $args['pagination_number_post'] = $attr['attribute']['pagination_number_post']['size'];
        } else {
            $args['pagination_number_post'] = $attr['attribute']['pagination_number_post'];
        }

        return $args;
    }

    abstract public function render_column($result, $column_class);
    abstract public function render_column_alt($result, $column_class);
    abstract public function render_output($attr, $column_class);
}

