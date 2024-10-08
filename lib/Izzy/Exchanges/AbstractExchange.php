<?php

namespace Izzy\Exchanges;

use Izzy\Interfaces\IExchange;

/**
 * Абстрактный класс криптобиржи.
 * Содержит общую для всех криптобирж логику.
 */
abstract class AbstractExchange implements IExchange
{
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
