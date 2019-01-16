<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Walker;

Class CategoryWalker extends \Walker
{
    public $tree_type = 'category';
    public $db_fields = array ( 'parent' => 'parent', 'id' => 'term_id' );
    public $cache = array();

    public function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0)
    {
        $this->cache[] = $object;
    }
}