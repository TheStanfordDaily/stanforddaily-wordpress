<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Image;

/**
 * Class JNews Image
 */
Class Image
{
    /**
     * @var Image
     */
    private static $instance;

    private $image_size = array();

    private $prefix = "jnews-";

    /**
     * @return Image
     */
    public static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        $this->setup_image_size();

        add_action( 'wp_loaded', array($this, 'image_hook'));

        add_action('after_setup_theme', array($this, 'generate_image'), 99);
    }

    public function generate_image()
    {
        $generate_image = get_theme_mod('jnews_image_generator', 'normal');

        if($generate_image === 'dynamic')
        {
            add_filter('image_downsize', array($this, 'image_down_size'), 99, 3);
        } else {
            add_action( 'init', array($this, 'add_image_size'));
        }
    }

    public function image_hook()
    {
        $mechanism = get_theme_mod('jnews_image_load', 'lazyload');

        if($mechanism === 'lazyload')
        {
            $image = ImageLazyLoad::getInstance();
        } else if ($mechanism === 'background') {
            $image = ImageBackgroundLoad::getInstance();
        } else {
            $image = ImageNormalLoad::getInstance();
        }

        add_filter( 'jnews_image_lazy_owl' , array($image, 'owl_lazy_image'), null, 2);
        add_filter( 'jnews_single_image_lazy_owl' , array($image, 'owl_lazy_single_image'), null, 2);
        add_filter( 'jnews_image_thumbnail' , array($image, 'image_thumbnail'), null, 2);
        add_filter( 'jnews_image_thumbnail_unwrap' , array($image, 'image_thumbnail_unwrap'), null, 2);
        add_filter( 'jnews_single_image_unwrap' , array($image, 'single_image_unwrap'), null, 2);
        add_filter( 'jnews_single_image_owl' , array($image, 'owl_single_image'), null, 2);

        add_filter( 'jnews_single_image', array($image, 'single_image'), null, 3 );
        add_filter( 'image_size_names_choose', array($this, 'custom_size') );
    }

    public function custom_size($sizes)
    {
        $this->setup_image_size();
        foreach($this->image_size as $key => $size) {
            $sizes[$key] = esc_html__('Custom Size', 'jnews');
        }
        return $sizes;
    }

    public function get_image_size($size)
    {
        return $this->image_size[$size];
    }

    public function setup_image_size()
    {
        $this->image_size = array
        (
            // dimension : 0.5
            $this->prefix . '360x180'           => array('width' => 360,  'height' => 180, 'crop' => true , 'dimension' => 500),
            $this->prefix . '750x375'           => array('width' => 750,  'height' => 375, 'crop' => true , 'dimension' => 500),
            $this->prefix . '1140x570'          => array('width' => 1140, 'height' => 570, 'crop' => true , 'dimension' => 500),

            // dimension : 0.715
            $this->prefix . '120x86'            => array('width' => 120,  'height' => 86,  'crop' => true , 'dimension' => 715),
            $this->prefix . '350x250'           => array('width' => 350,  'height' => 250, 'crop' => true , 'dimension' => 715),
            $this->prefix . '750x536'           => array('width' => 750,  'height' => 536, 'crop' => true , 'dimension' => 715),
            $this->prefix . '1140x815'          => array('width' => 1140, 'height' => 815, 'crop' => true , 'dimension' => 715),

            // dimension
            $this->prefix . '360x504'           => array('width' => 360, 'height' => 504, 'crop' => true , 'dimension' => 1400),

            // dimension 1
            $this->prefix . '75x75'             => array('width' => 75, 'height' => 75, 'crop' => true , 'dimension' => 1000),

            // featured post
            $this->prefix . 'featured-750'      => array('width' => 750,  'height' => 0,  'crop' => true , 'dimension' => 1000),
            $this->prefix . 'featured-1140'     => array('width' => 1140, 'height' => 0,  'crop' => true , 'dimension' => 1000),
        );
    }

    public function add_image_size()
    {
        foreach($this->image_size as $id => $image)
        {
            add_image_size( $id, $image['width'], $image['height'], $image['crop'] );
        }
    }

    public static function generate_image_retina($image, $imageretina, $alt, $echo)
    {
        $srcset = '';

        if(!empty($imageretina))
        {
            $srcset = "srcset=\"" . esc_url($image) . " 1x, " . esc_url($imageretina) . " 2x\"";
        }

        $header_logo = "<img src=\"" . esc_url($image) . "\" " . $srcset . " alt=\"" . esc_attr($alt) . "\">";

        if($echo) {
            echo jnews_sanitize_output($header_logo);
        } else {
            return $header_logo;
        }
    }

    /**
     * The image downside filter

     * @param  boolean $ignore
     * @param  integer $id
     * @param  string  $size
     * @return mixed
     */
    public function image_down_size($ignore = false, $id = null, $size = 'medium')
    {
        global $_wp_additional_image_sizes;

        $image   = wp_get_attachment_url($id);
        $meta    = wp_get_attachment_metadata($id);
        $width   = 0;
        $height  = 0;
        $crop    = false;
        $dynamic = false;

        // return immediately if the size is "thumbnail".
        if ($size == 'thumbnail') {
            return false;
        }

        // return immediately if intermediate image size found.
        if (image_get_intermediate_size($id, $size) || is_array($size)) {
            return false;
        }

        // check if the image size is defined by 'add_image_size()' but not created yet.
        if (isset($_wp_additional_image_sizes[$size])) {
            $width  = $_wp_additional_image_sizes[$size]['width'];
            $height = $_wp_additional_image_sizes[$size]['height'];
            $crop   = $_wp_additional_image_sizes[$size]['crop'];
        }

        // here we assume that the size is dynamic e.g. '200x200'.
        elseif ($sizeArr = $this->parse_size($size)) {
            $width   = isset($sizeArr['width']) ? $sizeArr['width'] : 0;
            $height  = isset($sizeArr['height']) ? $sizeArr['height'] : 999999;
            $crop    = isset($sizeArr['height']) ? true : false;
            $dynamic = true;
        }

        // let's continue if original image found, also if width & height are specified.
        if ($image && $width && $height)
        {
            if (! $img = $this->make_image($id, $width, $height, $crop)) {
                return false;
            }

            if ($dynamic) {
                $img['jnews_dynamic_images'] = true;
            }

            unset($img['path']);

            $meta['sizes'][$size] = $img;

            // update attachment metadata.
            wp_update_attachment_metadata($id, $meta);

            // replace original image url with newly created one.
            $image = str_replace(wp_basename($image), wp_basename($img['file']), $image);

            // we might need to further constrain it if content_width is narrower
            list($width, $height) = image_constrain_size_for_editor($width, $height, $size);

            // finally return the result.
            return array($image, $width, $height, false);
        }

        return false;
    }


    /**
     * Parse image size.

     * @param  string $string
     * @return array
     */
    public function parse_size($string)
    {
        $size  = array();

        if(!is_array($string) && substr( $string, 0, strlen($this->prefix) ) === $this->prefix)
        {
            $string = substr( $string, strlen($this->prefix) );
            $array = explode('x', $string);

            foreach ($array as $key => $value) {
                $value = absint(trim($value));

                if (! $value) {
                    continue;
                }

                if ($key === 0) {
                    $size['width'] = $value;
                }

                if ($key === 1) {
                    $size['height'] = $value;
                }
            }
        } else {
            return $string;
        }

        return $size;
    }


    /**
     * Create a new image by cropping the original image based on given size.
     *
     * @since  1.0.0
     * @access public
     * @param  integer $id
     * @param  integer $width
     * @param  integer $height
     * @param  boolean $crop
     * @return array
     */
    public function make_image($id, $width, $height = 999999, $crop = false)
    {
        $image  = get_attached_file($id);
        $editor = wp_get_image_editor($image);

        if (! is_wp_error($editor)) {
            $editor->resize($width, $height, $crop);
            $editor->set_quality(100);

            $filename = $editor->generate_filename();

            return $editor->save($filename);
        }
    }

}
