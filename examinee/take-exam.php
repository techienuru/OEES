<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/examinee.php";
$object = new take_exam($connect);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>OEES - Take the entrance Exam</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

    <style>
        .take-exam-card {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .exam-details {
            margin: 0;
            padding: 0;
            list-style: none;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .exam-details h3 {
            margin: 0 0 10px;
            font-size: 24px;
            color: #333;
        }

        .exam-details p {
            margin: 5px 0;
            font-size: 18px;
            color: #555;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #00c896;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #518071;
        }
    </style>

</head>

<body>

    <div class="wrapper">
        <div class="sidebar" data-background-color="white" data-active-color="danger">

            <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="./dashboard.php" class="simple-text">
                        OEES
                    </a>
                </div>

                <ul class="nav">
                    <li>
                        <a href="dashboard.php">
                            <i class="ti-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="take-exam.php">
                            <i class="ti-pencil-alt"></i>
                            <p>Take Exam</p>
                        </a>
                    </li>
                    <li>
                        <a href="exam-score.php">
                            <i class="ti-stats-up"></i>
                            <p>Exam Score</p>
                        </a>
                    </li>
                    <li>
                        <a href="edit-profile.php">
                            <i class="ti-pencil"></i>
                            <p>Edit Profile</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="logout.php">
                            <i class="ti-power-off"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="#">Take Entrance Exam</a>
                    </div>

                </div>
            </nav>


            <div class="content">
                <div class="container-fluid take-exam-card">
                    <div class="header">
                        <h1>General Entrance Exam</h1>
                        <p>Prepare to take the comprehensive entrance exam covering multiple subjects.</p>
                    </div>

                    <div class="exam-details">
                        <h3>Exam Details</h3>
                        <p><strong>Duration:</strong> 10 minutes</p>
                        <p>
                            <strong>Total Questions:</strong>
                            <?php
                            $object->noOfQuestions();
                            echo $object->noOfQuestions;
                            ?>
                        </p>
                        <p><strong>Subjects Covered:</strong> Mathematics, English, Science, General Knowledge</p>
                    </div>

                    <div class="btn-box">
                        <a href="./start-exam.php" class="btn">Start Exam</a>
                    </div>

                </div>
            </div>


        </div>
    </div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>