<?php
class UberGrid_ArrayHelper implements ArrayAccess, Iterator, Countable{
	public $data;
	public $keys;
	protected $current_index = 0;

	function __construct($data = array()){
		$this->data = $data;
		$this->keys = array_keys($data);
	}
	public function offsetExists ( $offset ){
		return isset($this->data[$offset]);
	}
	public function getData(){
		return $this->data;
	}
	public function offsetGet ( $offset ){
		if (isset($this->data[$offset])){
			$result = $this->data[$offset];
			if (is_array($result)){
				return new UberGrid_ArrayHelper($result);
			}
			return $result;
		}

		return null;
	}

	public function count(){
		return count($this->data);
	}
	public function offsetSet ( $offset , $value ){
		if (is_array($value)){
			$value = new UberGrid_ArrayHelper($value);
		}
		$this->data[$offset] = $value;
		$this->keys = array_keys($this->data);
	}

	public function offsetUnset ( $offset ){
		unset($this->data[$offset]);
		$this->keys = array_keys($this->data);
	}

	public function parse_args_r( $a, $b ) {
		$a = (array) $a;
		$b = (array) $b;
		$r = $b;

		foreach ( $a as $k => &$v ) {
			if ( is_array( $v ) && isset( $r[ $k ] ) ) {
				$r[ $k ] = self::parse_args_r( $v, $r[ $k ] );
			} else {
				$r[ $k ] = $v;
			}
		}

		return $r;
	}

	public function current (){
		return $this->data[$this->keys[$this->current_index]];
	}
	public function key() {
		return $this->keys[$this->current_index];
	}
	public function next() {
		$this->current_index++;
	}
	public function rewind() {
		$this->current_index = 0;
	}
	public function valid() {
		return $this->current_index < count($this->keys);
	}
}
