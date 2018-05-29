<div class="nav_wrap">
    <div class="item_main">
        <?php
            $elements = get_theme_mod('jnews_hb_element_mobile_drawer_top_center', jnews_header_default("drawer_element_top"));
            foreach($elements as $element)
            {
                get_template_part('fragment/header/element/mobile/aside/' . $element);
            }
        ?>
    </div>
    <div class="item_bottom">
        <?php
            $elements = get_theme_mod('jnews_hb_element_mobile_drawer_bottom_center', jnews_header_default("drawer_element_bottom"));
            foreach($elements as $element)
            {
                get_template_part('fragment/header/element/mobile/aside/' . $element);
            }
        ?>
    </div>
</div>