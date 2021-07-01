<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/tutorials.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Tutorial($db);

    $stmt = $items->getTutorial();
    $itemCount = $stmt->rowCount();


    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $tutorialArr = array();
        $tutorialArr["body"] = array();
        $tutorialArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                
                "id" => $id,
                "title" => $title,
                "description" => $description
                
            );

            array_push($tutorialArr["body"], $e);
        }
        http_response_code(200);
        echo json_encode($tutorialArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>