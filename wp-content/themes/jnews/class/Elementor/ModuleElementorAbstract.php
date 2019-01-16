<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Elementor;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use JNews\Module\ModuleOptionAbstract;
use JNews\Module\ModuleViewAbstract;

abstract Class ModuleElementorAbstract extends Widget_Base
{
	/***
	 * @var ModuleViewAbstract
	 */
	private $view_instance;

	/**
	 * @var ModuleOptionAbstract
	 */
	private $option_instance;

	private $class_name;

	public function __construct(array $data = [], $args = null)
	{
		$this->class_name = get_class( $this );

		parent::__construct( $data, $args );
	}

	private function get_class($param)
	{
		$mod = explode('_', $this->class_name);
		return "\JNews\Module\\" . $mod[1] . "\\" . $mod[1] . "_" . $mod[2] . "_"  . $param;
	}

	private function get_option_instance()
	{
		if ( ! $this->option_instance )
		{
			$option_class = apply_filters('jnews_module_elementor_get_option_class', $this->get_class( 'Option' ));
			$this->option_instance = call_user_func( array( $option_class, 'getInstance' ) );
		}

		return $this->option_instance;
	}

	private function get_view_instance()
	{
		if ( ! $this->view_instance )
		{
			$view_class = apply_filters('jnews_module_elementor_get_view_class', $this->get_class( 'View' ));
			$this->view_instance = call_user_func( array( $view_class, 'getInstance' ) );
		}

		return $this->view_instance;
	}

	public function get_name()
	{
		return strtolower( get_class( $this ) );
	}

	public function get_icon()
	{
		return jnews_get_shortcode_name_from_option( get_class( $this->get_option_instance() ) );
	}

	public function get_title()
	{
		return $this->get_option_instance()->get_module_name();
	}

	public function get_categories()
	{
		$element_category = str_replace(' ','', $this->get_option_instance()->get_category());
		return [ strtolower($element_category) ];
	}

	protected function _register_controls()
	{
		$this->build_option( $this->get_option_instance()->get_options() );
	}

	private function build_option( $options )
	{
		$group_options = $this->parse_group_option( $options );

		foreach ( $group_options as $group => $options )
		{
			if ( ! $group ) continue;

			if ( $group === 'style' )
			{
				$section = array(
					'label' => esc_html__( 'Style', 'jnews' ),
					'tab'   => Controls_Manager::TAB_STYLE
				);
			} else if ( $group === 'setting' ) {
				$section = array(
					'label' => esc_html__( 'Setting', 'jnews' ),
					'tab' => Controls_Manager::TAB_CONTENT
				);
			} else {
				$section = array(
					'label' => esc_html( $group ),
					'tab' => Controls_Manager::TAB_CONTENT
				);
			}

			$this->start_controls_section(
				'section_' . str_replace(' ', '-', $group ),
				$section
			);

			foreach ( $options as $option )
			{
				$this->parse_control_option( $option );
			}

			$this->end_controls_section();
		}
	}

	private function parse_control_option( $option )
	{
		switch ( $option['type'] )
		{
			case 'textfield':
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::TEXT,
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

			case 'textarea':
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::TEXTAREA,
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

			case 'colorpicker' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::COLOR,
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

			case 'dropdown' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::SELECT,
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'options'       => array_flip($option['value']),
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

			case 'iconpicker' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::ICON,
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

			case 'radioimage' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::CHOOSE,
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'options'       => $this->parse_radioimage_option($option['value'], $option['param_name']),
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

			case 'attach_image' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::MEDIA,
						'default'       => [
							'url' => isset( $option['std'] ) ? $option['std'] : '',
						],
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

			case 'checkbox' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::SWITCHER,
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

			case 'textarea_html' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::CODE,
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'language'      => 'html',
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

			case 'slider' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::SLIDER,
						'default'       => [
							'size' => isset( $option['std'] ) ? $option['std'] : 0,
						],
						'range'         => [
							'px' => [
								'min'  => $option['min'],
								'max'  => $option['max'],
								'step' => $option['step'],
							],
						],
						'description'   => isset( $option['description'] ) ? $option['description'] : ''
					]
				);
				break;

            case 'number' :
	            $this->add_control(
		            $option['param_name'],
		            [
			            'label'         => $option['heading'],
			            'type'          => Controls_Manager::NUMBER,
			            'default'       => isset( $option['std'] ) ? $option['std'] : 0,
			            'min'           => $option['min'],
			            'max'           => $option['max'],
			            'step'          => $option['step'],
			            'label_block'   => true,
			            'description'   => isset( $option['description'] ) ? $option['description'] : ''
		            ]
	            );
                break;

			case 'multicategory' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => 'multicategory',
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : '',
					]
				);
				break;

			case 'multitag' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => 'multitag',
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : '',
					]
				);
				break;

			case 'multipost' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => 'multipost',
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : '',
					]
				);
				break;

			case 'multiauthor' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => 'multiauthor',
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : '',
					]
				);
				break;

			case 'multiproduct' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => 'multiproduct',
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'label_block'   => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : '',
					]
				);
				break;

			case 'multiselect' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => Controls_Manager::SELECT2,
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'options'       => array_flip($option['value']),
						'label_block'   => true,
						'multiple'      => true,
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : '',
						'description'   => isset( $option['description'] ) ? $option['description'] : '',
					]
				);
				break;

			case 'alert' :
				$this->add_control(
					$option['param_name'],
					[
						'label'         => $option['heading'],
						'type'          => 'alert',
						'default'       => isset( $option['std'] ) ? $option['std'] : '',
						'label_block'   => true,
						'description'   => isset( $option['description'] ) ? $option['description'] : '',
						'condition'     => isset( $option['dependency'] ) ? $this->parse_dependency_option( $option['dependency'] ) : ''
					]
				);
				break;

			default:
//                jlog($option['type']);
				break;
		}
	}

	private function parse_group_option( $options )
	{
		$group_option = array();

		foreach( $options as $option )
		{
			if ( ( isset( $option['group'] ) && strtolower( $option['group'] ) === 'design' ) )
			{
				$group_option['style'][] = $option;
			}
			else
			{
				if ( isset( $option['group'] ) )
				{
					$group_option[$option['group']][] = $option;
				} else {
					$group_option['setting'][] = $option;
				}
			}
		}

		return $group_option;
	}

	protected function render()
	{
		$settings = $this->get_settings();
		echo $this->get_view_instance()->build_module($settings);
	}

	protected function _content_template()
	{
		$this->get_view_instance()->_content_template();
	}

	public function is_reload_preview_required()
	{
		return true;
	}

	public function parse_radioimage_option( $value, $param )
	{
		$new_value = array();

		foreach ( array_flip($value) as $key => $item )
		{
			$new_value[$key] = array(
				'icon' => $param
			);
		}

		return $new_value;
	}

	public function parse_dependency_option( $value )
	{
		return array( $value['element'] => ($value['value'] === 'true') ? 'yes' : $value['value'] );
	}
}