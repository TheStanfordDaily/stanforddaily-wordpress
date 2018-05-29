<?php
    add_filter('jnews_can_render_account_popup', '__return_true');
    do_action('jnews_push_first_load_action', array('desktop_login', 'login_form'));
?>
<div class="jeg_nav_item jeg_nav_account">
    <ul class="jeg_accountlink jeg_menu">
        <li>
            <i class="fa fa-spinner fa-spin fa-fw"></i>
        </li>
    </ul>
</div>