<?php 

	if ( is_array( $value ) ) 
	{
		$value = rawUrlEncode( wp_json_encode( $value ) );
	} elseif ( empty( $value ) ) {
		$value = rawUrlEncode( wp_json_encode( array() ) );
	} else {
		// remove null value
		$value = array_filter( json_decode( rawUrlDecode($value) )  );
		$value = rawUrlEncode( wp_json_encode( $value ) );
	}

	if ( !function_exists('jeg_widget_repeater') ) 
	{
		function jeg_widget_repeater()
		{
			?>
			<script type="text/html" class="customize-control-repeater-content">
				<# var field; var index = data.index; #>

				<li class="repeater-row minimized" data-row="{{{ index }}}">

					<div class="repeater-row-header">
						<span class="repeater-row-label"></span>
						<i class="dashicons dashicons-arrow-down repeater-minimize"></i>
					</div>
					<div class="repeater-row-content">
						<# _.each( data, function( field, i ) { #>

							<div class="repeater-field repeater-field-{{{ field.type }}}">

								<# if ( 'text' === field.type || 'url' === field.type || 'email' === field.type || 'tel' === field.type || 'date' === field.type ) { #>

									<label>
										<# if ( field.label ) { #>
											<span class="customize-control-title">{{ field.label }}</span>
										<# } #>
										<input type="{{field.type}}" id="{{{ field.id }}}{{ index }}" name="{{{ field.id }}}{{ index }}" value="{{{ field.default }}}" data-field="{{{ field.id }}}">
										<# if ( field.description ) { #>
											<span class="customize-control-description">{{ field.description }}</span>
										<# } #>
									</label>

								<# } else if ( 'hidden' === field.type ) { #>

									<input type="hidden" data-field="{{{ field.id }}}" <# if ( field.default ) { #> value="{{{ field.default }}}" <# } #> />

								<# } else if ( 'checkbox' === field.type ) { #>

									<label>
										<input type="checkbox" id="{{{ field.id }}}{{ index }}" name="{{{ field.id }}}{{ index }}" value="true" data-field="{{{ field.id }}}" <# if ( field.default ) { #> checked="checked" <# } #> /> {{ field.label }}
										<# if ( field.description ) { #>
											{{ field.description }}
										<# } #>
									</label>

								<# } else if ( 'select' === field.type ) { #>

									<label>
										<# if ( field.label ) { #>
											<span class="customize-control-title">{{ field.label }}</span>
										<# } #>
										<select id="{{{ field.id }}}{{ index }}" name="{{{ field.id }}}{{ index }}"  data-field="{{{ field.id }}}">
											<# _.each( field.choices, function( choice, i ) { #>
												<option value="{{{ i }}}" <# if ( field.default == i ) { #> selected="selected" <# } #>>{{ choice }}</option>
											<# }); #>
										</select>
										<# if ( field.description ) { #>
											<span class="customize-control-description">{{ field.description }}</span>
										<# } #>
									</label>

								<# } else if ( 'dropdown-pages' === field.type ) { #>

									<label>
										<# if ( field.label ) { #>
											<span class="customize-control-title">{{{ data.label }}}</span>
										<# } #>
										<div class="customize-control-content repeater-dropdown-pages">{{{ field.dropdown }}}</div>
										<# if ( field.description ) { #>
											<span class="customize-control-description">{{{ field.description }}}</span>
										<# } #>
									</label>

								<# } else if ( 'radio' === field.type ) { #>

									<label>
										<# if ( field.label ) { #>
											<span class="customize-control-title">{{ field.label }}</span>
										<# } #>
										<# if ( field.description ) { #>
											<span class="customize-control-description">{{ field.description }}</span>
										<# } #>

										<# _.each( field.choices, function( choice, i ) { #>
											<label>
												<input type="radio" name="{{{ field.id }}}{{ index }}" data-field="{{{ field.id }}}" value="{{{ i }}}" <# if ( field.default == i ) { #> checked="checked" <# } #>> {{ choice }} <br/>
											</label>
										<# }); #>
									</label>

								<# } else if ( 'radio-image' === field.type ) { #>

									<label>
										<# if ( field.label ) { #>
											<span class="customize-control-title">{{ field.label }}</span>
										<# } #>
										<# if ( field.description ) { #>
											<span class="customize-control-description">{{ field.description }}</span>
										<# } #>

										<# _.each( field.choices, function( choice, i ) { #>
											<input type="radio" id="{{{ field.id }}}_{{ index }}_{{{ i }}}" name="{{{ field.id }}}{{ index }}" data-field="{{{ field.id }}}" value="{{{ i }}}" <# if ( field.default == i ) { #> checked="checked" <# } #>>
												<label for="{{{ field.id }}}_{{ index }}_{{{ i }}}">
													<img src="{{ choice }}">
												</label>
											</input>
										<# }); #>
									</label>

								<# } else if ( 'color' === field.type ) { #>

									<# var defaultValue = '';
									if ( field.default ) {
										if ( '#' !== field.default.substring( 0, 1 ) ) {
											defaultValue = '#' + field.default;
										} else {
											defaultValue = field.default;
										}
										defaultValue = ' data-default-color=' + defaultValue; // Quotes added automatically.
									} #>
									<label>
										<# if ( field.label ) { #>
											<span class="customize-control-title">{{{ field.label }}}</span>
										<# } #>
										<# if ( field.description ) { #>
											<span class="customize-control-description">{{{ field.description }}}</span>
										<# } #>
										<input class="color-picker-hex" type="text" maxlength="7" placeholder="<?php echo esc_attr__( 'Hex Value', 'jnews' ); ?>"  value="{{{ field.default }}}" data-field="{{{ field.id }}}" {{ defaultValue }} />

									</label>

								<# } else if ( 'textarea' === field.type ) { #>

									<# if ( field.label ) { #>
										<span class="customize-control-title">{{ field.label }}</span>
									<# } #>
									<# if ( field.description ) { #>
										<span class="customize-control-description">{{ field.description }}</span>
									<# } #>
									<textarea rows="5" data-field="{{{ field.id }}}">{{ field.default }}</textarea>

								<# } else if ( field.type === 'image' || field.type === 'cropped_image' ) { #>

									<label>
										<# if ( field.label ) { #>
											<span class="customize-control-title">{{ field.label }}</span>
										<# } #>
										<# if ( field.description ) { #>
											<span class="customize-control-description">{{ field.description }}</span>
										<# } #>
									</label>

									<figure class="jnews-image-attachment" data-placeholder="<?php echo esc_attr__( 'No Image Selected', 'jnews' ); ?>" >
										<# if ( field.default ) { #>
											<# var defaultImageURL = ( field.default.url ) ? field.default.url : field.default; #>
											<img src="{{{ defaultImageURL }}}">
										<# } else { #>
											<?php echo esc_attr__( 'No Image Selected', 'jnews' ); ?>
										<# } #>
									</figure>

									<div class="actions">
										<button type="button" class="button remove-button<# if ( ! field.default ) { #> hidden<# } #>"><?php echo esc_attr__( 'Remove', 'jnews' ); ?></button>
										<button type="button" class="button upload-button" data-label=" <?php echo esc_attr__( 'Add Image', 'jnews' ); ?>" data-alt-label="<?php echo esc_attr__( 'Change Image', 'jnews' ); ?>" >
											<# if ( field.default ) { #>
												<?php echo esc_attr__( 'Change Image', 'jnews' ); ?>
											<# } else { #>
												<?php echo esc_attr__( 'Add Image', 'jnews' ); ?>
											<# } #>
										</button>
										<# if ( field.default.id ) { #>
											<input type="hidden" class="hidden-field" value="{{{ field.default.id }}}" data-field="{{{ field.id }}}" >
										<# } else { #>
											<input type="hidden" class="hidden-field" value="{{{ field.default }}}" data-field="{{{ field.id }}}" >
										<# } #>
									</div>

								<# } else if ( field.type === 'upload' ) { #>

									<label>
										<# if ( field.label ) { #>
											<span class="customize-control-title">{{ field.label }}</span>
										<# } #>
										<# if ( field.description ) { #>
											<span class="customize-control-description">{{ field.description }}</span>
										<# } #>
									</label>

									<figure class="jnews-file-attachment" data-placeholder="<?php echo esc_attr__( 'No File Selected', 'jnews' ); ?>" >
										<# if ( field.default ) { #>
											<# var defaultFilename = ( field.default.filename ) ? field.default.filename : field.default; #>
											<span class="file"><span class="dashicons dashicons-media-default"></span> {{ defaultFilename }}</span>
										<# } else { #>
											<?php echo esc_attr__( 'No File Selected', 'jnews' ); ?>
										<# } #>
									</figure>

									<div class="actions">
										<button type="button" class="button remove-button<# if ( ! field.default ) { #> hidden<# } #>"><?php echo esc_attr__( 'Remove', 'jnews' ); ?></button>
										<button type="button" class="button upload-button" data-label="<?php echo esc_attr__( 'Add File', 'jnews' ); ?>" data-alt-label="<?php echo esc_attr__( 'Change File', 'jnews' ); ?>" >
											<# if ( field.default ) { #>
												<?php echo esc_attr__( 'Change File', 'jnews' ); ?>
											<# } else { #>
												<?php echo esc_attr__( 'Add File', 'jnews' ); ?>
											<# } #>
										</button>
										<# if ( field.default.id ) { #>
											<input type="hidden" class="hidden-field" value="{{{ field.default.id }}}" data-field="{{{ field.id }}}" >
										<# } else { #>
											<input type="hidden" class="hidden-field" value="{{{ field.default }}}" data-field="{{{ field.id }}}" >
										<# } #>
									</div>

								<# } #>

							</div>
						<# }); #>
						<button type="button" class="button-link repeater-row-remove"><?php echo esc_attr__( 'delete', 'jnews' ); ?></button>
					</div>
				</li>
			</script>
			<?php
		}
	}
?>

<div class="widget-wrapper type-repeater" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>
    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
    <div class="jeg-repeater-wrapper">
        <ul class="repeater-fields"></ul>
        <div class="repeater-add-wrapper">
        	<button class="button button-large button-primary repeater-add"><i class="fa fa-plus"></i></button>	
        </div>
        <?php jeg_widget_repeater(); ?>
        <input type="hidden" class="repeater-value" id="<?php echo esc_attr( $fieldid ) ?>" name="<?php echo esc_attr($fieldname); ?>" value='<?php echo wp_kses_post($value); ?>' data-customize-setting-link="<?php echo esc_attr($fieldid); ?>" data-label='<?php echo wp_json_encode($row_label); ?>' data-field='<?php echo wp_json_encode($fields); ?>'>
    </div>
</div>

