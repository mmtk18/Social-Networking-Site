<?php

// Sample MongoDB command:
// db.product.distinct("scent", {"prodCat": "10 oz can"})

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$mongo_id = new MongoDB\BSON\ObjectID('5a642a95aff8fb3ec8385f32');

$query = ['_id' => $mongo_id]; // your typical MongoDB query
$cmd = new MongoDB\Driver\Command([
    // build the 'distinct' command
    'collection' => 'USERS', // specify the collection name
    //'key' => 'notification', // specify the field for which we want to get the distinct values
    'query' => $query // criteria to filter documents
]);
$cursor = $manager->executeCommand('catalog', $cmd); // retrieve the results
$scents = current($cursor->toArray())->values; // get the distinct values as an array

var_dump($scents);

?>
