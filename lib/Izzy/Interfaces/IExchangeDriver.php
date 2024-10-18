<?php

namespace Izzy\Interfaces;

use Izzy\Money;

/**
 * Интерфейс криптобиржи
 */
interface IExchangeDriver
{
	// Обновить информацию с биржи
	public function update(): void;

	// Установить соединение с биржей
	public function connect(): bool;

	// Отсоединиться от биржи
	public function disconnect(): void;

	// Запросить суммарный баланс всех средств на бирже
	public function getTotalBalance(): Money;
}
