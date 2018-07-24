<?php

require_once "vendor/autoload.php";
require_once "tests/RemoteProxy/RemoteProxyTest.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

registerWhoopsErrorHandler();

function registerWhoopsErrorHandler()
{
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}