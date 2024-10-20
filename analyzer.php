#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

$analyzer = Izzy\Analyzer::getInstance();
$analyzer->run();
