<?php
get_header();
the_post();
?>

    <div class="jeg_main">
        <div class="jeg_container">

            <div class="jeg_content jeg_singlepage">
                <div class="container">

                    <div class="row">

                        <div class="jeg_main_content col-md-12">

                            <div class="entry-header">
                                <h1 class="jeg_post_title"><?php the_title(); ?></h1>
                            </div>

                            <div class="entry-content">
                                <div class="content-inner">
                                    <?php the_content(); ?>
                                    <?php wp_link_pages(); ?>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <?php do_action('jnews_after_main'); ?>
        </div>
    </div>

<?php get_footer();