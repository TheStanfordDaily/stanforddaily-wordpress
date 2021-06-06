<?php
if($filebird_activation_error != '') {
  $filebird_activation_error = apply_filters('filebird_activation_error', $filebird_activation_error);
  if($filebird_activation_error == 'no-purchase') {
    $filebird_activation_error = __('It seems you don\'t have any valid FileBird license. Please <a href="https://ninjateam.org/support" target="_blank">contact support</a> to get help or <a href="https://1.envato.market/Get-FileBird" target="_blank">purchase a FileBird license</a>', 'filebird');
  }
  ?>
  <div class="notice notice-warning is-dismissible">
    <h3><?php _e('Oops! Activation failed.', 'filebird'); ?></h3>
    <p>
      <?php echo $filebird_activation_error; ?>
    </p>
  </div>
  <?php
}
?>