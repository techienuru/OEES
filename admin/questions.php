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
                            <i class="ti-user"></i>
                            <p>Questions</p>
                        </a>
                    </li>
                    <li>
                        <a href="examinees.php">
                            <i class="ti-view-list-alt"></i>
                            <p>Examinees</p>
                        </a>
                    </li>
                    <li>
                        <a href="score.php">
                            <i class="ti-text"></i>
                            <p>Examination Scores</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="logout.php">
                            <i class="ti-export"></i>
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
                                    <p class="category">Questions Examinees are meant to answer</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Ques. No</th>
                                            <th>Question</th>
                                            <th>Option A</th>
                                            <th>Option B</th>
                                            <th>Option C</th>
                                            <th>Option D</th>
                                            <th>Answer</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>What are the core programming languages for Frontend?</td>
                                                <td>React, Typescript & Git</td>
                                                <td>Git, Github, HTML & CSS</td>
                                                <td>HTML, CSS, & JS</td>
                                                <td>Git, Github, HTML & CSS</td>
                                                <td>C</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>What are the core programming languages for Frontend?</td>
                                                <td>React, Typescript & Git</td>
                                                <td>Git, Github, HTML & CSS</td>
                                                <td>HTML, CSS, & JS</td>
                                                <td>Git, Github, HTML & CSS</td>
                                                <td>C</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>What are the core programming languages for Frontend?</td>
                                                <td>React, Typescript & Git</td>
                                                <td>Git, Github, HTML & CSS</td>
                                                <td>HTML, CSS, & JS</td>
                                                <td>Git, Github, HTML & CSS</td>
                                                <td>C</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="card card-plain">
                                <div class="header">
                                    <h4 class="title">Add Question</h4>
                                    <p class="category">Add a question for Examinees</p>
                                </div>
                                <div class="content">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Question</label>
                                                    <textarea rows="5" class="form-control border-input" placeholder="Here can be your question" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Option A</label>
                                                    <input type="text" class="form-control border-input" placeholder="Enter Option A" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="option-B">Option B</label>
                                                    <input type="text" class="form-control border-input" placeholder="Enter Option B" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Option C</label>
                                                    <input type="text" class="form-control border-input" placeholder="Enter Option C" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="option-D">Option D</label>
                                                    <input type="text" class="form-control border-input" placeholder="Enter Option D" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Answer</label>
                                                    <select name="" id="" class="form-control border-input" required>
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