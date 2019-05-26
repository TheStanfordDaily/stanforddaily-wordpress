<?php
class TSD_REST_Jobs_Controller extends WP_REST_Posts_Controller {
    
    public function __construct( $post_type ) {
        $this->post_type = $post_type;
        $this->namespace = 'wp/v2';
        $obj             = get_post_type_object( $post_type );
        $this->rest_base = ! empty( $obj->rest_base ) ? $obj->rest_base : $obj->name;
 
        $this->meta = new WP_REST_Post_Meta_Fields( $this->post_type );
    }

    public function create_item_permissions_check( $request ) {
        return true;
    }
}
?>