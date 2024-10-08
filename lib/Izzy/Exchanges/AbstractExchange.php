<?php

namespace Izzy\Exchanges;

use Izzy\Interfaces\IExchange;

/**
 * Абстрактный класс криптобиржи.
 * Содержит общую для всех криптобирж логику.
 */
abstract class AbstractExchange implements IExchange
{
	protected string $exchangeName = '';

	public function __construct() {
		$exchangeName = $this->getExchangeName();
		echo "Exchange driver for $exchangeName loaded successfully.\n";
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
