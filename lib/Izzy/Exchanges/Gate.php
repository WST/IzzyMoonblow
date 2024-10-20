<?php

namespace Izzy\Exchanges;

use Izzy\Money;
use GateApi\Api\WalletApi;
use GateApi\Configuration;

/**
 * Драйвер для работы с биржей Gate
 */
class Gate extends AbstractExchangeDriver
{
	protected string $exchangeName = "Gate";

	private $config;

	private $walletApi;

	protected function refreshAccountBalance(): void {
		$info = $this->walletApi->getTotalBalance(['currency' => 'USDT']);
		$value = $info->getTotal()->getAmount();
		$this->setBalance(new Money($value));
	}

	public function connect(): bool {
		$key = $this->dbRow['key'];
		$secret = $this->dbRow['secret'];
		$this->config = Configuration::getDefaultConfiguration()->setKey($key)->setSecret($secret);
		$this->walletApi = new WalletApi(null, $this->config);
		return true;
	}

	public function disconnect(): void {
		// TODO: Implement disconnect() method.
	}
}
