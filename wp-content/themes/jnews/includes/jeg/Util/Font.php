<?php
/**
 * @author      Jegtheme
 * @license     https://opensource.org/licenses/MIT
 */
namespace Jeg\Util;

/**
 * The Font object.
 */
final class Font
{
    /**
     * The mode we'll be using to add google fonts.
     * This is a todo item, not yet functional.
     *
     * @static
     * @todo
     * @access public
     * @var string
     */
    public static $mode = 'link';

    /**
     * Holds a single instance of this object.
     *
     * @static
     * @access private
     * @var null|object
     */
    private static $instance = null;

    /**
     * An array of our google fonts.
     *
     * @static
     * @access public
     * @var null|object
     */
    public static $google_fonts = null;

    /**
     * @var array
     */
    public static $google_font_index = null;

    /**
     * The class constructor.
     */
    private function __construct(){}

    /**
     * Get the one, true instance of this class.
     * Prevents performance issues since this is only loaded once.
     *
     * @return object Font
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Compile font options from different sources.
     *
     * @return array    All available fonts.
     */
    public static function get_all_fonts() {
        $standard_fonts = self::get_standard_fonts();
        $google_fonts   = self::get_google_fonts();

        return apply_filters( 'jnews_fonts_all', array_merge( $standard_fonts, $google_fonts ) );
    }

    /**
     * Return an array of standard websafe fonts.
     *
     * @return array    Standard websafe fonts.
     */
    public static function get_standard_fonts() {
        $standard_fonts = array(
            'serif' => array(
                'label' => _x( 'Serif', 'font style', 'jnews' ),
                'stack' => 'Georgia,Times,Times New Roman,serif',
            ),
            'sans-serif' => array(
                'label'  => _x( 'Sans Serif', 'font style', 'jnews' ),
                'stack'  => 'Helvetica Neue, Helvetica, Roboto, Arial, sans-serif',
            ),
            'monospace' => array(
                'label' => _x( 'Monospace', 'font style', 'jnews' ),
                'stack' => 'Monaco, Lucida Sans Typewriter,Lucida Typewriter,Courier New,Courier,monospace',
            ),
        );
        return apply_filters( 'jnews_fonts_standard_fonts', $standard_fonts );
    }

    /**
     * Return an array of backup fonts based on the font-category
     *
     * @return array
     */
    public static function get_backup_fonts() {
        $backup_fonts = array(
            'sans-serif'  => 'Helvetica Neue, Helvetica, Roboto, Arial, sans-serif',
            'serif'       => 'Georgia, serif',
            'display'     => 'Comic Sans MS, cursive, sans-serif',
            'handwriting' => 'Comic Sans MS, cursive, sans-serif',
            'monospace'   => 'Lucida Console, Monaco, monospace',
        );
        return apply_filters( 'jnews_fonts_backup_fonts', $backup_fonts );
    }

    /**
     * Return an array of all available Google Fonts.
     *
     * @return array    All Google Fonts.
     */
    public static function get_google_fonts() {

        if ( null === self::$google_fonts || empty( self::$google_fonts ) ) {

            $fonts = include JEG_DIR  . '/data/webfonts.php' ;

            $google_fonts = array();
            if ( is_array( $fonts ) ) {
                foreach ( $fonts['items'] as $font ) {
                    $google_fonts[ $font['family'] ] = array(
                        'label'    => $font['family'],
                        'variants' => $font['variants'],
                        'subsets'  => $font['subsets'],
                        'category' => $font['category'],
                        'type'     => 'google'
                    );
                }
            }

            self::$google_fonts = apply_filters( 'jnews_fonts_google_fonts', $google_fonts );

        }

        return self::$google_fonts;

    }

    /**
     * Dummy function to avoid issues with backwards-compatibility.
     * This is not functional, but it will prevent PHP Fatal errors.
     *
     * @static
     * @access public
     */
    public static function get_google_font_uri() {}

    /**
     * Returns an array of all available subsets.
     *
     * @static
     * @access public
     * @return array
     */
    public static function get_google_font_subsets() {
        return array(
            // 'all'                => esc_attr__( 'All', 'jnews' ),
            'cyrillic'              => esc_attr__( 'Cyrillic', 'jnews' ),
            'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'jnews' ),
            'devanagari'            => esc_attr__( 'Devanagari', 'jnews' ),
            'greek'                 => esc_attr__( 'Greek', 'jnews' ),
            'greek-ext'             => esc_attr__( 'Greek Extended', 'jnews' ),
            'khmer'                 => esc_attr__( 'Khmer', 'jnews' ),
            // 'latin'              => esc_attr__( 'Latin', 'jnews' ),
            'latin-ext'             => esc_attr__( 'Latin Extended', 'jnews' ),
            'vietnamese'            => esc_attr__( 'Vietnamese', 'jnews' ),
            'hebrew'                => esc_attr__( 'Hebrew', 'jnews' ),
            'arabic'                => esc_attr__( 'Arabic', 'jnews' ),
            'bengali'               => esc_attr__( 'Bengali', 'jnews' ),
            'gujarati'              => esc_attr__( 'Gujarati', 'jnews' ),
            'tamil'                 => esc_attr__( 'Tamil', 'jnews' ),
            'telugu'                => esc_attr__( 'Telugu', 'jnews' ),
            'thai'                  => esc_attr__( 'Thai', 'jnews' ),
        );
    }

    /**
     * Returns an array of all available variants.
     *
     * @static
     * @access public
     * @return array
     */
    public static function get_all_variants() {
        return array(
            '100'       => esc_attr__( 'Ultra-Light 100', 'jnews' ),
            '100italic' => esc_attr__( 'Ultra-Light 100 Italic', 'jnews' ),
            '200'       => esc_attr__( 'Light 200', 'jnews' ),
            '200italic' => esc_attr__( 'Light 200 Italic', 'jnews' ),
            '300'       => esc_attr__( 'Book 300', 'jnews' ),
            '300italic' => esc_attr__( 'Book 300 Italic', 'jnews' ),
            'regular'   => esc_attr__( 'Normal 400', 'jnews' ),
            'italic'    => esc_attr__( 'Normal 400 Italic', 'jnews' ),
            '500'       => esc_attr__( 'Medium 500', 'jnews' ),
            '500italic' => esc_attr__( 'Medium 500 Italic', 'jnews' ),
            '600'       => esc_attr__( 'Semi-Bold 600', 'jnews' ),
            '600italic' => esc_attr__( 'Semi-Bold 600 Italic', 'jnews' ),
            '700'       => esc_attr__( 'Bold 700', 'jnews' ),
            '700italic' => esc_attr__( 'Bold 700 Italic', 'jnews' ),
            '800'       => esc_attr__( 'Extra-Bold 800', 'jnews' ),
            '800italic' => esc_attr__( 'Extra-Bold 800 Italic', 'jnews' ),
            '900'       => esc_attr__( 'Ultra-Bold 900', 'jnews' ),
            '900italic' => esc_attr__( 'Ultra-Bold 900 Italic', 'jnews' ),
        );
    }

    /**
     * Determine if a font-name is a valid google font or not.
     *
     * @static
     * @access public
     * @param string $fontname The name of the font we want to check.
     * @return bool
     */
    public static function is_google_font( $fontname )
    {
        if(is_null(self::$google_font_index))
        {
            self::$google_font_index = include JEG_DIR  . '/data/googlefontsindex.php';
        }
        return in_array( $fontname, self::$google_font_index );
    }

    /**
     * Gets available options for a font.
     *
     * @static
     * @access public
     * @return array
     */
    public static function get_font_choices() {
        $fonts = self::get_all_fonts();
        $fonts_array = array();
        foreach ( $fonts as $key => $args ) {
            $fonts_array[ $key ] = $key;
        }
        return $fonts_array;
    }
}
