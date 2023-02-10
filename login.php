<?php
  if(isset($_POST['submit'])) {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'inventory_login');

    // Get the user's credentials from the form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Query the database for the user based on their role
    $query = "SELECT * FROM login_details WHERE username = '$username' AND role = '$role'";
    $result = mysqli_query($conn, $query);

    // If the user exists in the database
    if(mysqli_num_rows($result) == 1) {
      $user = mysqli_fetch_assoc($result);
      $hashedPassword = $user['password'];

      // Verify the entered password against the hashed password in the database
      if(password_verify($password, $hashedPassword)) {
        // Start a session and store the user's information
        session_start();
        $_SESSION['user'] = $user;

        // Check the role of the user and redirect them to the corresponding dashboard
        if($role == 1) {
          header('Location: admin_dashboard.php');
        } elseif ($role == 2) {
          header('Location: employee_dashboard.php');
        } elseif ($role == 3) {
          header('Location: customer_dashboard.php');
        }
      } else {
        // Return an error message for incorrect password
        echo "Incorrect password";
      }
    } else {
      // Return an error message for incorrect username or role
      echo "Incorrect username or role";
    }
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>

<body>
    <div class="container">
        <div class="cover">
            <div class="front">
                <img src="images/construction.jpg">
            </div>
        </div>
        <form action="login.php" method="post">
            <div class="login-form">
                <div class="title">Login</div>
                <div class="input-boxes">
                    <div class="input-box">
                        <img src="images/user.png" id="user-png">
                        <input type="text" placeholder="Enter your username" required>
                    </div>
                    <div class="input-box">
                        <img src="images/portfolio.png" id="job-png">
                        <select name="role">
                            <option value="" disabled selected>--Select your Role--</option>
                            <option value="1">Admin</option>
                            <option value="2">Employee</option>
                            <option value="3">Customer</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <img src="images/padlock.png" id="password-png">
                        <input type="password" placeholder="Enter your passsword" required>
                    </div>
                    <div class="text"><a href="#">Forgot password?</a></div>
                    <div class="button input-box">
                        <!-- <img src="images/padlock.png" id="password-png"> -->
                        <input type="submit" value="Submit" class="button">
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>