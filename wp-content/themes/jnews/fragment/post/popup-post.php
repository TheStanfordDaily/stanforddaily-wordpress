<?php

use JNews\Module\ModuleQuery;

global $post;

$result = ModuleQuery::do_query(
    array(
        'post_type'              => 'post',
        'sort_by'                => 'oldest',
        'post_offset'            => 0,
        'number_post'            => isset( $number_popup_post ) ? $number_popup_post : 1,
        'pagination_number_post' => 1,
        'date_query'    => array(
            'column'    => 'post_date',
            'after'     => $post->post_date,
        ),
    )
);

if ( !empty( $result['result'] ) ) : ?>

    <section class="jeg_popup_post">
        <span class="caption"><?php jnews_print_translation('Next Post', 'jnews', 'next_post'); ?></span>

        <?php foreach ( $result['result'] as $res ) : ?>
            <div class="jeg_popup_content">
                <div class="jeg_thumb">
                    <?php echo jnews_edit_post( $res->ID ); ?>
                    <a href="<?php echo esc_url( get_permalink( $res->ID ) ); ?>">
                        <?php echo apply_filters( 'jnews_image_thumbnail', $res->ID, 'jnews-75x75' ); ?>
                    </a>
                </div>
                <h3 class="post-title">
                    <a href="<?php echo esc_url( get_permalink( $res->ID ) ); ?>">
                        <?php echo wp_kses_post( $res->post_title ); ?>
                    </a>
                </h3>
            </div>
        <?php endforeach ?>
        
        <a href="#" class="jeg_popup_close"><i class="fa fa-close"></i></a>
    </section>

<?php endif; ?>