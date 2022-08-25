<?php
include_once("superclass.php");
//https://www.startutorial.com/articles/view/php_file_upload_tutorial_part_1
// Juiste file path
$fileName = $_GET['name'];
$filePath = 'uploads/'.$fileName;
// Verwijder file als het bestaat
if ( file_exists($filePath) ) {
    unlink($filePath);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>