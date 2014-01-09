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
		$this->db->exec("insert into dplan (name) values ('Test Plan')");
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
		$this->assertEquals('Test Plan',$plan->name);
	}
	function testAllReturnsArrayOfHashs() {
		$plans = $this->plan->all();
		$this->assertTrue(is_array($plans));
		$this->assertCount(1,$plans);
		$this->assertInstanceOf('hash',$plans[0]);
		$this->assertEquals('Test Plan',$plans[0]['name']);
	}
}

