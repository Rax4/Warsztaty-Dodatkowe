<?php

require 'class/User.php';

$host = '';
$db = '';
$user = '';
$password = '';

//$connection = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
//FAKE TO DELETE NOW!!!!!!!!!!!///
$connection = 'fake';
User::$connection = $connection;