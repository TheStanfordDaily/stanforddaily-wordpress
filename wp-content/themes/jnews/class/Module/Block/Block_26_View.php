<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_26_View extends BlockViewAbstract
{
    public function render_block_type_1($post, $image_size)
    {
        $thumbnail = $this->get_thumbnail($post->ID, $image_size);
        $category = jnews_get_primary_category($post->ID);
        $category = "<a href=\"" . get_category_link($category) . "\">" . get_cat_name($category) . "</a>";

        // comment
        $comment            = jnews_get_comments_number($post->ID);

        // author detail
        $author             = $post->post_author;
        $author_url         = get_author_posts_url($author);
        $author_name        = get_the_author_meta('display_name', $author);

        $post_meta = ( get_theme_mod('jnews_show_block_meta', true) && get_theme_mod('jnews_show_block_meta_date', true) ) ?
            "<div class=\"jeg_post_meta\">
                <div class=\"jeg_meta_date\"><i class=\"fa fa-clock-o\"></i> {$this->format_date($post)}</div>
            </div>" : "";


        $output =
            "<article " . jnews_post_class("jeg_post jeg_pl_lg_9", $post->ID) . ">
                <header class=\"jeg_postblock_heading\">
                    <div class=\"jeg_post_category\"><span>{$category}</span></div>
                    <h3 class=\"jeg_post_title\"><a href=\"". get_the_permalink($post) ."\">" . get_the_title($post) . "</a></h3>
                    {$post_meta}
                </header>

                <div class=\"jeg_thumb\"> 
                    " . jnews_edit_post( $post->ID ) . "
                    <a href=\"" . get_the_permalink($post) . "\">{$thumbnail}</a> 
                </div>

                <div class=\"jeg_postblock_content\">
                    <div class=\"jeg_post_excerpt\">
                        <p>" . $this->get_excerpt($post) . "</p>
                    </div>
                    <div class=\"jeg_readmore_wrap\">
                        <a href=\"" . get_the_permalink($post) . "\" class=\"jeg_readmore\">" . jnews_return_translation('Read more','jnews', 'read_more') . "</a>
                    </div>
                </div>

                <div class=\"jeg_meta_footer clearfix\">
                    <div class=\"jeg_meta_author\"><span class=\"label\">" . jnews_return_translation('by', 'jnews', 'by') . "</span> <a href=\"{$author_url}\">{$author_name}</a></div>
                     <div class=\"jeg_meta_comment\"><i class=\"fa fa-comment-o\"></i> <a href=\"" . jnews_get_respond_link($post->ID) . "\">{$comment} " . jnews_return_translation('Comments', 'jnews', 'comments') . "</a></div>
                </div>
            </article>";

        return $output;
    }

    public function render_block_type_2($post, $image_size)
    {
        $thumbnail = $this->get_thumbnail($post->ID, $image_size);
        $category = jnews_get_primary_category($post->ID);
        $category = "<a href=\"" . get_category_link($category) . "\">" . get_cat_name($category) . "</a>";

        // comment
        $comment            = jnews_get_comments_number($post->ID);

        // author detail
        $author             = $post->post_author;
        $author_url         = get_author_posts_url($author);
        $author_name        = get_the_author_meta('display_name', $author);

        // share bar
        $share_bar = apply_filters('jnews_share_flat_output', '', $post->ID);

        $post_meta = ( get_theme_mod('jnews_show_block_meta', true) && get_theme_mod('jnews_show_block_meta_date', true) ) ?
            "<div class=\"jeg_post_meta\">
                <div class=\"jeg_meta_date\"><i class=\"fa fa-clock-o\"></i> {$this->format_date($post)}</div>
            </div>" : "";

        $output =
            "<article " . jnews_post_class("jeg_post jeg_pl_lg_9", $post->ID) . ">
                <header class=\"jeg_postblock_heading\">
                    <div class=\"jeg_post_category\"><span>{$category}</span></div>
                    <h3 class=\"jeg_post_title\"><a href=\"". get_the_permalink($post) ."\">" . get_the_title($post) . "</a></h3>
                    {$post_meta}
                </header>

                <div class=\"jeg_thumb\"> 
                    " . jnews_edit_post( $post->ID ) . "
                    <a href=\"" . get_the_permalink($post) . "\">{$thumbnail}</a> 
                </div>

                <div class=\"jeg_postblock_content\">
                    <div class=\"jeg_post_excerpt\">
                        <p>" . $this->get_excerpt($post) . "</p>
                    </div>
                    <div class=\"jeg_readmore_wrap\">
                        <a href=\"" . get_the_permalink($post) . "\" class=\"jeg_readmore\">" . jnews_return_translation('Read more','jnews', 'read_more') . "</a>
                    </div>
                </div>

                <div class=\"jeg_meta_footer clearfix\">
                    <div class=\"jeg_meta_author\"><span class=\"label\">" . jnews_return_translation('by', 'jnews', 'by') . "</span> <a href=\"{$author_url}\">{$author_name}</a></div>
                    {$share_bar}
                     <div class=\"jeg_meta_comment\"><i class=\"fa fa-comment-o\"></i> <a href=\"" . jnews_get_respond_link($post->ID) . "\">{$comment} " . jnews_return_translation('Comments', 'jnews', 'comments') . "</a></div>
                </div>
            </article>";

        return $output;
    }

    public function build_column_1($results)
    {
        $first_block  = '';
        $ads_position = $this->random_ads_position(sizeof($results));

        for ( $i = 0; $i < sizeof($results); $i++ ) 
        {
            if ( $i == $ads_position ) 
            {
                $first_block .= $this->render_module_ads('jeg_ajax_loaded anim_' . $i);
            }

            $first_block .= $this->render_block_type_1($results[$i], 'jnews-360x180');
        }

        $output =
            "<div class=\"jeg_posts jeg_load_more_flag\"> 
                {$first_block}
            </div>";

        return $output;
    }

    public function build_column_2($results)
    {
        $first_block  = '';
        $ads_position = $this->random_ads_position(sizeof($results));

        for ( $i = 0; $i < sizeof($results); $i++ ) 
        {
            if ( $i == $ads_position ) 
            {
                $first_block .= $this->render_module_ads('jeg_ajax_loaded anim_' . $i);
            }

            $first_block .= $this->render_block_type_2($results[$i], 'jnews-1140x570');
        }

        $output =
            "<div class=\"jeg_posts jeg_load_more_flag\"> 
                {$first_block}
            </div>";

        return $output;
    }

    public function render_output($attr, $column_class)
    {
        $results    = $this->build_query($attr);
        $navigation = $this->render_navigation($attr, $results['next'], $results['prev'], $results['total_page']);

        if(!empty($results['result'])) {
            $content = $this->render_column($results['result'], $column_class);
        } else {
            $content = $this->empty_content();
        }

        return
            "<div class=\"jeg_block_container\">
                {$this->get_content_before($attr)}
                {$content}
                {$this->get_content_after($attr)}
            </div>
            <div class=\"jeg_block_navigation\">
                {$this->get_navigation_before($attr)}
                {$navigation}
                {$this->get_navigation_after($attr)}
            </div>";
    }

    public function render_column($result, $column_class)
    {
        switch($column_class)
        {
            case "jeg_col_1o3" :
                $content = $this->build_column_1($result);
                break;
            case "jeg_col_3o3" :
            case "jeg_col_2o3" :
            default :
                $content = $this->build_column_2($result);
                break;
        }

        return $content;
    }

    public function render_column_alt($result, $column_class)
    {
        switch($column_class)
        {
            case "jeg_col_1o3" :
                $content = $this->build_column_1($result);
                break;
            case "jeg_col_3o3" :
            case "jeg_col_2o3" :
            default :
                $content = $this->build_column_2($result);
                break;
        }

        return $content;
    }
}