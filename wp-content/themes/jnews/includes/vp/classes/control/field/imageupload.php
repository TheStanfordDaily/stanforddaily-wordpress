<?php

class VP_Control_Field_Imageupload extends VP_Control_Field
{

	public function __construct()
	{
		parent::__construct();
	}

	public static function withArray($arr = array(), $class_name = null)
	{
		if(is_null($class_name))
			$instance = new self();
		else
			$instance = new $class_name;
		$instance->_basic_make($arr);
		return $instance;
	}

	public function _setup_data()
	{
		$preview = wp_get_attachment_image_src($this->get_value(), 'thumbnail');
		$this->add_data('preview', $preview[0]);
		parent::_setup_data();
	}

	public function render($is_compact = false)
	{
		$this->_setup_data();
		$this->add_data('is_compact', $is_compact);
		return VP_View::instance()->load('control/imageupload', $this->get_data());
	}

}

/**
 * EOF
 */