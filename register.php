<?php
include_once 'includes/connect.php';
include_once 'includes/classes/classes.php';

$object = new register($connect);

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $object->collectInputs();
    if (!$object->checkIfEmailExist()) {
        $object->generatePassword();
        $object->insertIntoDB();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>OEES - Get started by creating an account</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png" type="" />

    <!-- Font awesome Link -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./Bootstrap/bootstrap.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./css/register.css" rel="stylesheet">
    <style>
        .success-message {
            z-index: 999;
            background-color: black;
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row 100vh align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-5">
                    <div class="rounded p-4 p-sm-5 my-4 mx-3" id="inner-container">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="./" class="text-decoration-none">
                                    <h3></i>OEES</h3>
                                </a>
                                <h3 class="text-white">Create an account</h3>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control text-white" id="floatingInput" name="fullname" placeholder="fullname" required>
                                        <label for="floatingInput">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control text-white" id="floatingInput" name="email" placeholder="name@example.com" required>
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row  mb-3">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control text-white" id="floatingInput" name="phone_number" placeholder="Phone Number" required>
                                        <label for="floatingInput">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control text-white" id="floatingInput" name="dob" placeholder="dob" required>
                                        <label for="floatingInput">Date of Birth</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <select name="gender" class="form-control text-white" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Rather not say">Rather not say</option>
                                        </select>
                                        <label for="floatingInput">Gender</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control text-white" id="floatingInput" name="last_institution" placeholder="last Institution" required>
                                        <label for="floatingInput">Last Institution Name</label>
                                    </div>
                                </div>
                            </div>

                            <p class="text-light mb-4">
                                Already have an account yet?
                                <a href="./login.php">Login</a>
                            </p>
                            <button type="submit" name="submit" class="btn py-3 w-100 mb-4">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="./Bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/mine.js"></script>

</body>

</html>