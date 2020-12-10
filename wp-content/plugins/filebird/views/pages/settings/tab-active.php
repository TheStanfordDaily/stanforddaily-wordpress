<h1><?php _e('Active', 'filebird'); ?></h1>
        <table class="form-table njt-fb-import-tbl">
            <tbody>
                <tr>
                    <th scope="row">
                      <label for="">
                        <?php _e('Purchase Code', 'filebird'); ?>
                      </label>
                      
                    </th>
                    <td>
                      <input type="text" name="fb_purchase_code" class="regular-text" value="<?php echo esc_attr(get_option('fb_purchase_code')); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                      <label for="">
                        <?php _e('Personal Access Token', 'filebird'); ?>
                      </label>
                      
                    </th>
                    <td>
                      <input type="text" name="fb_envato_token" class="regular-text" value="<?php echo esc_attr(get_option('fb_envato_token')); ?>" />
                      <p><?php echo sprintf(__('Get one <a href="javascript:void(0)" class="login_envato_now">here</a>')); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    </th>
                    <td>
                      <button type="button" class="button button-primary fb_active_license"> <?php _e('Active', 'filebird'); ?></button>
                    </td>
                </tr>
            </tbody>
        </table>