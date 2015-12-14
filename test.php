<?php

use PlasmaCode\GetEnv\Env;
include_once __DIR__ . '/src/Env.php';

$env = new Env(__DIR__ . '/test.env');
var_dump($_ENV['TEST']);
?>