<?php

class Hash {
	protected $store = array();
	function get($key) {
		if (array_key_exists($key,$this->store))
			return $this->store[$key];
	}
	function set($key, $value=null) {
		$this->store[$key] = $value;
	}
}
