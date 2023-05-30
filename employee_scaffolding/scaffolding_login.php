<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM login_details WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $role = $user['role'];

        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        // Redirect to the appropriate dashboard
        if ($role == 'Admin') {
            header('Location: admin_scaffolding.php');
            exit();
        } elseif ($role == 'Employee') {
            header('Location: employee_dashboard.php');
            exit();
        } elseif ($role == 'Customer') {
            header('Location: customer_dashboard.php');
            exit();
        } else {
            echo "Invalid role";
            exit();
        }
    } else {
        echo "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap1.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
</head>

<body class="bg-gradient-primary" style="background: #eb8d4a;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background: url(&quot;assets/img/dogs/thiru_excavatorbeautifulcolorfulasethatic8krealisticwallpaperno_229741c3-2fee-432e-80a7-7eb9d54c5b5d.png&quot;) center / cover;"></div>
                            </div>
                            <div class="col-lg-6" style="height: 518.025px;">
                                <div class="p-5" style="height: 518.65px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="margin-bottom: 40px;">Welcome Back!</h4>
                                    </div>
                                    <form class="user" action="" method="post" style="height: 298.6px;">
                                        <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Username" name="username" required="" style="margin-bottom: 20px;margin-top: 71px;font-size: 15px;">
                                    </div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password" style="margin-bottom: 20px;font-size: 15px;"></div>
                                        <!-- <button class="btn btn-primary d-block btn-user w-100" type="submit" style="background: #782c25;margin-bottom: 60px;font-size: 15px;">Login</button> -->
                                        <input class="btn btn-primary d-block btn-user w-100" type="submit" name="submit" value="Login" class="button" style="background: #782c25;margin-bottom: 60px;font-size: 15px;">
                                        <hr>
                                        <div style="text-align: center;">
                                        <a class="small" href="scaffolding_forgot_password.php" style="font-size: 15px;color: #782c25;">Forgot Password?</a>
                                    </div>
                                        <div style="text-align: center;"><a class="small" href="scaffolding_account.php" style="font-size: 15px;color: #782c25;">Create an Account!</a></div>
                                    </form>
                                    <div class="text-center"></div>
                                    <div class="text-center" style="padding-bottom: 0px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap1.min.js"></script>
    <script src="assets/bs-init1.js"></script>
    <script src="assets/theme1.js"></script>
</body>

</html>