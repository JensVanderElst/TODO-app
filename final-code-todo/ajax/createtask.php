<?php
    include_once("../classes/Task.class.php");
    include_once("../classes/Db.class.php");
        $task = $_POST['task'];
        $list = $_POST['list'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $response = [];
    if( Task::create($task, $time, $date, $list) ){
        $response['status'] = 'success';  
    }
    else {
        $response['status'] = 'error';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
