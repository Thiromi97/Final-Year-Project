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
        <div class="cover"></div>
        <form action="#">
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
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                            <option value="customer">Customer</option>
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