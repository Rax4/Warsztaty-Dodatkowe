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
}
else
{
    echo 'Nie podałeś parametru';
}



if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    if ($requestClass=='user') 
    {
        if (isset($requestParam) && $requestParam>0) 
        {
            $oUser = new User();
            $userData = $oUser->loadFromDB($requestParam);
            var_dump($userData);
        }
        else if(isset($requestParam) && $requestParam=='0')
        {
            $oUser = new User();
            $userData = $oUser->loadFromDB($requestParam);
            var_dump($userData);
        }
        else 
        {
            $oUser = new User();
            $oUser = $oUser->loadAllFromDB();
            var_dump($oUser);
        }
    }
    else
    {
        echo 'Nie chodzi o usera!';
    }
}
