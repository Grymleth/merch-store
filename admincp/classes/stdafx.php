<?php

if(!@include_once(__PATH_CLASSES__ . 'class.common.php')) throw new Exception('Could not load class (common).');
if(!@include_once(__PATH_CLASSES__ . 'class.session.php')) throw new Exception('Could not load class (session).');
if(!@include_once(__PATH_CLASSES__ . 'class.database.php')) throw new Exception('Could not load class (database).');
if(!@include_once(__PATH_CLASSES__ . 'class.account.php')) throw new Exception('Could not load class (account).');
if(!@include_once(__PATH_CLASSES__ . 'class.inventory.php')) throw new Exception('Could not load class (inventory).');
if(!@include_once(__PATH_CLASSES__ . 'class.transaction.php')) throw new Exception('Could not load class (transaction).');
?>