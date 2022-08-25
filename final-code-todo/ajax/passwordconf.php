<?php
    include_once("../classes/User.class.php");
    include_once("../classes/Db.class.php");
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['passwordConfirmation'];
        $response = [];
    if( User::passwordCheck($password, $passwordConfirmation) ){
        $response['status'] = 'success'; 
        
    }
    else {
        $response['status'] = 'error';   
        
    }
    header('Content-Type: application/json');
    echo json_encode($response);