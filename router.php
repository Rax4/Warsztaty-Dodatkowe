<?php

require 'config/connection.php';
//var_dump($_SERVER['REQUEST_METHOD']);
//var_dump($_SERVER['REQUEST_URI']);

//Deklaracje zmiennych
$request = '';
$arrayRequest = [];
$requestClass = '';

//Parsowanie zapytania
$request = $_SERVER['REQUEST_URI'];
$arrayRequest = explode('/', $request);

if (isset($arrayRequest[2]))
{
    $requestClass = $arrayRequest[2];
}
else
{
    echo 'Nie podałeś nazwy klasy';
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    if ($requestClass=='user') 
    {
        echo 'Mamy Usera!';
    }
    else
    {
        echo 'Nie chodzi o usera!';
    }
}
