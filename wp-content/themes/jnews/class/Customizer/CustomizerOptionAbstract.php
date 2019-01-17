<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Customizer;

use Jeg\Customizer;

/**
 * Class Theme JNews Customizer
 */
abstract Class CustomizerOptionAbstract
{
    /**
     * @var Customizer
     */
    protected $customizer;

    protected $id;

    public function __construct($customizer, $id)
    {
        $this->id = $id;
        $this->customizer = $customizer;
        $this->set_option();
    }

    public function add_lazy_section($id, $title, $panel, $dependency = array()){
        $section = array(
            'id'            => $id,
            'title'         => $title,
            'panel'         => $panel,
            'priority'      => $this->id,
            'type'          => 'jnews-lazy-section',
            'dependency'    => $dependency
        );
        $this->customizer->add_section($section);
    }

    abstract public function set_option();
}
