<?php
/***
 * Class represents one user
 * 
 */
class User extends DataBase
{
    private $id;
    private $addressId;
    private $name;
    private $surname;
    private $credits;
    private $hashedPassword;


    public function __construct() 
    {
        $this->id = -1;
        $this->addressId = null;
        $this->name = '';
        $this->surname = '';
        $this->credits = null;
        $this->hashedPassword = '';
    }
    
    public function setAddressId($address)
    {
        $this->addressId = $address;
        return true;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return true;
    }
    
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return true;
    }
    
    public function setCredis($credits)
    {
        $this->credits = $credits;
        return true;
    }
    
    public function setHashedPassword($password)
    {
        $newHashedPassword = password_hash($password,PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
        return true;
    }
    
    public function getAddressId()
    {
        return $this->addressId;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getSurname()
    {
        return $this->surname;
    }
    
    public function getCredis()
    {
        return $this->credits;
    }
    
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function create()
    {
        if($this->id == -1)
        {
            $sql = "INSERT INTO Users(address_id, name, surname, credits, hashed_password)
            VALUES (?,?,?,?,?)";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->addressId,  $this->name, $this->surname, $this->credits, $this->hashedPassword]);
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
            $sql = "UPDATE Users SET address_id=?, name=?,surname=?,credits=?,hashed_password=?WHERE id=?";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->addressId,  $this->name, $this->surname, $this->credits, $this->hashedPassword,  $this->id]);
            if($result == true)
            {
                return true;
            }
        }
        return false;
    }
    
    public function loadFromDB($id)
    {
        $sql = "SELECT * FROM Users WHERE id=$id";
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() == 1)
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->surname = $row['surname'];
            $this->credits = $row['credits'];
            $this->addressId = $row['address_id'];
            $this->hashedPassword = $row['hashed_password'];
            //Not true because usage on view (Also outcome will always be true)
            return $row;
        }
        return false;
    }

    static public function loadAllObjectsFromDB()
    {
        $sql = "SELECT * FROM Users";
        $ret = [];
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() != 0)
        {
            foreach($result as $row)
            {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->name = $row['name'];
                $loadedUser->surname = $row['surname'];
                $loadedUser->credits = $row['credits'];
                $loadedUser->addressId = $row['address_id'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }
    

    static public function loadAllFromDB()
    {
        $sql = "SELECT * FROM Users";
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
            $sql = "DELETE FROM Users WHERE id=$this->id";
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
