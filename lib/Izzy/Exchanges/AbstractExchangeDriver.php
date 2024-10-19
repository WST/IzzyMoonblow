<?php

namespace Izzy\Exchanges;

use Izzy\Interfaces\IExchangeDriver;

/**
 * Абстрактный класс криптобиржи.
 * Содержит общую для всех криптобирж логику.
 */
abstract class AbstractExchangeDriver implements IExchangeDriver
{
	protected string $exchangeName = '';

	protected $updater;

	protected $logger;

	public function __construct() {
		$exchangeName = $this->getExchangeName();
		$this->updater = \Izzy\Updater::getInstance();
		$this->logger = $this->updater->getLogger();
		$this->logger->info("Драйвер для биржи $exchangeName загружен успешно");
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

		while(true) {
			$timeout = $this->update();
            sleep($timeout);
		}
	}

	protected function log($message) {
        $this->logger->info($message);
    }
}
