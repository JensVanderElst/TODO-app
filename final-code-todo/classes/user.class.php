<?php

require_once("Db.class.php");
require_once("password.class.php");

    class User {
        private $username;
        private $fullname;
        private $password;
        private $passwordConfirmation;
        private $email;


        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }
        

        /**
         * Get the value of fullname
         */ 
        public function getFullname()
        {
                return $this->fullname;
        }

        /**
         * Set the value of fullname
         *
         * @return  self
         */ 
        public function setFullname($fullname)
        {
                $this->fullname = $fullname;

                return $this;
        }


        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }


        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }
        
        /**
         * Get the value of passwordConfirmation
         */ 
        public function getPasswordConfirmation()
        {
                return $this->passwordConfirmation;
        }

        /**
         * Set the value of passwordConfirmation
         *
         * @return  self
         */ 
        public function setPasswordConfirmation($passwordConfirmation)
        {
                $this->passwordConfirmation = $passwordConfirmation;

                return $this;
        }


        /**
         * @return boolean - true if registration, false if unsuccessful.
         */
        public function register() {
                        try {
                                $password = passwordOptions::hash($this->password);
                                $conn = Db::getInstance();
                                $statement = $conn->prepare('INSERT INTO user (username, fullname, email, password) values (:username, :fullname, :email, :password)');
                                $statement->bindParam(':username', $this->username);
                                $statement->bindParam(':fullname', $this->fullname);
                                $statement->bindParam(':email', $this->email);
                                $statement->bindParam(':password', $password);
                                $statement->execute();
                                    return true;
                    
                            } catch ( Throwable $t ) {
                                return false;
                    
                            }
                
            
        }

        public function login() {
                try {
                        $password = passwordOptions::hash($this->password);
                        $conn = Db::getInstance();
                        $statement = $conn->prepare("SELECT * FROM user WHERE username = :username");
                        $statement->bindParam(':username', $this->username); 
                        $statement->execute();
                        $result = $statement->fetch(PDO::FETCH_ASSOC);
                            
                        if (!empty($result)) {
                               if (password_verify($this->password, $result['password'])){
                                return array($_SESSION["id"] = $result['id'], $_SESSION['username'] = $result['username'], $_SESSION["email"] = $result['email'], $_SESSION["fullname"] = $result['fullname'], $_SESSION["admin"] = $result['admin']);
                                return true;
                               }
                        } else {
                                return false;
                        }
                        
            
                    } catch ( Throwable $t ) {
                        return false;
            
                    }
        
    
}

        public static function findEmail($email){
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from user where email = :email limit 1");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if(!empty($result)){
                    return true;
                    
            }else{
                    return false;
            }
            
        }

        public static function emailCheck($email){
            $mail = self::findEmail($email);
            
            // PDO returns false if no records are found so let's check for that
            if($mail == false){
                return true;
            } else {
                return false;
            }
        }

        public static function findUser($username){
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from user where username = :username limit 1");
            $statement->bindValue(":username", $username);
            $statement->execute();
            $result =  $statement->fetch(PDO::FETCH_ASSOC);
            if(!empty($result)){
                    return true;
            }else{
                    return false;
            }
        }

        public static function userCheck($username){
            $user = self::findUser($username);
            
            if($user == false){
                return true;
            } else {
                return false;
            }
    }

    public static function passwordCheck($password, $passwordConfirmation){
        
        if($password == $passwordConfirmation){
            return true;
        } else {
            return false;
        }
        }

        public static function getAll() {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select * from user');
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function makeadmin($username) {
                try {
                            $conn = Db::getInstance();
                            $stmt = $conn->prepare("UPDATE `user` set admin = '1' WHERE username = :username" );
                            $stmt->bindParam(":username", $username);
                            $stmt->execute();
                        
                            return true;
            
                    } catch ( Throwable $t ) {
                        return false;
            
                    }
            }
            public static function makeuser($username) {
                try {
                            $conn = Db::getInstance();
                            $stmt = $conn->prepare("UPDATE `user` set admin = NULL WHERE username = :username" );
                            $stmt->bindParam(":username", $username);
                            $stmt->execute();
                        
                            return true;
            
                    } catch ( Throwable $t ) {
                        return false;
            
                    }
            }
            public static function getcount() {
                $conn = Db::getInstance();
                $statement = $conn->prepare('select count(1) FROM `user`');
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_NUM);
                
            }

    }