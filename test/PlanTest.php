<?php

require_once 'model/plan.php';

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class TestPlanClass extends PHPUnit_Framework_TestCase {
	protected $dbname = 'plantest.sqlite3';
	protected $db;
	protected $plan;
	function setup() {
		$this->db = new PDO('sqlite:'.$this->dbname);
		`sqlite3 $this->dbname < sql/plan_ddl.sql`;
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$this->plan = new Plan($this->db);
	}
	function teardown() {
		unlink($this->dbname);
	}
	function testGetByIdMethodExists() {
		$this->assertTrue(method_exists('plan','getbyid'));
	}
	function testGetByIdReturnsHash() {
		$plan = $this->plan->getById(1);
		$this->assertEquals('Jason\'s Test Plan',$plan->name);
	}
}

