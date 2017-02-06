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
}
