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

	public function __construct() {
		$exchangeName = $this->getExchangeName();
		$updater = \Izzy\Updater::getInstance();
		$logger = $updater->getLogger();
		$logger->info("Драйвер для биржи $exchangeName загружен успешно");
	}

	public function getExchangeName(): string {
		return $this->exchangeName;
	}

	public function update(): void {
		// TODO: Implement update() method.
	}

	public function connect(): bool {
		// TODO: Implement connect() method.
	}

	public function disconnect(): void {
		// TODO: Implement disconnect() method.
	}
}
