#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/generated-conf/config.php';

$updater = new Izzy\Updater();
$updater->run();
