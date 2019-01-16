<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Element;

use JNews\Module\ModuleViewAbstract;

Class Element_Splitnav_View extends ModuleViewAbstract
{
    public function render_module($attr, $column_class)
    {
        $mega_nav   = '';
        $menus      = is_array( $attr['menu'] ) ? $attr['menu'] : explode(',', $attr['menu']);

        foreach ( $menus as $menu )
        {
            $menu_content = wp_nav_menu(
                array(
                    'menu'              => $menu,
                    'container'         => 'ul',
                    'depth'             => 3,
                    'echo'              => false
                )
            );
            $mega_nav .= "<div class=\"jeg_meganav\">" . $menu_content . "</div>";
        }

        $output =
            "<div class=\"jeg_meganav_bar jeg_splitpost_bar jeg_splitpost_3 {$this->color_scheme()}\">
                <div class=\"nav_wrap\">
                    <h3 class=\"current_title\">" . get_the_title(get_the_ID()) . "</h3>

                    <div class=\"jeg_meganav_wrap\">
                        {$mega_nav}
                    </div>
                </div>
            </div>";

        return $output;
    }

}
