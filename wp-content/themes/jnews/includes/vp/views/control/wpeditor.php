<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<?php
	// prepare value for tinyMCE editor
	$value = html_entity_decode( $value, ENT_COMPAT, 'UTF-8' );

	if ( has_filter( 'the_editor_content' ) ) 
	{
		$value = apply_filters( 'the_editor_content', $value );
	}

	$editor_settings = array(
		'wpautop' 			=> true,
		'media_buttons'		=> true,
		'textarea_name' 	=> $name,
		'textarea_rows'    	=> 10,
		'quicktags'		   	=> true,
		'drag_drop_upload' 	=> true,
        'teeny' 			=> true,
	);

	/**
	* Remove [, ], {, } (brackets), - (hypen) from Editor ID
	* @since 3.9
	* TinyMCE editor IDs cannot have brackets.
	*/

	$id = str_replace( array("[","]","-","{","}"), "", $name );
	$id = $id.'_ce' ;

	wp_editor( $value, $id, $editor_settings );
?>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot', $head_info); ?>