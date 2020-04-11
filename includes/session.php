<?php
session_start();

function db_query($findArray, $option) {
    try {

        $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $query = new MongoDB\Driver\Query($findArray, $option); 
         
        $rows = $mng->executeQuery("outerJoin.USERS", $query);
                
        return $rows;

    } catch (MongoDB\Driver\Exception\Exception $e) {
    
        $filename = basename(__FILE__);
        $error_msg = "The ". $filename . "script has experienced an error.\nIt failed with the following exception:\nException:" . $e->getMessage() . "\nIn file:" . $e->getFile() . "\nOn line:" . $e->getLine() . "\n";       
    
        $status = 'error';
        $output = array('status' => $status, 'data' => $error_msg);
        return $output;

    }
}

function db_count($query) {
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	$command = new MongoDB\Driver\Command(["count" => "USERS", "query" => $query]);
	try {
	    $result = $mng->executeCommand("outerJoin", $command);
	    $res = current($result->toArray());
	    $count = $res->n;
	    return $count;
	} catch (MongoDB\Driver\Exception\Exception $e) {
	    die($e->getMessage());
	}
}

class Session {
    private $userId;

    public function __construct() {
        //echo $_SESSION['id'] == '';
        if (isset($_SESSION['id']) && $_SESSION['id'] != '') {
            $mongo_id = new MongoDB\BSON\ObjectID($_SESSION['id']);

            $query = ["_id" => $mongo_id];
            if (db_count($query)) {
                $this->userId = $_SESSION['id'];
            } else {
                $this->userId = NULL;
            }
        } else {
            $this->userId = NULL;
        }
    }
    
    public function isLoggedIn() {
        return ($this->userId != NULL);
    }

    public function login($userMail, $password) {
        if ($this->isLoggedIn()) {
            $response = ['status' => 'Error', 'data' => 'already logged in'];
            return $response;
        } else {
            if (db_count(['email' => $userMail])) {
                $hashedPassword = sha1($password);
    
                if (db_count(['email' => $userMail, 'password' => $hashedPassword])) {
                    $option = ["projection" => ['password' => 0, 'secret_quote' => 0, 'feedback' => 0, 'warning' => 0, 'group_chat' => 0]];
                    $rows = db_query(['email' => $userMail, 'password' => $hashedPassword], $option);

                    $printer = array();
                    foreach ($rows as $row) {
                        array_push($printer, $row);
                    }

                    $this->userId = (string)$printer[0]->_id;
                    $_SESSION['id'] = (string)$printer[0]->_id;

                    $bulk = new MongoDB\Driver\BulkWrite;
                    $mongo_id = new MongoDB\BSON\ObjectID($_SESSION['id']);
                    $bulk->update(
                        ['_id' => $mongo_id],
                        ['$set' => ['user_status' => 1]],
                        ['multi' => false, 'upsert' => true]
                    );

                    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
                    $result = $manager->executeBulkWrite('outerJoin.USERS', $bulk);

                    //die(json_encode($printer[0]));
                    $response = ['status' => 'Success', 'data' => 'Loggin in'];
                    return $response;
                } else {
                    $response = ['status' => 'Error', 'data' => 'Invalid password'];
                    return $response;
                }
            } else {
                $response = ['status' => 'Error', 'data' => 'Invalid Username'];
                return $response;
            }

        }
    }


    public function logout() {

        $bulk = new MongoDB\Driver\BulkWrite;
        $mongo_id = new MongoDB\BSON\ObjectID($_SESSION['id']);
        $bulk->update(
            ['_id' => $mongo_id],
            ['$set' => ['user_status' => 0]],
            ['multi' => false, 'upsert' => true]
        );

        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        $result = $manager->executeBulkWrite('outerJoin.USERS', $bulk);

        $_SESSION['id'] = '';
        $this->userId = NULL;
    }

}