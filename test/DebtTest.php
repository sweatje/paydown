<?php

require_once 'model/debt.php';

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class TestDebtClass extends PHPUnit_Framework_TestCase {
	protected $dbname = 'debttest.sqlite3';
	protected $db;
	protected $debt;
	function setup() {
		$this->teardown();
		$this->db = new PDO('sqlite:'.$this->dbname);
		`sqlite3 $this->dbname < sql/plan_ddl.sql`;
		`sqlite3 $this->dbname < sql/debt_ddl.sql`;
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$this->db->exec("insert into dplan (name) values ('Test Plan')");
		$this->db->exec("insert into debt (plan_id, name, amt) values (1, 'CC', 1000)");
		$this->db->exec("insert into debt (plan_id, name, amt) values (1, 'Mortgage', 200000)"); 
		$this->debt = new Debt($this->db);
	}
	function teardown() {
		if (file_exists($this->dbname)) unlink($this->dbname);
	}
	function testGetByIdMethodExists() {
		$this->assertTrue(method_exists('debt','getbyid'));
	}
	function testGetByIdReturnsHash() {
		$debt = $this->debt->getById(1);
		$this->assertEquals('CC',$debt->name);
	}
	function testAllReturnsArrayOfHashs() {
		$debts = $this->debt->all();
		$this->assertTrue(is_array($debts));
		$this->assertCount(2,$debts);
		$this->assertInstanceOf('hash',$debts[0]);
		$this->assertEquals('CC',$debts[0]['name']);
	}
	function testGetByPlanReturnsArrayOfHashs() {
		$debts = $this->debt->getByPlan(1);
		$this->assertTrue(is_array($debts));
		$this->assertCount(2,$debts);
		$this->assertInstanceOf('hash',$debts[0]);
		$this->assertEquals('Mortgage',$debts[1]['name']);
	}
	function testAddDebt() {
		$this->debt->addDebt(1,'test',5000);
		$debts = $this->debt->getByPlan(1);
		$this->assertTrue(is_array($debts));
		$this->assertCount(3,$debts);
		$this->assertInstanceOf('hash',$debts[0]);
		$this->assertEquals('test',$debts[2]['name']);
	}
}

