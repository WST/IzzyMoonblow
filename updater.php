#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/lib/common.php';

$updater = Izzy\Updater::getInstance();
$updater->run();
