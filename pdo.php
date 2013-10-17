<?php
require_once 'model/Hash.php';

function db_factory() {
	$dsn = (file_exists('paydown.prod.sqlite3')) ?
		'sqlite:paydown.prod.sqlite3' : 'sqlite:paydown.sqlite3';
	$db = new PDO($dsn);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	return $db;
}
function db() {
	static $db;
	if (!$db) $db = db_factory();
	return $db;
}

class Model {
	protected $db;
	function __construct($db=false) {
		$this->db = ($db) ? $db : db();
		$this->init();
	}
	function init() {
	}
	function exec($sql,$bind=array()) {
		$stmt = $this->db->prepare($sql);
		foreach($bind as $key => $val) {
			$stmt->bindValue(':'.$key, $val);
		}
		$stmt->execute();
		return $stmt;
	}
	function getRow($sql,$bind=array()) {
		$result = $this->exec($sql,$bind);
		$row = $result->fetch();
		$ret = new Hash($row);
		return $ret;
	}
	function getAll($sql,$bind=array()) {
		$ret = array();
		foreach( $this->exec($sql,$bind)->fetchAll() as $row ) $ret[] = new Hash($row);
		return $ret;
	}
}

