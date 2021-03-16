<?php 
session_start();
include_once "src/core/config.php";
include_once "src/class/class.route.php";

$route = new Route();

$route->add('/', 'HomeRoute');
$route->add('/home', 'HomeRoute');
$route->add('/products', 'ProductRoute');
$route->add('/category', 'CategoryRoute');
$route->add('/contact', 'ContactRoute');
$route->add('/accounts', 'AccountsRoute');

$route->submit();

?>