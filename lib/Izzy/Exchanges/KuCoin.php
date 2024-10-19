<?php

namespace Izzy\Exchanges;

use Izzy\Money;

/**
 * Драйвер для работы с биржей KuCoin
 */
class KuCoin extends AbstractExchangeDriver
{
	protected string $exchangeName = __CLASS__;

	public function getTotalBalance(): Money {

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
