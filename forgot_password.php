<?php
$successMessage = '';
$errorMessage = '';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);
$message = ""; // Variable to store the success or error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the username exists in the login_details table
    $usernameCheckSql = "SELECT * FROM login_details WHERE username = '$username'";
    $usernameCheckResult = mysqli_query($conn, $usernameCheckSql);

    if (mysqli_num_rows($usernameCheckResult) > 0) {
        // Username exists, update the password
        $updatePasswordSql = "UPDATE login_details SET password = '$password' WHERE username = '$username'";

        if (mysqli_query($conn, $updatePasswordSql)) {
            $successMessage = "Password changed successfully.";
        } else {
            $errorMessage = "ERROR: Could not update the password: " . mysqli_error($conn);
        }
    } else {
        $errorMessage = "Username does not exist.";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
</head>

<body class="bg-gradient-primary" style="background: #a1a7a3;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background: url(&quot;assets/img/dogs/TH97_construction_and_equipment_supply_companyAsian_Engineershi_b128c64c-6a93-4209-8362-6898855eb6d4.png&quot;) center / cover;"></div>
                            </div>
                            <div class="col-lg-6" style="height: 518.025px;">
                                <div class="p-5" style="height: 518.65px;">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" style="margin-bottom: 40px;">Change Password</h4>
                                    </div>
                                    <form class="user" action="" method="POST" style="height: 298.6px;">
                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Username" name="username" required="" style="margin-bottom: 20px;margin-top: 71px;font-size: 15px;">
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="New Password" name="password" style="margin-bottom: 20px;font-size: 15px;">
                                        </div>
                                        <button class="btn btn-primary d-block btn-user w-100" type="submit" name="submit" style="background: #2d2e34;margin-bottom: 60px;font-size: 15px;">Change Password</button>

                                        <?php if (!empty($message)): ?>
                                            <div class="text-center"><?php echo $message; ?></div>
                                        <?php endif; ?>

                                        <hr>
                                        <div style="text-align: center;"><a class="small" href="login.php" style="font-size: 15px;color: #2d2e34;">Already have an account?</a></div>
                                        <div style="text-align: center;"><a class="small" href="account.php" style="font-size: 15px;color: #2d2e34;">Create an Account!</a></div>
                                    </form>
                                    <?php
                    // Print the success or error messages
                    if (!empty($successMessage)) {
                        echo '<div class="alert alert-success">' . $successMessage . '</div>';
                    }
                    if (!empty($errorMessage)) {
                        echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
                    }
                    ?>
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
    <script src="assets/bootstrap.min.js"></script>
    <script src="assets/bs-init.js"></script>
    <script src="assets/theme.js"></script>
</body>

</html>
