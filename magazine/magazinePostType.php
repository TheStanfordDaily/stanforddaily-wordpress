<?php
/* Description: Registers custom post type for magazine post, exposes them to the API, and adds a page through which the custom post types can be moved from the regular posts containing "magazine" in their title.
 * Author: Ashwin Ramaswami
 * Date: 11/8/2017
 */

function tsd_magazine_post_type_init()
{
    register_post_type('tsd_magazine_post',
                       [
                           'labels'      => [
                               'name'          => __('Magazine Posts'),
                               'singular_name' => __('Magazine Post'),
                           ],
                           'public'      => true,
                           'taxonomies' => array('post_tag','category'),
			   'supports' => array('title','editor', 'thumbnail', 'author'),
                           'has_archive' => true,
                           'menu_position'=> 3,
                           'show_in_rest' => true,
                           'rest_base'          => 'tsd_magazine_posts',
  							'rest_controller_class' => 'WP_REST_Posts_Controller'
  							/*
								REST API can be accessed at http://stanforddaily.com/wp-json/wp/v2/tsd_magazine_posts/
  							*/
                       ]
    );
}
add_action('init', 'tsd_magazine_post_type_init');

function add_submenu_import_drafts_page() {
	add_submenu_page('edit.php?post_type=tsd_magazine_post', __('Import drafts'), __('Import drafts'), 'manage_options', 'magazinepostsimport', 'tsd_magazine_post_import_page', 3);
}

add_action('admin_menu', 'add_submenu_import_drafts_page');

function tsd_get_posts_of_posttype_like($postType, $magazine = false) {
	
	global $wpdb;
	$postType = esc_sql($postType);
	$magazineQuery = "";
	if ($magazine) {
		$magazineQuery = "and LOWER(POST_TITLE) LIKE '%magazine%' and post_status='draft'";
	}
	$query = "select post_title,post_type,post_author,post_status from wp_posts where POST_TYPE='{$postType}' {$magazineQuery};";
	$result = $wpdb->get_results($query, OBJECT);
	
	ob_start();
	echo "<div style='overflow:auto; height: 100px;'><table border=1>";
	foreach ( $result as $page )
	{
	   echo "<tr><td>";
	   var_dump($page);
	   echo "</td></tr>";
	}
	echo "</table></div>";
	echo $wpdb->show_errors(); 
	return ob_get_clean();
}

function tsd_switch_magazine_drafts_to($postTypeTo) {
	ob_start();
	global $wpdb;
	$postTypeTo = esc_sql($postTypeTo);
	$query = "update wp_posts set POST_TYPE='{$postTypeTo}' where POST_TYPE='post' and LOWER(POST_TITLE) LIKE '%magazine%' and post_status='draft'";
	echo $query;
	$wpdb->query("start transaction");
	$result = $wpdb->get_results($query, OBJECT);
	var_dump($wpdb->last_error);
	if ($wpdb->last_error != "") {
		$wpdb->query("rollback");
  		echo 'Error!: ' . $wpdb->last_error;
	}
	else {
		$wpdb->query("commit");
		ob_get_clean();
		header('Location: /wp-admin/edit.php?post_type=tsd_magazine_post&page=magazinepostsimport');
		die;
	}
	
	// echo "<h1>Error!!</h1>";
	echo $wpdb->show_errors(); 
	return ob_get_clean();
}

function tsd_magazine_post_import_page() {
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["action"] == "import") {
		//echo getMagazineDrafts();
		echo tsd_switch_magazine_drafts_to("tsd_magazine_post");
		return;
	}
	echo "<h1>Draft posts:</h1>";
	echo tsd_get_posts_of_posttype_like("post", true);
	echo "<h1>Magazine posts:</h1>";
	echo tsd_get_posts_of_posttype_like("tsd_magazine_post", false);
	?>
	<b>Warning: only do this if you know what you are doing. This button imports all drafts with name [magazine] into the magazine posts.</b>
	<form method="POST" action="">
		Import drafts:<br><br>
		<input type="hidden" name="action" value="import" />
		<input type="submit" class="button" value="Import drafts" />
	</form>
	<?php
}
