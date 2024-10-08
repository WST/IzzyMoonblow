<?php

namespace Izzy\Models;

use Izzy\Interfaces\IExchangeDriver;
use Izzy\Models\Base\Exchange as BaseExchange;

/**
 * Skeleton subclass for representing a row from the 'exchanges' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Exchange extends BaseExchange
{
	private ?IExchangeDriver $driver;

	public function loadDriver() {
		$driver = $this->getName();
		$className = "\\Izzy\\Exchanges\\$driver";
		if(!class_exists($className)) {
			throw new \Exception("Драйвер не найден: $driver");
		}
        $this->driver = new $className();
		return $this->driver;
	}
}
