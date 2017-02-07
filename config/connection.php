<?php

require 'class/User.php';

$host = 'localhost';
$db = 'paczkolab';
$user = 'root';
$password = 'coderslab';

$connection = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password, [PDO::FETCH_ASSOC]);

User::$connection = $connection;