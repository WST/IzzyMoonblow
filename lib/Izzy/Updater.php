<?php

namespace Izzy;

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
		foreach($this->exchanges as $exchange) {
			try {
				$exchange->loadDriver();
			} catch (\Exception $e) {
				$this->logger->error("Ошибка загрузки драйвера для биржи {$exchange->getName()}: {$e->getMessage()}");
    			continue;
			}
		}

		// Отключимся от базы данных перед разделением
		Propel::getServiceContainer()->closeConnections();
	}

	public static function getInstance(): Updater {
		static $instance = null;
		if (is_null($instance)) {
			$instance = new Updater();
		}
		return $instance;
	}
}
