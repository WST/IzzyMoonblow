<?php

namespace Izzy\Exchanges;

use Izzy\Money;

/**
 * Драйвер для работы с биржей Gate
 */
class Gate extends AbstractExchangeDriver
{
	protected string $exchangeName = __CLASS__;

	public function getTotalBalance(): Money {

	}

	public function update(): int {
		return 10;
	}

	public function connect(): bool {
		return false;
	}

	public function disconnect(): void {
		// TODO: Implement disconnect() method.
	}
}
