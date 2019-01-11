<?php
/* Template Name: Test Template */
get_header();
the_post();
$single = new \JNews\Single\SinglePage();
?>

    <div class="jeg_main <?php $single->main_class(); ?>">
        <div class="jeg_container">

            <div class="jeg_content jeg_singlepage">
                <div class="container">

                    <div class="row">
                        <div class="jeg_main_content col-md-<?php echo esc_attr($single->column_width()) ?>">

                            <?php if(jnews_can_render_breadcrumb()) : ?>
                            <div class="jeg_breadcrumbs jeg_breadcrumb_container">
                                <?php $single->render_breadcrumb(); ?>
                            </div>
                            <?php endif; ?>

                            <div class="entry-header">
                                <div class = "tsd_container">
                                    <img class = "jeg_featured featured_image" alt="Featured Image" style="width:100%" 
                                        src = "<?php echo $single->get_featured_image_src('full')?>">
                                    <div id = "rectangle"></div>
                                    <!--<img src = "https://www.stanforddaily.com/wp-content/uploads/2018/06/DailyRedSmall.jpeg" alt= "TSD Logo" 
                                        style = "position: absolute; width: 20%; top: 0px; left: 15%; ">
                                    -->
                                    <h1 class="jeg_post_title center_left" style = "color: white; left: 5%; 
                                        width: 40%; font-family: 'Times New Roman', Times, serif; top: 30%;">
                                        <?php the_title(); ?></h1>
                                    <div class="jeg_meta_author" style = "color: white; left: 5%; 
                                        width: 40%; font-family: 'Times New Roman', Times, serif; top: 30%;"> </div>
                                     <div class="jeg_meta_date" style = "color: white; left: 5%; 
                                        width: 40%; font-family: 'Times New Roman', Times, serif; top: 30%;"> </div>
                                    <!--
                                    <div class="jeg_meta_container">
                                        <div class="jeg_post_meta jeg_post_meta_2" style = "color: white; left: 5%; 
                                        width: 40%; font-family: 'Times New Roman', Times, serif; top: 30%; position: relative;">
                                            <div class="jeg_meta_author"> </div>
                                            <div class="jeg_meta_date"> </div>
                                        </div>
                                    </div>
                                    -->
                                </div>
                                <?php if($single->can_render_post_meta()) :  ?>
                                    <div class="jeg_meta_container">
                                        <div class="jeg_post_meta">
                                            <div class="jeg_meta_author">
                                                <span class="meta_text"><?php jnews_print_translation('by', 'jnews', 'by'); ?></span>
                                                <?php jnews_the_author_link(); ?>
                                            </div>
                                            <div class="jeg_meta_date"><a href="<?php the_permalink(); ?>"><?php the_date(); ?></a></div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <?php
                                if ( vp_metabox('jnews_single_page.show_post_featured', true) )
                                {
                                    //echo jnews_sanitize_output($single->render_featured_post());
                                    
                                }
                            ?>

                            <?php do_action('jnews_share_top_bar', get_the_ID()); ?>

                            <div class="entry-content <?php $single->share_float_additional_class() ?>">
                                <?php if ($single->is_share_float()) : ?>
                                <div class="jeg_share_button share-float jeg_sticky_share clearfix <?php echo esc_html(vp_metabox('jnews_single_page.share_color')); ?>">
                                    <?php do_action('jnews_share_float_bar', get_the_ID()); ?>
                                </div>
                                <?php endif; ?>

                                <div class="content-inner">
                                    <?php the_content(); ?>
                                    <?php wp_link_pages(); ?>
                                    <?php do_action('jnews_share_bottom_bar', get_the_ID()); ?>
                                </div>
                            </div>


                            <?php
                            if ( comments_open() || '0' != jnews_get_comments_number() ) {
                                comments_template();
                            }
                            ?>
                        </div>
                        <?php $single->render_sidebar(); ?>
                    </div>

                </div>
            </div>
	        <?php do_action('jnews_after_main'); ?>

        </div>
    </div>

<?php get_footer();