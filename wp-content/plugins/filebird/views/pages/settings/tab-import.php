<h1><?php _e('Import to FileBird', 'filebird'); ?></h1>
<p style="margin-top:0;">
  <?php _e('Import categories/folders from other plugins. We import virtual folders, your website will be safe, don\'t worry ;)', 'filebird') ?>
</p>
  <table class="form-table njt-fb-import-tbl">
      <tbody>
          <tr class="<?php echo $countEnhancedFolder <= 3 ? 'hidden' : ''; ?>">
              <th scope="row">
                <label for="">
                  <?php echo __('Enhanced Media Library plugin by wpUXsolutions', 'filebird') ?>
                </label>
                <p class="description" style="font-weight: 400">
                  <?php
                    $str = __('We found you have <strong>(%1$s)</strong> categories you created from <strong>Enhanced Media Library</strong> plugin.', 'filebird');
                    if($countEnhancedFolder > 0) {
                      $str .= __(' Would you like to import to <strong>FileBird</strong>?', 'filebird');
                    }
                    echo (sprintf($str, $countEnhancedFolder));
                  ?>
                </p>
              </th>
              <td>
                <div class="fbv-btn-wrapper-import">
                  <?php if($countEnhancedFolder > 0) : ?>
                    <button class="button button-primary button-large njt-fb-import" data-site="enhanced" type="button" data-count="<?php echo $countEnhancedFolder; ?>"><?php _e('Import Now', 'filebird') ?></button>
                  <?php endif; ?>
                </div>
              </td>
          </tr>
          <tr class="fbv-row-breakline <?php echo $countEnhancedFolder <= 3 ? 'hidden' : ''; ?>">
            <td colspan="2">
              <span class="fbv-breakline"></span>
            </td>
          </tr>
          <tr class="<?php echo $countWpmlfFolder <= 3 ? 'hidden' : ''; ?>">
              <th scope="row">
                <label for="">
                  <?php echo __('WordPress Media Library Folders by Max Foundry', 'filebird') ?>
                </label>
                <p class="description" style="font-weight: 400">
                  <?php
                    $str = __('We found you have <strong>(%1$s)</strong> categories you created from <strong>WordPress Media Library Folders</strong> plugin.', 'filebird');
                    if($countWpmlfFolder > 0) {
                      $str .= __(' Would you like to import to <strong>FileBird</strong>?', 'filebird');
                    }
                    echo (sprintf($str, $countWpmlfFolder));
                  ?>
                </p>
              </th>
              <td>
                <div class="fbv-btn-wrapper-import">
                  <?php if($countWpmlfFolder > 0) : ?>
                    <button class="button button-primary button-large njt-fb-import" data-site="wpmlf" type="button" data-count="<?php echo $countWpmlfFolder; ?>"><?php _e('Import Now', 'filebird') ?></button>
                    <?php endif; ?>
                </div>
              </td>
          </tr>
          <tr class="fbv-row-breakline <?php echo $countWpmlfFolder <= 3 ? 'hidden' : ''; ?>">
            <td colspan="2">
              <span class="fbv-breakline"></span>
            </td>
          </tr>
          <tr class="<?php echo $countWpmfFolder <= 3 ? 'hidden' : ''; ?>">
              <th scope="row">
                <label for="">
                  <?php echo __('WP Media folder by Joomunited', 'filebird') ?>
                </label>
                <p class="description" style="font-weight: 400">
                  <?php
                    $str = __('We found you have <strong>(%1$s)</strong> categories you created from <strong>WP Media folder</strong> plugin.', 'filebird');
                    if($countWpmfFolder > 0) {
                      $str .= __(' Would you like to import to <strong>FileBird</strong>?', 'filebird');
                    }
                    echo (sprintf($str, $countWpmfFolder));
                  ?>
                </p>
              </th>
              <td>
                <div class="fbv-btn-wrapper-import">
                  <?php if($countWpmfFolder > 0) : ?>
                    <button class="button button-primary button-large njt-fb-import" data-site="wpmf" type="button" data-count="<?php echo $countWpmfFolder; ?>"><?php _e('Import Now', 'filebird') ?></button>
                    <?php endif; ?>
                </div>
              </td>
          </tr>
          <tr class="fbv-row-breakline <?php echo $countWpmfFolder <= 3 ? 'hidden' : ''; ?>">
            <td colspan="2">
              <span class="fbv-breakline"></span>
            </td>
          </tr>
          <tr class="<?php echo $countRealMediaFolder <= 3 ? 'hidden' : ''; ?>">
              <th scope="row">
                <label for="">
                  <?php echo __('WP Real Media Library by devowl.io GmbH', 'filebird') ?>
                </label>
                <p class="description" style="font-weight: 400">
                  <?php
                    $str = __('We found you have <strong>(%1$s)</strong> categories you created from <strong>WP Real Media Library</strong> plugin.', 'filebird');
                    if($countRealMediaFolder > 0) {
                      $str .= __(' Would you like to import to <strong>FileBird</strong>?', 'filebird');
                    }
                    echo (sprintf($str, $countRealMediaFolder));
                  ?>
                </p>
              </th>
              <td>
                <div class="fbv-btn-wrapper-import">
                  <?php if($countRealMediaFolder > 0) : ?>
                    <button class="button button-primary button-large njt-fb-import" data-site="realmedia" type="button" data-count="<?php echo $countRealMediaFolder; ?>"><?php _e('Import Now', 'filebird') ?></button>
                    <?php endif; ?>
                </div>
              </td>
          </tr>
          <tr class="fbv-row-breakline <?php echo $countRealMediaFolder <= 3 ? 'hidden' : ''; ?>">
            <td colspan="2">
              <span class="fbv-breakline"></span>
            </td>
          </tr>
      </tbody>
  </table>