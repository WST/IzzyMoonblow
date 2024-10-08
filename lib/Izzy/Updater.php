<?php

namespace Izzy;

use Izzy\Models\ExchangeQuery;

class Updater
{
	private $exchanges;

	public function __construct() {
		$this->exchanges = ExchangeQuery::create()
			->orderByName()
			->find();
	}

	public function run() {
		foreach ($this->exchanges as $exchange) {
			echo $exchange->getName() . PHP_EOL;
		}
	}
}
