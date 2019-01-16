<?php
$index = new \JNews\Archive\IndexArchive();
get_header();
?>

    <div class="jeg_main <?php $index->main_class(); ?>">
		<div class="jeg_container">
			<div class="jeg_content">
				<div class="jeg_vc_content">
					<?php
						$index->render_top_content();
					?>
				</div>
				<div class="jeg_section">
					<div class="container">
						<div class="jeg_cat_content row">
							<div class="jeg_main_content col-sm-<?php echo esc_attr($index->get_content_width()); ?>">
								<div class="jnews_index_content_wrapper">
									<?php echo jnews_sanitize_output( $index->render_content() ); ?>
								</div>

								<?php echo jnews_sanitize_output( $index->render_navigation() ); ?>
							</div>
							<?php $index->render_sidebar(); ?>
						</div>
					</div>
				</div>

			</div>
			<?php do_action('jnews_after_main'); ?>
		</div>
	</div>

<?php get_footer(); ?>