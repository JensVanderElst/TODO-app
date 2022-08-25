<?php
    include_once("../classes/Lists.class.php");
    include_once("../classes/Db.class.php");
        $list = $_POST['list'];
        $user = $_POST['user'];
        $response = [];
    if( Lists::create($list, $user) ){
        $response['status'] = 'success'; 
    }
    else {
        $response['status'] = 'error';
    }
    header('Content-Type: application/json');
    echo json_encode($response);