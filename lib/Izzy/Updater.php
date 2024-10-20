<?php

namespace Izzy;

use Izzy\Interfaces\IExchangeDriver;
use Izzy\Models\ExchangeQuery;
use Monolog\Logger;
use Propel\Runtime\Propel;

class Updater extends ConsoleApplication
{
	private $exchanges;

	private Database $database;

	public function __construct() {
		parent::__construct('updater');
		$this->database = new Database(IZZY_CONFIG . "/database.php");
		$this->database->connect();
		$this->exchanges = $this->database->listExchanges();
	}

	public function run() {
		// Отключимся от базы данных перед разделением
		$this->database->close();
		unset($this->database);

		// Запускаем обновляторы бирж
		$status = $this->runExchangeUpdaters();
		die($status);
	}

	private function runExchangeUpdaters() {
		$updaters = [];

		/** @var IExchangeDriver $exchange */
		foreach($this->exchanges as $exchangeName => $exchange) {
			$updaters[] = $exchange->run();
		}

		foreach ($updaters as $updater) {
			$status = NULL;
			pcntl_waitpid($updater, $status);
		}

		return 0;
	}

	public static function getInstance(): Updater {
		static $instance = null;
		if (is_null($instance)) {
			$instance = new self();
		}
		return $instance;
	}
}
