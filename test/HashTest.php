<?php

require_once 'model/Hash.php';

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class TestHashClass extends PHPUnit_Framework_TestCase {
        function testGetReturnsNullForUnsetKey() {
		$hash = new Hash;
                $this->assertEquals(null, $hash->get('unset key'));
        }
	function testSetStoresValueWithKeyForGetRetrieval() {
		$hash = new Hash;
		$hash->set('key','value');
		$this->assertEquals('value', $hash->get('key'));
	}
}
