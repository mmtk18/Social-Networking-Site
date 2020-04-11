<?php

    include_once "../includes/session.php";

    $session = new Session();

    $jsonMessage = array();

    if (!$session->isLoggedIn()) {
        $jsonMessage['status'] = 'Error';
        die(json_encode($jsonMessage));
    }

    $email = $_SESSION['id'];
    $mongo_id = new MongoDB\BSON\ObjectID($email);

    $count = db_count(['_id' => $mongo_id]);

    if ($count > 0) {
        $option = ["projection" => [ 
                    'password' => 0, 'secret_quote' => 0, 
                    'feedback' => 0, 'warning' => 0, 
                    'group_chat' => 0, 'notification' => 0]];
        $rows = db_query(['_id' => $mongo_id], $option);

        $printer = array();
        foreach ($rows as $row) {
            array_push($printer, $row);
        }
        die(json_encode($printer[0]));
    } else {
        $jsonMessage['status'] = 'Invalid_email';
        die(json_encode($jsonMessage));
    }


?>