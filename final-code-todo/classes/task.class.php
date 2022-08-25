<?php

require_once("Db.class.php");

class Task {


    public static function create($task, $time, $date, $list) {
        
        try {
                    $conn = Db::getInstance();
                    $statement = $conn->prepare("INSERT INTO `task` (`title`, `time`, `enddate`, `list_id`, `done`) VALUES (:title,:time,:enddate,:list_id,'0')");
                    $statement->bindParam(":title", $task);
                    $statement->bindParam(":time", $time);
                    $statement->bindParam(":enddate", $date);
                    $statement->bindParam(":list_id", $list);
                    $statement->execute();
                    return true;
                    
            } catch ( Throwable $t ) {
                return false;
    
            }
    }
    public static function getAll($listid) {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select * from task where list_id = :list_id ORDER BY enddate ASC');
        $statement->bindParam(':list_id', $listid);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function done($taskname, $listid) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE `task` set `done` = '1' WHERE title = :title AND list_id = :list_id");
        $statement->bindParam(':title', $taskname);
        $statement->bindParam(':list_id', $listid);
        $statement->execute();

        
    }
    public static function undone($taskname, $listid) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE `task` set `done` = '0' WHERE title = :title AND list_id = :list_id");
        $statement->bindParam(':title', $taskname);
        $statement->bindParam(':list_id', $listid);
        $statement->execute();
        
    }
    public static function taskdelete($listid) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("DELETE FROM `task` WHERE list_id = :list_id");
        $statement->bindParam(':list_id', $listid);
        $statement->execute();
        
    }

    public static function singletaskdelete($taskid) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("DELETE FROM `task` WHERE id = :id");
        $statement->bindParam(':id', $taskid);
        $statement->execute();
        
    }

    public function settaskname($taskname){
        self::checktaskname($taskname);
        $this->taskname = $taskname;
    }

    private function tasknameExist($taksname){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT id FROM `task` WHERE title = :title");
        $statement->bindValue(":title", $taskname);
        $statement->execute();
        $result = $statement->fetch();

        if(!$result){
            return False;
        }
        else{
            return True;
        }
    }

    private function checktaskname($taskname){
        if($this->tasknameExist($taskname)){
          throw new Exception("Titel is al in gebruik");
        }
      }
    
}
