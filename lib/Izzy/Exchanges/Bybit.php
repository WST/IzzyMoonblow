<?php

namespace Izzy\Exchanges;

use Izzy\Money;
use ByBit\SDK\ByBitApi;
use Izzy\Updater;

class Bybit extends AbstractExchangeDriver
{
	protected string $exchangeName = __CLASS__;

	protected ByBitApi $api;

	public function __construct() {
        parent::__construct();

	}

	public function connect(): bool {
		try {
			$this->api = new ByBitApi('', '', ByBitApi::PROD_API_URL);
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}

	public function disconnect(): void {
		// TODO: Implement disconnect() method.
	}

	public function update(): void {
		$this->log("Обновление информации для биржи Bybit");
	}

	public function getTotalBalance(): Money {

	}
}
