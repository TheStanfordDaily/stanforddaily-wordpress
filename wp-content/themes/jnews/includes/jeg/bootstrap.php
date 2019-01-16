<?php
/**
 * @author : Jegtheme
 */

if( defined('JEG_VERSION') )
    return;

defined( 'JEG_VERSION' )        or define( 'JEG_VERSION',  '1.0.0' );
defined( 'JEG_URL' )            or define( 'JEG_URL', get_template_directory_uri() . '/includes/jeg');
defined( 'JEG_FILE' )           or define( 'JEG_FILE',  __FILE__ );
defined( 'JEG_DIR' )            or define( 'JEG_DIR', dirname( __FILE__ ) );
defined( 'JEG_NAMESPACE' )      or define( 'JEG_NAMESPACE', 'Jeg_');
defined( 'JEG_CLASSPATH' )      or define( 'JEG_CLASSPATH', JEG_DIR);

require_once JEG_DIR . '/autoload.php';

add_action( 'init', 'jeg_initialize_customizer');

function jeg_initialize_customizer()
{
    // Instantiate Customizer
    Jeg\Customizer::getInstance();

    // Style Generator
    Jeg\Util\StyleGenerator::getInstance();
}

if ( ! function_exists('jeg_sanitize_output') ) 
{
	function jeg_sanitize_output( $value )
	{
		return $value;
	}
}