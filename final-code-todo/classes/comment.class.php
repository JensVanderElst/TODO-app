<?php

require_once("Db.class.php");

class Comment {


    public static function create($comment, $task) {
        try {
                    $conn = Db::getInstance();
                    $stmt = $conn->prepare("INSERT INTO `comment` (title,time,task_id) values (:title,CURRENT_TIMESTAMP,:task_id)");
                    $stmt->bindParam(":title", $comment);
                    $stmt->bindParam(":task_id", $task);
                    $stmt->execute();
                
                    return true;
    
            } catch ( Throwable $t ) {
                return false;
    
            }
    }

    public static function update($commentid, $commenttext) {
        try {
                    $conn = Db::getInstance();
                    $stmt = $conn->prepare("UPDATE `comment` set `title` = :title WHERE id = :id");
                    $stmt->bindParam(":title", $commenttext);
                    $stmt->bindParam(":id", $commentid);
                    $stmt->execute();
                
                    return true;
    
            } catch ( Throwable $t ) {
                return false;
    
            }
    }

    public static function getAll($taskid) {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select * from comment where task_id = :task_id ORDER BY time DESC');
        $statement->bindParam(':task_id', $taskid);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getcomment($getid) {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select title from comment where id = :id');
        $statement->bindParam(':id', $getid);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}