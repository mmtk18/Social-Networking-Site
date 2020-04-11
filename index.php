<?php
	include_once "./includes/session.php";

    $session = new Session();

    $jsonMessage = array();

    if (!$session->isLoggedIn()) {
        $jsonMessage['status'] = 'Error';
		$jsonMessage['data'] = "Not Logged in";
		$newURL = './register.php';
		header('Location: '.$newURL);
		die(json_encode($jsonMessage));
    } else {
		$jsonMessage['status'] = 'Success';
		$jsonMessage['data'] = "Logging in";
	}

?>


	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Document</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="./css/index.css">
		<link rel="stylesheet" href="./css/test.css">

		<style>
			.pb-cmnt-container {
				font-family: Lato;
				margin-top: 100px;
			}

			.pb-cmnt-textarea {
				resize: none;
				padding: 20px;
				height: 130px;
				width: 100%;
				border: 1px solid #F2F2F2;
			}
		</style>

	</head>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
					 aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="./index.php">Outer Join</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

					<form class="navbar-form navbar-left">
						<div class="form-group">
							<input type="text" class="form-control" id="search-box" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default" onclick="searchUser();">Submit</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown" id="notify-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<span id="notify-button" class="glyphicon glyphicon-info-sign"></span>
							</a>
							<ul class="dropdown-menu" id="notify_append">
								<li>
									<a href="#">
										<b>Your notifications are:</b>
									</a>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<span id="append_name">Welcome </span>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">
										<span id="update-button" class="glyphicon glyphicon-cog"></span>Update Settings</a>
								</li>
								<li>
									<a href="#" onclick="logout();">
										<span id="notify-button" class="glyphicon glyphicon-log-out"></span>logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>


		<div class="row container-fluid">
			<div class="col-sm-3" id="append_info_div" onclick="location.href = './myprofile.php';">
				<h2>Profile</h2>
				<div class="row">
					<div class="col-sm-8">
						<img class="img-responsive img-circle" src="./images/skeleton_logo.png" alt="Chania">
					</div>
				</div>
				<br>
			</div>
			<div class="col-sm-6" id="append_post_div">
				<h2>Friend's Posts</h2>

				<div class="panel panel-default">
					<div class="panel-body">
						<div class="media" id="user_post_1">
							<div class="media-left">
								<img src="./images/skeleton_logo.png" class="media-object" style="width:45px">
							</div>
							<div class="media-body">
								<h4 class="media-heading">John Doe
									<small>
										<i>Posted on February 19, 2016</i>
									</small>
								</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
									aliqua.
								</p>
								<i onclick="myFunction(this)" class="fa fa-thumbs-o-up btn btn-primary"> Like</i>

								<!-- Nested media object -->
								<div class="media" id="user_post_comment_1">
									<div class="media-left">
										<img src="./images/skeleton_logo.png" class="media-object" style="width:45px">
									</div>
									<div class="media-body">
										<h4 class="media-heading">John Doe
											<small>
												<i>Posted on February 20, 2016</i>
											</small>
										</h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
											aliqua.
										</p>
									</div>
								</div>

								<!-- Nested media object -->
								<div class="form-group">
									<label for="comment">Comment:</label>
									<textarea class="form-control" rows="4" id="comment"></textarea><br>
									<button type="button" class="btn btn-primary" onclick="comment_post(this)">Post</button>
								</div>


							</div>
						</div>
					</div>
				</div>


			</div>
			<div class="col-sm-3 visible-lg">
				<h2>Group Chat</h2>
				<p>Your chat is visible to all the members</p>
				<div id="chat_affect">
					<ul style="width: 280px; height: 300px; overflow: auto" id="chat_scroll"></ul>
					<div>
						<div class="msj-rta macro" style="margin:350px 24px auto auto">
							<div class="text text-r" style="background:whitesmoke !important">
								<input class="mytext" placeholder="Type a message" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script src="./js/index.js"></script>

		<script>
		function comment_post(x) {
			console.log(x.id);
			var s = x.id;
			var comm = $('#comment_' + s).val();
			console.log(comm);
			var name = x.id.split("_");
			console.log(name);
			var request = {'updateId': name[0], 'postIndex':name[1], 'comment': comm};
			$.post("./ajax/commentPost.php", request, function (response) {
				if (response != 'Updated') {
					alert('comment not posted');
				} else {
					location.reload();
				}
			});
		}
		</script>

	</body>

	</html>