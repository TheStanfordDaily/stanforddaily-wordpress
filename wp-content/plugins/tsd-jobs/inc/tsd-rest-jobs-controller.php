<?php
class TSD_REST_Jobs_Controller extends WP_REST_Posts_Controller {
    
    public function __construct( $post_type ) {
        parent::__construct($post_type);
        $this->namespace = "tsd/v1";
    }

    public function create_item_permissions_check( $request ) {
        return true;
    }

}
?>