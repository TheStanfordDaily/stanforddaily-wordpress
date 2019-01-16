<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal\Element;

use JNews\Module\ModuleQuery;
use JNews\Widget\Normal\NormalWidgetInterface;

Class RecentNewsWidget implements NormalWidgetInterface
{
    public function get_options()
    {
        return array (
            'title'     => array(
                'title'     => esc_html__('Title', 'jnews'),
                'desc'      => esc_html__('Title on widget header.', 'jnews'),
                'type'      => 'text'
            ),
            'postnumber'   => array(
                'title'     => esc_html__('Recent News Number', 'jnews'),
                'desc'      => esc_html__('Total recent news that is going to be shown.', 'jnews'),
                'default'   => '3',
                'type'      => 'text'
            ),
        );
    }

    public function render_widget($instance, $text_content = null)
    {
        ?>
        <div class="jeg_postblock">
            <?php
            $number = empty ( $instance['postnumber'] ) ? 3 : $instance['postnumber'];
            $results = ModuleQuery::do_query(array(
                'post_type'                 => 'post',
                'sort_by'                   => 'latest',
                'post_offset'               => 0,
                'number_post'               => $number,
                'pagination_number_post'    => $number,
            ));

            foreach($results['result'] as $result)
            {
                $additional_class = (!has_post_thumbnail($result->ID)) ? ' no_thumbnail' : '';
                ?>
                <div <?php post_class("jeg_post jeg_pl_sm" . $additional_class, $result->ID) ?>>
                    <div class="jeg_thumb">
                        <?php echo jnews_edit_post( $result->ID ); ?>
                        <a href="<?php echo esc_url(get_the_permalink($result)); ?>">
                            <?php echo apply_filters('jnews_image_thumbnail', $result->ID, 'jnews-120x86'); ?>
                        </a>
                    </div>
                    <div class="jeg_postblock_content">
                        <h3 property="headline" class="jeg_post_title"><a property="url" href="<?php echo esc_url(get_the_permalink($result)); ?>"><?php echo get_the_title($result); ?></a></h3>
                    <?php if( get_theme_mod('jnews_show_block_meta', true) && get_theme_mod('jnews_show_block_meta_date', true) ) : ?>
                        <div class="jeg_post_meta">
                            <div property="datePublished" class="jeg_meta_date"><i class="fa fa-clock-o"></i> <?php echo get_the_modified_date(null, $result); ?></div>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}