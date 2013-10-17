<?php
require_once 'pdo.php';

class Plan extends Model {
	const GET_BY_ID_SQL = 'select * from dplan where id = :id';
	function getById($id) {
		return $this->getRow(Plan::GET_BY_ID_SQL,array('id'=>$id));
	}
	function All() {
		return $this->getAll('select * from dplan');
	}
}
