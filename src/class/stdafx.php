<?php

// common static functions
include "class.common.php";

// Database classes
include "class.account.php";
include "class.inventory.php";
include "class.transaction.php";

// Routes
include "class.homeRoute.php";
include "class.productRoute.php";
include "class.categoryRoute.php";
include "class.accountsRoute.php";
include "class.contactRoute.php";
include "class.404.php";

require_once "class.database.php";

?>