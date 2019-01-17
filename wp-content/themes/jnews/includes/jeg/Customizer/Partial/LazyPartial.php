<?php
/**
 * @author      Jegtheme
 * @license     https://opensource.org/licenses/MIT
 */
namespace Jeg\Customizer\Partial;

/**
 * Default Settings
 */
class LazyPartial extends \WP_Customize_Partial  {

    /**
     * partial(section)(id)
     * @var string pattern
     */
    public static $pattern = '/^partial\((?P<section>[^\)]+)\)\((?P<id>[^\)]+)\)$/';

    /**
     * Pattern to be replaced in javascript
     */
    public static function js_pattern_template()
    {
        return "partial({section})({id})";
    }
}
