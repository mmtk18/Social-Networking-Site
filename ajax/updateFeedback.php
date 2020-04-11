<?php

    include_once "../includes/session.php";

    $session = new Session();

    $jsonMessage = array();

    if (!$session->isLoggedIn()) {
        $jsonMessage['status'] = 'Illegal_entry';
        die(json_encode($jsonMessage));
    }

    $idToUpdate = $_SESSION['id'];
    $message = $_POST['message'];
    $stars = $_POST['stars'];

    $mongo_date = new DateTime();
    $notify_time = $mongo_date->getTimestamp();
    
    $ins = ['feedback_txt' => $message, 'feedback_time' => $notify_time, 'stars' => $stars];

    $mongo_id = new MongoDB\BSON\ObjectID($idToUpdate);

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
        ['_id' => $mongo_id],
        ['$push' => ['feedback' => $ins]]
    );

    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('outerJoin.USERS', $bulk);
    echo "Updated successfully";


    // $doc = [$mongo_id.'.notification' => $ins];
    // echo "notification inserted";
    // $bulk->insert($doc);
?>