<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleViewAbstract;

Class Element_Iconlink_View extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
        $newtab = ($attr['newtab']) ? "target=\"_blank\"" : "" ;

        $output =
            "<div class=\"jeg_iconlink {$column_class} {$this->unique_id} {$this->get_vc_class_name()} {$this->color_scheme()}\">                
                <a class=\"jeg_block_icon_link\" href=\"{$attr['title_url']}\" {$newtab}>
                    <i class=\"{$attr['icon']}\"></i>
                </a>
                <div class=\"jeg_block_icon_desc\">
                    <a class=\"jeg_block_icon_title\" href=\"{$attr['title_url']}\" {$newtab}><h3>{$attr['title']}</h3></a>
                    <a class=\"jeg_block_icon_desc_span\" href=\"{$attr['title_url']}\" {$newtab}><span>{$attr['subtitle']}</span></a>
                </div>
            </div>";

        return $output;
    }

    public function render_column_alt($result, $column_class) {}
    public function render_column($result, $column_class) {}
}