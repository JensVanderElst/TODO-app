<?php
    include_once("../classes/User.class.php");
    include_once("../classes/Db.class.php");
        $username = $_POST['username'];
        $response = [];
    if( User::userCheck($username) ){
        $response['status'] = 'success'; 
        
    }
    else {
        $response['status'] = 'error';   
        
    }
    header('Content-Type: application/json');
    echo json_encode($response);