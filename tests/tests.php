<?php
    include '../config/connection.php';
        //SZKODA ZAPYCHAĆ BAZĘ DANYCH - TEST NA ZAPIS ZAKOŃCZONY SUKCESEM
    $oUser = new User();
    var_dump($oUser);
    var_dump($oUser->setAddress(2));
    var_dump($oUser);
    var_dump($oUser->setCredis(500));
    var_dump($oUser);
    var_dump($oUser->setHashedPassword('test'));
    var_dump($oUser);
    var_dump($oUser->setName('Nejm'));
    var_dump($oUser);
    var_dump($oUser->setSurname('SzurNejm'));
    var_dump($oUser);

    var_dump($oUser->create());
    var_dump($oUser);
    
    //TEST FUNKCJI WCZYTANIA I UPDATE ZAKOŃCZONY SUKCESEM
    $oUser = new User();
    var_dump($oUser = $oUser->loadFromDB(1));
    var_dump($oUser->setCredis(1000));
    var_dump($oUser->update());
    var_dump($oUser);
    
    // TEST FUNKCJI DELETE ZAKOŃCZONY SUKCESEM
    $oUser = new User();
    var_dump($oUser = $oUser->loadFromDB(1));
    var_dump($oUser->delete());
    var_dump($oUser);

    // TEST FUNKCJI LOAD ALL ZAKOŃCZONY SUKCESEM
    $oUser = new User();
    var_dump($oUser = $oUser->loadAllFromDB());
    var_dump($oUser);
