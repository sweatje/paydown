<?php

require_once 'model/income.php';

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class TestIncomeClass extends PHPUnit_Framework_TestCase {
	protected $dbname = 'incometest.sqlite3';
	protected $db;
	protected $income;
	function setup() {
		$this->db = new PDO('sqlite:'.$this->dbname);
		`sqlite3 $this->dbname < sql/plan_ddl.sql`;
		`sqlite3 $this->dbname < sql/income_ddl.sql`;
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$this->db->exec("insert into dplan (name) values ('Test Plan')");
		$this->db->exec("insert into income (plan_id, name, amt) values (1, 'Job', 8000)");
		/*
                $this->db->exec("insert into income_adj (income_id, name, start_dt, amt) 
			values (1,'Test Raise', datetime('now','localtime','start of month','+2 months'), 250)"); 
		*/
		$this->income = new Income($this->db);
	}
	function teardown() {
		unlink($this->dbname);
	}
	function testGetByIdMethodExists() {
		$this->assertTrue(method_exists('income','getbyid'));
	}
	function testGetByIdReturnsHash() {
		$income = $this->income->getById(1);
		$this->assertEquals('Job',$income->name);
	}
	function testAllReturnsArrayOfHashs() {
		$incomes = $this->income->all();
		$this->assertTrue(is_array($incomes));
		$this->assertCount(1,$incomes);
		$this->assertInstanceOf('hash',$incomes[0]);
		$this->assertEquals('Job',$incomes[0]['name']);
	}
	function testGetByPlanReturnsArrayOfHashs() {
		$incomes = $this->income->getByPlan(1);
		$this->assertTrue(is_array($incomes));
		$this->assertCount(1,$incomes);
		$this->assertInstanceOf('hash',$incomes[0]);
		$this->assertEquals('Job',$incomes[0]['name']);
	}
}

