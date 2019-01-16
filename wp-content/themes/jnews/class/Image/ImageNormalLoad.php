<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Image;

/**
 * Class JNews Image
 */
Class ImageNormalLoad implements ImageInterface
{
    /**
     * @var ImageNormalLoad
     */
    private static $instance;

    /**
     * @return ImageNormalLoad
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function single_image_unwrap($id, $size)
    {
        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'normal_load_image'), 10, 2);

        $image_size = wp_get_attachment_image_src($id, $size);
        $image = get_post($id);
        $percentage = round($image_size[2] / $image_size[1] * 100, 3);

        $thumbnail = "<div class=\"thumbnail-container\" style=\"padding-bottom:" . $percentage . "%\">";
        $thumbnail .= wp_get_attachment_image( $id, $size );
        $thumbnail .= "</div>";

        if(!empty($image->post_excerpt))
        {
            $thumbnail .= "<p class=\"wp-caption-text\">" .  $image->post_excerpt . "</p>";
        }

        remove_filter('wp_get_attachment_image_attributes', array($this, 'normal_load_image'), 10);

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function image_thumbnail_unwrap($id, $size)
    {
        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'normal_load_image'), 10, 2);

        $post_thumbnail_id = get_post_thumbnail_id( $id );
        $image_size = wp_get_attachment_image_src($post_thumbnail_id, $size);
        $image = get_post($post_thumbnail_id);

	    if ( $image_size[1] > 0 )
	    {
		    $percentage = round($image_size[2] / $image_size[1] * 100, 3);
	    } else {
		    $percentage = $image_size[2];
	    }

        $thumbnail = "<div class=\"thumbnail-container\" style=\"padding-bottom:" . $percentage . "%\">";
        $thumbnail .= get_the_post_thumbnail( $id, $size );
        $thumbnail .= "</div>";

        if(!empty($image->post_excerpt))
        {
            $thumbnail .= "<p class=\"wp-caption-text\">" .  $image->post_excerpt . "</p>";
        }

        remove_filter('wp_get_attachment_image_attributes', array($this, 'normal_load_image'), 10);

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function image_thumbnail($id, $size)
    {
        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'normal_load_image'), 10, 2);

        $image_size = Image::getInstance()->get_image_size($size);

        $additional_class = '';
        if(!has_post_thumbnail($id)) {
            $additional_class = 'no_thumbnail';
        }

        $thumbnail = "<div class=\"thumbnail-container {$additional_class} size-{$image_size['dimension']} \">";
        $thumbnail .= get_the_post_thumbnail( $id, $size );
        $thumbnail .= "</div>";

        remove_filter('wp_get_attachment_image_attributes', array($this, 'normal_load_image'), 10);

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function owl_single_image($id, $size)
    {
        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'normal_load_image'), 10, 2);

        $image_size = Image::getInstance()->get_image_size($size);

        $thumbnail = "<div class=\"thumbnail-container size-{$image_size['dimension']} \">";
        $thumbnail .= wp_get_attachment_image( $id, $size );
        $thumbnail .= "</div>";

        remove_filter('wp_get_attachment_image_attributes', array($this, 'normal_load_image'), 10);

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function owl_lazy_single_image($id, $size)
    {
        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'normal_load_image'), 10, 2);

        $image_size = Image::getInstance()->get_image_size($size);

        $thumbnail = "<div class=\"thumbnail-container size-{$image_size['dimension']} \">";
        $thumbnail .= wp_get_attachment_image( $id, $size );
        $thumbnail .= "</div>";

        remove_filter('wp_get_attachment_image_attributes', array($this, 'normal_load_image'), 10);

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function owl_lazy_image($id, $size)
    {
        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'normal_load_image'), 10, 2);

        $image_size = Image::getInstance()->get_image_size($size);

        $thumbnail = "<div class=\"thumbnail-container size-{$image_size['dimension']} \">";
        $thumbnail .= get_the_post_thumbnail( $id, $size );
        $thumbnail .= "</div>";

        remove_filter('wp_get_attachment_image_attributes', array($this, 'normal_load_image'), 10);

        return $thumbnail;
    }

    /**
     * @param $img_src
     * @param $img_title
     * @param $img_size
     * @return string
     */
    public function single_image($img_src, $img_title, $img_size)
    {
        $img_tag = "<img src='{$img_src}' alt='{$img_title}' title='{$img_title}'>";

        if($img_size) {
            return "<div class='thumbnail-container size-{$img_size}'>{$img_tag}</div>";
        }  else {
            return $img_tag;
        }
    }

    public function normal_load_image($attr, $image)
    {
        if( empty($attr['alt']) && !empty($image->post_excerpt) )
        {
            $attr['alt'] = wp_strip_all_tags($image->post_excerpt);
        }

        return $attr;
    }
}
