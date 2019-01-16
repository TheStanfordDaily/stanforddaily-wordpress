<?php

namespace JNews\Elementor\Control;

use \Elementor\Base_Data_Control;

class Multiproduct extends Base_Data_Control
{

	public function get_type()
	{
		return 'multiproduct';
	}

	public function content_template()
	{
		$data           = array();
		$control_uid    = $this->get_control_uid();

		$packages       = new \WP_Query(array(
			'post_type'      => 'product',
			'posts_per_page' => 10,
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_type',
					'field'    => 'slug',
					'terms'    => array('post_package')
				)
			),
			'orderby'       => 'menu_order title',
			'order'         => 'ASC',
			'post_status'   => 'publish'
		));

		if ( $packages->have_posts() )
		{
			while ( $packages->have_posts() )
			{
				$packages->the_post();
				$data[] = array(
					'text'  => get_the_title(),
					'value' => get_the_ID()
				);
			}
		}

		wp_reset_postdata();

		$data = wp_json_encode($data);
		?>
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper type-multiproduct">
				<input id="<?php echo $control_uid; ?>" type="text" class="tooltip-target input-sortable" data-tooltip="{{ data.title }}" title="{{ data.title }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}" />
				<div class="data-option" style="display: none;">
					<?php echo esc_html($data); ?>
				</div>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<script type="text/javascript">
            (function($)
            {
                window.open_control($('input#<?php echo $control_uid; ?>'));
            })(jQuery);
		</script>
		<?php
	}
}