<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Form;

use Jeg\Template;

Class FormControl
{
    /**
     * @var Template
     */
    protected static $control_template;

    public static function get_control_template()
    {
        if(!self::$control_template)
        {
            self::$control_template = new Template(JNEWS_THEME_DIR . 'class/Form/control/');
        }

        return self::$control_template;
    }

    public static function generate_form($type, $setting)
    {
        $control_template = self::get_control_template();

        if($type === 'heading') {
            return $control_template->render('heading', $setting,  false);
        }

        if($type === 'alert') {
            return $control_template->render('alert', $setting,  false);
        }

        if($type === 'number') {
            return $control_template->render('number', $setting,  false);
        }

        if($type === 'textfield' || $type === 'text') {
            return $control_template->render('text', $setting,  false);
        }

        if($type === 'textarea_html' || $type === 'textarea') {
            return $control_template->render('textarea', $setting,  false);
        }

        if($type === 'select' || $type === 'dropdown') {
            return $control_template->render('select', $setting,  false);
        }

        if($type === 'checkbox') {
            return $control_template->render('checkbox', $setting,  false);
        }

        if($type === 'color' || $type === 'colorpicker') {
            return $control_template->render('color', $setting,  false);
        }

        if($type === 'slider') {
            return $control_template->render('slider', $setting,  false);
        }

        if($type === 'attach_image' || $type === 'image') {
            return $control_template->render('image', $setting,  false);
        }

        if($type === 'checkblock') {
            return $control_template->render('checkblock', $setting,  false);
        }

        if($type === 'multipost') {
            return $control_template->render('multipost', $setting,  false);
        }

        if($type === 'multitag') {
            return $control_template->render('multitag', $setting,  false);
        }

        if($type === 'multiauthor') {
            return $control_template->render('multiauthor', $setting,  false);
        }

        if($type === 'multiselect') {
            return $control_template->render('multiselect', $setting,  false);
        }

        if($type === 'multicategory') {
            return $control_template->render('multicategory', $setting,  false);
        }

        if($type === 'radioimage') {
            return $control_template->render('radioimage', $setting,  false);
        }

        if($type === 'repeater') {
            return $control_template->render('repeater', $setting,  false);
        }

        return null;
    }
}

