<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Theme JNews_Post_Split
 */
Class JNews_Split_Type_1 extends JNews_Split_Type_Abstract
{

    public function render()
    {
        $output  = $this->before_content;
        $output .= "<div class='top-split-nav'>" . $this->drop_section() . "</div>";
        $output .= $this->render_content();
        $output .= $this->drop_section();
        $output .= $this->bottom_nav();
        return $output;
    }

    public function drop_section()
    {
        $output =
            "<div class=\"jeg_splitpost_bar jeg_splitpost_1\">
                <span>" . jnews_return_translation('Jump to section', 'jnews-split', 'jump_to_section') . "</span>
                <div class=\"nav_wrap\">
                    "  . $this->current_title() . "
                    " . $this->split_post_nav() . "
                </div>
            </div>";

        return $output;
    }

    public function bottom_nav()
    {
        $link_text = '';
        $page_text = sprintf(jnews_return_translation("Page %s of %s", 'jnews-split', 'page_s_of_s'), $this->get_page_number(), $this->max_page);

        $previous_class = ( $this->current_page === 1 ) ? "disabled" : "";
        $previous_url = $this->get_page_link_url($this->current_page - 1);

        $next_class = ($this->current_page === $this->max_page) ? "disabled" : "";
        $next_url = $this->get_page_link_url($this->current_page + 1);


        for($i = 1; $i <= $this->max_page; $i++) {
            $index = $i - 1;
            $link_url = $this->get_page_link_url($i);
            $active = ( $this->current_page === $i ) ? "active" : "";
            $page_number = $this->get_page_number($i);
            $link_text .= "<a class=\"page_number {$active}\" href=\"{$link_url}\" data-id=\"{$index}\">{$page_number}</a>";
        }

        $output =
            "<div class=\"jeg_split_pagination jeg_pagelinks jeg_pagination jeg_pagenav_1 no_pageinfo_ no_navtext_ jeg_alignleft\">
                <span class=\"page_info\">{$page_text}</span>
                <div class=\"nav_link\">
                    <a class=\"page_nav prev {$previous_class}\" href=\"{$previous_url}\">
                        <span class=\"navtext\">" . jnews_return_translation('Previous', 'jnews-split', 'previous') ."</span>
                    </a>
                    {$link_text}
                    <a class=\"page_nav next {$next_class}\" href=\"{$next_url}\">
                        <span class=\"navtext\">" . jnews_return_translation('Next', 'jnews-split', 'next') ."</span>
                    </a>
                </div>
            </div>";

        return $output;
    }

    public function get_split_type() {
        return "1";
    }
}
