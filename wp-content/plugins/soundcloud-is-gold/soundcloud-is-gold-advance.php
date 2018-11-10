<?php
function soundcloud_is_gold_advance_options() {

  //Output Options Header
  soundcloud_options_header();
  ?>

  <form method="post" action="options.php" id="soundcloudMMMainForm" name="soundcloudMMMainForm" class="">
  <p class="hidden soundcloudMMId" id="soundcloudMMId-<?php echo $soundcouldMMId ?>"><?php echo $soundcouldMMId ?></p>
    <?php settings_fields('soundcloud_is_gold_options'); ?>
    <ul id="soundcloudMMSettings">
      <!-- Color and Classes -->
      <li class="soundcloudMMBox"><label class="optionLabel">Soundcloud</label>
        <ul class="subSettings texts">
          <li class="clear">
            <label>Your API key</label>
            <input class="soundcloudMMInput soundcloudMMClasses" type="text" name="soundcloud_is_gold_options[soundcloud_is_gold_classes]" value="<" />
          </li>
        </ul>
      </li>
    </ul>
  </form>

  <?php
  //Output Options Footer
  soundcloud_options_footer();
}
?>
