<?php

class Size extends DataBase
{    
    private $id;
    private $symbol;
    private $price;

    public function __construct() 
    {
        $this->id = -1;
        $this->symbol = null;
        $this->price = '';
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
        return true;
    }
    
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
        return true;
    }
    
    public function getSymbol()
    {
        return $this->symbol;
    }
    
    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function create()
    {
        if($this->id == -1)
        {
            $sql = "INSERT INTO Sizes(symbol, price)
            VALUES (?,?)";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->symbol,  $this->price]);
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
            $sql = "UPDATE Sizes SET symbol=?, price=?WHERE id=?";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->symbol,  $this->price, $this->id]);
            if($result == true)
            {
                return true;
            }
        }
        return false;
    }
    
    public function loadFromDB($id)
    {
        $sql = "SELECT * FROM Sizes WHERE id=$id";
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() == 1)
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->symbol = $row['symbol'];
            $this->price = $row['price'];
            
            return $row;
        }
        return false;
    }

    static public function loadAllObjectsFromDB()
    {
        $sql = "SELECT * FROM Sizes";
        $ret = [];
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() != 0)
        {
            foreach($result as $row)
            {
                $loadedSize = new Size();
                $loadedSize->id = $row['id'];
                $loadedSize->symbol = $row['symbol'];
                $loadedSize->price = $row['price'];
                $ret[] = $loadedSize;
            }
        }
        return $ret;
    }
    
        
    static public function loadAllFromDB()
    {
        $sql = "SELECT * FROM Sizes";
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
            $sql = "DELETE FROM Sizes WHERE id=$this->id";
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
