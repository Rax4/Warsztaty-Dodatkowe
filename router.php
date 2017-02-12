<?php

require 'load.php';
$class = null;
$returnUrl = null;

$request = '';
$arrayRequest = [];
$requestClass = '';

//Parsowanie zapytania
$request = $_SERVER['REQUEST_URI'];
$arrayRequest = explode('/', $request);

if (isset($arrayRequest[2]))
{
    $requestClass = $arrayRequest[2];
}
else
{
    echo 'Nie podałeś nazwy klasy';
    die();
}

if (isset($arrayRequest[3]))
{
    $requestParam = $arrayRequest[3];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    if (isset($requestParam)==false || $requestParam == false) 
    {
        if ($requestClass=='user') 
        {
            
                $arr = User::loadAllFromDB();
        }
        if ($requestClass=='parcel') 
        {
            
                $arr = Package::loadAllFromDB();
        }
        if ($requestClass=='size') 
        {
            
                $arr = Size::loadAllFromDB();
        }
        if ($requestClass=='address') 
        {
            
                $arr = Address::loadAllFromDB();
        }
    }
    else 
    {
        if($requestClass == 'user')
        {
            $user = new User();
            $arr = $user->loadFromDB($requestParameter);
            
        }
        else if($requestClass == 'size')
        {
            $user = new Size();
            $arr = $user->loadFromDB($requestParameter);
            
        }
        else if($requestClass == 'address')
        {
            $user = new Address();
            $arr = $user->loadFromDB($requestParameter);
            
        }
        else if($requestClass == 'parcel')
        {
            $user = new Package();
            $arr = $user->loadFromDB($requestParameter);
        }
    }
    echo json_encode($arr);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    switch ($requestClass) 
    {
        case 'user':
            $addressId =   $_POST['address_id'];
            $name =         $_POST['name'];
            $surname=       $_POST['surname'];
            $credits =      $_POST['credits'];
            $pass =         $_POST['pass'];
            
            $class = new User();
            $class->setAddressId($addressId);
            $class->setName($name);
            $class->setSurname($surname);
            $class->setCredits($credits);
            $class->setHashedPassword($pass);
            break;

        case 'size':
            $size = $_POST['size'];
            $price = $_POST['price'];
            $class = new Size();
            $class->setSymbol($size);
            $class->setPrice($price);
            break;
        
        case 'address':
            $city   = $_POST['city'];
            $code   = $_POST['code'];
            $street = $_POST['street'];
            $flat   = $_POST['flat'];
            $class = new Address();
            
            $class->setCity($city);
            $class->setCode($code);
            $class->setStreet($street);
            $class->setNumber($flat);
            break;
        
        case 'parcel':
            $address_id = $_POST['address_id'];
            $size_id = $_POST['size_id'];
            $user_id = $_POST['user_id'];
            $class = new Package();
            $class->setSize($size_id);
            $class->setUserId($user_id);
            break;
        
        default:
            break;
    }
    
    if( $class->create() == false ) 
    {
        return false;
    }
    else 
    {
        return true;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'PUT') 
{
    parse_str(file_get_contents("php://input"), $put_vars);
    $id = $put_vars['id'];
    switch ($requestClass) 
    {
        case 'user':
            $address_id =   $put_vars['address_id'];
            $name =         $put_vars['name'];
            $surname=       $put_vars['surname'];
            $credits =      $put_vars['credits'];
            // $pass =         $put_vars['pass'];
            
            $class = new User();
            $class->loadFromDB($id);
            
            $class->setAddressId($address_id);
            $class->setName($name);
            $class->setSurname($surname);
            $class->setCredits($credits);
            // $class->setPass($pass);
            break;
         
        case 'size':
            $size = $put_vars['size'];
            $price = $put_vars['price'];
            $class = new Size();
            $class->loadFromDB($id);
            $class->setSymbol($size);
            $class->setPrice($price);
            break;
        
        case 'address':
            $city   = $put_vars['city'];
            $code   = $put_vars['code'];
            $street = $put_vars['street'];
            $flat   = $put_vars['flat'];
            $class = new Address();
            $class->loadFromDB($id);
            
            $class->setCity($city);
            $class->setCode($code);
            $class->setStreet($street);
            $class->setNumber($flat);
            break;
        
        case 'parcel':
            $size_id = $put_vars['size_id'];
            $user_id = $put_vars['user_id'];
            $class = new Package();
            $class->loadFromDB($id);
            $class->setSizeId($size_id);
            $class->setUserId($user_id);
            break;
        
        default:
            break;
    }
    if( $class->update() == false ) 
    {
        return false;
    }
    else 
    {
        return true;
    }
    
}
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') 
{
    parse_str(file_get_contents("php://input"), $put_vars);
    $id = $put_vars['id'];
    switch ($requestClass) 
    {
        case 'user':
            $class = new User();
            $class->loadFromDB($id);
            break;
      
        case 'size':
            $class = new Size();
            $class->loadFromDB($id);
            break;
        
        case 'address':
            $class = new Address();
            $class->loadFromDB($id);
            break;
        
        case 'parcel':
            $class = new Package();
            $class->loadFromDB($id);
            break;
        
        default:
            break;
    }
    if( $class->deleteFromDB() == false ) {
        return false;
    }else {
        return true;
    }
    
}
