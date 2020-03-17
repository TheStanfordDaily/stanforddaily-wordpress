<?php
class TSD_REST_Jobs_Controller extends WP_REST_Controller {
	/**
	 * The namespace.
	 *
	 * @var string
	 */
	protected $namespace;
	/**
	 * Rest base for the current object.
	 *
	 * @var string
	 */
    protected $rest_base;
    
    /* Custom post type name.
     */
    protected $custom_post_type;

    protected $viewable_meta_fields;

    protected $editable_meta_fields;

    protected $required_keys;

    protected $meta_prefix;
    
    public function __construct($namespace, $rest_base, $custom_post_type) {
        $this->namespace = $namespace;
        $this->rest_base = $rest_base;
        $this->custom_post_type = $custom_post_type;
        $this->viewable_meta_fields = array("jobType", "companyName", "companySite", "jobLocation", "appInstructions");
        $this->editable_meta_fields = array("jobType", "companyName", "companySite", "jobLocation", "appInstructions");
        $this->required_keys = array("jobType", "jobTitle", "companyName", "companySite", "jobLocation", "jobDescription", "appInstructions");
        $this->meta_prefix = "tsd_";
    }

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {

		register_rest_route( $this->namespace, '/' . $this->rest_base, 	array(
            'methods'             => WP_REST_Server::READABLE,
            'callback'            => array( $this, 'get_items' ),
            'permission_callback' => array( $this, 'get_items_permissions_check' ),
        ) );
        
        register_rest_route( $this->namespace, '/' . $this->rest_base, [
            'methods' => WP_REST_Server::EDITABLE,
            'callback' => array( $this, 'add_item' ),
            'permission_callback' => array( $this, 'add_item_permissions_check' ),
         ] );

        register_rest_route( $this->namespace, '/' . $this->rest_base . '/(?P<id>\d+)', [
            'methods' => WP_REST_Server::READABLE,
            'callback' => array( $this, 'get_item' ),
            'permission_callback' => array( $this, 'get_item_permissions_check' ),
            'args' => [
                'id'
             ],
         ] );

	}
	/**
	 * Check permissions for the read.
	 *
	 * @param WP_REST_Request $request get data from request.
	 *
	 * @return bool|WP_Error
	 */
	public function get_items_permissions_check( $request ) {
		return true;
    }
    
    public function get_item_permissions_check( $request ) {
		return true;
	}
	/**
	 * Check permissions for the update
	 *
	 * @param WP_REST_Request $request get data from request.
	 *
	 * @return bool|WP_Error
	 */
	public function add_item_permissions_check( $request ) {
		return true;
	}
	/**
	 * Get jobs.
	 */
	public function get_items( $request ) {

        $args = array(  
            'post_type' => $this->custom_post_type,
            // 'post_status' => 'publish',
            'posts_per_page' => 10
        );
    
        $posts = new WP_Query( $args );
        $res = array();
        foreach($posts->get_posts() as $post) {
            $res[] = $this->encode_post_to_json_obj($post);
        }

		return rest_ensure_response( $res );
    }

    /**
     * Get a single job by ID.
     */
	public function get_item( $request ) {

        $args = array(  
            'post_type' => $this->custom_post_type,
            'p' => $request->get_param("id"),
            'posts_per_page' => 1,
            'post_status' => array('draft', 'publish')
        );
    
        $posts = new WP_Query( $args );
        foreach($posts->get_posts() as $post) {
            $res = $this->encode_post_to_json_obj($post);
            return rest_ensure_response( $res );
        }

		return new WP_REST_Response(esc_html__("Job not found."), 404);
    }

	/**
	 * Create a new job, making its status "draft" (awaiting manual approval).
	 */
	public function add_item( $request ) {

        /*
            jobType: "Internship"
            jobTitle: "as"
            companyName: "test"
            companySite: "esolutions.com"
            companyLogo: "data:application/pdf;name=2020-02-24%20%E2%80%94%2"
            jobLocation: "atl, GA"
            jobDescription: "asdsad"
            appInstructions: "asdasdasd"
        */

        $body = json_decode($request->get_body(), true);
        foreach ($this->required_keys as $required_key) {
            if (!array_key_exists($required_key, $body)) {
                return new WP_REST_Response(esc_html__("Invalid key " . $required_key), 400);
            }
        }
        
        $meta_input = array();
        foreach ($this->editable_meta_fields as $field) {
            if (array_key_exists($field, $body)) {
                $meta_input[$this->meta_prefix . $field] = esc_html($body[$field]);
            }
        }
        $args = array(
            "post_title" => esc_html($body["jobTitle"]),
            "post_content" => wp_kses_post($body["jobDescription"]),
            "post_type" => $this->custom_post_type,
            "post_status" => "draft",
            "meta_input" => $meta_input
        );
        $post_id = wp_insert_post($args);
        if ($post_id == 0) {
            return new WP_Error('tsd_job_create_error', 'Error creating job');
        }
		return rest_ensure_response( array("id" => $post_id) );
    }
    
    /* Encode a job (Post) object to a json object.
     */
    function encode_post_to_json_obj($post) {
        $item = array(
            "id" => $post->ID,
            "jobDescription" => $post->post_content,
            "jobTitle" => $post->post_title,
            "post_status" => $post->post_status
            // "companyLogo" => 
        );
        foreach ($this->viewable_meta_fields as $field) {
            $item[$field] = get_post_meta($post->ID, $this->meta_prefix . $field, true);
        }
        return $item;
    }

}
?>