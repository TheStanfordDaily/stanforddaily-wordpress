<?php
/**
 * Style Generator
 *
 * @author      Jegtheme
 * @license     https://opensource.org/licenses/MIT
 */
namespace Jeg\Util;

use Jeg\Customizer;
use Jeg\Customizer\ActiveCallback;

Class StyleGenerator
{
    /**
     * @var StyleGenerator
     */
    private static $instance;

    /**
     * @var \Jeg\Customizer\ActiveCallback
     */
    private $active_callback;

    /**
     * @var string
     */
    private $extension = 'css';

    /**
     * @var string
     */
    private $file_name = 'jnews-';

    /**
     * @var string
     */
    private $file_hash = 'jnews-style-hash';

    /**
     * @var string
     */
    private $folder_name = 'jnews';

    /**
     * @var string
     */
    public static $inline_prefix = 'jnews_style_';

    /**
     *
     * @return StyleGenerator

     */
    public static function getInstance()
    {
        if ( null === self::$instance )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * StyleGenerator constructor
     */
    private function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'inline_dynamic_css' ), 99 );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_google_font' ) );
        add_action( 'wp_head', array($this, 'generate_preview_style'), 99);
        add_action( 'customize_save_after', array( $this, 'remove_file_hash' ) );
    }

    public function get_active_callback()
    {
        if($this->active_callback === null) {
            $this->active_callback = ActiveCallback::getInstance();
        }

        return $this->active_callback;
    }

    /**
     * Generate Google Font Index,
     * Selalu update saat update webfonts
     * Panggil fungsi ini kalau ada update di webfonts
     */
    public function generate_google_font_index()
    {
        $google_font = Font::get_google_fonts();
        $google_font = array_keys($google_font);
        $google_html = '';
        foreach($google_font as $font){
            $google_html .= "'{$font}',";
        }
        $google_html = "array({$google_html})";
        echo jeg_sanitize_output($google_html);
    }

    public function extract_outputs($field)
    {
        return isset($field['output']) ? $field['output'] : null;
    }

    /**
     * only show this generated style on previewer mode
     */
    public function generate_preview_style()
    {
        if ( is_customize_preview() )
        {
            $fields = Customizer::getInstance()->get_all_fields();
            $style_tag = '';

            foreach($fields as $setting => $field)
            {
                $style_tag .= $this->build_preview_style($setting, $field);
            }

            echo jeg_sanitize_output($style_tag);
        }
    }

    public function build_preview_style($setting, $field)
    {
        $value = get_theme_mod($setting);

        if(empty($value))
        {
            return null;
        }

        if(isset($field['output']))
        {
            $styles = $field['output'];
            $new_style = '';

            if($this->get_active_callback()->evaluate_by_id($setting))
            {
                foreach ($styles as $style)
                {
                    if($style['method'] === 'inject-style')
                    {
                        $new_style .=  $style['element'] . " { " . $this->style_parse($setting, $style) . " } ";

                        if(isset($style['mediaquery']))
                        {
                            $new_style = $style['mediaquery'] . " { " . $new_style . " } ";
                        }
                    }

                    if($style['method'] === 'typography')
                    {
                        $new_style .= $style['element'] . " { " . $this->font_parse($setting, $style) . " } ";
                    }

                    if($style['method'] === 'gradient')
                    {
                        $new_style .= $style['element'] . " { " . $this->gradient_style($setting, $style) . " } ";
                    }
                }
            }

            if(!empty($new_style))
            {
                $prefix = self::$inline_prefix;
                return "<style id='{$prefix}{$setting}'>" . $new_style . "</style>\n";
            }
        }

        return null;
    }

    public function gradient_style($setting, $style)
    {
        if(get_theme_mod($setting))
        {
            $gradient = get_theme_mod($setting);
            $degree = $gradient['degree'];
            $begincolor = $gradient['begincolor'];
            $beginlocation = $gradient['beginlocation'];
            $endcolor = $gradient['endcolor'];
            $endlocation = $gradient['endlocation'];

            $style = "background: -moz-linear-gradient({$degree}deg, {$begincolor} {$beginlocation}%, {$endcolor} {$endlocation}%);" .
                "background: -webkit-linear-gradient({$degree}deg, {$begincolor} {$beginlocation}%, {$endcolor} {$endlocation}%);" .
                "background: -o-linear-gradient({$degree}deg, {$begincolor} {$beginlocation}%, {$endcolor} {$endlocation}%);" .
                "background: -ms-linear-gradient({$degree}deg, {$begincolor} {$beginlocation}%, {$endcolor} {$endlocation}%);" .
                "background: linear-gradient({$degree}deg, {$begincolor} {$beginlocation}%, {$endcolor} {$endlocation}%);";


            return $style;

        }

        return null;
    }

    public function check_folder()
    {
        $wp_upload_dir = wp_upload_dir();

        if ( ! is_dir( $wp_upload_dir['basedir'] . '/' . $this->folder_name ) )
        {
            if ( ! mkdir( $wp_upload_dir['basedir'] . '/' . $this->folder_name, 0777 ) )
            {
                return false;
            }
        }

        return true;
    }

    public function get_file_path()
    {
        $wp_upload_dir = wp_upload_dir();

        return sprintf( '%s/jnews/%s.%s', $wp_upload_dir['basedir'], $this->file_name . $this->get_file_hash(), $this->extension );
    }

    public function get_file_url()
    {
        $wp_upload_dir = wp_upload_dir();

        return sprintf( '%s/jnews/%s.%s', $wp_upload_dir['baseurl'], $this->file_name . $this->get_file_hash(), $this->extension );
    }

    public function remove_file_hash()
    {
        $this->remove_dynamic_file();
        delete_option($this->file_hash);
    }

    public function get_file_hash()
    {
        $hash = get_option($this->file_hash);

        if(!$hash)
        {
            update_option($this->file_hash , $this->generate_random());
        }

        return $hash;
    }

    public function generate_random($length = 10)
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }


    public function remove_dynamic_file()
    {
        global $wp_filesystem;

        if (empty($wp_filesystem))
        {
            require_once (ABSPATH . '/wp-admin/includes/file.php');

            WP_Filesystem();
        }

        $file_path = $this->get_file_path();

        if($this->check_folder())
        {
            $wp_filesystem->delete($file_path);
        }
    }

    public function generate_css_file()
    {
        global $wp_filesystem;

        if (empty($wp_filesystem))
        {
            require_once (ABSPATH . '/wp-admin/includes/file.php');

            WP_Filesystem();
        }

        $file_path = $this->get_file_path();

        $styles = apply_filters('jnews_generate_inline_style', $this->build_inline_style());

        if($this->check_folder())
        {
            if ( $wp_filesystem->put_contents( $file_path, $styles, 0777 ) )
            {
                return true;
            } else {
	            if ( file_put_contents( $file_path, $styles ) )
	            {
		            return true;
	            }
            }
        }

        return false;
    }

    public function inline_dynamic_css()
    {
        do_action( 'jnews_before_inline_dynamic_css' );

        if ( is_customize_preview() )
        {
            wp_enqueue_style( 'jnews-dynamic-style', JEG_URL . '/assets/css/jnews-dynamic-styles.css', null );

            $styles = apply_filters('jnews_generate_inline_style', '');

            wp_add_inline_style('jnews-dynamic-style', $styles);

        } else {

            if ( ! file_exists( $this->get_file_path() ) )
            {
                do_action('jnews_register_customizer_option', Customizer::getInstance());

                $this->generate_css_file();
            }

            wp_enqueue_style( 'jnews-dynamic-style', $this->get_file_url(), null );
        }
    }

    public function concat_element($element)
    {
        return preg_replace('/\s\s+/', ' ', $element);
    }

    public function build_inline_style()
    {
        $media_queries = $this->generate_css();
        $media = '';

        foreach($media_queries as $query => $styles)
        {
            $style_string = '';

            foreach($styles as $element => $style)
            {
                $element = $this->concat_element($element);
                $style_string = $style_string . $element . " { " . implode(' ', $style) . " } ";
            }

            $media = ( $query === 'default' ) ? $media . $style_string : $media . $query . ' { ' . $style_string . ' } ';
        }

        return $media;
    }

    public function generate_css()
    {
        $fields = Customizer::getInstance()->get_all_fields(array($this, 'extract_outputs'));

        $generated_style = array();

        foreach($fields as $setting => $styles)
        {
            // check if dependency is meet
            if($this->get_active_callback()->evaluate_by_id($setting))
            {
                foreach ($styles as $style)
                {
                    $new_style = '';

                    if($style['method'] === 'inject-style')
                    {
                        $new_style =  $this->style_parse($setting, $style);
                    }

                    if($style['method'] === 'typography')
                    {
                        $new_style = $this->font_parse($setting, $style);
                    }

                    if($style['method'] === 'gradient')
                    {
                        $new_style =  $this->gradient_style($setting, $style);
                    }

                    if(!empty($new_style))
                    {
                        $media = isset($style['mediaquery']) ? $style['mediaquery'] : 'default';

                        $generated_style[$media][$style['element']][] = $new_style;
                    }
                }
            }
        }

        return apply_filters('jnews_generated_style_array', $generated_style, $fields);
    }

    public function load_google_font()
    {
        $fonts = $this->get_google_font_setting();

        if ( is_array( $fonts ) ) 
        {
            $this->add_google_font_to_header($fonts);
        }
    }

    public function get_google_font_setting()
    {
        $settings = apply_filters('jnews_fonts_option_setting', '');
        $fonts    = array();

        if($settings)
        {
            foreach($settings as $setting)
            {
                $option = get_theme_mod($setting);

                if($option)
                {
                    $fonts[] = array(
                        'setting'   => $setting,
                        'name'      => $option['font-family'],
                        'variant'   => isset($option['variant']) ? $option['variant'] : "",
                        'subsets'   => isset($option['subsets']) ? $option['subsets'] : "",
                    );
                }
            }

            return $fonts;
        }

        return false;
    }

    public function add_google_font_to_header($fonts)
    {
        $subsets = array();
        $font_variant = array();

        if ( is_customize_preview() )
        {
            foreach($fonts as $font)
            {
                if(Font::is_google_font($font['name']) && ! get_theme_mod('jnews_gdpr_google_font_disable', false) )
                {
                    $font_detail = $font_array = array();

                    $variant = empty($font['variant']) ? array('reguler') : $font['variant'];
                    $font_array[] = $font['name'] . ":" . implode(',', $variant);

                    if(!empty($font['subsets']))
                    {
                        $subsets = $font['subsets'];
                        $font_detail['subset'] = urlencode( implode(',', $subsets) );
                    }

                    if(!empty($font_array))
                    {
                        $font_detail['family'] = str_replace( '%2B', '+', urlencode( implode( '|', $font_array ) ) );
                        $font_url = add_query_arg( $font_detail, "//fonts.googleapis.com/css" );
                        wp_enqueue_style ($font['setting'], $font_url , null, null);
                    }
                }
            }

        } else {
            $font_url = $this->generate_font_url( $fonts );

            if( $font_url )
            {
                wp_enqueue_style ('jnews_customizer_font', $font_url , null, null);
            }
        }
    }

    public function generate_font_url( $fonts )
    {
        $subsets = array();
        $font_variant = array();

        foreach( $fonts as $font )
        {
            if(isset($font['name']) && !empty($font['name']))
            {
	            if(Font::is_google_font($font['name']) && ! get_theme_mod('jnews_gdpr_google_font_disable', false) )
                {
                    if(isset($font['subsets']) && !empty($font['subsets']))
                    {
                        foreach ($font['subsets'] as $subset)
                        {
                            if(!in_array($subset, $subsets))
                            {
                                $subsets[] = $subset;
                            }
                        }
                    }

                    if(!isset($font_variant[$font['name']]))
                    {
                        $font_variant[$font['name']] = array();
                    }

                    if(!in_array($font['variant'], $font_variant[$font['name']]) && !empty($font['variant']) )
                    {
                        $font_variant[$font['name']][] = $font['variant'];
                    }
                }
            }
        }

        $font_array = array();

        foreach ($font_variant as $font => $variant)
        {
            if(empty($variant)) {
                $variant = array('reguler');
            } else {
                $variant = call_user_func_array('array_merge', $variant);
            }
            $font_array[] = $font . ":" . implode(',', $variant);
        }


        if( ! empty($font_array) )
        {
            $font_detail = array();
            $font_detail['family'] = str_replace( '%2B', '+', urlencode( implode( '|', $font_array ) ) );

            if(!empty($subsets)) {
                $font_detail['subset'] = urlencode( implode(',', $subsets) );
            }

            $font_url = add_query_arg( $font_detail, "//fonts.googleapis.com/css" );
            return $font_url;
        }

        return false;
    }

    public function get_font_variant($variant)
    {
        if($variant === '100')          { return array( 'weight' => '100', 'style' => 'normal'  );  }
        if($variant === '100reguler')   { return array( 'weight' => '100', 'style' => 'reguler' );  }
        if($variant === '100italic')    { return array( 'weight' => '100', 'style' => 'italic'  );  }
        if($variant === '200')          { return array( 'weight' => '200', 'style' => 'normal'  );  }
        if($variant === '200reguler')   { return array( 'weight' => '200', 'style' => 'reguler' );  }
        if($variant === '200italic')    { return array( 'weight' => '200', 'style' => 'italic'  );  }
        if($variant === '300')          { return array( 'weight' => '300', 'style' => 'normal'  );  }
        if($variant === '300reguler')   { return array( 'weight' => '300', 'style' => 'reguler' );  }
        if($variant === '300italic')    { return array( 'weight' => '300', 'style' => 'italic'  );  }
        if($variant === 'regular')      { return array( 'weight' => '400', 'style' => 'normal'  );  }
        if($variant === 'italic')       { return array( 'weight' => '400', 'style' => 'italic'  );  }
        if($variant === '400reguler')   { return array( 'weight' => '400', 'style' => 'reguler' );  }
        if($variant === '400italic')    { return array( 'weight' => '400', 'style' => 'italic'  );  }
        if($variant === '500')          { return array( 'weight' => '500', 'style' => 'normal'  );  }
        if($variant === '500reguler')   { return array( 'weight' => '500', 'style' => 'reguler' );  }
        if($variant === '500italic')    { return array( 'weight' => '500', 'style' => 'italic'  );  }
        if($variant === '600')          { return array( 'weight' => '600', 'style' => 'normal'  );  }
        if($variant === '600reguler')   { return array( 'weight' => '600', 'style' => 'reguler' );  }
        if($variant === '600italic')    { return array( 'weight' => '600', 'style' => 'italic'  );  }
        if($variant === '700')          { return array( 'weight' => '700', 'style' => 'normal'  );  }
        if($variant === '700reguler')   { return array( 'weight' => '700', 'style' => 'reguler' );  }
        if($variant === '700italic')    { return array( 'weight' => '700', 'style' => 'italic'  );  }
        if($variant === '800')          { return array( 'weight' => '800', 'style' => 'normal'  );  }
        if($variant === '800reguler')   { return array( 'weight' => '800', 'style' => 'reguler' );  }
        if($variant === '800italic')    { return array( 'weight' => '800', 'style' => 'italic'  );  }
        if($variant === '900')          { return array( 'weight' => '900', 'style' => 'normal'  );  }
        if($variant === '900reguler')   { return array( 'weight' => '900', 'style' => 'reguler' );  }
        if($variant === '900italic')    { return array( 'weight' => '900', 'style' => 'italic'  );  }
    }

    public function font_parse($setting, $option)
    {
        if(get_theme_mod($setting))
        {
            $font = get_theme_mod($setting);

            $style = '';

            if(isset($font['font-family']) && !empty($font['font-family']))
            {
                $style .= 'font-family: ' . $font['font-family'] . '; ';

                if(sizeof($font['variant']) === 1 && isset($font['variant']) && !empty($font['variant']))
                {
                    $variant = $this->get_font_variant($font['variant'][0]);

                    $style .= 'font-weight : ' . $variant['weight'] . '; ';
                    $style .= 'font-style : ' . $variant['style'] . '; ';
                }
            }

            if(!empty($font['font-size']))
            {
                $style .= 'font-size: ' . $font['font-size'] . '; ';
            }

            if(!empty($font['letter-spacing']))
            {
                $style .= 'letter-spacing: ' . $font['letter-spacing'] . '; ';
            }

            if(!empty($font['line-height']))
            {
                $style .= 'line-height: ' . $font['line-height'] . '; ';
            }

            if(!empty($font['color']))
            {
                $style .= 'color : ' . $font['color'] . '; ';
            }

            if(!empty($font['text-transform']))
            {
                $style .= 'text-transform : ' . $font['text-transform'] . '; ';
            }

            return $style;

        }

        return null;
    }


    public function style_parse($setting, $option)
    {
        if( false !== get_theme_mod($setting) && "" !== get_theme_mod($setting) )
        {
            if(!isset($option['property']) || empty($option['property']))
            {
                $option['property'] = '';
            }

            if(!isset($option['prefix']) || empty($option['prefix']))
            {
                $option['prefix'] = '';
            }

            if(!isset($option['units']) || empty($option['units']))
            {
                $option['units'] = '';
            }

            if(!isset($option['suffix']) || empty($option['suffix']))
            {
                $option['suffix'] = '';
            }

            $style = $option['property'] . ' : ' .  $option['prefix'] . get_theme_mod($setting) . $option['units']  . $option['suffix'] . ';';

            return $style;
        }

        return null;
    }

    public function get_font_url()
    {
        $fonts = $this->get_google_font_setting();

        if ( $fonts || is_array( $fonts )  ) 
        {
            return $this->generate_font_url( $fonts );
        }
        return false;
    }
}