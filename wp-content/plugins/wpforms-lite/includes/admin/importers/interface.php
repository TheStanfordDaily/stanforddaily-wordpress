<?php
/**
 * Interface WPForms_Importer_Interface to handle common methods for all importers.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.4.2
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
interface WPForms_Importer_Interface {

	/**
	 * Defines some properties.
	 *
	 * @since 1.4.2
	 */
	public function init();

	/**
	 * Get ALL THE FORMS.
	 *
	 * @since 1.4.2
	 */
	public function get_forms();

	/**
	 * Get a single form.
	 *
	 * @since 1.4.2
	 *
	 * @param int $id Form ID.
	 */
	public function get_form( $id );

	/**
	 * Import a single form using AJAX.
	 *
	 * @since 1.4.2
	 */
	public function import_form();

	/**
	 * Replace 3rd-party form provider tags/shortcodes with our own Smart Tags.
	 *
	 * @since 1.4.2
	 *
	 * @param string $string
	 * @param array $fields
	 *
	 * @return string
	 */
	public function get_smarttags( $string, $fields );
}
