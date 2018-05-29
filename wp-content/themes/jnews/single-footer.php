<?php
get_header();
the_post();
?>

<div class="content-placeholder">
    <div class="jeg_container">
        <div class="container">
            <div class="row">
                <div class="jeg_main_content col-md-8">
                    <div class="placeholder_title"></div>
                    <div class="placeholder_title w60"></div>
                    <div class="placeholder_img"></div>
                    <div class="placeholder_text"></div>
                    <div class="placeholder_text"></div>
                    <div class="placeholder_text"></div>
                    <div class="placeholder_text w60"></div>
                </div>
                <div class="jeg_sidebar col-md-4">
                    <div class="placeholder_widget"></div>
                    <div class="placeholder_text"></div>
                    <div class="placeholder_text w60"></div>
                    <br>
                    <div class="placeholder_widget"></div>
                    <div class="placeholder_text"></div>
                    <div class="placeholder_text w60"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-holder" id="footer" data-id="footer">
    <div class="jeg_footer jeg_footer_custom">
        <div class="jeg_container">
            <div class="jeg_content">
                <div class="jeg_vc_content">
                    <?php
                    $footer_builder = JNews\Footer\FooterBuilder::getInstance();
                    $footer_builder->set_on_footer();
                    $footer = $footer_builder->get_footer_page_id();

                    the_content();

                    $footer_builder->not_on_footer();
                    ?>
                </div>
            </div>
        </div>
    </div><!-- /.footer -->
</div>

</div>

<?php
    wp_footer()
?>
</body>
</html>
