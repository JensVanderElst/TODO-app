<?php
    abstract class Db{
        private static $conn;
        
        public static function getInstance(){
            if (self::$conn != null) {
                return self::$conn;
            } else {
                self::$conn = new PDO('mysql:host=localhost;dbname=todo_manager;charset=utf8mb4','root','');
                return self::$conn;
            }
            
        }
    }