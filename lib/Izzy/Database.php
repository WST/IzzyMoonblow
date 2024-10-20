<?php

namespace Izzy;

use PDO;

class Database
{
	private PDO $pdo;

	private $config;

	public function __construct($configFile) {
		$this->config = require $configFile;
	}

	public function connect() {
		$this->pdo = new PDO(
			"mysql:host={$this->config['host']};dbname={$this->config['database']}",
			$this->config['username'], $this->config['password']
		);
	}

	public function close() {
		unset($this->pdo);
	}

	public function listExchanges(): array {
		$sql = "SELECT * FROM exchanges WHERE enabled = 1";
		$statement = $this->pdo->prepare($sql);
		$statement->execute();

		$exchanges = [];
		while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$driverName = "Izzy\\Exchanges\\{$row['name']}";
			if(!class_exists($driverName)) continue;
			$exchanges[$row['name']] = new $driverName($row);
		}

		$statement->closeCursor();

		return $exchanges;
	}

	public function setExchangeBalance(string $exchangeName, Money $balance): void {
		$balanceFloat = $balance->getAmount();
		$sql = "UPDATE exchanges SET balance = :balance WHERE name = :name";
		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(':name', $exchangeName);
		$statement->bindParam(':balance', $balanceFloat);
		$statement->execute();
		$statement->closeCursor();
	}

	public function getTotalBalance(): Money {
		$sql = "SELECT SUM(balance) AS totalBalance FROM exchanges";
		$statement = $this->pdo->prepare($sql);
		$statement->execute();
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		$statement->closeCursor();
		return new Money($row['totalBalance']);
	}
}
