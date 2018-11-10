<?php
$soundcloudIsGoldAdvancedPlayerDefault = array(
    'checkboxes' => array(        
            'buying' => array('label' => 'Show/Hide Buying', 'slug' => 'Buying', 'value' => TRUE, 'type' => 'checkboxes'),
            'sharing' => array('label' => 'Show/Hide Sharing', 'slug' => 'Sharing', 'value' => TRUE, 'type' => 'checkboxes'),
            'show_bpm' => array('label' => 'Show/Hide Bpm', 'slug' => 'bpm', 'value' => TRUE, 'type' => 'checkboxes'),
            'show_playcount' => array('label' => 'Show/Hide Playcount', 'slug' => 'Playcount', 'value' => TRUE, 'type' => 'checkboxes'),
            'enable_api' => array('label' => 'Enable API', 'slug' => 'Api', 'value' => FALSE, 'type' => 'checkboxes'),
            'single_active' => array('label' => 'Single Active', 'slug' => 'SingleActive', 'value' => FALSE, 'type' => 'checkboxes'),
            'show_user' => array('label' => 'Show/Hide User', 'slug' => 'User', 'value' => TRUE, 'type' => 'checkboxes')
         ),
    'texts' => array(
            'theme_color' => array('label' => 'Theme Color', 'slug' => 'ThemeColor', 'value' => '', 'type' => 'colorPicker'),
            'text_buy_track' => array('label' => 'Text buy track', 'slug' => 'TextBuyTrack', 'value' => '', 'type' => 'texts'),
            'text_buy_set' => array('label' => 'Text buy set', 'slug' => 'TextBuySet', 'value' => '', 'type' => 'texts'),
            'text_download_track' => array('label' => 'Text download track', 'slug' => 'TextDownloadTrack', 'value' => '', 'type' => 'texts'),
            'start_track' => array('label' => 'Start Track', 'slug' => 'StartTrack', 'value' => '', 'type' => 'texts'),
            'height' => array('label' => 'Height', 'slug' => 'Height', 'value' => '', 'type' => 'texts'),
            'font' => array('label' => 'Font', 'slug' => 'Font', 'value' => '', 'type' => 'texts')
        )
);
add_option('soundcloud_is_gold_advanced_player', $soundcloudIsGoldAdvancedPlayerDefault);

/* Default Settings */
$soundcloudIsGoldAdvancedPlayer = get_option('soundcloud_is_gold_advanced_player');
printl($soundcloudIsGoldAdvancedPlayer);
?>
<div id="soundcloudMMAdvancedSettingsOptions" class="subSettings">
    <a href="#" title="bring it on!" id="soundcloudMMAdvancedSettingsShowHide" class="soundcloudMMAdvancedSettingsShowHide">I'm a grown up, show me those Advanced Options!</a>
    <div class="soundcloudMMAdvancedSettingsPanels">
        <?php foreach($soundcloudIsGoldAdvancedPlayer as $topKey => $advancePlayerOptions) : ?>
        <ul class="subSettings <?php echo $topKey ?>">
            <?php foreach($advancePlayerOptions as $key => $advancePlayerOption) : ?>
                
                <!-- ColorPicker Field -->
                <?php if(isset($advancePlayerOption['type']) && $advancePlayerOption['type'] == 'colorPicker') :?>
                <li>
                    <label for="soundcloudMM<?php echo $advancePlayerOption['slug'] ?>"><?php echo $advancePlayerOption['label'] ?></label>
                    <div class="soundcloudMMColorPickerContainer" id="soundcloudMMColorPickerContainer">
                        <input type="text" class="soundcloudMMInput soundcloudMMColor soundcloudMM<?php echo $advancePlayerOption['slug'] ?>" id="soundcloudMM<?php echo $advancePlayerOption['slug'] ?>" name="soundcloud_is_gold_advanced_player[<?php echo $topKey ?>][<?php echo $key ?>][value]" value="<?php echo $advancePlayerOption['value'] ?>" style="background-color:<?php echo $advancePlayerOption['value'] ?>"/><a href="#" class="soundcloudMMBt soundcloudMMBtSmall inline blue soundcloudMMRounder soundcloudMMResetColor">reset to default</a>
                        <div id="soundcloudMMColorPicker" class="shadow soundcloudMMColorPicker"><div id="soundcloudMMColorPickerSelect" class="soundcloudMMColorPickerSelect"></div><a id="soundcloudMMColorPickerClose" class="blue soundcloudMMBt soundcloudMMColorPickerClose">done</a></div>
                    </div>
                </li>
                <?php endif; ?>
                
                <!-- Text Fields -->
                <?php if(isset($advancePlayerOption['type']) && $advancePlayerOption['type'] == 'texts' && $key != 'start_track') :?>
                <li><label for="soundcloudMM<?php echo $advancePlayerOption['slug'] ?>"><?php echo $advancePlayerOption['label'] ?></label><input type="text" value="<?php echo $advancePlayerOption['value'] ?>" name="soundcloud_is_gold_advanced_player[<?php echo $topKey ?>][<?php echo $key ?>][value]" class="soundcloudMMInput soundcloudMM<?php echo $advancePlayerOption['slug'] ?>" id="soundcloudMM<?php echo $advancePlayerOption['slug'] ?>" /></li>
                <?php endif; ?>
                
                <!-- Checkboxes Fields -->    
                <?php if(isset($advancePlayerOption['type']) && $advancePlayerOption['type'] == 'checkboxes') :?>
                <li><input type="checkbox" <?php echo (isset($advancePlayerOption['value']) && $advancePlayerOption['value']) ? 'checked="checked"' : ''?> name="soundcloud_is_gold_advanced_player[<?php echo $topKey ?>][<?php echo $key ?>][value]" value="true" class="soundcloudMM<?php echo $advancePlayerOption['slug'] ?>" id="soundcloudMM<?php echo $advancePlayerOption['slug'] ?>"/><label for="soundcloudMM<?php echo $advancePlayerOption['slug'] ?>"><?php echo $advancePlayerOption['label'] ?></label></li>
                <?php endif; ?>
               
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
    </div>
</div>