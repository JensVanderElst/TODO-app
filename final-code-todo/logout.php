<?php
include_once("superclass.php");
    session_start();
    session_destroy();
    header("Location: login.php");

?>