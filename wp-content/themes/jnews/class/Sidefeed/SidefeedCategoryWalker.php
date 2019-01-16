<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Sidefeed;

Class SidefeedCategoryWalker extends \Walker
{
    public $tree_type = 'category';
    public $db_fields = array ( 'parent' => 'parent', 'id' => 'term_id' );
    public $cache = array();

    public function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0)
    {
        $cacheobj = array();
        $cacheobj['object'] = $object;
        $cacheobj['depth'] = $depth;
        $cacheobj['id'] = $object->term_id;
        $indent = '';

        if($depth == 1) {
            $indent = " - ";
        } else if ($depth == 2) {
            $indent = "  -  ";
        }

        $cacheobj['title'] = $indent . $object->name . "  [ID : " . $object->term_id . "]";
        $this->cache[] = $cacheobj;
    }
}
