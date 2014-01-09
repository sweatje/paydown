<?php

require_once 'model/ServiceLocator.php';

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class TestServiceLocatorClass extends PHPUnit_Framework_TestCase {
	protected $sl;
	function setup() {
		$this->sl = SL::SL();
	}
	function testSLReturnsSingletonInstance() {
		$this->assertTrue(SL::SL() instanceOf ServiceLocator);
		$this->assertTrue($this->sl instanceOf ServiceLocator);
		$this->assertSame(SL::SL(), ServiceLocator::SL());
	}
	function testSLShorthandForServiceLocatorInstance() {	
		$this->assertSame($this->sl, SL());
	}
	function testUnableToInstanciateServiceLocator() {
		// $sl = new ServiceLocator; // throws fatal php error
		$ref = new ReflectionClass('ServiceLocator');
		$this->assertFalse($ref->IsInstantiable()); 
	}
	function testDbReturnsPDOAdapter() {
		$this->assertTrue($this->sl->db() instanceOf PDO);
	}
	function testPlanModelLocator() {
		$this->assertTrue($this->sl->plan() instanceOf Plan);
		$this->assertSame($this->sl->plan(), $this->sl->plan());
	}
}
