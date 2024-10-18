<?php

namespace Izzy;

use Monolog\Logger;
use Monolog\Level;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Bramus\Monolog\Formatter\ColoredLineFormatter;

class ConsoleApplication
{
	protected ?Logger $logger;

	public function __construct($applicationName) {
		$this->logger = new Logger($applicationName);
		$formatter = new ColoredLineFormatter(
			null,
			"[%datetime%] <%level_name%> %message%\n",
			"Y-m-d H:i:s",
			true, // allowInlineLineBreaks option, default false
			true  // discard empty Square brackets in the end, default false
		);
		$streamHandler = new StreamHandler('php://stdout', Level::Info);
		$streamHandler->setFormatter($formatter);
		$this->logger->pushHandler($streamHandler);
	}

	public function getLogger(): Logger {
        return $this->logger;
    }
}
