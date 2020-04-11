<?php


try {
     
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
    $bulk = new MongoDB\Driver\BulkWrite;
    
    //$doc = ['_id' => new MongoDB\BSON\ObjectID, 'name' => 'Benz', 'price' => 26700];
    //$bulk->insert($doc);
	$id = '5a61f215aff8fb13023aca63';
    $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($id)], ['$set' => ['secret_quote.answer_1' => 'jerry']]);
    //$bulk->delete(['name' => 'Toyota']);
    
    $mng->executeBulkWrite('outerJoin.USERS', $bulk);
        
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";    
}

?>

