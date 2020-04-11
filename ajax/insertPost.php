<?php

    include_once "../includes/session.php";

    $session = new Session();

    $jsonMessage = array();

    if (!$session->isLoggedIn()) {
        $jsonMessage['status'] = 'Illegal_entry';
        die(json_encode($jsonMessage));
    }

    $idToUpdate = $_SESSION['id'];
    $message = $_POST['post_txt'];
    $visibility = $_POST['visibility'];

    $mongo_date = new DateTime();
    $notify_time = $mongo_date->getTimestamp();
    
    $ins = ['post_txt' => $message, 'post_time' => $notify_time,
     'visibility' => $visibility, 
    'likes' => [], 'comments' => []];

    $mongo_id = new MongoDB\BSON\ObjectID($idToUpdate);

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(
        ['_id' => $mongo_id],
        ['$push' => ['user_post' => $ins]]
    );

    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('outerJoin.USERS', $bulk);
    echo "Updated";

?>