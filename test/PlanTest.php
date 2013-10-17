<?php

require_once 'model/plan.php';

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class TestPlanClass extends PHPUnit_Framework_TestCase {
	function testGetByIdMethod() {
		$this->assertTrue(method_exists('plan','getbyid'));
	}
}

