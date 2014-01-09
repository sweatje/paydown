<?php

require_once 'pdo.php';
/*function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
set_error_handler("exception_error_handler");
*/

class ServiceLocator {
	protected static $instance;
	protected function __construct() {}
	static function ServiceLocatorInstance() {
		if (!ServiceLocator::$instance) {
			ServiceLocator::$instance = new ServiceLocator;
		}
		return ServiceLocator::$instance;
	}
	static function SL() {
		return ServiceLocator::ServiceLocatorInstance();
	}
	function db() {
		return db();
	}
	function plan() {
		static $plan;
		require_once 'model/plan.php';
		if (!$plan) $plan = new Plan(ServiceLocator::db());
		return $plan;
	}
}

class SL extends ServiceLocator {
}

function SL() {
	return ServiceLocator::ServiceLocatorInstance();
}
