<?php

namespace App\Utils;

class Validator
{
    
    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePassword($password)
    {
        return strlen($password) >= 8; 
    }

    public static function validateUsername($username)
    {
        return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username); 
    }

  
    public static function validateId($id)
    {
        return is_numeric($id) && $id > 0;
    }
}