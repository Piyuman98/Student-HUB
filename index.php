<?php
session_start();
include 'config.php';

$message = ''; // Initialize the $message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $message = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Hub Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Sweet alert css-->
    <link href="common_js/sweet-alert/sweet-alert.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container" style="padding-top:150px">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome To Student Hub</h1>
                                    </div>
                                    
                                    <form method="post" id="form" class="user needs-validation" novalidate>
                                        <div class="form-group">
                                        <div style="color:red;"><?php echo $message; ?></div>
                                            <input type="text" class="form-control form-control-user"
                                                id="txt_username" aria-describedby="emailHelp"
                                                placeholder="Enter User Name" name="username" required>
                                            <div class="invalid-feedback">
                                                Please enter a username.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="txt_password" name="password" placeholder="Password" required>
                                            <div class="invalid-feedback">
                                                Please enter a password.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                        <hr>
<!--                                        <a href="index.html" class="btn btn-google btn-user btn-block">-->
<!--                                            <i class="fab fa-google fa-fw"></i> Login with Google-->
<!--                                        </a>-->
<!--                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">-->
<!--                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook-->
<!--                                        </a>-->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                  <div class="text-center">
                                      <a class="small" href="register.php">Create an Account!</a>
                                 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Sweet alert js-->
    <script src="common_js/sweet-alert/sweetalert.min.js"></script>
    <script src="common_js/common.js"></script>
    <script src="login_controller/login_controller.js"></script>

</body>

</html>