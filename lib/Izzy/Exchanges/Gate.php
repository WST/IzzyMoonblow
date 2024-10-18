<?php

namespace Izzy\Exchanges;

use Izzy\Money;

class Gate extends AbstractExchangeDriver
{
	protected string $exchangeName = __CLASS__;

	public function getTotalBalance(): Money {

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
