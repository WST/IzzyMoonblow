<?php

namespace Izzy;

use Izzy\ConsoleApplication;

class Analyzer extends ConsoleApplication
{
	public function __construct(){
		parent::__construct('analyzer');
		$this->database = new Database("/home/ilya/projects/IzzyMoonblow/config/database.php");
		$this->database->connect();
	}

	public static function getInstance(): Analyzer {
		static $instance = null;
		if (is_null($instance)) {
			$instance = new self();
		}
		return $instance;
	}

	public function run() {
		while(true) {
			$balance = $this->database->getTotalBalance();
			echo "Total balance: $balance\n";
			sleep(10);
		}
	}
}
