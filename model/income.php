<?php
require_once 'pdo.php';

class Income extends Model {
	const GET_BY_ID_SQL = 'select * from income where id = :id';
	function getById($id) {
		return $this->getRow(self::GET_BY_ID_SQL,array('id'=>$id));
	}
	function All() {
		return $this->getAll('select * from income');
	}
}
