<?php
    include '../class/User.php';
    
    $oUser = new User();
    var_dump($oUser);
    var_dump($oUser->setAddress("lupa"));
    var_dump($oUser);
    var_dump($oUser->setCredis(500));
    var_dump($oUser);
    var_dump($oUser->setHashedPassword('test'));
    var_dump($oUser);
    var_dump($oUser->setName('Nejm'));
    var_dump($oUser);
    var_dump($oUser->setSurname('SzurNejm'));
    var_dump($oUser);
