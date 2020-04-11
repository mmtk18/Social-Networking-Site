<?php


try {
     
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
    $bulk = new MongoDB\Driver\BulkWrite;
    
    //$doc = ['_id' => new MongoDB\BSON\ObjectID, 'name' => 'Benz', 'price' => 26700];
    //$bulk->insert($doc);
    //$bulk->update(['name' => 'Benz'], ['$set' => ['price' => 52000]]);
    $bulk->delete(['name' => 'Toyota']);
    
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

