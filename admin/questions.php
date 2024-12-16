<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/admin.php";

$object = new questions($connect);

$object->collectUserID();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $object->collectFormInputs();
    $object->insertIntoDB();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>OEES - Set questions for the entrance examination</title>

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
                    <li class="active">
                        <a href="questions.php">
                            <i class="ti-help-alt"></i>
                            <p>Questions</p>
                        </a>
                    </li>
                    <li>
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
                        <a class="navbar-brand">Questions</a>
                    </div>

                </div>
            </nav>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Exam Questions</h4>
                                    <p class="category">Challenges Awaiting Examinees</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <?php
                                    $sql = $object->selectExamQuestions();

                                    if (!$sql->num_rows > 0) {
                                        echo "
                                            <div class='container'>
                                                <div class='alert alert-info'>
                                                    <span>No question has been added</span>
                                                </div>
                                            </div>
                                        ";
                                    } else {
                                        echo '
                                            <table class="table table-striped">
                                            <thead>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>Option A</th>
                                                <th>Option B</th>
                                                <th>Option C</th>
                                                <th>Option D</th>
                                                <th>Answer</th>
                                            </thead>
                                            <tbody>
                                        ';
                                    }

                                    ?>
                                    <?php
                                    $number = 1;

                                    while ($result = $sql->fetch_assoc()) {
                                        $ques_id = $result["ques_id"];
                                        $ques = $result["ques"];
                                        $option_a = $result["option_a"];
                                        $option_b = $result["option_b"];
                                        $option_c = $result["option_c"];
                                        $option_d = $result["option_d"];
                                        $answer = $result["answer"];

                                        echo "
                                                    <tr>
                                                        <td>$number</td>
                                                        <td>$ques</td>
                                                        <td>$option_a</td>
                                                        <td>$option_b</td>
                                                        <td>$option_c</td>
                                                        <td>$option_d</td>
                                                        <td>$answer</td>
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


                        <div class="col-md-12">
                            <div class="card card-plain">
                                <div class="header">
                                    <h4 class="title">Add Question</h4>
                                    <p class="category">Create New Challenge for Examinees</p>
                                </div>
                                <div class="content">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Question</label>
                                                    <textarea rows="5" name="question" class="form-control border-input" placeholder="Here can be your question" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Option A</label>
                                                    <input type="text" class="form-control border-input" name="option_a" placeholder="Enter Option A" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="option-B">Option B</label>
                                                    <input type="text" class="form-control border-input" name="option_b" placeholder="Enter Option B" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Option C</label>
                                                    <input type="text" class="form-control border-input" name="option_c" placeholder="Enter Option C" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="option-D">Option D</label>
                                                    <input type="text" class="form-control border-input" name="option_d" placeholder="Enter Option D" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Answer</label>
                                                    <select name="answer" class="form-control border-input" required>
                                                        <option value="">--Select Answer--</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-info btn-fill btn-wd">Add Question</button>
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
<script src="../Bootstrap/bootstrap.bundle.min.js" type="text/javascript"></script>

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