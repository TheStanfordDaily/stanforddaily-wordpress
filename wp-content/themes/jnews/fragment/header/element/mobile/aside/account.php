<?php
    add_filter('jnews_can_render_account_popup', '__return_true');
    do_action('jnews_push_first_load_action', array('mobile_login','login_form'));
?>
<div class="jeg_aside_item jeg_mobile_profile">
    <div class="jeg_mobile_profile_wrapper"></div>
</div>