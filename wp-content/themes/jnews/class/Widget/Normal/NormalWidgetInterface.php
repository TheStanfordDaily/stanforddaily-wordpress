<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Widget\Normal;

interface NormalWidgetInterface
{
    public function get_options();
    public function render_widget($instance, $content = null);
}