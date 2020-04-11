<?php
$mongo_id = new MongoDB\BSON\ObjectID('5a642a95aff8fb3ec8385f32');
    $mongo_send_id = new MongoDB\BSON\ObjectID('5a644a89aff8fb3ec74ede52');
    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        
		$bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => $mongo_id],
            ['$pull' => ['friends' => NULL]]
        );
        $result = $manager->executeBulkWrite('outerJoin.USERS', $bulk);

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => $mongo_send_id],
            ['$pull' => ['friends' => NULL]]
        );
        $result = $manager->executeBulkWrite('outerJoin.USERS', $bulk);

    echo "updation done";

?>
