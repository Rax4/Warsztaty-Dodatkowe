<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Package
 *
 * @author piotr
 */
class Package
{
    private $id;
    private $userId;
    private $size;
    static public $connection;

    public function __construct() 
    {
        $this->id = -1;
        $this->userId = null;
        $this->size = '';
    }
    
    public function setUserId($id)
    {
        $this->id = $id;
        return true;
    }
    
    public function setSize($size)
    {
        $this->size = $size;
        return true;
    }
    
    public function getUserId()
    {
        return $this->userId;
    }
    
    public function getSize()
    {
        return $this->size;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function create()
    {
        if($this->id == -1)
        {
            $sql = "INSERT INTO Packages(user_id, size)
            VALUES (?,?)";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->userId,  $this->size]);
            if($result == true)
            {
                $this->id = self::$connection->lastInsertId();
                return true;
            }
        }
        return false;
    }
    public function update()
    {
        if($this->id != -1) 
        {
            $sql = "UPDATE Packages SET user_id=?, size=?WHERE id=?";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->userId,  $this->size, $this->id]);
            if($result == true)
            {
                return true;
            }
        }
        return false;
    }
    
    public function loadFromDB($id)
    {
        $sql = "SELECT * FROM Packages WHERE id=$id";
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() == 1)
        {
            $this = new Package();
            $this->id = $row['id'];
            $this->userId = $row['user_id'];
            $this->size = $row['size'];
            return $row;
        }
        return false;
    }

    static public function loadAllFromDB()
    {
        $sql = "SELECT * FROM Packages";
        $ret = [];
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() != 0)
        {
            foreach($result as $row)
            {
                $loadedPackage = new Package();
                $loadedPackage->id = $row['id'];
                $loadedPackage->userId = $row['user_id'];
                $loadedPackage->size = $row['size'];
                $ret[] = $loadedPackage;
            }
        }
        return $ret;
    }
    
    public function delete()
    {
        if($this->id != -1)
        {
            $sql = "DELETE FROM Packages WHERE id=$this->id";
            $result = self::$connection->query($sql);
            if($result == true)
            {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
}

