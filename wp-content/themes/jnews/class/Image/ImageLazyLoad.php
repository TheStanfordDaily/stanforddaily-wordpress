<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Image;

/**
 * Class JNews Image
 */
Class ImageLazyLoad implements ImageInterface
{
    /**
     * @var ImageLazyLoad
     */
    private static $instance;

    private $expand_range = 700;

    /**
     * @return ImageLazyLoad
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
        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'lazy_load_image'), 10, 2);

        $image_size = wp_get_attachment_image_src($id, $size);
        $image = get_post($id);
        $percentage = round($image_size[2] / $image_size[1] * 100, 3);

        $thumbnail = "<div class=\"thumbnail-container animate-lazy\" style=\"padding-bottom:" . $percentage . "%\">";
        $thumbnail .= wp_get_attachment_image( $id, $size );
        $thumbnail .= "</div>";

        if(!empty($image->post_excerpt))
        {
            $thumbnail .= "<p class=\"wp-caption-text\">" .  $image->post_excerpt . "</p>";
        }

        remove_filter('wp_get_attachment_image_attributes', array($this, 'lazy_load_image'), 10);

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function image_thumbnail_unwrap($id, $size)
    {
        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'lazy_load_image'), 10, 2);

        $post_thumbnail_id = get_post_thumbnail_id( $id );
        $image_size = wp_get_attachment_image_src($post_thumbnail_id, $size);
        $image = get_post($post_thumbnail_id);
        $percentage = !empty( $image_size[1] ) ? round( $image_size[2] / $image_size[1] * 100, 3 ) : '';

        $thumbnail = "<div class=\"thumbnail-container animate-lazy\" style=\"padding-bottom:" . $percentage . "%\">";
        $thumbnail .= get_the_post_thumbnail( $id, $size );
        $thumbnail .= "</div>";

        if(!empty($image->post_excerpt))
        {
            $thumbnail .= "<p class=\"wp-caption-text\">" .  $image->post_excerpt . "</p>";
        }

        remove_filter('wp_get_attachment_image_attributes', array($this, 'lazy_load_image'), 10);

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function image_thumbnail($id, $size)
    {
        $image_size = Image::getInstance()->get_image_size($size);

        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'lazy_load_image'), 10, 2);

        $additional_class = '';
        if(!has_post_thumbnail($id)) {
            $additional_class = 'no_thumbnail';
        }

        $thumbnail = "<div class=\"thumbnail-container animate-lazy {$additional_class} size-{$image_size['dimension']} \">";
        $thumbnail .= get_the_post_thumbnail( $id, $size );
        $thumbnail .= "</div>";

        remove_filter('wp_get_attachment_image_attributes', array($this, 'lazy_load_image'), 10);

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function owl_single_image($id, $size)
    {
        $image_size = Image::getInstance()->get_image_size($size);

        $thumbnail = "<div class=\"thumbnail-container size-{$image_size['dimension']} \">";
        $thumbnail .= wp_get_attachment_image( $id, $size );
        $thumbnail .= "</div>";

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function owl_lazy_single_image($id, $size)
    {
        $image_size = Image::getInstance()->get_image_size($size);

        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'owl_lazy_attr'), 10, 2);

        $thumbnail = "<div class=\"thumbnail-container size-{$image_size['dimension']} \">";
        $thumbnail .= wp_get_attachment_image( $id, $size );
        $thumbnail .= "</div>";

        remove_filter('wp_get_attachment_image_attributes', array($this, 'owl_lazy_attr'), 10);

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function owl_lazy_image($id, $size)
    {
        $image_size = Image::getInstance()->get_image_size($size);
        add_filter( 'wp_get_attachment_image_attributes' , array($this, 'owl_lazy_attr'), 10, 2);

        $thumbnail = "<div class=\"thumbnail-container size-{$image_size['dimension']} \">";
        $thumbnail .= get_the_post_thumbnail( $id, $size );
        $thumbnail .= "</div>";

        remove_filter('wp_get_attachment_image_attributes', array($this, 'owl_lazy_attr'), 10);

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
        $img_tag = "<img class='lazyload' src='{$this->get_empty_image()}' data-expand='" . $this->expand_range . "' alt='{$img_title}' data-src='{$img_src}' title='{$img_title}'>";

        if($img_size) {
            return "<div class='thumbnail-container animate-lazy size-{$img_size}'>{$img_tag}</div>";
        }  else {
            return $img_tag;
        }
    }

    /**
     * @param $attr
     * @param $image
     * @return mixed
     */
    public function lazy_load_image($attr, $image)
    {
        $attr['class']          = $attr['class'] . ' lazyload';
        $attr['data-src']       = $attr['src'];
        $attr['data-sizes']     = 'auto';
        $attr['data-srcset']    = isset($attr['srcset']) ? $attr['srcset'] : '';
        $attr['data-expand']    = $this->expand_range;
        $attr['src']            = $this->get_empty_image();

        if( empty($attr['alt']) && !empty($image->post_parent) )
        {
            $attr['alt'] = wp_strip_all_tags(get_the_title($image->post_parent));
        }

        // Need to fix issues on ajax request image not showing
        if (wp_doing_ajax()) {
            $attr['data-animate'] = 0;
        }

        unset($attr['srcset']);
        unset($attr['sizes']);
        return $attr;
    }

    /**
     * @param $attr
     * @param $image
     * @return mixed
     */
    public function owl_lazy_attr($attr, $image)
    {
        $attr['class']          = $attr['class'] . ' owl-lazy';
        $attr['data-src']       = $attr['src'];
        $attr['src']            = $this->get_empty_image();

        if( empty($attr['alt']) && !empty($image->post_parent) )
        {
            $attr['alt'] = wp_strip_all_tags(get_the_title($image->post_parent));
        }

        unset($attr['srcset']);
        unset($attr['sizes']);
        return $attr;
    }

    public function get_empty_image()
    {
        return get_parent_theme_file_uri('assets/img/jeg-empty.png');
    }
}
