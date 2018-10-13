<?php

function uber_grid_get_grid_defaults() {
	return array(
		'mode' => 'manual',
		'cells' => array(),
		'auto' => array(
			'post_type' => 'post',
			'orderby' => 'date',
			'order' => 'DESC',
			'limit' => 24,
			'offset' => 0,
			'ids' => array(),
			'taxonomyFilters' => array(),
			'taxonomy_filters_relation' => 'AND',
			'customFieldFilters' => array(),
			'custom_field_filters_relation' => 'AND',
			'cellTemplates' => array(array())
		),
		'fonts' => array(
			'title' => array(
				'family' => 'Marvel',
				'style' => '700',
				'size' => 24
			),
			'tagline' => array(
				'family' => 'Marvel',
				'style' => '700',
				'size' => 12
			),
			'hover_text' => array(
				'family' => 'Marvel',
				'style' => 'regular',
				'size' => 12
			),
			'hover_title' => array(
				'family' => 'Marvel',
				'style' => 'regular',
				'size' => 18
			),
			'lightbox_text' => array(
				'family' => 'Marvel',
				'style' => 'regular',
				'size' => 13
			),
			'lightbox_title' => array(
				'family' => 'Marvel',
				'style' => 'regular',
				'size' => 18
			),
			'label_title' => array(
				'family' => 'Marvel',
				'style' => 'regular',
				'size' => 16
			),
			'label_tagline' => array(
				'family' => 'Marvel',
				'style' => '300',
				'size' => 12
			),
			'label_price' => array(
				'family' => 'Marvel',
				'style' => '700',
				'size' => 24
			),
			'filters' => array(
				'family' => 'Marvel',
				'style' => '700',
				'size' => 18
			),
			'pagination' => array(
				'family' => 'Marvel',
				'style' => 'regular',
				'size' => 13
			),
		),
		'layout' => array(
			'default' => array(
				'max_width'             => null,
				'cell_width'            => 160,
				'cell_height'           => 160,
				'cell_gap'              => 0,
				'cell_autosize'         => 0,
				'cell_border_width'     => 0,
				'cell_border_color'     => "FFFFFF",
				'cell_border_opacity'   => 1.0,
				'cell_border_radius'    => 0,
				'cell_shadow_radius'    => 0,
				'columns'								=> ''
			),
			'440' => array(
				'cell_width'            => 120,
				'cell_height'           => 120,
				'cell_gap'              => 0,
				'cell_border_width'          => 0,
				'border_radius'         => 0,
				'title_font_size'       => 14,
				'tagline_font_size'     => 11,
				'hover_title_font_size' => 14,
				'hover_text_font_size'  => 11,
				'label_title_font_size' =>14,
				'label_tagline_font_size'=> 11,
				'label_price_font_size' => 14,
				'label_max_height'      => null,
				'columns'								=> ''
			),
			'768' => array(
				'cell_width'            => 160,
				'cell_height'           => 160,
				'cell_gap'              => 0,
				'cell_border_width'          => 0,
				'cell_border_radius'         => 0,
				'title_font_size'       => 18,
				'tagline_font_size'     => 14,
				'hover_title_font_size' => 18,
				'hover_text_font_size'  => 14,
				'label_title_font_size' =>18,
				'label_tagline_font_size'=> 14,
				'label_price_font_size' => 18,
				'label_max_height' => null,
				'columns'								=> ''
			)
		),

		'filters' => array(
			'color' => '#999',
			'align' => 'center',
			'background_color' => 'transparent',
			'border_color' => '#eee',
			'accent_color' => '#666',
			'accent_background_color' => "transparent",
			'accent_border_color' => '#999',
			'all' => 'All',
			'sort' => 0,
			'exclude_all' => 0,
			'style' => 'tabs'
		),

		'effects' => array(
			'bw' => false,
			'hover' => 'none',
			'hover_on_mobile' => true
		),
		'pagination' => array(
			'enable' => false,
			'style' => 'pagination',
			'per_page' => 12,
			'align' => 'center',
			'color' => '#999',
			'border_color' => '#eee',
			'background_color' => 'transparent',
			'current_page_color' => '#666',
			'current_page_background_color' => "transparent",
			'current_page_border_color' => '#999',
			'load_more' => 'Load more'
		),
		'lightbox' => array(
			'carousel' => true,
			'theme' => uber_grid_lightbox_theme_option_get()
		)
	);
}
class UberGrid_Grid extends UberGrid_ArrayHelper {

	var $id;
	var $slug;
	var $template;

	function __construct($id = null, $options = array(), $override = null){
		parent::__construct();
		$id = (int)$id;
		$posts = get_posts("post_type=uber-grid&p=$id");
		if (count($posts)){
			$post = $posts[0];
			if ($post->post_status != 'publish')
				return;
			$this->id = $id;
			$this->slug = $post->post_name;
			$this->data = get_post_meta($id, '_uber_grid_data', true);
			if ($this->data)
				$this->data = json_decode($this->data, true);
			else {
				$this->data = $this->fetch_legacy_data();
			}
		} else {
			$this->data = array();
		}
		$this->data = $this->parse_args_r($this->data, uber_grid_get_grid_defaults());
	}

	function convert_legacy_cell($cell_data){
		$cell = array();
		foreach(array('title', 'tagline', 'title_background_image', 'tagline_color', 'title_color', 'title_background_color', 'image',
			'title_position', 'layout') as $key){
			if (isset($cell_data[$key]))
				$cell[$key] = $cell_data[$key];
		}
		if (isset($cell_data['tags']))
			$cell['filtering_tags'] = $cell_data['tags'];
		if (isset($cell_data['tags_source']))
			$cell['tags_taxonomy'] = $cell_data['tags_source'];
		if (isset($cell_data['link_enable']))
			$cell['link']['enable'] = $cell_data['link_enable'];
		if (isset($cell_data['link_mode']))
			$cell['link']['mode'] = $cell_data['link_mode'];
		if ($cell['link']['mode'] == 'lightbox'){
			if (preg_match('/(youtu|vimeo)/', $cell_data['link_url'])){
				$cell['link']['lightbox']['mode'] = 'video';
			}
		}
		if (isset($cell_data['link_url']))
			$cell['link']['url'] = $cell_data['link_url'];
		if (isset($cell_data['lightbox_image']))
			$cell['link']['lightbox']['image'] = $cell_data['lightbox_image'];
		foreach(array('title', 'text', 'facebook', 'twitter', 'instagram', 'linkedin', 'pinterest', 'email',
			'flickr', 'googleplus') as $setting){
			if (isset($cell_data['lightbox_' . $setting]))
				$cell['link']['lightbox'][$setting] = $cell_data['lightbox_' . $setting];
		}

		if (isset($cell_data['hover_enable']))
			$cell['hover']['enable'] = $cell_data['hover_enable'];
		if (isset($cell_data['hover_position']))
			$cell['hover']['position'] = $cell_data['hover_position'];
		if (isset($cell_data['hover_title']))
			$cell['hover']['title'] = $cell_data['hover_title'];
		if (isset($cell_data['hover_text']))
			$cell['hover']['text'] = $cell_data['hover_text'];
		if (isset($cell_data['hover_text_color']))
			$cell['hover']['text_color'] = $cell_data['hover_text_color'];
		if (isset($cell_data['hover_background_image']))
			$cell['hover']['background_image'] = $cell_data['hover_background_image'];
		if (isset($cell_data['hover_background_color']))
			$cell['hover']['background_color'] = $cell_data['hover_background_color'];


		foreach(array('enable', 'title', 'title_color', 'tagline',
			'tagline_color', 'price', 'price_background_color',
			'price_color', 'background_color', 'border_top_color',
			'border_bottom_color') as $prop){
				$name = 'label_' . $prop;
				if (isset($cell_data[$name]))
					$cell['label'][$prop] = $cell_data[$name];
			}
		return $cell;
	}

	function fetch_legacy_data(){
		$result = array();
		if ($mode = get_post_meta($this->id, '_current-mode', true)){
			if ($mode == 'auto')
				$result['mode'] = 'auto';
		}
		if ($cells = get_post_meta($this->id, '_cells', true)){
			foreach($cells as $cell_data){
				$result['cells'] []= $this->convert_legacy_cell($cell_data);
			}

		}
		if ($fonts = get_post_meta($this->id, '_fonts', true)){
			$result_fonts = array();
			foreach(array('title', 'tagline', 'hover_title', 'hover_text', 'lightbox_title',
				'lightbox_text', 'label_title', 'label_tagline', 'label_price', 'filters', 'pagination') as $font_category){
				$result_fonts[$font_category] = array(
					'family' => $fonts[$font_category . "_font"],
					'style' => $fonts[$font_category . "_font_style"],
					'size' => $fonts[$font_category . "_font_size"]
				);
			}
			$result['fonts'] = $result_fonts;
			$result['filters']['color'] = $fonts['filters_color'];
			$result['filters']['background_color'] = $fonts['filters_background_color'];
			$result['filters']['accent_color'] = $fonts['filters_accent_color'];
			$result['filters']['accent_background_color'] = $fonts['filters_accent_background_color'];
			if (isset($fonts['filters_sort']))
				$result['filters']['sort'] = $fonts['filters_sort'];
			$result['filters']['align'] = $fonts['filters_align'];
			$result['filters']['all'] = $fonts['filters_all'];
		}
		if ($effects = get_post_meta($this->id, '_effects', true)){
			if (isset($effects['bw']))
				$result['effects']['bw'] = $effects['bw'];
			$result['effects']['hover'] = $effects['hover_effect'];
		}
		if ($auto = get_post_meta($this->id, '_auto', true)){
			$result['auto'] = array(
				'post_type' => $auto['post_type'],
				'orderby' => $auto['orderby'],
				'order' => $auto['order'],
				'custom_field_filters_relation' => 'AND',
				"taxonomy_filters_relation" => 'AND'
			);
			if (isset($auto['offset']))
				$result['auto']['offset'] = $auto['offset'];
			if (isset($auto['limit']))
				$result['auto']['limit'] = $auto['limit'];


			if (isset($auto['taxonomies'])){
				$taxonomies = $auto['taxonomies'];
				for ($i = 0; $i < count($taxonomies); $i++){
					$result['auto']['taxonomyFilters'] []= array(
						'taxonomy' => $taxonomies[$i],
						'tags' => $auto['tags'][$i],
						'operator' => $auto['operators'][$i]
					);
				}

			}

			if (isset($auto['meta_keys'])){
				$custom_fields = $auto['meta_keys'];
				for($i = 0; $i < count($custom_fields); $i++){
					$result['auto']['customFieldFilters'] []= array(
						'key' => $custom_fields[$i],
						'operator' => $auto['meta_operators'][$i],
						'value' => $auto['meta_values'][$i],
						'type' => $auto['meta_types'][$i]
					);
				}
			}

		}

		if ($template = get_post_meta($this->id, '_template', true)){
			$template = $this->convert_legacy_cell($template);
			$template['application_mode'] = 'order';
			$result['auto']['cellTemplates'] []= $template;
		}
		if ($pagination = get_post_meta($this->id, '_pagination', true)){
			$result['pagination'] = $pagination;
		}
		if ($layout = get_post_meta($this->id, '_layout', true)){
			$result['layout']['default'] = $layout;
		}
		if ($layout = get_post_meta($this->id, '_responsive_440')){
			$result['layout']['440'] = $layout;
		}
		if ($layout = get_post_meta($this->id, '_responsive_768')){
			$result['layout']['768'] = $layout;
		}
		return $result;
	}

	function get_json_data(){
		return json_encode($this->data);
	}

	function get_classes(){
		$classes = array('uber-grid-wrapper');
		return implode(" ", $classes);
	}

	function get_2x_width(){
		return $this['layout']['default']['cell_width'] * 2 + $this['layout']['default']['cell_border_width'] * 2 + $this['layout']['default']['cell_gap'];
	}

	function get_2x_height(){
		return $this['layout']['default']['cell_height'] * 2 + $this['layout']['default']['cell_border_width'] * 2 + $this['layout']['default']['cell_gap'];
	}

	function get_manual_cells(){
		$result = array();
		$cells = $this['cells'];
		foreach($cells->getData() as $cell){
			$result []= new UberGrid_Cell($cell);
		}
		return $result;
	}

	function get_cells(){
		$cells = array();
		foreach($this->get_manual_cells() as $cell) {
			$cells []= $cell;
		}
		if ($this['mode'] == 'auto'){
			foreach($this->build_auto_cells() as $auto_cell) {
				$cells []= $auto_cell;
			}
		}
		return $cells;
	}

	function render($options = array()){
		$options = wp_parse_args($options, array(
			'lightbox' => true,
			'buttons' => true
		));
		$cells = $this->get_cells();
		if (current_user_can('manage_options') && $options['buttons'] && !get_option('uber_grid_hide_buttons', false))
			require(UBERGRID_PATH . "templates/edit-buttons.php");
		$this->render_css($cells);
		$this->render_html($cells, $options);
	}

	function render_css($cells){
		require(UBERGRID_PATH . "templates/grid-style-grid.php");
		require(UBERGRID_PATH . "templates/grid-style.css.php");
	}

	function build_auto_cells(){
		$auto = $this['auto'];
		if (empty($auto['posts'])){
			$query = array(
					'post_type' => $auto['post_type'],
					'orderby' => $auto['orderby'],
					'order' => $auto['order'],
					'offset' => (int)$auto['offset'],
					'tax_query' => $this->build_auto_tax_query(),
					'meta_query' => $this->build_meta_query(),
					'posts_per_page' => min((int)$auto['limit'], 500)
			);
			if ('attachment' == $query['post_type']){
				$query['post_status'] = 'inherit';
			}
		} else
			$query = array(
				'post__in' => explode(',', $auto['posts']),
				'post_type' => 'any',
				'post_status' => 'any',
				'offset' => 0
			);
		$auto_cells = array();
		$query = new WP_Query(apply_filters('uber_grid_auto_cells_query', $query, $this->id));
		global $post;
		$index = 0;
		while($query->have_posts()){
			$query->the_post();
			$template = $this->choose_template($post, $index++);
			$auto_cells []= new UberGrid_TemplatedCell($post, $template, $this);
		}
		wp_reset_query();
		return $auto_cells;
	}

	function choose_template($post, $index){
		switch ($this['auto']['choose_template_method']){
			case 'php':
				return $this->choose_template_by_php($post, $index);
			case 'taxonomy':
				return $this->choose_template_by_taxonomy($post, $index);
			default:
				$templates = $this['auto']['cellTemplates'];
				return $templates[$index % $templates->count()];
		}
	}

	function choose_template_by_php($post, $index){
		foreach($this['auto']['cellTemplates'] as $template) {
			$code = $template['criteria_php_code'];
			try {
				$result = @eval( $code );
			} catch (Exception $e){
				$result = false;
			}
			if ( $result ) {
				return new UberGrid_ArrayHelper($template);
			}
		}
		return new UberGrid_ArrayHelper();
	}

	function choose_template_by_taxonomy($post, $index){
		foreach($this['auto']['cellTemplates'] as $template) {
			$template = new UberGrid_ArrayHelper($template);
			if ($taxonomy = $template['criteria_taxonomy']){
				if ($tags = $template['criteria_tags']){
					$tags = array_map('trim', explode(',', $tags));
					$post_tags = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'slugs'));
					if (count(array_intersect($tags, $post_tags)))
						return $template;
				}
			}

		}
		return new UberGrid_ArrayHelper();
	}


	function build_meta_query(){
		$meta_query = array();
		foreach($this['auto']['customFieldFilters'] as $filter){
			if (!empty($filter))
				$meta_query []= array(
					'key' => $filter['key'],
					'compare' => $filter['operator'],
					'value' => $filter['value'],
					'type' => $filter['type']
				);
		}
		if (count($this['auto']['customFieldFilters']) > 1){
			$meta_query['relation'] = $this['auto']['customFieldFiltersRelation'];
		}
		return $meta_query;
	}

	function build_auto_tax_query(){
		$tax_query = array();
		foreach ($this['auto']['taxonomyFilters'] as $filter){
			if (!empty($filter))
				$terms = array_map('trim', isset($filter['tags']) ? explode(',', $filter['tags']) : array());
				$terms = array_map('sanitize_title', $terms);
				$tax_query []= array(
					'taxonomy' => $filter['taxonomy'],
					'field' => 'slug',
					'terms' => $terms,
					'operator' => $filter['operator']
				);
		}
		if (count($this['auto']['taxonomyFilters']) > 1){
			$tax_query['relation'] = $this['auto']['taxonomyFiltersRelation'];
		}
		return $tax_query;
	}

	function has_2x_cells($cells){
		foreach($cells as $cell){
			if ($cell->get_columns() == 2)
				return true;
		}
		return false;
	}

	function render_html($cells, $options = array()){
		if (count($cells))
			require("templates/grid.php");
		else
			require("templates/grid-blank-slate.php");
	}

	function render_cells($cells, $options){
		$i = 0;
		foreach($cells as $cell){
			?><div <?php $cell->render_cell_attributes($this, $i) ?>><?php require("templates/cell.php") ?></div><?php
			$i++;
		}
	}


	function font_families(){
		$fonts = $this['fonts'];
		$font_families = array();
		foreach($fonts as $font){
			if (!empty($font['family']))
				$font_families []= $font['family'] . ':' . $font['style'];
		}
		return array_unique(array_filter($font_families));
	}

	function parse_font_weight($style){
		if (in_array($style, array('', 'regular', 'italic')))
			return '400';
		if ($style == 'bold')
			return '700';
		if (preg_match('/^(\d{3,4})/', $style, $matches))
			return $matches[0];
		return '400';
	}

	function parse_font_style($style){
		if (in_array($style, array('', 'italic')))
			return $style;
		if (preg_match('/^(\d{3,4}.+)/', $style, $matches))
			return preg_replace('/^(\d{3,4})/', '', $style);
		return 'normal';
	}

	function grid_classes(){
		$classes = array('uber-grid');
		if ($this['effects']['bw'])
			$classes []= 'uber-grid-bw';
		if ($this['effects']['hover'])
			$classes []= 'uber-grid-effect-' . $this['effects']['hover'];
		else $classes []= 'uber-grid-effect-none';
		if ($this['effects']['hover_on_mobile'])
			$classes []= 'uber-grid-mobile-hover';
		return implode(' ', $classes);
	}

	function get_tags_from_cells($cells){
		$tags = array();
		foreach($cells as $cell){
			if (isset($cell['filtering_tags']))
				$tags = array_merge($tags, array_map('trim', explode(',', $cell['filtering_tags'])));
		}
		$tags = array_filter(array_unique($tags));
		return $tags;
	}

	function array_unique($array) {
    return array_intersect_key( $array, array_unique(array_map("strtolower",$array)));
	}

	function get_tags($cells){
		$tags = $this->get_tags_from_cells($cells);
		if ($this['filters']['tags']){
			return array_filter(array_map('trim', explode(',', $this['filters']['tags'])));
		}
		$tags = array_filter($this->array_unique($tags));
		if ($this['filters']['sort'])
			sort($tags);
		return $tags;
	}

	function get_columns_width($columns){
		$layout = $this['layout'];
		return $columns * ($layout['cell_width'] + $layout['cell_border_width'] * 2 + $layout['cell_gap']);
	}

	function label_height(){
		return  (int)$this->label_title_font_size * 1.2 + (int)$this->label_tagline_font_size * 1.2 + 24;
	}

	function responsive_440_get_columns_width($columns){
		return $columns * ($this['layout']['440']['cell_width'] + $this['layout']['440']['cell_border_width'] * 2 + $this['layout']['440']['cell_gap']);
	}

	function responsive_768_get_columns_width($columns){
		return $columns * ($this['layout']['768']['cell_width'] + $this['layout']['768']['cell_border_width'] * 2 + $this['layout']['768']['cell_gap']);
	}

	function responsive_768_label_height(){
		return  (int)$this['layout']['768']['label_title_font_size'] * 1.2 + (int)$this['layout']['768']['label_tagline_font_size'] * 1.2 + 24;
	}
	function responsive_440_label_height(){
		return  (int)$this['layout']['440']['label_title_font_size'] * 1.2 + (int)$this['layout']['440']['label_tagline_font_size'] * 1.2 + 24;
	}
	function filters_options() {
		$data = $this['filters']->data;
		if (isset($data['default'])) {
			$data['default'] = sanitize_title($data['default']);
		}
		return $data;
	}
	function js_options(){
		return array(
			'ajaxurl' => uber_grid_ajax_url(),
			'scriptUrl' => UBERGRID_URL . "assets/js/uber-grid.js?ver=" . UBERGRID_VERSION,
			'autosize' => !!$this['layout']['default']['cell_autosize'],
			'max_width' => $this['layout']['default']['max_width'],
			'columns' => $this['layout']['default']['columns'],
			'columns_440' => $this['layout']['440']['columns'],
			'columns_768' => $this['layout']['768']['columns'],
			'pagination' => array(
					'per_page' => $this['pagination']['per_page'],
					'enable' => $this['pagination']['enable'],
					'style' => $this['pagination']['style'],
					'load_more' => $this['pagination']['load_more'],

			),
			'lightbox' => $this['lightbox']->data,
			'filters' => $this->filters_options(),
			'size' => array('width' => $this['layout']['default']['cell_width'], 'height' => $this['layout']['default']['cell_height']),
			'size440' => array('width' => $this['layout']['440']['cell_width'], 'height' => $this['layout']['440']['cell_height']),
			'size768' => array('width' => $this['layout']['768']['cell_width'], 'height' => $this['layout']['768']['cell_height']),
			'gutter' => $this['layout']['default']['cell_gap'],
			'gutter_768' => $this['layout']['768']['cell_gap'],
			'gutter_440' => $this['layout']['440']['cell_gap'],
			'cell_border' => $this['layout']['default']['cell_border_width'],
			'cell_border_440' => $this['layout']['440']['cell_border_width'],
			'cell_border_768' => $this['layout']['440']['cell_border_width'],
		);
	}
}
