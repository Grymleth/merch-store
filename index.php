<?php 

include_once "src/core/config.php";
include_once "src/class/class.route.php";

$route = new Route();

$route->add('/', 'Home');
$route->add('/home', 'Home');
$route->add('/products', 'ShopItem');
$route->add('/contact', 'Contact');

$route->submit();

?>