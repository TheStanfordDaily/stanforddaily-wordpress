<?php
require_once(ABSPATH . "wp-admin/includes/image.php");

class UberGrid_TemplatedCell extends UberGrid_Cell{
	var $current_post;
	var $grid;
	function __construct($post, $template, $grid){
		$data = $template->getData();
		$data = $this->process_tags($data, $post);
		$this->grid = $grid;
		parent::__construct($data, $post);
		$this->find_featured_image($post);
		if ($taxonomy = $this->grid['auto']['filtering_taxonomy']){
			$this['filtering_tags'] = $this->find_tags($post, $taxonomy);
		}

		if ($this['link']['mode'] == 'lightbox' && $post->post_type == 'attachment'){
			$this['link']['lightbox']['image'] = $post->ID;
		}
		do_action('uber_grid_build_auto_cell', $this, $post, $grid);
	}

	function process_tags($data, $post){
		foreach(array_keys($data) as $field){
			if (is_array($data[$field]) or $data[$field] instanceof UberGrid_ArrayHelper){
				$data[$field] = new UberGrid_ArrayHelper($this->process_tags($data[$field], $post));
			} else {
				$data[$field] = $this->do_tags($data[$field], $post);

			}
			$data[$field] = apply_filters('ubergrid_cell_field_value', $data[$field], $field, $post);
		}
		return $data;
	}

	function is_leaf_term($term){
		$children = get_terms(array($this->tags_source), array('child_of' => $term->term_id));
		return count($children) == 0;
	}

	function find_tags($post, $taxonomy){
		$tags = array();
		foreach(wp_get_post_terms($post->ID, $taxonomy) as $term){
			$tags []= $term->name;
		}
		return implode(', ', $tags);
	}

	function find_featured_image($post){
		$thumbnail = $post->post_type == 'attachment' ? $post->ID : get_post_thumbnail_id($post->ID);
		if ((int)$thumbnail && empty($this['image'])){
			$src = wp_get_attachment_image_src($thumbnail);
			if ($src[0])
				$this['image'] = $thumbnail;
			else
				$thumbnail = null;
		}
		if (!$thumbnail){
			$attachments = get_children(array('post_parent' => $post->ID, 'post_type' => 'attachment', 'numberposts' => 1, 'post_mime_type' => 'image'));
			if (count($attachments)){
				$keys = array_keys($attachments);
				$thumbnail = $keys[0];
			}
		}
		if (!$this['link']['lightbox']['image'] && $thumbnail && $this['link']['mode'] == 'lightbox'){
			$this['link']['lightbox']['image'] = $thumbnail;
		}
	}


	function do_tags($value, $post){
		$this->current_post = $post;
		if (!is_array($value) && !is_object($value)){
			$value = preg_replace_callback("/" . preg_quote('%post_title%') . "/", array($this, '_post_title_filter'), $value);
			$value = preg_replace_callback("/" . preg_quote('%post_excerpt%') . "/", array($this, '_post_excerpt_filter'), $value);
			$value = preg_replace_callback("/" . preg_quote('%post_content%') . "/", array($this, '_post_content_filter'), $value);
			$value = str_replace('%post_ID%', $post->ID, $value);
			$value = preg_replace_callback("/" . preg_quote('%post_permalink%') . "/", array($this, '_post_permalink_filter'), $value);
			$value = str_replace("%post_date%", mysql2date(get_option('date_format'), $post->post_date), $value);
			$value = preg_replace_callback("/" . preg_quote('%post_terms%') . "/", array($this, '_post_terms_filter'), $value);
			$value = preg_replace_callback("/" . preg_quote('%post_tags%') . "/", array($this, '_post_tags_filter'), $value);
			$value = preg_replace_callback("/" . preg_quote('%post_categories%') . "/", array($this, '_post_categories_filter'), $value);
			$value = preg_replace_callback("/%post_meta_([^%]+)%/", array($this, 'do_replace'), $value);
			$value = preg_replace_callback("/%wc_product_price%/", array($this, '_post_wc_product_price_filter'), $value);
			$value = str_replace('%post_author%', get_the_author(), $value);
			$value = str_replace('%post_author_url%',
				get_the_author_meta('url'), $value);
			$value = str_replace('%post_author_posts_url%', get_author_posts_url($post->post_author), $value);
			$value = preg_replace_callback("/%taxonomy_terms_([^%]+)%/", array($this, '_taxonomy_filter'), $value);
		}
		return $value;
	}

	function _post_wc_product_price_filter($match){
		global $post;
		if (function_exists('wc_get_product')){
			$product = wc_get_product($post);
			return $product->get_price_html();
		} else {
			return '';
		}
	}

	function _taxonomy_filter($matches){
		return $this->find_tags($this->current_post, $matches[1]);
	}

	function _post_terms_filter($match){
		return $this->find_tags($this->current_post, $this->grid['auto']['filtering_taxonomy']);
	}

	function _post_tags_filter($match){
		return $this->find_tags($this->current_post, 'post_tag');
	}

	function _post_categories_filter($match){
		return $this->find_tags($this->current_post, 'category');
	}

	function _post_permalink_filter($match){
		return get_permalink($this->current_post->ID);
	}

	function _post_content_filter($match){
		global $post;
		return get_the_content();
	}

	function _post_title_filter($match){
		return get_the_title();
	}

	function _post_excerpt_filter($match){
		return get_the_excerpt();
	}

	function do_replace($matches){
		return get_post_meta($this->current_post->ID, $matches[1], true);
	}

	function reset(){
		$this->i = 0;
	}

}
