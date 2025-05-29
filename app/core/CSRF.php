<?php

class CSRF {
    
    
    public static function generateToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    
    
    
    
    public static function validateToken($token)
    {
        if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
            
            
            
            
            
            return true;
        }
        return false;
    }

    public static function getTokenFieldName()
    {
        return 'csrf_token';
    }

    
    public static function field()
    {
        echo '<input type="hidden" name="' . self::getTokenFieldName() . '" value="' . self::generateToken() . '">';
    }
}