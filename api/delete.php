<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/tutorials.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Tutorial($db);
    
    $data = json_decode(file_get_contents("php://input"));
   // return "true";
    
    $item->id = $data->id;
    
    if($item->deleteTutorial()){
        echo json_encode("Tutorial deleted.");
    } else{
        echo json_encode("Tutorial could not be deleted");
    }
?>