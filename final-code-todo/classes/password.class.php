<?php
    class PasswordOptions
    {
        public static function hash($password)
        {
            $options = [
                'cost' => 11,
            ];
            return password_hash($password, PASSWORD_BCRYPT, $options);
        }
            
            
    }