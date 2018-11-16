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
                                <div class = "container">
                                    <img scr = "jeg_featured featured_image" alt="Featured Image" style="width:100%">
                                    <img scr = "https://www.stanforddaily.com/wp-content/uploads/2018/06/DailyRedSmall.jpeg" alt= "TSD Logo" style="tsd_position">
                                    <div id = "rectangle"></div>
                                    <h1 class="jeg_post_title center_left"><?php the_title(); ?></h1>
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
                                    <p> This an example page. This is an example page. It’s different from 
                                    a blog post because it will stay in one place and will show up 
                                    in your site navigation (in most themes). Most people start with an About 
                                    page that introduces them to potential site visitors. It might say something like this:</p>
                                    <aside class ="p_quote">
                                        <blockquote> <p> Hi there! I'm a bike messenger by day, aspiring 
                                        actor by night, and this is my website. </p> </blockquote>
                                    </aside>
                                    <img class = "jeg_featured featured_image" alt="Featured Image" style="width:100%">
                                    <p style = "font-size: 10px"> "This is the caption." </p>
                                    <p> Here's some more text. <p>
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