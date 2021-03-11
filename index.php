<?php 
session_start();
include_once "src/core/config.php";
include_once "src/class/class.route.php";

$route = new Route();

$route->add('/', 'Home');
$route->add('/home', 'Home');
$route->add('/products', 'Product');
$route->add('/category', 'Category');
$route->add('/contact', 'Contact');
$route->add('/accounts', 'Accounts');

$route->submit();

?>