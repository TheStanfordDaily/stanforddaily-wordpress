<?php
/**
 * @author : Jegtheme
 */

class JNews_Meta_Facebook extends JNews_Meta_Abstract
{
    public function __construct($post_id)
    {
        if(!class_exists('OpenGraphProtocol'))
        {
            require_once 'includes/ogp/open-graph-protocol.php';
            require_once 'includes/ogp/objects.php';
            require_once 'includes/ogp/media.php';
        }

        parent::__construct($post_id);
    }

    public function get_post_image()
    {
        $attachment_id = vp_metabox('jnews_social_meta.fb_description', null, $this->post_id);

        if(!$attachment_id)
        {
            $attachment_id = get_post_thumbnail_id($this->post_id);
        }

        return $attachment_id ? wp_get_attachment_image_src($attachment_id, 'full') : null;
    }

    public function get_post_description()
    {
        $description = vp_metabox('jnews_social_meta.fb_description', null, $this->post_id);

        if(!$description)
        {
            $description = $this->get_excerpt();
        }

        return wp_strip_all_tags( $description );
    }

    public function get_post_title()
    {
        $title = vp_metabox('jnews_social_meta.fb_title', null, $this->post_id);

        if(!$title)
        {
            $title =  get_the_title();
        }

        return wp_strip_all_tags( $title );
    }

    /**
     * Render Facebook Meta for Single Post
     */
    public function render_post_meta()
    {
        $graphProtocol = new OpenGraphProtocol();

        $graphProtocol->setType('article')
            ->setLocale( $this->get_locale() )
            ->setSiteName( $this->get_site_name() )
            ->setTitle( $this->get_post_title() )
            ->setURL( $this->get_post_url() )
            ->setDescription( $this->get_post_description() );

        /**
         * Set Image
         */
        $image = $this->get_post_image();

        if($image)
        {
            $imageProtocol = new OpenGraphProtocolImage();
            $imageProtocol->setURL($image[0])
                ->setWidth($image[1])
                ->setHeight($image[2]);

            $graphProtocol->addImage($imageProtocol);
        }

        /**
         * Set Video
         */
        $video = $this->get_post_video();
        $valid_video_format = array('swf', 'mp4', 'ogv', 'webm');

        if(!empty($video))
        {
            if(in_array($video['format'], $valid_video_format))
            {
                $videoProtocol = new OpenGraphProtocolVideo();
                $videoProtocol->setURL( $video['url'] )
                    ->setType( OpenGraphProtocolVideo::extension_to_media_type( $video['format'] ) )
                    ->setWidth( 750 )
                    ->setHeight( 447 );

                $graphProtocol->addVideo($videoProtocol);
            }
        }

        /**
         * Set Article
         */
        $articleProtocol = new OpenGraphProtocolArticle();
        $post_author = $this->get_post_author();

        $articleProtocol->setSection( $this->get_post_category() )
            ->setPublishedTime( $this->get_published_time() )
            ->setModifiedTime( $this->get_modified_time() )
            ->addAuthor($post_author['profiles']);

        foreach ( $this->get_post_tags() as $tag ) {
            $articleProtocol->addTag( $tag );
        }

        $this->print_meta( $graphProtocol->toHTML() . "\n" . $articleProtocol->toHTML() . "\n" );
    }


    /**
     * Render Facebook Meta for Website
     */
    public function render_site_meta()
    {
        $graphProtocol = new OpenGraphProtocol();

        $graphProtocol->setType('website')
            ->setLocale( $this->get_locale() )
            ->setURL( $this->get_post_url() )
            ->setSiteName( $this->get_site_name() )
            ->setTitle( $this->get_site_title() )
            ->setDescription( $this->get_site_description() );

        $this->print_meta( $graphProtocol->toHTML() . "\n" );
    }
}