<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/examinee.php";

$object = new dashboard($connect);

$object->collectUserID();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>OEES - Examinee Dashboard</title>

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
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="ti-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
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
                        <a class="navbar-brand" href="#">Dashboard</a>
                    </div>

                </div>
            </nav>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="card card-user">
                                <div class="image">
                                    <img src="assets/img/background.jpg" alt="..." />
                                </div>
                                <div class="content">
                                    <div class="author">
                                        <img class="avatar border-white" src="assets/img/faces/face-2.png" alt="..." />
                                        <h4 class="title">
                                            <?php echo $object->fullname; ?>
                                            <br />
                                            <a href="#">
                                                <small>
                                                    <?php echo $object->email; ?>
                                                </small>
                                            </a>
                                        </h4>
                                    </div>
                                    <p class="description text-center">
                                        "Excel with confidence,
                                        <br>
                                        no doubts.
                                        <br>
                                        Ready to start your journey to success?"
                                    </p>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-md-3 col-md-offset-1">
                                            <h5>
                                                <?php
                                                $object->noOfExamsTaken();
                                                echo $object->noOfExamsTaken;
                                                ?>
                                                <br />
                                                <small>Exams</small>
                                            </h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>
                                                <?php
                                                $object->noOfExamsPassed();
                                                echo $object->noOfExamsPassed;
                                                ?>
                                                <br />
                                                <small>Passed</small>
                                            </h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>
                                                <?php
                                                $object->noOfExamsFailed();
                                                echo $object->noOfExamsFailed;
                                                ?>
                                                <br />
                                                <small>Failed</small>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Profile</h4>
                                </div>
                                <div class="content">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?php echo $object->fullname; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?php echo $object->email; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?php echo $object->phone_number; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date Of Birth</label>
                                                    <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?php echo $object->dob; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?php echo $object->gender; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Institution Attended</label>
                                                    <input type="text" class="form-control border-input" disabled placeholder="Company" value="<?php echo $object->last_institution; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </form>
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

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        demo.initChartist();

        $.notify({
            icon: 'ti-gift',
            message: "Welcome <b><?php echo $object->fullname; ?></b> - <?php echo $object->exam_status; ?>."

        }, {
            type: 'success',
            timer: 4000
        });

    });
</script>

</html>