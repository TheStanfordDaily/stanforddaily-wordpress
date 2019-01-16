<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Image;

/**
 * Class JNews Image
 */
Class ImageBackgroundLoad implements ImageInterface
{
    /**
     * @var ImageBackgroundLoad
     */
    private static $instance;

    private $expand_range = 700;

    /**
     * @return ImageBackgroundLoad
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
     * Check if image is a GIF file
     *
     * @param $image_src
     * @return bool
     */
    public function is_gif_file($image_src)
    {
        $filetype = wp_check_filetype($image_src);
        return $filetype['ext'] === 'gif';
    }

    /**
     * @param $image_id
     * @param $size
     * @return string
     */
    public function get_image_url($image_id, $size)
    {
        $image = wp_get_attachment_image_src($image_id, $size);

        if($this->is_gif_file($image[0])) {
            $image = wp_get_attachment_image_src($image_id, 'full');
            return $image[0];
        } else {
            return $image[0];
        }
    }

    public function alt_text($id)
    {
        $image = get_post($id);

        if($image)
        {
            $image_alt = get_post_meta( $image->ID, '_wp_attachment_image_alt', true);

            if( empty($image_alt) && !empty($image->post_parent) )
            {
                $image_alt = wp_strip_all_tags(get_the_title($image->post_parent));
            }

            return 'title="' . $image_alt . '"';
        } else {
            return '';
        }
    }

    public function single_hero_image($id, $size)
    {
        $post_thumbnail_id = get_post_thumbnail_id( $id );
        $image = $this->get_image_url($post_thumbnail_id, $size);

        // $thumbnail = "<div class=\"thumbnail-container animate-lazy thumbnail-background jeg_thumb\">
        // <div class=\"lazyload\" {$this->alt_text($post_thumbnail_id)} data-bgset=\"{$image}\" data-expand='{$this->expand_range}' data-animate='0'></div>
        // </div>";

        $thumbnail = "<div class=\"thumbnail-container thumbnail-background\" data-src=\"{$image}\" >
                        <div class=\"lazyloaded\" data-src=\"{$image}\" style=\"background-image: url($image)\"></div>
                    </div>";

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function single_image_unwrap($id, $size)
    {
        $image_src = wp_get_attachment_image_src($id, $size);
        $percentage = round($image_src[2] / $image_src[1] * 100, 3);
        $image_url = $this->get_image_url($id, $size);

        $thumbnail = "<div class=\"thumbnail-container animate-lazy thumbnail-background\" style=\"padding-bottom:" . $percentage . "%;\">
                        <div class=\"lazyload\" {$this->alt_text($id)} data-bgset=\"{$image_url}\" data-expand='{$this->expand_range}'></div>
                      </div>";

        $image = get_post($id);
        if(!empty($image->post_excerpt))
        {
            $thumbnail .= "<p class=\"wp-caption-text\">" .  $image->post_excerpt . "</p>";
        }

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function image_thumbnail_unwrap($id, $size)
    {
        $post_thumbnail_id = get_post_thumbnail_id( $id );
        return $this->single_image_unwrap($post_thumbnail_id, $size);
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function image_thumbnail($id, $size)
    {
        $image_size = Image::getInstance()->get_image_size($size);

        $additional_class = $image = $post_thumbnail_id = '';

        if(!has_post_thumbnail($id)) {
            $additional_class = 'no_thumbnail';
        } else {
            $post_thumbnail_id = get_post_thumbnail_id( $id );
            $image = $this->get_image_url($post_thumbnail_id, $size);
        }

        $thumbnail = "<div class=\"thumbnail-container animate-lazy thumbnail-background {$additional_class} size-{$image_size['dimension']}\">
                        <div class=\"lazyload\" {$this->alt_text($post_thumbnail_id)} data-bgset=\"$image\" data-expand='{$this->expand_range}'></div>
                      </div>";

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

        $image = $this->get_image_url($id, $size);
        $thumbnail = "<div class=\"thumbnail-container animate-lazy thumbnail-background size-{$image_size['dimension']}\">
                        <div class=\"lazyload\" {$this->alt_text($id)} data-bgset=\"{$image}\" data-expand='{$this->expand_range}'></div>
                     </div>";

        return $thumbnail;
    }

    /**
     * @param $id
     * @param $size
     * @return string
     */
    public function owl_lazy_single_image($id, $size)
    {
	    $image              = get_post($id);
	    $image_size         = wp_get_attachment_metadata($id);
        $image_dimension    = Image::getInstance()->get_image_size($size);
	    $image_url          = $this->get_image_url($id, $size);

        $thumbnail = "<div class=\"thumbnail-container animate-lazy thumbnail-background size-{$image_dimension['dimension']}\">
                        <div class=\"lazyload\" {$this->alt_text($id)} data-bgset=\"{$image_url}\" data-expand='{$this->expand_range}' data-full-width=\"{$image_size['width']}\" data-full-height=\"{$image_size['height']}\" alt=\"{$image->post_excerpt}\"></div>
                      </div>";

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

        $additional_class = $image = $post_thumbnail_id = '';

        if(!has_post_thumbnail($id)) {
            $additional_class = 'no_thumbnail';
        } else {
            $post_thumbnail_id = get_post_thumbnail_id( $id );
            $image = $this->get_image_url($post_thumbnail_id, $size);
        }

        $thumbnail = "<div class=\"thumbnail-container animate-lazy thumbnail-background size-{$image_size['dimension']} {$additional_class}\">
                        <div class=\"lazyload\" {$this->alt_text($post_thumbnail_id)} data-bgset=\"{$image}\" data-expand='{$this->expand_range}'></div>
                      </div>";

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
        if($img_size) {
            return "<div class='thumbnail-container animate-lazy thumbnail-background size-{$img_size}'>
                        <div class=\"lazyload\" data-bgset=\"{$img_src}\"></div>
                    </div>";
        }  else {
            return "<img src='{$img_src}' alt='{$img_title}' title='{$img_title}'>";
        }
    }
}
