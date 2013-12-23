<?php
require_once 'pdo.php';

class Debt extends Model {
	static $table = 'debt';
	function addDebt($plan_id, $name, $amount) {
		$sql = 'insert into '.static::$table.' (plan_id, name, amt) values (:plan_id, :name, :amt)';
		$this->exec($sql, array('plan_id' => $plan_id, 'name' => $name, 'amt' => $amount));
	}
}

