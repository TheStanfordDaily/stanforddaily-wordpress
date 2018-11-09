<?php
// Adapted from https://www.cssigniter.com/how-to-add-a-custom-user-field-in-wordpress/

$tsd_author_custom_fields = array(
    "blurb" => array("title" => "Blurb", "type" => "textarea"),
    "hometown" => array("title" => "Hometown"),
    "timeAtDaily" => array("title" => "Time at the Daily"),
    "tapOrder" => array("title" => "Favorite TAP Order"),
    "diningHall" => array("title" => "Dining Hall"),
    "studySpot" => array("title" => "Study Spot"),
    "findYou" => array("title" => "Find You"),
);

function tsd_authors_plugin_add_custom_fields()
{
    add_action('show_user_profile', 'crf_show_extra_profile_fields');
    add_action('edit_user_profile', 'crf_show_extra_profile_fields');

    function crf_show_extra_profile_fields($user)
    {
        global $tsd_author_custom_fields;
        ?>
	<h3><?php esc_html_e('Mobile App Author Information', 'crf');?></h3>

	<table class="form-table">
        <?php foreach ($tsd_author_custom_fields as $field => $fieldOptions) {
            $name = "tsd_" . $field;
            $value = esc_attr(get_the_author_meta("tsd_" . $field, $user->ID));
            ?>
		<tr>
            <th>
                <label for="<?php echo "tsd_" . $field; ?>">
                    <?php echo isset($fieldOptions["title"]) ? $fieldOptions["title"] : $field; ?>
                </label>
            </th>
			<td>
                <?php if (isset($fieldOptions["type"]) && $fieldOptions["type"] == "textarea") {?>
                    <textarea
			       name="<?php echo $name; ?>"
                    ><?php echo $value; ?></textarea>
                <?php } else {?>
                    <input type="text"
                    name="<?php echo $name; ?>"
                    value="<?php echo $value; ?>"
                    />
                <?php }?>
			</td>
        </tr>
        <?php }?>
	</table>
	<?php
}

    add_action('user_profile_update_errors', 'crf_user_profile_update_errors', 10, 3);
    function crf_user_profile_update_errors($errors, $update, $user)
    {
        if (!$update) {
            return;
        }

        // if (empty($_POST['year_of_birth'])) {
        //     $errors->add('year_of_birth_error', __('<strong>ERROR</strong>: Please enter your year of birth.', 'crf'));
        // }

        // if (!empty($_POST['year_of_birth']) && intval($_POST['year_of_birth']) < 1900) {
        //     $errors->add('year_of_birth_error', __('<strong>ERROR</strong>: You must be born after 1900.', 'crf'));
        // }
    }

    add_action('personal_options_update', 'crf_update_profile_fields');
    add_action('edit_user_profile_update', 'crf_update_profile_fields');

    function crf_update_profile_fields($user_id)
    {
        global $tsd_author_custom_fields;
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }

        //if (!empty($_POST['year_of_birth']) && intval($_POST['year_of_birth']) >= 1900) {
        foreach ($tsd_author_custom_fields as $field => $fieldOptions) {
            if (isset($_POST['tsd_' . $field])) {
                update_user_meta($user_id, 'tsd_' . $field, $_POST['tsd_' . $field]);
            }
        }
        //}
    }
}
?>