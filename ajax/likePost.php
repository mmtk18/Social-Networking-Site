<?php

    include_once "../includes/session.php";

    $session = new Session();

    $jsonMessage = array();

    if (!$session->isLoggedIn()) {
        $jsonMessage = 'Illegal_entry';
        die(json_encode($jsonMessage));
    }

    $idToUpdate = $_POST['updateId'];
    $postIndex = (string)$_POST['postIndex'];
    
    $id = (string)$_SESSION['id'];
    $mongo_session_id = new MongoDB\BSON\ObjectID($id);

    $count = db_count(['_id' => $mongo_session_id, 'user_post.' . $postIndex . "likes" => $id]);

    
    if ($count == 0) {
        $mongo_id = new MongoDB\BSON\ObjectID($idToUpdate);
        
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => $mongo_id],
            ['$push' => ['user_post.' . $postIndex . '.likes' => $id]]
        );
        
        //echo 'user_post.' . $postIndex . 'likes';
        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        $result = $manager->executeBulkWrite('outerJoin.USERS', $bulk);
    }

    
    echo "Updated";

?>