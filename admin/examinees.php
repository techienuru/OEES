<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/admin.php";

$object = new examinees($connect);
$object->collectUserID();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>OEES - Authorized and unauthorized Examinee</title>

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
                    <li>
                        <a href="questions.php">
                            <i class="ti-help-alt"></i>
                            <p>Questions</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="examinees.php">
                            <i class="ti-user"></i>
                            <p>Examinees</p>
                        </a>
                    </li>
                    <li>
                        <a href="score.php">
                            <i class="ti-bar-chart"></i>
                            <p>Examination Scores</p>
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
                        <a class="navbar-brand" href="#">Examinees</a>
                    </div>

                </div>
            </nav>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Examinees</h4>
                                    <p class="category">Authorized and Unverified Examinees</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>Date of Birth</th>
                                            <th>Gender</th>
                                            <th>Last Institution</th>
                                            <th>Exam Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sql = $object->selectExaminees();
                                            $number = 1;
                                            while ($row = $sql->fetch_assoc()) {
                                                $examinee_id = $row["examinee_id"];
                                                $fullname = $row["fullname"];
                                                $email = $row["email"];
                                                $phone_number = $row["phone_number"];
                                                $dob = $row["dob"];
                                                $gender = $row["gender"];
                                                $last_institution = $row["last_institution"];
                                                $can_take_exam = $row["can_take_exam"];
                                                $text_color;

                                                switch ($can_take_exam) {
                                                    case 1:
                                                        $can_take_exam = 'Eligible';
                                                        $text_color = "success";
                                                        break;
                                                    case 0:
                                                        $can_take_exam = 'Not eligible';
                                                        $text_color = 'danger';
                                                        break;
                                                }

                                                echo "
                                                    <tr>
                                                        <td>$number</td>
                                                        <td>$fullname</td>
                                                        <td>$email</td>
                                                        <td>$phone_number</td>
                                                        <td>$dob</td>
                                                        <td>$gender</td>
                                                        <td>$last_institution</td>
                                                        <td class='text-$text_color'>$can_take_exam</td>
                                                        <td>
                                                            <a href='process-eligiblity.php?change_exam_status=$can_take_exam&examinee_id=$examinee_id' class='btn btn-info btn-sm'>Change Exam Status</a>
                                                        </td>
                                                    </tr>  
                                                ";
                                                $number++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>


</html>