<?php

// This is global bootstrap for autoloading

use tad\FunctionMocker\FunctionMocker;

require_once __DIR__ . '/../vendor/autoload.php';

include_once('_support/extra.php');

FunctionMocker::init();
