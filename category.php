<?php get_header(); ?>
<?php 
		$category_id = get_query_var('cat') ; 
		$cat_options = get_option( "tie_cat_$category_id");

		if ($cat_options['cat_ubergrid']) {
			switch ($category_id) {
				case 23: /* Sports */
					echo ubergrid(1096597);
					break;	
				case 25: /* A&L */
					echo ubergrid(1096423);
					break;
				case 3: /* News */
					echo ubergrid(1096611);
					break;
				case 632: /* Football */
					echo ubergrid(1096714);
					break;
				case 626: /* Baseball */
					echo ubergrid(1096715);
					break;
				case 627: /* Men's basketball */
					echo ubergrid(1096716);
					break;
				case 628: /* Women's basketball */
					echo ubergrid(1096717);
					break;
				default:
					break;
			}
		}
?>
	<div class="content">
	<?php tie_breadcrumbs() ?>
		<?php $category_id = get_query_var('cat') ; ?>
		<div class="page-head">
			<h1 class="page-title">
				<?php echo single_cat_title( '', false ) ?>
			</h1>
			<?php if( tie_get_option( 'category_rss' ) ): ?>
			<a class="rss-cat-icon ttip" title="<?php _e( 'Feed Subscription', 'tie' ); ?>" href="<?php echo get_category_feed_link($category_id) ?>"></a>
			<?php endif; ?>
			<div class="stripe-line"></div>

			<?php
			if( tie_get_option( 'category_desc' ) ):	
				$category_description = category_description();
				if ( ! empty( $category_description ) )
				echo '<div class="clear"></div><div class="archive-meta">' . $category_description . '</div>';
			endif;
			?>
		</div>
		<?php get_template_part( 'includes/slider-category' ); ?>
		
		<?php
		if ($cat_options['cat_blog_style']):
			get_template_part('loop-blog', 'category');
		else:
			get_template_part( 'loop', 'category' );
		endif;
		?>
		<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>
		
	</div> <!-- .content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
