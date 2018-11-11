<?php
// Adapted from https://www.cssigniter.com/how-to-add-a-custom-user-field-in-wordpress/

$theDailySections = ["news" => "News",
                    "al" => "Arts and Life",
                    "op" => "Opinions",
                    "grind" => "The Grind",
                    "sports" => "Sports",
                    "copyedit" => "Copy Editing",
                    "multimedia" => "Multimedia"];

$tsd_author_custom_fields = [
    "blurb" => ["title" => "Blurb", "type" => "textarea"],
    "hometown" => ["title" => "Hometown"],
    "timeAtDaily" => ["title" => "Time at the Daily"],
    "tapOrder" => ["title" => "Favorite TAP Order"],
    "diningHall" => ["title" => "Dining Hall"],
    "studySpot" => ["title" => "Study Spot"],
    "findYou" => ["title" => "Find You"],
    "section" => ["title" => "Your Section(s)", "type" => "checkbox", "choices" => $theDailySections]
];

function tsd_authors_plugin_add_custom_fields()
{
    add_action('show_user_profile', 'tsd_authors_plugin_show_extra_profile_fields');
    add_action('edit_user_profile', 'tsd_authors_plugin_show_extra_profile_fields');

    function tsd_authors_plugin_show_extra_profile_fields($user)
    {
        global $tsd_author_custom_fields;
        ?>
	<h2><?php esc_html_e('Mobile App Author Information');?></h2>

	<table class="form-table">
        <?php foreach ($tsd_author_custom_fields as $field => $fieldOptions) {
            $name = "tsd_" . $field;
            $value = esc_attr(get_the_author_meta($name, $user->ID));
            ?>
		<tr>
            <th>
                <label for="<?php echo $name; ?>">
                    <?php echo $fieldOptions["title"] ?? $field; ?>
                </label>
            </th>
			<td>
                <?php $fieldType = $fieldOptions["type"] ?? "text";
                switch ($fieldType) {
                    case 'textarea': ?>
                    <textarea
                    name="<?php echo $name; ?>"
                    id="<?php echo $name; ?>"
                    rows="5"
                    cols="30"
                    ><?php echo $value; ?></textarea>
                    <?php break;
                    case 'checkbox':
                    // Ref: https://stackoverflow.com/a/14873743/2603230
                    $userSections = get_user_meta( $user->ID, $name, true );
                    foreach($fieldOptions["choices"] as $thisKey => $thisValue) { ?>
                        <label><input type="checkbox" name="<?php echo $name; ?>[<?php echo $thisKey; ?>]" <?php if (in_array($thisKey, $userSections)) { ?>checked="checked"<?php }?> /> <?php echo $thisValue; ?></label><br />
                    <?php }
                    break;
                    default: ?>
                    <input type="text"
                    class="regular-text"
                    name="<?php echo $name; ?>"
                    id="<?php echo $name; ?>"
                    value="<?php echo $value; ?>"
                    />
                    <?php break;
                } ?>
			</td>
        </tr>
        <?php }?>
	</table>
	<?php
}

    add_action('user_profile_update_errors', 'tsd_authors_plugin_user_profile_update_errors', 10, 3);
    function tsd_authors_plugin_user_profile_update_errors($errors, $update, $user)
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

    add_action('personal_options_update', 'tsd_authors_plugin_update_profile_fields');
    add_action('edit_user_profile_update', 'tsd_authors_plugin_update_profile_fields');

    function tsd_authors_plugin_update_profile_fields($user_id)
    {
        global $tsd_author_custom_fields;
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }

        //if (!empty($_POST['year_of_birth']) && intval($_POST['year_of_birth']) >= 1900) {
        foreach ($tsd_author_custom_fields as $field => $fieldOptions) {
            if ($fieldOptions["type"] == "checkbox") {
                update_user_meta($user_id, 'tsd_' . $field, array_keys($_POST['tsd_' . $field]));
                continue;
            }
            if (isset($_POST['tsd_' . $field])) {
                update_user_meta($user_id, 'tsd_' . $field, $_POST['tsd_' . $field]);
            }
        }
        //}
    }
}
?>
