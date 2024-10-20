<?php

namespace Izzy\Exchanges;

use Izzy\Money;

/**
 * Драйвер для работы с биржей KuCoin
 */
class KuCoin extends AbstractExchangeDriver
{
	protected string $exchangeName = 'KuCoin';

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
