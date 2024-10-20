<?php

namespace Izzy\Exchanges;

use ByBit\SDK\Exceptions\HttpException;
use Izzy\Money;
use ByBit\SDK\ByBitApi;
use ByBit\SDK\Enums\AccountType;
use Izzy\Updater;

/**
 * Драйвер для работы с биржей Bybit
 */
class Bybit extends AbstractExchangeDriver
{
	protected string $exchangeName = 'Bybit';

	// Общий баланс всех средств на бирже, пересчитанный в доллары
	private ?Money $totalBalance = null;

	// API для общения с биржей
	protected ByBitApi $api;

	public function connect(): bool {
		try {
			$key = $this->dbRow['key'];
			$secret = $this->dbRow['secret'];
			$this->api = new ByBitApi($key, $secret, ByBitApi::PROD_API_URL);
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}

	public function disconnect(): void {
		// TODO: Implement disconnect() method.
	}

	protected function refreshAccountBalance() {
		$this->log("Обновляем баланс кошелька на {$this->exchangeName}");
		try {
			$params = ['accountType' => AccountType::UNIFIED];
			$info = $this->api->accountApi()->getWalletBalance($params);
			$value = @ (float)$info['list'][0]['totalEquity'];
			if (is_null($this->totalBalance)) {
				$this->totalBalance = new Money($value);
			} else {
				$this->totalBalance->setAmount($value);
			}
			$this->setBalance($this->totalBalance);
		} catch (HttpException $exception) {
			$this->log("Не удалось обновить баланс кошелька на {$this->exchangeName}");
		}
	}
}
