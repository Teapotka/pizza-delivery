<?php

//konštanta
define('DATABASE', [
    'HOST' => 'localhost',
    'DBNAME' => 'pizza_delivery',
    'USER_NAME' => 'root',
    'PASSWORD' => ''
]);

session_start();
require_once('classes/Session.php');
require_once('classes/Database.php');
require_once('classes/Pizza.php');
require_once('classes/Order.php');
require_once('classes/Feedback.php');
require_once('classes/Admin.php');
?>