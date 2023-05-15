<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_login";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $query = "SELECT * FROM login_details WHERE username = '$username' AND password = '$password' AND role = '$role'";
  $result = mysqli_query($conn, $query);
  // If the user exists in the database
  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    // Start a session and store the user's information
    session_start();
    $_SESSION['user'] = $user;
    // Check the role of the user and redirect them to the corresponding dashboard
    if ($role == 1) {
      header('Location: admin_dashboard.php');
    } elseif ($role == 2) {
      header('Location: employee_dashboard.php');
    } elseif ($role == 3) {
      header('Location: customer_dashboard.php');
    }
  } else {
    // Return an error message for incorrect username or password or role
    echo "Incorrect username or password or role";
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
    <form action="" method="post">
      <div class="login-form">
        <div class="title">Login</div>
        <div class="input-boxes">
          <div class="input-box">
            <img src="images/user.png" id="user-png">
            <input type="text" placeholder="Enter your username" name="username" required>
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
            <input type="password" placeholder="Enter your passsword" name="password" required>
          </div>
          <div class="text"><a href="#">Forgot password?</a></div>
          <div class="button input-box">
            <input type="submit" name="submit" value="Submit" class="button">
          </div>
        </div>
      </div>
    </form>

    <?php
    mysqli_close($conn);
    ?>
  </div>
</body>

</html>