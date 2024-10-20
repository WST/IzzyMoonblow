<?php

namespace Izzy\Exchanges;

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

	private int $iteration = 0;

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

	private function refreshAccountBalance() {
		$this->log("Обновляем баланс кошелька на {$this->exchangeName}");

		$params = ['accountType' => AccountType::UNIFIED];
		$info = $this->api->accountApi()->getWalletBalance($params);
		$value = @ (float)$info['list'][0]['totalEquity'];
		if(is_null($this->totalBalance)) {
			$this->totalBalance = new Money($value);
		} else {
			$this->totalBalance->setAmount($value);
		}

		$this->setBalance($this->totalBalance);
	}

	public function update(): int {
		$this->log("Обновление информации для биржи Bybit");

		// Каждые 10 циклов обновляем актуальный баланс
		if($this->iteration % 10 == 0) {
			$this->refreshAccountBalance();
		}

		// Инкрементируем число итераций
		$this->iteration ++;

		// Засыпаем на 5 секунд между циклами работы
		return 5;
	}
}
