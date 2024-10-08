<?php

namespace Izzy\Interfaces;

interface IMarket
{
	public function getCandles();

	public function firstCandle(): ICandle;

	public function lastCandle(): ICandle;
}
