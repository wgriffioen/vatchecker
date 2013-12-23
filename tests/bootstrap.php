<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo "You must install the dependencies using:\n";
    echo "    composer install --dev\n";
    exit(1);
}

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('VATChecker\Tests', __DIR__);
