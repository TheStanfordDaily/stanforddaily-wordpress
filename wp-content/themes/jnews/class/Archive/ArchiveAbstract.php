<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Archive;

use JNews\Module\Block\BlockViewAbstract;
use JNews\Module\Hero\HeroViewAbstract;

/**
 * Class Theme ArchiveAbstract
 */
abstract Class ArchiveAbstract
{
    /**
     * @var HeroViewAbstract
     */
    protected $hero_instance;

    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @var  BlockViewAbstract
     */
    protected $content_instance;

    /**
     * todo : should choose which breadcrumb we need to use
     *
     * @return string
     */
    public function render_breadcrumb()
    {
        return jnews_render_breadcrumb();
    }

	public function main_class()
	{
		$layout = $this->get_page_layout();

		switch ($layout)
		{
			case 'left-sidebar' :
			case 'left-sidebar-narrow' :
				echo "jeg_sidebar_left";
				break;

			case 'double-sidebar' :
				echo "jeg_double_sidebar";
				break;

			case 'double-right-sidebar' :
				echo "jeg_double_right_sidebar";
				break;

			default :
				break;
		}
	}

	public function render_sidebar()
	{
		$layout = $this->get_page_layout();

		if ( $layout !== 'no-sidebar' )
		{
			$sidebar = array(
				'content-sidebar'   => $this->get_content_sidebar(),
				'sticky-sidebar'    => $this->get_sticky_sidebar(),
				'width-sidebar'     => $this->get_sidebar_width(),
				'position-sidebar'  => 'left'
			);

			set_query_var( 'sidebar', $sidebar );
			get_template_part('fragment/archive-sidebar');

			if($layout === 'double-right-sidebar' || $layout === 'double-sidebar')
			{
				$sidebar['content-sidebar']  = $this->get_second_sidebar();
				$sidebar['position-sidebar'] = 'right';
				set_query_var( 'sidebar', $sidebar );
				get_template_part('fragment/archive-sidebar');
			}
		}
	}

    public function get_content_width()
    {
    	$layout = $this->get_page_layout();

    	switch ($layout)
	    {
		    case 'right-sidebar':
		    case 'left-sidebar':
		    	return 8;
		    	break;

		    case 'right-sidebar-narrow':
		    case 'left-sidebar-narrow':
			    return 9;
			    break;

		    case 'double-sidebar':
		    case 'double-right-sidebar':
			    return 6;
			    break;
	    }

	    return 12;
    }

    public function get_sidebar_width()
    {
	    $layout = $this->get_page_layout();

	    if($layout === 'left-sidebar' || $layout === 'right-sidebar')
	    {
		    return 4;
	    }

	    return 3;
    }

    public function get_sticky_sidebar()
    {
	    if ( $this->sticky_sidebar() )
	    {
		    return 'jeg_sticky_sidebar';
	    }
	    return false;
    }

    // content
    abstract public function get_content_type();
    abstract public function get_content_excerpt();
    abstract public function get_content_date();
    abstract public function get_content_date_custom();
    abstract public function get_content_pagination();
    abstract public function get_content_pagination_limit();
    abstract public function get_content_pagination_align();
    abstract public function get_content_pagination_navtext();
    abstract public function get_content_pagination_pageinfo();
	abstract public function get_page_layout();
    abstract public function get_content_sidebar();
	abstract public function get_second_sidebar();
	abstract public function sticky_sidebar();
}
