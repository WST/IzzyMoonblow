<?php

namespace Izzy\Exchanges;

use Izzy\Exchanges\AbstractExchangeDriver;
use Izzy\Money;

/**
 * Драйвер для работы с биржей BingX
 */
class BingX extends AbstractExchangeDriver
{
	protected string $exchangeName = __CLASS__;

	public function getTotalBalance(): Money {
		// TODO: Implement getTotalBalance() method.
	}

	public function update(): int {
		// TODO: Implement update() method.
	}

	public function connect(): bool {
		// TODO: Implement connect() method.
	}

	public function disconnect(): void {
		// TODO: Implement disconnect() method.
	}
}
