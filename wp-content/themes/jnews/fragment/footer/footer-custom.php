<div class="jeg_footer jeg_footer_custom">
    <div class="jeg_container">
        <div class="jeg_content">
            <div class="jeg_vc_content">
                <?php
                    $footer_builder = JNews\Footer\FooterBuilder::getInstance();
                    $footer_builder->set_on_footer();
                    $footer_builder->render_footer();
                    $footer_builder->not_on_footer();
                ?>
            </div>
        </div>
    </div>
</div><!-- /.footer -->