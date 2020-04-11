<?php
    include_once './includes/session.php';
    $session = new Session();

    if ($session->isLoggedIn()) {
        $newURL = './index.php';
		header('Location: '.$newURL);
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
    <link rel="stylesheet" href="./css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        #rememberme-0 {
            margin-left: 0px;
        }

        .column1 {
            float: left;
            width: 50%;
            padding: 10px;
            height: 300px;
            /* Should be removed. Only for demonstration */
        }

        .column2 {
            float: right;
            width: 50%;
            padding: 10px;
            height: 300px;
            /* Should be removed. Only for demonstration */
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
            overflow-x: hidden;
            width: 100%;
        }

        #modal_width {
            min-width: 600px;
            margin-left: -125px;
        }

        #confirmsignup {
            margin-left: 16px;
        }
    </style>
</head>

<body>

    <!-- Button trigger modal -->

    <div class="container" style="margin-top:150px;">
        <hr class="prettyline">
        <br>
        <center>
            <h1>
                <b>Welcome to Outer Join</b>
            </h1>
            <h3>You need to sign in or register for this service</h3>
            <br>
            <button class="btn btn-primary btn-lg" href="#signup" data-toggle="modal" data-target=".bs-modal-sm">Sign In/Register</button>
        </center>
        <br>
        <hr class="prettyline">
    </div>


    <!-- Modal -->
    <div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" id="modal_width">
                <br>
                <div class="bs-example bs-example-tabs">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#signin" data-toggle="tab" style="margin-left:200px;">Sign In</a>
                        </li>
                        <li class="">
                            <a href="#signup" data-toggle="tab">Register</a>
                        </li>
                        <!-- <li class="">
                            <a href="#why" data-toggle="tab">Why?</a>
                        </li> -->
                    </ul>
                </div>
                <div class="modal-body">
                    <div id="myTabContent" class="tab-content">
                        <!-- <div class="tab-pane fade in" id="why">
                            <p>We need this information so that you can receive access to the site and its content. Rest assured
                                your information will not be sold, traded, or given to anyone.</p>
                            <p></p>
                            <br> Please contact
                            <a mailto:href="JoeSixPack@Sixpacksrus.com"></a>JoeSixPack@Sixpacksrus.com</a> for any other inquiries.</p>
                        </div> -->
                        <div class="tab-pane fade active in" id="signin">
                            <form class="form-horizontal" onsubmit="event.preventDefault();">
                                <fieldset>
                                    <!-- Sign In Form -->
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label" for="Email_login">Email-id:</label>
                                        <div class="controls">
                                            <input required="" id="Email_login" name="Email_login" type="text" class="form-control" placeholder="xyz@abc.com" class="input-medium"
                                                required="">
                                        </div>
                                    </div>

                                    <!-- Password input-->
                                    <div class="control-group">
                                        <label class="control-label" for="passwordinput_login">Password:</label>
                                        <div class="controls">
                                            <input required="" id="passwordinput_login" name="passwordinput_login" class="form-control" type="password" placeholder="********"
                                                class="input-medium">
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="control-group">
                                        <label class="control-label" for="signin_button"></label>
                                        <div class="controls">
                                            <button id="signin_button" name="signin_button" class="btn btn-success" onclick="validate_test();">Sign In</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="signup">
                            <form class="form-horizontal" onsubmit="event.preventDefault();">
                                <fieldset>
                                    <!-- Sign Up Form -->
                                    <!-- Text input-->
                                    <div class="row container-fluid">
                                        <div class="col-lg-6">
                                            <div class="control-group">
                                                <label class="control-label" for="Email">Email:</label>
                                                <div class="controls">
                                                    <input id="Email" name="Email" class="form-control" type="text" placeholder="xyz@abc.com" class="input-large" required="">
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="control-group">
                                                <label class="control-label" for="userid">Name:</label>
                                                <div class="controls">
                                                    <input id="userid" name="userid" class="form-control" type="text" placeholder="xyz" class="input-large" required="">
                                                </div>
                                            </div>

                                            <!-- Password input-->
                                            <div class="control-group">
                                                <label class="control-label" for="password">Password:</label>
                                                <div class="controls">
                                                    <input id="password" name="password" class="form-control" type="password" placeholder="********" class="input-large" required="">
                                                    <em>1-8 Characters</em>
                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="control-group">
                                                <label class="control-label" for="reenterpassword">Re-Enter Password:</label>
                                                <div class="controls">
                                                    <input id="reenterpassword" class="form-control" name="reenterpassword" type="password" placeholder="********" class="input-large"
                                                        required="">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="sel1">Select Gender:</label>
                                                <select class="form-control" id="sel1">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                    <option>Other</option>
                                                    <option>Prefer not to say</option>
                                                </select>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="reenterpassword">Enter Birthday:</label>
                                                <div class="controls">
                                                    <!--   <label class="control-label">Date: -->
                                                    <input type="text" id="datepicker" class="form-control">
                                                    <!--  </label> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="control-group">
                                                <label class="control-label" for="reenterpassword">Enter a secret question:</label>
                                                <div class="controls">
                                                    <input id="sec1" class="form-control" name="reenterpassword" type="text" placeholder="" class="input-large" required="">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="reenterpassword">Enter the answer:</label>
                                                <div class="controls">
                                                    <input id="sec_ans1" class="form-control" name="reenterpassword" type="text" placeholder="" class="input-large" required="">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="reenterpassword">Enter another secret question:</label>
                                                <div class="controls">
                                                    <input id="sec2" class="form-control" name="reenterpassword" type="text" placeholder="" class="input-large" required="">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="reenterpassword">Enter the answer:</label>
                                                <div class="controls">
                                                    <input id="sec_ans2" class="form-control" name="reenterpassword" type="text" placeholder="" class="input-large" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                                <!-- Button -->
                                <div class="control-group">
                                    <label class="control-label" for="confirmsignup"></label>
                                    <div class="controls">
                                        <button id="confirmsignup" name="confirmsignup" class="btn btn-success" onclick="validate_signup();">Sign Up</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        $(function () {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "c-30:c",
                dateFormat: "yy-mm-dd"
            });
        });

        function ValidateEmail(mail) {
            if (mail == '') {
                alert("Please enter email id");
                return false;
            }
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
                return (true);
            }
            alert("You have entered an invalid email address!");
            return (false);
        }

        function validate_empty_fields(toCheck, field) {
            if (toCheck == '') {
                alert("Please enter value for " + field);
                return false;
            }
            if (field == 'name') {
                if (/^[a-zA-Z ]+$/.test(toCheck) == false) {
                    alert("Invalid Name");
                    return false;
                }
            }
            if (field == 'password' && toCheck.length < 8) {
                alert("Password should be atleast 8 characters");
                return false;
            }
            return true;
        }

        function validate_test() {
            var email_id = $('#Email_login').val();
            if (ValidateEmail(email_id)) {
                var password = $('#passwordinput_login').val();
                if (password.length >= 8) {
                    var request = { 'email': email_id, 'password': password };
                    $.post("./ajax/login.php", request, function (response) {
                        jsondata = JSON.parse(response);
                        console.log(jsondata);
                        if (jsondata["status"] == 'Success') {
                            window.location = './index.php';
                        } else {
                            alert(jsondata["data"]);
                        }
                    });
                } else {
                    alert("Password should be atleast 8 characters");
                }
            }
        }

        function validate_signup() {
            var email_id = $('#Email').val();
            var user_name = $('#userid').val();
            var password = $('#password').val();
            var confPassword = $('#reenterpassword').val();
            var gender = $('#sel1').find(":selected").text();
            var birthday = $('#datepicker').val();
            var q1 = $('#sec1').val();
            var q2 = $('#sec2').val();
            var a1 = $('#sec_ans1').val();
            var a2 = $('#sec_ans2').val();

            function Person(nme_attr, email_attr, pwd_attr, conf_attr, gender_attr, birthday_attr, q1_attr, q2_attr, a1_attr, a2_attr) {
                this.firstName = nme_attr;
                this.email = email_attr;
                this.password = pwd_attr;
                this.confPassword = conf_attr;
                this.gender = gender_attr;
                this.birthday = birthday_attr;
                this.q1 = q1_attr;
                this.a1 = a1_attr;
                this.q2 = q2_attr;
                this.a2 = a2_attr;
            }

            var myUserAttr = new Person(user_name, email_id, password, confPassword, gender, birthday, q1, a1, q2, a2);

            if (validate_empty_fields(user_name, 'name')
                && validate_empty_fields(password, 'password') && validate_empty_fields(confPassword, 'password')
                && ValidateEmail(email_id)
            ) {
                if (password == confPassword) {
                    request = {
                        'email': email_id, 'password': password,
                        'name': user_name, 'confPassword': confPassword,
                        'gender': gender, 'question1': q1, 'answer1': a1,
                        'question2': q2, 'answer2': a2, 'birthday' : birthday
                    };

                    $.post("./ajax/register.php", request, function (response) {
                        console.log(response);
                        jsondata = JSON.parse(response);
                        if (jsondata["status"] == 'Success') {
                            window.location = './index.php';
                        } else {
                            alert(jsondata["data"]);
                        }
                    });
                } else {
                    alert("Passwords do not match");
                }

            }


        }

        //$("#signin_button").click(validate_login());

    </script>

</body>

</html>