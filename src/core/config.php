<?php 

define('APPROOT', dirname(__FILE__));

define('URLROOT', 'localhost/merch-store/');

define('SITENAME', 'Eban Merch');

// GLOBAL PATHS
define('HTTP_HOST', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'CLI');
define('SERVER_PROTOCOL', (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ) ? 'https://' : 'http://');
define('__ROOT_DIR__', str_replace('\\','/',dirname(dirname(dirname(__FILE__)))).'/');
define('__RELATIVE_ROOT__', (!empty($_SERVER['SCRIPT_NAME'])) ? str_ireplace(rtrim(str_replace('\\','/', realpath(str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME']))), '/'), '', __ROOT_DIR__) : '/');// /
define('__BASE_URL__', SERVER_PROTOCOL.HTTP_HOST.__RELATIVE_ROOT__);

// DB CONSTANTS
define('DB_HOST', 'localhost');

// Inventory
define('DB_INVENTORY_USER', 'root');

define('DB_INVENTORY_PASS', '');

define('DB_INVENTORY_NAME', 'inventory');

?>

