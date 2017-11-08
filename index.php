<?php get_header(); ?>

	<?php
		if( tie_get_option( 'slider_pos' ) == 'big') {
			get_template_part('includes/slider');// Get Slider template
			echo '<aside id="top-headlines-area">'; 
			echo '<aside id="sidebar">';
			echo '&nbsp';		
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Top Headlines') ); //Add Top Headlines "sidebar"
			echo '</aside>';
			echo '</aside>';
		}
	?>
	
	<?php 
		if( tie_get_option( 'slider_pos' ) != 'big') {
			echo '<div class="content">';
			get_template_part('includes/slider'); // Get Slider template 
			echo '</div>';
			echo '<aside id="top-headlines-area">'; 
			echo '<aside id="sidebar">';		
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Top Headlines') ); //Add Top Headlines "sidebar"
			echo '</aside>';
			echo '</aside>';
		}
	?>

<div class="content">

	<?php
	if( tie_get_option('on_home') != 'boxes' ){

		get_template_part( 'loop', 'index' );
		if ($wp_query->max_num_pages > 1) tie_pagenavi();

	}else{
		
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Frontpage Top Widgets') ) {}
		$cats = get_option( 'tie_home_cats' ) ;
		if($cats)
			foreach ($cats as $cat)	tie_get_home_cats($cat);
		else _e( 'You can use Homepage builder to build your homepage', 'tie' );

		tie_home_tabs();

		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Frontpage Bottom Widgets') ) {}
	}
	?>		
</div><!-- .content /-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
