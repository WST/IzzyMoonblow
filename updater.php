#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

$updater = Izzy\Updater::getInstance();
$updater->run();
