<?php

    include_once "../includes/session.php";

    $session = new Session();

    $jsonMessage = array();

    if (!$session->isLoggedIn()) {
        $jsonMessage['status'] = 'Illegal_entry';
        die(json_encode($jsonMessage));
    }

    $idToUpdate = $_POST['updateId'];
    $message = $_POST['message'];

    $mongo_date = new DateTime();
    $notify_time = $mongo_date->getTimestamp();
    
    $ins = ['notify_txt' => $message, 'notify_time' => $notify_time, 'seen' => 0];

    $mongo_id = new MongoDB\BSON\ObjectID($idToUpdate);

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
        ['_id' => $mongo_id],
        ['$push' => ['notification' => $ins]]
    );

    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('outerJoin.USERS', $bulk);
    echo "Updated successfully";


    // $doc = [$mongo_id.'.notification' => $ins];
    // echo "notification inserted";
    // $bulk->insert($doc);
?>