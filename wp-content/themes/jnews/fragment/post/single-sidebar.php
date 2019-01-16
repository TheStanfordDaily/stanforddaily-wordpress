<?php
	$single = JNews\Single\SinglePost::getInstance();

	$sidebar_pos = '';	
	if ($single->get_layout() == 'double-sidebar')
	{
		$sidebar_pos = isset( $double_sidebar ) ? 'right' : 'left';
	}

?>

<div class="jeg_sidebar <?php echo esc_attr( $sidebar_pos .' '. $single->get_sticky_sidebar() ); ?> col-md-<?php echo esc_attr( $single->get_sidebar_width() ); ?>">
    <?php
        if ( isset( $double_sidebar ) )
        {
	        jnews_widget_area( $single->get_second_sidebar() );
        } else {
	        jnews_widget_area( $single->get_sidebar() );
        }
     ?>
</div>