<?php

namespace Izzy\Interfaces;

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
}
