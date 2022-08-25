<?php

require_once("Db.class.php");

class Lists {


    public static function create($list, $user) {
        try {
                    $conn = Db::getInstance();
                    $stmt = $conn->prepare("INSERT INTO `list` (name,user_id) values (:name,:user_id)");
                    $stmt->bindParam(":name", $list);
                    $stmt->bindParam(":user_id", $user);
                    $stmt->execute();
                
                    return true;
    
            } catch ( Throwable $t ) {
                return false;
    
            }
    }
    public static function getAll($userid) {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select * from list where user_id = :user_id ORDER BY time DESC');
        $statement->bindParam(':user_id', $userid);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



    public static function deletelList($userid, $listname) {
        try {
                    $conn = Db::getInstance();
                    $stmt = $conn->prepare("DELETE FROM `list` WHERE name = :name AND user_id = :user_id" );
                    $stmt->bindParam(":name", $listname);
                    $stmt->bindParam(":user_id", $userid);
                    $stmt->execute();
                
                    return true;
    
            } catch ( Throwable $t ) {
                return false;
    
            }
    }

    public static function getcount() {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select count(1) FROM `list`');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
        
    } 
}