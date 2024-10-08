#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

$updater = new Izzy\Updater();
$updater->run();
