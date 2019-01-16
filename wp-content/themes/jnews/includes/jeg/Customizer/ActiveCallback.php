<?php
/**
 * @author      Jegtheme
 * @license     https://opensource.org/licenses/MIT
 */
namespace Jeg\Customizer;

use Jeg\Customizer;

Class ActiveCallback
{

    /**
     * @var ActiveCallback
     */
    private static $instance;

    /**
     * @var bool
     */
    private $active_flag = true;

    /**
     * @var Customizer
     */
    private $customizer;

    /**
     * @return ActiveCallback
     */
    public static function getInstance()
    {
        if ( null === static::$instance )
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function get_customizer()
    {
        if($this->customizer === null)
        {
            $this->customizer = Customizer::getInstance();
        }

        return $this->customizer;
    }

    public function get_option($option)
    {
        $data = explode('[' , rtrim ($option, ']'));

        if(sizeof($data) === 1) {
            return get_option($option);
        } else {
            $option = get_option($data[0]);
            return $option[$data[1]];
        }
    }

    /**
     * Figure out whether the current object should be displayed or not.
     *
     * @param  array
     * @return boolean
     */
    public function evaluate($active_callback)
    {
        // reset flag
        $this->active_flag = true;
        $fields = $this->get_customizer()->get_fields();

        foreach($active_callback as $active)
        {
            $field = $fields[ $active['setting'] ];
            $type = isset($field['option_type']) ? $field['option_type']  : '';

            if($type === 'option') {
                $current_setting = $this->get_option( $active['setting'] );
            } else {
                $current_setting = get_theme_mod( $active['setting'] );
            }

            $this->active_flag = $this->active_flag && $this->compare( $active['value'] , $current_setting , $active['operator']);
        }

        return $this->active_flag;
    }

    /**
     * evaluate by id
     *
     * @param $id
     * @return bool
     */
    public function evaluate_by_id($id) {

        $this->active_flag = true;

        $fields = $this->get_customizer()->get_all_fields();
        $field = $fields[ $id ];

        if(isset($field['active_callback']))
        {
            $active_callback = $field['active_callback'];

            foreach($active_callback as $active)
            {
                $current_setting = get_theme_mod( $active['setting'], $fields[$active['setting']]['default']);
                $this->active_flag = $this->active_flag && $this->compare($active['value'], $current_setting, $active['operator']);
            }
        }

        return $this->active_flag;
    }

    /**
     * Compares the 2 values given the condition
     *
     * @param mixed  $value1   The 1st value in the comparison.
     * @param mixed  $value2   The 2nd value in the comparison.
     * @param string $operator The operator we'll use for the comparison.
     * @return boolean whether The comparison has succeded (true) or failed (false).
     */
    public function compare( $value1, $value2, $operator ) {
        switch ( $operator ) {
            case '===':
                $show = ( $value1 === $value2 ) ? true : false;
                break;
            case '==':
            case '=':
            case 'equals':
            case 'equal':
                $show = ( $value1 == $value2 ) ? true : false;
                break;
            case '!==':
                $show = ( $value1 !== $value2 ) ? true : false;
                break;
            case '!=':
            case 'not equal':
                $show = ( $value1 != $value2 ) ? true : false;
                break;
            case '>=':
            case 'greater or equal':
            case 'equal or greater':
                $show = ( $value1 >= $value2 ) ? true : false;
                break;
            case '<=':
            case 'smaller or equal':
            case 'equal or smaller':
                $show = ( $value1 <= $value2 ) ? true : false;
                break;
            case '>':
            case 'greater':
                $show = ( $value1 > $value2 ) ? true : false;
                break;
            case '<':
            case 'smaller':
                $show = ( $value1 < $value2 ) ? true : false;
                break;
            case 'contains':
            case 'in':
                if ( is_array( $value1 ) && ! is_array( $value2 ) ) {
                    $array  = $value1;
                    $string = $value2;
                } elseif ( is_array( $value2 ) && ! is_array( $value1 ) ) {
                    $array  = $value2;
                    $string = $value1;
                }
                if ( isset( $array ) && isset( $string ) ) {
                    if ( ! in_array( $string, $array ) ) {
                        $show = false;
                    }
                } else {
                    if ( false === strrpos( $value1, $value2 ) && false === strpos( $value2, $value1 ) ) {
                        $show = false;
                    }
                }
                break;
            default:
                $show = ( $value1 == $value2 ) ? true : false;

        }

        if ( isset( $show ) ) {
            return $show;
        }

        return true;
    }

}