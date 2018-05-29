<div class="jeg_navbar_mobile" data-mode="<?php echo esc_attr(get_theme_mod('jnews_mobile_menu_follow', 'scroll')); ?>">
    <?php
    $mobile_height = 0;
    $rows = array('top', 'mid');
    foreach ($rows as $row)
    {
        if(jnews_can_render_header('mobile', $row)) {
            get_template_part('fragment/header/mobile-' . $row );

            if($row === 'top') {
                $mobile_height += 30;
            } else if ($row === 'mid') {
                $mobile_height += (int) get_theme_mod('jnews_header_mobile_midbar_height', 60);
            }

        }
    }
    ?>
</div>
<div class="sticky_blankspace" style="height: <?php echo esc_attr($mobile_height) ?>px;"></div>