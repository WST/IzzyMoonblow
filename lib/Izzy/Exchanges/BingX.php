<?php

namespace Izzy\Exchanges;

use Izzy\Exchanges\AbstractExchangeDriver;
use Izzy\Money;

/**
 * Драйвер для работы с биржей BingX
 */
class BingX extends AbstractExchangeDriver
{
	protected string $exchangeName = 'BingX';

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
