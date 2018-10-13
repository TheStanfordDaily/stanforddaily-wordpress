<?php
/**
 * Contains the autoloader.
 *
 * @package Heartbeat_Control
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoloads files based on class names.
 *
 * @param string $classname The class name.
 *
 * @return void
 */
function heartbeat_control_autoload( $classname ) {
	$class     = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower( $classname ) ) );
	$file_path = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . $class . '.php';
	if ( file_exists( $file_path ) ) {
		require_once $file_path;
	}
}

// Register the autoloader.
spl_autoload_register( 'heartbeat_control_autoload' );
