<?php

try {

    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	$mongo_id = new MongoDB\BSON\ObjectID("5a644a89aff8fb3ec74ede52");

    $query = new MongoDB\Driver\Query(["_id" => $mongo_id]); 
     
    $rows = $mng->executeQuery("outerJoin.USERS", $query);
    $printer = array();
    foreach ($rows as $row) {
    	var_dump($row);
    }

	//die(json_encode($printer));
	echo (string)$printer[0]->_id;
    
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";       
}

?>
