<?php 

include 'config.php';

include 'class.route.php';
include 'src/class.home.php';
include 'src/class.shopitem.php';
include 'src/class.contact.php';
include 'src/class.404.php';

$route = new Route();

$route->add('/', 'Home');
$route->add('/shop_item', 'ShopItem');
$route->add('/contact', 'Contact');

$route->submit();

?>