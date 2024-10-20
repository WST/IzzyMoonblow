<?php

namespace Izzy\Exchanges;

use Izzy\Database;
use Izzy\Interfaces\IExchangeDriver;
use Izzy\Money;

/**
 * Абстрактный класс криптобиржи.
 * Содержит общую для всех криптобирж логику.
 */
abstract class AbstractExchangeDriver implements IExchangeDriver
{
	protected string $exchangeName = '';

	protected array $dbRow = [];

	protected Database $database;

	public function __construct(array $dbRow) {
		$this->dbRow = $dbRow;
		$exchangeName = $this->getExchangeName();
		$this->database = new Database("/home/ilya/projects/IzzyMoonblow/config/database.php");
		$this->log("Драйвер для биржи $exchangeName загружен успешно");
	}

	public function getExchangeName(): string {
		return $this->exchangeName;
	}

	public function run(): int {
		$pid = pcntl_fork();
		if($pid) {
			return $pid;
		}

		if(!$this->connect()) {
			return -1;
		}

		$this->database->connect();

		while(true) {
			$timeout = $this->update();
            sleep($timeout);
		}
	}

	protected function setBalance(?Money $balance = null) {
		if(is_null($balance)) return;
		$this->database->setExchangeBalance($this->exchangeName, $balance);
	}

	protected function log($message) {
        //$this->logger->info($message);
		echo "$message\n";
    }
}
