<?php
    $feed = new \JNews\Sidefeed\Sidefeed();
    if($feed->can_render())
    {
        $content = $feed->get_side_feed_content();
?>
        <div id="jeg_sidecontent">
            <div class="jeg_side_heading">
                <ul class="jeg_side_tabs">
                    <?php echo  $feed->render_side_feed_tab(); ?>
                </ul>
                <div class="jeg_side_feed_cat_wrapper">
                    <?php echo jnews_sanitize_output($feed->render_side_feed_category_button()); ?>
                </div>
                <?php echo jnews_sanitize_output($feed->render_side_feed_script()); ?>
            </div>

            <div class="sidecontent_postwrapper">
                <div class="jeg_sidefeed">
                    <?php echo jnews_sanitize_output($content['content']); ?>
                </div>
                <div class="sidefeed_loadmore">
                    <button class="btn <?php echo ( $content['next'] ) ? "" : "btn-end"; ?>" data-end="<?php jnews_print_translation('End of Content', 'jnews', 'end_of_content') ?>" data-loading="<?php jnews_print_translation('Loading...', 'jnews', 'loading') ?>" data-loadmore="<?php jnews_print_translation('Load More', 'jnews', 'load_more') ?>">
                        <?php
                            if($content['next']) {
                                jnews_print_translation('Load More', 'jnews', 'load_more');
                            } else {
                                jnews_print_translation('End of Content', 'jnews', 'end_of_content');
                            }
                        ?>
                    </button>
                </div>
            </div>
            <div class="jeg_sidefeed_overlay">
                <div class='preloader_type preloader_<?php echo esc_html(get_theme_mod('jnews_sidefeed_loader', 'dot')); ?>'>
                    <div class="sidefeed-preloader jeg_preloader dot">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="sidefeed-preloader jeg_preloader circle">
                        <div class="jnews_preloader_circle_outer">
                            <div class="jnews_preloader_circle_inner"></div>
                        </div>
                    </div>
                    <div class="sidefeed-preloader jeg_preloader square">
                        <div class="jeg_square"><div class="jeg_square_inner"></div></div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>

