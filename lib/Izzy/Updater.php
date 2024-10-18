<?php

namespace Izzy;

use Izzy\Interfaces\IExchangeDriver;
use Izzy\Models\ExchangeQuery;
use Monolog\Logger;
use Propel\Runtime\Propel;

class Updater extends ConsoleApplication
{
	private $exchanges;

	public function __construct() {
		parent::__construct('updater');
		$this->exchanges = ExchangeQuery::create()
			->orderByName()
			->find();
	}

	public function run() {
		// Отключимся от базы данных перед разделением
		Propel::getServiceContainer()->closeConnections();

		// Запускаем обновляторы бирж
		$status = $this->runExchangeUpdaters();
		die($status);
	}

	private function runExchangeUpdaters() {
		$updaters = [];

		/** @var IExchangeDriver $exchange */
		foreach($this->exchanges as $exchange) {
			$driverName = $exchange->getDriverName();
			$driver = new $driverName();
			$updaters[] = $driver->run();
			unset($driver);
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
			$instance = new Updater();
		}
		return $instance;
	}
}
