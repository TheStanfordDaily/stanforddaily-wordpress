<div id="<?php echo esc_attr( $id ); ?>" class="jeg_upload_wrapper <?php echo esc_attr( $class ); ?>">

	<?php if ( apply_filters( 'jnews_enable_upload', true ) ): ?>
        <div class="upload_preview_container">
            <ul>
				<?php

				if ( $source && is_array( $source ) )
				{
					$output = '';

					foreach ( $source as $item )
					{
						$image = wp_get_attachment_image_src( $item, 'thumbnail' );

						if ( $image )
						{
							$output .=
								"<li>
                                <input type='hidden' name='{$name}[]' value='" . esc_attr($item) . "'>
                                <img src='" . esc_url($image[0]) . "'>
                                <div class='remove'></div>
                            </li>";
						}
					}

					echo $output;
				}
				?>
            </ul>
        </div>
        <div id="<?php echo esc_attr($button); ?>" class="btn btn-default btn-sm btn-block-xs">
            <i class="fa fa-folder-open-o"></i>
	        <?php jnews_print_translation( 'Choose Image', 'jnews', 'choose_image' ); ?>
        </div>
	<?php else: ?>
		<?php echo apply_filters( 'jnews_enable_upload_msg', '' ); ?>
	<?php endif ?>

</div>

<?php if ( apply_filters( 'jnews_enable_upload', true ) ): ?>
    <script>
        (function ($)
        {
            $(document).ready(function()
            {
                var file_frame;

                $('#<?php echo esc_js($button); ?>').on( 'click', function( event )
                {
                    event.preventDefault();

                    if ( file_frame )
                    {
                        file_frame.open();
                        return;
                    }

                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: '<?php echo esc_html__( 'Add Media', 'jnews' ); ?>',
                        button: {
                            text: '<?php jnews_print_translation( 'Insert', 'jnews', 'insert_media' ); ?>',
                        },
                        multiple: <?php echo $multi ? 'true' : 'false'; ?>
                    });

                    file_frame.on( 'select', function()
                    {
                        var output     = '',
                            attachment = file_frame.state().get('selection').toJSON();

                        for ( var i = 0; i < attachment.length; i++ )
                        {
                            output +=
                                "<li>" +
                                "<input type='hidden' name='<?php echo esc_attr($name); ?>[]' value='" + attachment[i]['id'] + "'>" +
                                "<img src=" + attachment[i]['url'] + ">" +
                                "<div class='remove'></div>" +
                                "</li>";
                        }


						<?php if ( $multi ): ?>
                        $('.upload_preview_container ul').append(output);
						<?php else: ?>
                        $('.upload_preview_container ul').html(output);
						<?php endif ?>
                    });

                    file_frame.open();
                });

                $('#<?php echo esc_js($id); ?>').find(".upload_preview_container").on('click', '.remove', function()
                {
                    var parent = $(this).parent();
                    $(parent).fadeOut( function()
                    {
                        $(this).remove();
                    });
                });

                $('#<?php echo esc_js($id); ?>').find('.upload_preview_container ul').sortable();
            });
        })(jQuery);
    </script>
<?php endif ?>