<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Menu;

use JNews\Form\FormControl;

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class MenuOptionWalker extends \Walker_Nav_Menu_Edit
{
    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {}


    public function setting_field($key, $field, $item)
    {
        $setting = array();

        $setting['title']       = isset($field['title']) ? $field['title'] : '';
        $setting['desc']        = isset($field['desc']) ? $field['desc'] : '';
        $setting['options']     = isset($field['options']) ? $field['options'] : array();
        $setting['fieldkey']    = $key;
        $setting['fieldid']     = "jnews_mega_menu" . "-{$item->ID}-{$key}";
        $setting['fieldname']   = "jnews_mega_menu" . "[{$item->ID}][{$key}]";
        $setting['value']       = isset($item->mega_menu[$key]) ? $item->mega_menu[$key] : '';
        $setting['default']     = isset($field['default']) ? $field['default'] : '';
        $setting['fields']      = isset($field['fields']) ? $field['fields'] : array();
        $setting['row_label']   = isset($field['row_label']) ? $field['row_label'] : array();
        $setting['dependency']  = isset($field['dependency']) ? $field['dependency'] : array();

        if(empty($setting['value']))
        {
            $setting['value'] = isset($field['default']) ? $field['default'] : '';
        }

        return $setting;
    }

    function get_fields( $item )
    {
        $fields = array();
        $html   = "<div class='clearfix'></div>";

        if ( apply_filters('jnews_load_mega_menu_option', false) )
        {
            include get_parent_theme_file_path ('class/Menu/option.php');
            $fields = jnews_get_mega_menu_option();
        }

        foreach ($fields as $accordion_title => $controls)
        {
            $child_form = '';

            foreach ($controls as $key => $field)
            {
                $child_form .= FormControl::generate_form($field['type'], $this->setting_field($key, $field, $item));
            }

            $sanitize_title = sanitize_title($accordion_title);

            $html .=
                "<div class='jeg_accordion_wrapper collapsible close widget_class {$sanitize_title}'>" .
                    "<div class='jeg_accordion_heading'>
                        <span class='jeg_accordion_title'>{$accordion_title}</span>
                        <span class='jeg_accordion_button'></span>
                    </div>" .
                    "<div class='jeg_accordion_body' style='display: none'>" . $child_form . "</div>" .
                "</div>";
        }

        $html .= "<div class='clearfix jeg_menu_bottom'></div>";

        return $html;
    }

    /**
     * Start the element output.
     *
     * @see Walker_Nav_Menu::start_el()
     * @since 3.0.0
     *
     * @global int $_wp_nav_menu_max_depth
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     * @param int    $id     Not used.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $item_output = '';
        parent::start_el( $item_output, $item, $depth, $args, $id );
        $output .= preg_replace(
        // NOTE: Check this regex from time to time!
            '/(?=<(fieldset|p)[^>]+class="[^"]*field-move)/',
            $this->get_fields( $item ),
            $item_output
        );
    }
}
