<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Module;

use JNews\Module\ModuleManager;

Class RegisterModuleWidget
{
    /**
     * @var RegisterModuleWidget
     */
    private static $instance;

    /**
     * @return RegisterModuleWidget
     */
    public static function getInstance()
    {
        if ( null === static::$instance )
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
	    include get_parent_theme_file_path('class/Widget/Module/module-widget.php');
        add_action('widgets_init', array($this, 'register_widget_module') );
    }

    public function register_widget_module()
    {
        $manager = ModuleManager::getInstance();
        $modules = $manager->populate_module();
        
        foreach($modules as $module) {
            if($module['widget']) {
                $module_widget = $this->widget_name($module);
                register_widget($module_widget);
            }
        }
    }

    public function widget_name($module)
    {
        return $module['name'] . '_Widget';
    }
}

