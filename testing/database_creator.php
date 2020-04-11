<?php


try {
     
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
    $bulk = new MongoDB\Driver\BulkWrite;
	date_default_timezone_set('Asia/Kolkata');
    
	$mongo_date = new DateTime('1997-09-03');
	$birth_date = $mongo_date->getTimestamp();	

	$mongo_date = new DateTime();
	$reg_date = $mongo_date->getTimestamp();

	$mongo_date = new DateTime('2017-10-03  16:30:00');
	$notify_time = $mongo_date->getTimestamp();

	$mongo_date = new DateTime('2017-10-03  17:40:00');
	$post_time = $mongo_date->getTimestamp();

	$mongo_date = new DateTime('2017-10-03  17:40:00');
	$comment_time = $mongo_date->getTimestamp();

	$mongo_date = new DateTime('2017-10-03  17:40:00');
	$feedback_time = $mongo_date->getTimestamp();

	$mongo_date = new DateTime('2017-10-03  17:40:00');
	$chat_time = $mongo_date->getTimestamp();

	$secrets = 	[
					"question_1" => "What is your pets name?", 
					"answer_1" => "Tom", 
					"question_2" => "What's your mother tongue?", 
					"answer_2" => "Telugu"
				];

	$user_inf = [
					"school" => "ssv", 
					"college" => "PSG", 
					"relationship_status" => "single", 
					"mobile" => "9791745977", 
					"mobile_visibility" => "public", 
					"website" => "www.surya3997.ml", 
					"connector_id" => "surya3997", 
					"home_town" => "cbe", 
					"current_city" => "cbe", 
					"Job" => ""
				];


    $doc = 	[
				'_id' => new MongoDB\BSON\ObjectID, 
				'name' => 'Surya Prasath', 
				'email' => "surya3997@gmail.com", 
				'password' => "1d2727face9e8a5171fd434ca9ac155020be70db", 
				'gender' => "male", 
				'birthday' => $birth_date, 
				"registered" => $reg_date, 
				"secret_quote" => $secrets, 
				"user_info" => $user_inf, 
				"user_cover_pic" => [], 
				"user_profile_pic" => [], 
				"notification" => 	[
										[
											"notify_txt" => "You have signed in!", 
											"notify_time" => $notify_time,
											"seen" => 0
										]
									],
				"user_status" => 1,
				"user_post" => 	[
									[
										"post_txt" => "This is my first post!",
										"post_pic" => "",
										"post_time" => $post_time,
										"visibility" => "friends",
										"likes" => 	[],
										"comments" => 	[
															[
																"commenter" => "",
																"comment_txt" => "",
																"time" => ""
															]
														]
									]
								],
				"friends" => 	[],
				"feedback" => 	[
									[
										"feedback_txt" => "",
										"star" => 0,
										"time" => ""
									]
								],
				"warning" => 	[
									[
										"warning_txt" => "",
										"seen" => 1
									]
								],
				"group_chat" => [
									[
										"chat_text" => "",
										"time" => $chat_time
									]
								]

			];
    
	$bulk->insert($doc);
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

