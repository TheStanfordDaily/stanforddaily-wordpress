<h1><?php _e('REST API', 'filebird'); ?></h1>
    <?php _e("An API to run Get folders & Set attachments", 'filebird') ?><br/>
    <?php echo __('Please see FileBird API for developers <a target="_blank" href="https://ninjateam.gitbook.io/filebird/api">here</a>.', 'filebird') ?>
    <table class="form-table">
      <tbody>
        <tr>
            <th scope="row">
              <label for="">
                <?php echo __('API key', 'filebird') ?>
              </label>
            </th>
            <td>
              <?php
              $key = get_option('fbv_rest_api_key', '');
              $classes = array('regular-text');
              if(strlen($key) == 0) {
                $classes[] = 'hidden';
              }
              $classes = array_map('esc_attr', $classes);
              ?>
              <input type="text" id="fbv_rest_api_key" class="<?php echo implode(' ', $classes); ?>" value="<?php echo esc_attr($key); ?>" onclick="this.select()" />
              <button type="button" class="button button-primary fbv_generate_api_key_now"><?php _e('Generate'); ?></button>
            </td>
        </tr>
      </tbody>
    </table>