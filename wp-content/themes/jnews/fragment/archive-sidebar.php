<div class="jeg_sidebar <?php esc_attr_e( $sidebar['position-sidebar'] . ' ' . $sidebar['sticky-sidebar'] ); ?> col-sm-<?php esc_attr_e($sidebar['width-sidebar']); ?>">
    <?php jnews_widget_area( $sidebar['content-sidebar'] ); ?>
</div>