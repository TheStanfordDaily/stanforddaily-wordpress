<?php

return array(

	////////////////////////////////////////
	// Localized JS Message Configuration //
	////////////////////////////////////////

	/**
	 * Validation Messages
	 */
	'validation' => array(
		'alphabet'     => 'Value needs to be Alphabet',
		'alphanumeric' => 'Value needs to be Alphanumeric',
		'numeric'      => 'Value needs to be Numeric',
		'email'        => 'Value needs to be Valid Email',
		'url'          => 'Value needs to be Valid URL',
		'maxlength'    => 'Length needs to be less than {0} characters',
		'minlength'    => 'Length needs to be more than {0} characters',
		'maxselected'  => 'Select no more than {0} items',
		'minselected'  => 'Select at least {0} items',
		'required'     => 'This is required',
	),

	/**
	 * Import / Export Messages
	 */
	'util' => array(
		'import_success'    => 'Import succeed, option page will be refreshed..',
		'import_failed'     => 'Import failed',
		'export_success'    => 'Export succeed, copy the JSON formatted options',
		'export_failed'     => 'Export failed',
		'restore_success'   => 'Restoration succeed, option page will be refreshed..',
		'restore_nochanges' => 'Options identical to default',
		'restore_failed'    => 'Restoration failed',
	),

	/**
	 * Control Fields String
	 */
	'control' => array(
		// select2 select box
		'select2_placeholder' => 'Select option(s)',
		// fontawesome chooser
		'fac_placeholder'     => 'Select an Icon',
	),

);

/**
 * EOF
 */