<?php
get_header();
$author = new \JNews\Archive\AuthorArchive();
$url = get_author_posts_url(get_the_author_meta('ID'));
$section = isset($_REQUEST['section']) ? esc_html($_REQUEST['section']) : '';
?>

    <div class="jeg_main <?php $author->main_class(); ?>">
        <div class="jeg_container">
            <div class="jeg_content">

                <div class="jeg_section">
                    <div class="container">
                        
                        <?php do_action( 'jnews_archive_above_content' ); ?>

                        <div class="jeg_archive_header jeg_authorpage clearfix">

                            <?php if(jnews_can_render_breadcrumb()) : ?>
                            <div class="jeg_breadcrumbs jeg_breadcrumb_container">
                                <?php echo jnews_sanitize_output( $author->render_breadcrumb() ); ?>
                            </div>
                            <?php endif; ?>

                            <div class="jeg_author_wrap vcard">
                                <div class="jeg_author_image">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 110, null, get_the_author_meta('display_name') ) ?>
                                </div>
                                <div class="jeg_author_content">
                                    <h3 class="jeg_author_name fn">
                                        <?php echo esc_html(get_the_author_meta('display_name')); ?>
                                    </h3>
                                    <p class="jeg_author_desc">
                                        <?php if ( get_the_author_meta( 'description') ) :
                                            the_author_meta( 'description');
                                        endif; ?>
                                    </p>
                                    <div class="jeg_author_socials">
                                        <?php get_template_part('fragment/post/author-social'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="jeg_cat_content row">
                            <div class="jeg_main_content col-sm-<?php echo esc_attr($author->get_content_width()); ?>">

                                <?php if ( defined( 'JNEWS_REVIEW' ) ): ?>
                                    <ul class="authorlink">
                                        <li class="<?php echo esc_attr($section === '' ? 'active' : '');  ?>">
                                            <a href="<?php echo esc_url($url); ?>"><?php jnews_print_translation('All', 'jnews', 'all'); ?></a>
                                        </li>
                                        <li class="<?php echo esc_attr($section === 'review' ? 'active' : '');  ?>">
                                            <a href="<?php echo esc_url(add_query_arg(array('section' => 'review'), $url)); ?>"><?php jnews_print_translation('Reviews', 'jnews', 'reviews'); ?></a>
                                        </li>
                                    </ul>
                                <?php endif ?>

                                <div class="jnews_author_content_wrapper">
                                    <?php echo jnews_sanitize_output( $author->render_content() ); ?>
                                </div>
                            </div>
	                        <?php $author->render_sidebar(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php do_action('jnews_after_main'); ?>
        </div>
    </div>

<?php get_footer(); ?>