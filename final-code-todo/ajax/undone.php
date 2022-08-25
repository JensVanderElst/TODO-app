<?php
    include_once("../classes/Task.class.php");
    include_once("../classes/Db.class.php");
        $listid = $_POST['listid'];
        $taskname = $_POST['taskname'];
        $response = [];
    if( Task::undone($taskname, $listid) ){
        $response['status'] = 'success';  
    }
    else {
        $response['status'] = 'error';
    }
    header('Content-Type: application/json');
    echo json_encode($response);