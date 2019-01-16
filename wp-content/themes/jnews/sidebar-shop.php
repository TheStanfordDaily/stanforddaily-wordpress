</div>

<?php
    $layout  = jnews_can_render_woo_widget();

    if ( $layout !== 'no-sidebar' )
    {
	    $sidebar = jnews_get_woo_widget();
	    $sidebar_position = '';

	    if ( $layout === 'double-sidebar' ) $sidebar_position = 'left';

        ?>
        <div id="wc-sidebar" class="jeg_sidebar <?php echo esc_attr( $sidebar_position . ' ' . jnews_get_woo_sticky_sidebar() ); ?> col-md-<?php echo esc_attr( jnews_get_woo_sidebar_width() ); ?>">
            <div class="wc-sidebar-wrapper">
			    <?php jnews_widget_area($sidebar); ?>
            </div>
        </div>
        <?php

        if ( $layout === 'double-right-sidebar' || $layout === 'double-sidebar' )
        {
	        $sidebar = jnews_get_woo_second_widget();
	        ?>
            <div id="wc-sidebar" class="jeg_sidebar right <?php echo esc_attr( jnews_get_woo_sticky_sidebar() ); ?> col-md-<?php echo esc_attr( jnews_get_woo_sidebar_width() ); ?>">
                <div class="wc-sidebar-wrapper">
			        <?php jnews_widget_area($sidebar); ?>
                </div>
            </div>
	        <?php
        }
    }
?>