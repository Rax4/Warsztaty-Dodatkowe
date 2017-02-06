<?php
/***
 * Class represents one user
 * 
 */
class User
{
    private $id;
    private $address;
    private $name;
    private $surname;
    private $credits;
    private $hashedPassword;
    static public $connection;


    public function __construct() 
    {
        $this->id = -1;
        $this->address = '';
        $this->name = '';
        $this->surname = '';
        $this->credits = null;
        $this->hashedPassword = '';
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
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
    
    public function getAddress()
    {
        return $this->address;
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
            $sql = "INSERT INTO Users(address, name, surname, credits, hashed_password)
            VALUES (?,?,?,?,?)";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->address,  $this->name, $this->surname, $this->credits, $this->hashedPassword]);
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
            $sql = "UPDATE Users SET address=?, name=?,surname=?,credits=?,hashed_password=?WHERE id=?";
            $stm = self::$connection->prepare($sql);
            $result = $stm->execute([$this->address,  $this->name, $this->surname, $this->credits, $this->hashedPassword,  $this->id]);
            if($result == true)
            {
                return true;
            }
        }
        return false;
    }
    
    static public function loadFromDB($id)
    {
        $sql = "SELECT * FROM Users WHERE id=$id";
        $result = self::$connection->query($sql);
        if($result == true && $result->rowCount() == 1)
        {
            $row = $result->fetch();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->name = $row['name'];
            $loadedUser->surname = $row['surname'];
            $loadedUser->credits = $row['credits'];
            $loadedUser->address = $row['address'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            return $loadedUser;
        }
        return null;
    }

    static public function loadAllFromDB()
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
                $loadedUser->address = $row['address'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
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
