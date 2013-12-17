<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('VATChecker\Tests', __DIR__);

if (!class_exists('PHPUnit_Framework_TestCase')) {
    echo "You must install the dev dependencies using:\n";
    echo "    composer install --dev\n";
    exit(1);
}