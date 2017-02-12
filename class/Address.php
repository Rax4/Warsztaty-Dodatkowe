<?php

class Address extends DataBase
{
    private $id;
    private $city;
    private $code;
    private $street;
    private $number;

    public function __construct() 
    {
        $this->id = -1;
        $this->city = '';
        $this->code = '';
        $this->street = '';
        $this->number = '';
    }
    
    public function setCity($city)
    {
        $this->city = $city;
        return true;
    }
    
    public function setCode($code)
    {
        $this->code = $code;
        return true;
    }
    
    public function setStreet($street)
    {
        $this->street = $street;
        return true;
    }
    
    public function setNumber($number)
    {
        $this->number = $number;
        return true;
    }
    
    public function getCity()
    {
        return $this->city;
    }
    
    public function getCode()
    {
        return $this->code;
    }
    
    public function getStreet()
    {
        return $this->street;
    }
    
    public function getNumber()
    {
        return $this->number;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function create()
    {
        if($this->id == -1)
        {
            $sql = "INSERT INTO Addresses(city, code, street, number)
            VALUES (?,?,?,?)";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->city,  $this->code, $this->street, $this->number]);
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
            $sql = "UPDATE Addresses SET city=?, code=?,street=?,number=?WHERE id=?";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->city,  $this->code, $this->street, $this->number, $this->id]);
            if($result == true)
            {
                return true;
            }
        }
        return false;
    }
    
    public function loadFromDB($id)
    {
        $sql = "SELECT * FROM Addresses WHERE id=$id";
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() == 1)
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->city = $row['city'];
            $this->code = $row['code'];
            $this->street = $row['street'];
            $this->number = $row['number'];
            return $row;
        }
        return false;
    }

    static public function loadAllObjectFromDB()
    {
        $sql = "SELECT * FROM Addresses";
        $ret = [];
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() != 0)
        {
            foreach($result as $row)
            {
                $loadedAddress = new Address();
                $loadedAddress->id = $row['id'];
                $loadedAddress->city = $row['city'];
                $loadedAddress->code = $row['code'];
                $loadedAddress->street = $row['street'];
                $loadedAddress->number = $row['number'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }
    
    static public function loadAllFromDB()
    {
        $sql = "SELECT * FROM Addresses";
        $row = [];
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() != 0)
        {
            foreach($result as $key => $value)
            {
                $row[$key] = $value;
            }
        }
        return $row;
    }
    
    public function delete()
    {
        if($this->id != -1)
        {
            $sql = "DELETE FROM Addresses WHERE id=$this->id";
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
