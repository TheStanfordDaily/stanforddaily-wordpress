<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleViewAbstract;

Class Element_Ads_View extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
        return "<div class='jeg_ad jeg_ad_module {$this->unique_id} {$this->additional_class($attr)} {$this->get_vc_class_name()}'>" . $this->build_module_ads( $attr ) . "</div>";
    }

    protected function additional_class($attr)
    {
    	$class = array();

    	if ( $attr['google_desktop'] === 'hide' )
	    {
	    	$class[] = 'jeg_ads_hide_desktop';
	    }

	    if ( $attr['google_tab'] === 'hide' )
	    {
		    $class[] = 'jeg_ads_hide_tab';
	    }

	    if ( $attr['google_phone'] === 'hide' )
	    {
		    $class[] = 'jeg_ads_hide_phone';
	    }

    	return implode(' ', $class);
    }
}