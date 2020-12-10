<h1><?php _e('Settings', 'filebird'); ?></h1>
<table class="form-table">
  <tr>
    <th scope="row">
      <label for="njt_fbv_folder_per_user"><?php _e('Each user has his own folders?', 'filebird'); ?></label>
    </th>
    <td>
      <label class="njt-switch">
        <input type="checkbox" name="njt_fbv_folder_per_user" class="njt-submittable" id="njt_fbv_folder_per_user"  value="1" <?php checked(get_option('njt_fbv_folder_per_user'), '1'); ?> />
        <span class="slider round">
          <span class="njt-switch-cursor"></span>
        </span>
      </label>
    </td>
  </tr>
  <?php
  /**
   <tr>
    <th scope="row">
      <label><?php _e('Wipe old data', 'filebird'); ?></label>
      <p class="description" style="font-weight: 400"><?php _e('This action will delete FileBird data in version 3.0 and earlier installs.', 'filebird'); ?></p>
    </th>
    <td>
    <button type="button" class="button button-primary njt_fbv_wipe_old_data"><?php _e('Wipe', 'filebird'); ?></button>
    </td>
  </tr>
    
  
  <tr>
    <th scope="row">
      <label><?php _e('Choose folder default open', 'filebird'); ?></label>
      <p class="description" style="font-weight: 400"><?php _e('', 'filebird'); ?></p>
    </th>
    <td>
    <select class="regular-text njt-submittable" name="njt_fbv_default_folder">
    <option value="-1" <?php selected(get_option('njt_fbv_default_folder'), '-1', true); ?>><?php _e('All Files', 'filebird'); ?></option>
    <?php
    foreach($allFolders as $k => $folder) {
      echo sprintf('<option value="%d" %s>%s</option>', $folder['id'], selected(get_option('njt_fbv_default_folder'), $folder['id'], false), $folder['text']);
    }
    ?>
    </select>
    </td>
  </tr>
    <tr>
    <th scope="row"><?php submit_button(); ?></th>
  </tr>
  */
  ?>
</table>