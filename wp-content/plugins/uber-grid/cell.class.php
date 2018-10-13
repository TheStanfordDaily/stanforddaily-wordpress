<?php

function un_preg_split($regexp, $subject) {
	if (function_exists('mb_split')) {
		return mb_split($regexp, $subject);
	}
	return preg_split('/' . $regexp . '/', $subject);
}

function ug_get_cell_tags($tags) {
	$tags = un_preg_split(",\s*", $tags);
	$tags = array_map('sanitize_title', $tags);
	return implode(', ', $tags);
}

class UberGrid_Cell extends UberGrid_ArrayHelper {
	var $defaults = array(
		'layout' => 'r1c1-io',
		'title_color' => '#FFFFFF',
		'title_background_color' => '#ff6760',
		'title_background_gradient_opacity' => 0.8,
		'title_background_image_position' => 'repeat',
		'title_position' => 'center',
		'tagline_color' => '#FFFFFF',
		'hover' => array(
			'text_color' => '#FFFFFF',
			'position' => "top-left",
			'background_image_position' => 'repeat',
			'background_opacity' => 0.85
		),
		'lightbox' => array(),
		'label' => array(
			'title_color' => '#666',
			'tagline_color' => '#999',
			'price_color' => "#FFFFFF",
			'price_background_color' => "",
			'border_bottom' => "0",
			'border_top' => '0',
			'border_bottom_color' => "#999",
			'border_top_color' => "#444",
			'background_color' => "transparent"
		)
	);

	function __construct($data = array()){
		$this->data = $this->parse_args_r($data, $this->defaults);
	}

	function render_cell_attributes($grid, $index){
		$attr = array('id' => "uber-grid-{$grid->id}-cell-{$index}");
		$attr['class'] = 'uber-grid-cell ' . str_replace('-', ' ', $this['layout']);
		if ($this['label']['enable'])
			$attr['class'] .= " uber-grid-has-label";
		if ($this['filtering_tags'])
			$attr['data-tags'] = ug_get_cell_tags($this['filtering_tags']);
		$attr['data-slug'] = $this->get_slug();
		$this->render_attributes($attr);
	}

	function getTags(){
		if (empty($this['tags']))
			return array();
		return array_map('trim', array_unique(explode(',', $this['tags'])));
	}



	function get_slug(){
		$parts = array();
		if ($this['image'])
			$parts []= $this['image'];
		if ($this['title'])
			$parts []= $this['title'];
		elseif ($this['tagline'])
			$parts []= $this['tagline'];
		return implode('-', array_map('sanitize_title', $parts));
	}



	function get_image_width($grid){
		if ($this->get_image_columns() == 2)
			return $grid->get_2x_width();
		return $grid['layout']['default']['cell_width'];
	}

	function get_image_height($grid){
		if ($this->get_image_rows() == 2)
			return $grid->get_2x_height();
		return $grid['layout']['default']['cell_height'];
	}

	function get_image_src($grid){
		$width = $this->get_image_width($grid) * 2;
		$height = $this->get_image_height($grid) * 2;
		$src = wp_get_attachment_image_src($this['image'], array($width, $height));
		return $src[0];
	}

	function get_image_alt(){
		if ($alt = get_post_meta($this['image'], '_wp_attachment_image_alt', true))
			return $alt;
		return $this['title'];
	}


	function get_title_background_image_src($grid, $fill){
		$img = wp_get_attachment_image_src($this['background_image'], 'original');
		$img = $img[0];
		return $img;
	}


	function get_hover_background_image_src($grid, $fill){
		$img = wp_get_attachment_image_src($this['hover']['background_image'], 'original');
		$img = $img[0];
		return $img;
	}

	function get_lightbox_image_src(){
		$img = wp_get_attachment_image_src($this['link']['lightbox']['image'] ? $this['link']['lightbox']['image'] : $this['image'], 'original');
		return $img[0];
	}

	function get_lightbox_image_width(){
		$image = isset($this['lightbox_image']) && $this['lightbox_image'] ? $this['lightbox_image'] : $this['image'];
		$img = wp_get_attachment_image_src($image, 'original');
		return $img[1];
	}

	function get_lightbox_image_height(){
		$image = isset($this['lightbox_image']) && $this['lightbox_image'] ? $this['lightbox_image'] : $this['image'];
		$img = wp_get_attachment_image_src($image, 'original');
		return $img[2];
	}

	function get_image_columns(){
		$columns = array(
			'r1c1-io' => 1,
			'r2c2-io' => 2,
			'r1c2-il' => 1,
			'r1c2-ir' => 1,
			'r2c2-il' => 1,
			'r2c2-ir' => 1,
			'r2c2-it' => 2,
			'r2c2-ib' => 2,
			'r1c2-io' => 2,
			'r2c1-it' => 1,
			'r2c1-ib' => 1,
			'r2c1-io' => 1
		);
		return $columns[$this['layout']];
	}

	function get_image_rows(){
		$rows = array(
			'r1c1-io' => 1,
			'r2c2-io' => 2,
			'r1c2-il' => 1,
			'r1c2-ir' => 1,
			'r2c2-il' => 2,
			'r2c2-ir' => 2,
			'r2c2-it' => 1,
			'r2c2-ib' => 1,
			'r1c2-io' => 1,
			'r2c1-it' => 1,
			'r2c1-ib' => 1,
			'r2c1-io' => 2
		);
		return $rows[$this['layout']];
	}

	function echo_horizontal_padding(){
		echo ($this->get_image_columns() == 1 ? '8' : '4') . "%";
	}

	function echo_vertical_padding(){
		echo ($this->get_image_rows() == 1 ? '8' : '4') . "%";
	}
	function get_default_link_attr($grid){
		$attr = array('class' => '');
		$attr['href'] = $this->get_link_url();
		if ($this['link']['mode'] == 'url' && $this['link']['rel']){
			$attr['rel'] = $this['link']['rel'];
		}
		if ($this['link']['mode'] == 'url' && $this['link']['target']){
			$attr['target'] = $this['link']['target'];
		}
		if ($this['lightbox_image']){
			$attr['data-lightbox-image-id'] = $this['link']['lightbox']['image'];
		}
		return $attr;
	}

	function link_attributes($grid, $options){
		$attr = $this->get_default_link_attr($grid);
		$attr['class'] .= ' uber-grid-cell-wrapper reactbox-disable';
		if ($this['link']['mode'] == 'lightbox' && $options['lightbox']){
			$attr['class'] .= ' uber-grid-lightbox';
		}

		$this->render_attributes($attr);
	}
	function non_link_hover_attributes($grid, $options) {
		$attr = array('class' => '');
		$attr['class'] .= 'uber-grid-hover reactbox-disable';
		if ($this['link']['mode'] == 'lightbox' && $options['lightbox']){
			$attr['class'] .= ' uber-grid-lightbox';
		}
		$attr['class'] .= ' uber-grid-hover-position-' .
			$this['hover']['position'];
		$this->render_attributes($attr);
	}
	function hover_attributes($grid, $options){
		$attr = $this->get_default_link_attr($grid);
		$attr['class'] .= 'uber-grid-hover reactbox-disable';
		if ($this['link']['mode'] == 'lightbox' && $options['lightbox']){
			$attr['class'] .= ' uber-grid-lightbox';
		}
		$attr['class'] .= ' uber-grid-hover-position-' .
			$this['hover']['position'];
		$this->render_attributes($attr);
	}

	function format_attribute($name, $value){
		return "$name=\"" . esc_attr($value) . "\" ";
	}

	function render_attributes($attr){
		foreach($attr as $key => $val){
			echo $this->format_attribute($key, $val);
		}
	}

	function get_link_url(){
		if ($this['link']['mode'] == 'url'){
			return trim($this['link']['url']);
		} else if ($this['link']['mode'] == 'lightbox') {
			if (in_array($this['link']['lightbox']['mode'], array('video', 'audio', 'iframe'))){
				return $this['link']['url'];
			}
		}

		if ($this['link']['lightbox']['image']){
			return $this->get_lightbox_image_src();
		}
		if (isset($this['link']['url']) && trim($this['link']['url']))
			return trim($this['link']['url']);
		return "#";
	}

	function get_rows(){
		return str_replace('r', '', preg_replace('/c.*$/', '', $this['layout']));
	}
	function get_columns(){
		return preg_replace('/[^\d]+$/', '', preg_replace('/^r\d+c/', '', $this['layout']));
	}

	function imageOnly(){
		return preg_match('/-io$/', $this['layout']);
	}

	function imageLocation(){
		return preg_replace('/.*\-/', '', $this['layout']);
	}

}
