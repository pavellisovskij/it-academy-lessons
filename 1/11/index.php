<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});

require 'app/core.php';
use app\StringValidator;

$str = '(29)8685958';
$validator = new StringValidator([
    [
        'method' => 'phone',
        'field'  => 'Строка',
        'value'  => $str,
    ]
]);
debug($validator->get_errors());


require 'view/layout.php';