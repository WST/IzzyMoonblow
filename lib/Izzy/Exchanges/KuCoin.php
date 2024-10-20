<?php

namespace Izzy\Exchanges;

use Izzy\Money;
use KuCoin\SDK\KuCoinApi;
use KuCoin\SDK\PrivateApi\Account;
use KuCoin\SDK\Exceptions\HttpException;
use KuCoin\SDK\Exceptions\BusinessException;
use KuCoin\SDK\Auth;

/**
 * Драйвер для работы с биржей KuCoin
 */
class KuCoin extends AbstractExchangeDriver
{
	protected string $exchangeName = 'KuCoin';

	private ?Account $account;

	protected function refreshAccountBalance() {
		// TODO: вычислять эквивалентную стоимость других активов, не только [0]
		$result = $this->account->getList()[0];
		$value = (float) $result['balance'];
		$this->setBalance(new Money($value));
	}

	public function connect(): bool {
		KuCoinApi::setBaseUri('https://api.kucoin.com');
		$key = $this->dbRow['key'];
		$secret = $this->dbRow['secret'];
		$password = $this->dbRow['password'];
		$auth = new Auth($key, $secret, $password, Auth::API_KEY_VERSION_V2);

		$this->account = new Account($auth);
		return true;
	}

	public function disconnect(): void {
		// TODO: Implement disconnect() method.
	}
}
