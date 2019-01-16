<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

require_once ABSPATH . 'wp-includes/class-wp-customize-setting.php';

final class CustomizeSetting extends \WP_Customize_Setting
{
    /**
     * Import an option value for this setting.
     *
     * @since 0.3
     * @param mixed $value The option value.
     * @return void
     */
    public function import( $value )
    {
        $this->update( $value );
    }
}