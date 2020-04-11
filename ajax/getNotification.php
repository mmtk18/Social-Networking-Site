<?php

    include_once "../includes/session.php";

    $session = new Session();

    $jsonMessage = array();

    if (!$session->isLoggedIn()) {
        $jsonMessage['status'] = 'Error';
		$jsonMessage['data'] = 'Illegal Entry';
        die(json_encode($jsonMessage));
    }

    
    $mongo_id = new MongoDB\BSON\ObjectID($_SESSION['id']);

    $rows = db_query(['_id' => $mongo_id], ['projection' => ['_id' => 0, 'notification' => 1]]);
    $pushArray = array();

    foreach($rows as $row) {
        array_push($pushArray, $row);
    }

    $jsonMessage['status'] = 'Success';
	$jsonMessage['data'] = $pushArray;

    die(json_encode($jsonMessage));

?>