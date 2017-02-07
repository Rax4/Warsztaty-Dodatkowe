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

if (isset($arrayRequest[3]))
{
    $requestParam = $arrayRequest[3];
    var_dump($requestParam);
}
else
{
    echo 'Nie podałeś parametru';
}



if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    if ($requestClass=='user') 
    {
        $oUser = new User();
        $userData = $oUser->loadFromDB(2);
        var_dump($userData);
    }
    else
    {
        echo 'Nie chodzi o usera!';
    }
}
