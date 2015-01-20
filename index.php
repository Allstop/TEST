<?php
// 自動載入類別

require 'vendor/autoload.php';

/*use Pux\Executor;

//pux
$mux = require "router/mux.php";
$route = $mux->dispatch($_SERVER['DOCUMENT_URI']);
echo Executor::execute($route);*/


$Controller = new Mvc\Controller\Controller();
$Controller->run();

echo "session=".$_SESSION['user'];