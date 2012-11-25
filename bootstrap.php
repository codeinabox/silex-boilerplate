<?php

function exception_error_handler($errno, $errstr, $errfile, $errline) {
    if(in_array($errno, array(E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR))) {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    } else {
        return false;
    }
}
set_error_handler("exception_error_handler");

$loader = require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
$loader->add(null, __DIR__ . DIRECTORY_SEPARATOR . 'app'); // adds the /app dir
