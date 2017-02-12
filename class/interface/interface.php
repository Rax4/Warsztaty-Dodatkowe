<?php

interface Action 
{
    public function create(); 
    public function update();
    public function loadFromDB();

    public static function loadAllObjectFromDB();
    
}
