<?php
/**
 * @author : Jegtheme
 */

abstract class JNews_Meta_Abstract
{
    protected $post_id;

    private $excerpt_length = 20;

    private $except_more = '';

    public function __construct($post_id)
    {
        $this->post_id = $post_id;
    }

    public function get_post_url()
    {
        global $wp;
        $post_id = get_the_ID();


        if(is_single())
        {
            return get_permalink($post_id);
        } else {
            return home_url(add_query_arg(array(),$wp->request));
        }
    }

    public function get_excerpt()
    {
        $post = get_post($this->post_id);
        $content = wp_trim_words($post->post_content, $this->excerpt_length, $this->except_more);
        return preg_replace( '/\[[^\]]+\]/', '', $content );
    }

    public function get_post_author()
    {
        $post = get_post( $this->post_id );
        $name = get_the_author_meta( 'display_name', $post->post_author );
        $profiles = get_the_author_meta( 'url', $post->post_author );

        if(get_the_author_meta('facebook', $post->post_author))
        {
            $profiles = get_the_author_meta( 'facebook', $post->post_author );
        }

        return array(
            'display_name' => $name,
            'profiles' => $profiles,
        );
    }

    public function get_post_tags()
    {
        $tags = array();
        $terms = wp_get_post_tags( $this->post_id );

        if ( $terms ) {
            foreach ( $terms as $key => $term ) {
                $tags[] = $term->name;
            }
        }

        return $tags;
    }

    public function get_post_video()
    {
        $video = array();

        if(get_post_format() === 'video')
        {
            $video_url      = get_post_meta( $this->post_id, '_format_video_embed', true );
            $video_format   = strtolower( pathinfo( $video_url, PATHINFO_EXTENSION ) );

            $video = array(
                'url' => $video_url,
                'format' => $video_format
            );
        }

        return $video;
    }

    public function get_post_category()
    {
        $category_id = apply_filters( 'jnews_get_primary_category_filter', null, $this->post_id );

        if ( $category_id )
        {
            return get_category($category_id)->name;
        }

        return null;
    }

    public function get_site_title()
    {
        return wp_get_document_title();
    }

    public function get_site_name()
    {
        return get_bloginfo('name');
    }

    public function get_site_description()
    {
        return get_bloginfo( 'description' );
    }

    public function get_published_time()
    {
        return get_post_time( 'c', true );
    }

    public function get_modified_time()
    {
        return get_post_modified_time( 'c', true );
    }

    public function get_locale()
    {
        return get_locale();
    }

    public function render_meta()
    {
        if(is_single())
        {
            $this->render_post_meta();
        } else if(is_page())
        {
            $template = get_page_template_slug();

            if($template === 'template-builder.php') {
                $this->render_site_meta();
            } else {
                $this->render_post_meta();
            }

        } else {
            $this->render_site_meta();
        }
    }

    public function generate_meta($arr)
    {
        $meta_html = '';

        foreach ($arr as $meta)
        {
            $meta_tag  = array();

            foreach ($meta as $name => $attribute)
            {
                $meta_tag[] = "$name=\"" . esc_attr($attribute) . "\"";
            }

            $meta_html .= sprintf("<meta %s>\n", implode(' ', $meta_tag));
        }

        return $meta_html;
    }

    public function print_meta($string)
    {
        echo wp_kses( $string, array(
            'meta' => array(
                'property' => array(),
                'content' => array(),
                'name' => array(),
            ),
        ) );
    }

    public abstract function get_post_title();
    public abstract function get_post_description();
    public abstract function get_post_image();
    public abstract function render_post_meta();
    public abstract function render_site_meta();
}