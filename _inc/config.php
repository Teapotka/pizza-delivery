<?php

//konštanta
define('DATABASE', [
    'HOST' => 'localhost',
    'DBNAME' => 'pizza_delivery',
    'USER_NAME' => 'root',
    'PASSWORD' => ''
]);

require_once('classes/Database.php');
require_once('classes/Pizza.php');
require_once('classes/Order.php');
?>