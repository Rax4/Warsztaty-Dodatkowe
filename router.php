<?php

include 'config/connection.php';
var_dump($_SERVER['REQUEST_METHOD']);
var_dump($_SERVER['REQUEST_URI']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    if ($_SERVER['REQUEST_URI']=='/router.php/user') 
    {
        echo 'To działa?';
    }
    else
    {
        echo 'Nie chodzi o usera!';
    }
}
