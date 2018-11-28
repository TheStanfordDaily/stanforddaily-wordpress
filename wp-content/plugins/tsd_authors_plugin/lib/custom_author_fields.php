<?php
// Adapted from https://www.cssigniter.com/how-to-add-a-custom-user-field-in-wordpress/

$theDailySections = ["news" => "News",
    "al" => "Arts and Life",
    "op" => "Opinions",
    "grind" => "The Grind",
    "sports" => "Sports",
    "copyedit" => "Copy Editing",
    "multimedia" => "Multimedia",
    "graphics" => "Graphics",
    "yearbook" => "Yearbook",
    "tech" => "Tech",
    "photo" => "Photo"];

$tsd_author_custom_fields = [
    "coverImage" => ["title" => "Cover Image", "type" => "image"],
    "funnyImage" => ["title" => "Funny Image", "type" => "image"],
    "profileImage" => ["title" => "Profile Image", "type" => "image"],
    "blurb" => ["title" => "Blurb", "type" => "textarea"],
    "hometown" => ["title" => "Hometown"],
    "timeAtDaily" => ["title" => "Time at the Daily"],
    "tapOrder" => ["title" => "Favorite TAP Order"],
    "diningHall" => ["title" => "Dining Hall"],
    "studySpot" => ["title" => "Study Spot"],
    "findYou" => ["title" => "Find You"],
    "section" => ["title" => "Your Section(s)", "type" => "checkbox", "choices" => $theDailySections],
];

// https://wordpress.stackexchange.com/a/233212/75147
add_action('admin_enqueue_scripts', 'tsd_authors_plugin_load_wp_media_files');
function tsd_authors_plugin_load_wp_media_files($page)
{
    if ($page == 'profile.php' || $page == 'user-edit.php') {
        wp_enqueue_media();
        wp_enqueue_script('tsd_authors_plugin_load_wp_media_script', plugins_url('/upload.js', __FILE__), ['jquery'], '0.1');
    }
}

function tsd_authors_plugin_add_custom_fields()
{
    add_action('show_user_profile', 'tsd_authors_plugin_show_extra_profile_fields');
    add_action('edit_user_profile', 'tsd_authors_plugin_show_extra_profile_fields');

    function tsd_authors_plugin_show_extra_profile_fields($user)
    {
        global $tsd_author_custom_fields;
        ?>
	<h2><?php esc_html_e('Mobile App Author Information');?></h2>

    <style>
    .user-preview-image {
        display: block;
        max-height: 200px;
        width: auto;
    }
    </style>
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
                    $userSections = get_user_meta($user->ID, $name, true);
                    foreach ($fieldOptions["choices"] as $thisKey => $thisValue) {?>
                        <label><input type="checkbox" name="<?php echo $name; ?>[<?php echo $thisKey; ?>]" <?php if (is_array($userSections) && in_array($thisKey, $userSections)) {?>checked="checked"<?php }?> /> <?php echo $thisValue; ?></label><br />
                    <?php }
                    break;
                case 'image':
                    // https://wordpress.stackexchange.com/a/233212/75147
                    $image_id = get_user_meta($user->ID, $name, true);
                    if (intval($image_id) > 0) {
                        // Change with the image size you want to use
                        $image = wp_get_attachment_image($image_id, 'medium', false, ['class' => 'user-preview-image', 'id' => $name]);
                    } else {
                        $image = '<img class="user-preview-image" id="' . $name . '" />';
                    }?>
                    <div class="tsd-authors-plugin-image-upload-options">
                        <input type="hidden" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr(get_the_author_meta($name, $user->ID)); ?>" class="regular-text" />
                        <input type="button" class="button-primary" value="Upload Image" id="selectimage" data-field-id="<?php echo $name; ?>" /><br /><br />
                        <?php echo $image; ?><span id="<?php echo $name; ?>-loading"></span>
                    </div>
                    <?php
break;
                default: ?>
                    <input type="text"
                    class="regular-text"
                    name="<?php echo $name; ?>"
                    id="<?php echo $name; ?>"
                    value="<?php echo $value; ?>"
                    />
                    <?php break;
            }?>
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

    // https://wordpress.stackexchange.com/a/233212/75147
    // Ajax action to refresh the user image
    add_action('wp_ajax_cyb_get_image_url', 'tsd_authors_plugin_cyb_get_image_url');
    function tsd_authors_plugin_cyb_get_image_url()
    {
        if (isset($_GET['id'])) {
            $image = wp_get_attachment_image(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT), 'medium', false, ['class' => 'user-preview-image', 'id' => $_GET['fieldId']]);
            $data = [
                'image' => $image,
                'fieldID' => $_GET['fieldId'],
            ];
            wp_send_json_success($data);
        } else {
            wp_send_json_error();
        }
    }
}
