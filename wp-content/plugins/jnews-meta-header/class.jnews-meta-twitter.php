<?php
/**
 * @author : Jegtheme
 */

class JNews_Meta_Twitter extends JNews_Meta_Abstract
{

    public function get_post_title()
    {
        $title = vp_metabox('jnews_social_meta.twitter_title', null, $this->post_id);

        if(!$title)
        {
            $title =  get_the_title();
        }

        return wp_strip_all_tags( $title );
    }

    public function get_post_description()
    {
        $description = vp_metabox('jnews_social_meta.twitter_description', null, $this->post_id);

        if(!$description)
        {
            $description = $this->get_excerpt();
        }

        return wp_strip_all_tags( $description );
    }

    public function get_post_image()
    {
        $attachment_id = vp_metabox('jnews_social_meta.twitter_image', null, $this->post_id);

        if(!$attachment_id)
        {
            $attachment_id = get_post_thumbnail_id($this->post_id);
        }

        return $attachment_id ? wp_get_attachment_image_src($attachment_id, 'full') : null;
    }

    public function get_post_author()
    {
        $post = get_post( $this->post_id );
        $name = get_the_author_meta( 'display_name', $post->post_author );
        $profiles = get_the_author_meta( 'url', $post->post_author );

        if(get_the_author_meta('twitter', $post->post_author))
        {
            $profiles = get_the_author_meta( 'twitter', $post->post_author );
        }

        return array(
            'display_name' => $name,
            'profiles' => $profiles,
        );
    }

    public function get_site_twitter_profile()
    {
        $social_icon = get_theme_mod('jnews_social_icon', array (
            array (
                'social_icon' => 'facebook',
                'social_url' => 'http://facebook.com',
            ),
            array (
                'social_icon' => 'twitter',
                'social_url' => 'http://twitter.com',
            ))
        );

        foreach ($social_icon as $social)
        {
            if($social['social_icon'] === 'twitter')
            {
                return $social['social_url'];
            }
        }
    }

    public function render_post_meta()
    {
        $meta = array();
        $author = $this->get_post_author();

        $meta[] = array(
            'name' => 'twitter:card',
            'content' => 'summary_large_image'
        );

        $meta[] = array(
            'name' => 'twitter:title',
            'content' => $this->get_post_title()
        );

        $meta[] = array(
            'name' => 'twitter:description',
            'content' => $this->get_post_description()
        );

        $meta[] = array(
            'name' => 'twitter:url',
            'content' => $this->get_post_url()
        );

        $meta[] = array(
            'name' => 'twitter:site',
            'content' => $author['profiles']
        );

        // set image
        $image = $this->get_post_image();

        if($image)
        {
            $meta[] = array(
                'name' => 'twitter:image:src',
                'content' => $image[0]
            );

            $meta[] = array(
                'name' => 'twitter:image:width',
                'content' => $image[1]
            );

            $meta[] = array(
                'name' => 'twitter:image:height',
                'content' => $image[2]
            );
        }

        $meta_html = $this->generate_meta($meta);
        $this->print_meta($meta_html);
    }


    public function render_site_meta()
    {
        $meta = array();

        $meta[] = array(
            'name' => 'twitter:card',
            'content' => 'summary'
        );

        $meta[] = array(
            'name' => 'twitter:title',
            'content' => $this->get_site_title()
        );

        $meta[] = array(
            'name' => 'twitter:description',
            'content' => $this->get_site_description()
        );

        $meta[] = array(
            'name' => 'twitter:url',
            'content' => $this->get_post_url()
        );

        $twitter_profile = $this->get_site_twitter_profile();

        if($twitter_profile)
        {
            $meta[] = array(
                'name' => 'twitter:site',
                'content' => $this->get_site_twitter_profile()
            );
        }

        $meta_html = $this->generate_meta($meta);
        $this->print_meta($meta_html);
    }


}