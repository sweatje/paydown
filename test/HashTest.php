<?php

require_once 'model/Hash.php';

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class TestHashClass extends PHPUnit_Framework_TestCase {
	protected $hash;
        function setup() {
		$this->hash = new Hash;
	}
	function testGetReturnsNullForUnsetKey() {
                $this->assertEquals(null, $this->hash->get('unset key'));
        }
	function testSetStoresValueWithKeyForGetRetrieval() {
		$this->hash->set('key','value');
		$this->assertEquals('value', $this->hash->get('key'));
	}
	function testHashTreatsAttributeSetSameAsGetSetMethods() {
		$this->hash->key = 'value';
		$this->assertEquals('value', $this->hash->get('key'));
		$this->hash->set('key2','value2');
		$this->assertEquals('value2', $this->hash->key2);
	}
	function testHashAllowsAccessAsAnArray() {
		$this->hash['key'] = 'value';
		$this->assertEquals('value', $this->hash['key']);
	}
	function testHashUsesContructorToPopulate() {
		$hash = new Hash(array('foo' => 'bar'));
		$this->assertEquals('bar',$hash->foo);
	}
}
