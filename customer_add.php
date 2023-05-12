<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scaffolding";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>New Customer</title>
    <link rel="stylesheet" href="assets/bootstrap1.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <script src="https://kit.fontawesome.com/961768b1ec.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card mb-5">
                        <div class="card-body p-sm-5">
                            <h2 class="text-center mb-4">New Customer</h2>
                            <form method="post">
                                <div class="mb-3"><label class="form-label">Customer Code</label><input class="form-control" type="text" id="name-2" name="customerCode" placeholder="Customer Code(CXX foramt)" minlength="3" maxlength="3" required=""></div>
                                <div class="mb-3"><label class="form-label">Customer Name</label><input class="form-control" type="text" id="name-3" name="customerName" maxlength="200" required="" placeholder="Customer Name"></div>
                                <div class="mb-3"><label class="form-label">NIC</label><input class="form-control" type="text" id="name-4" name="nic" maxlength="12" required="" placeholder="NIC"></div>
                                <div class="mb-3"><label class="form-label">Address</label><input class="form-control" type="text" id="name-1" name="address" maxlength="200" required="" placeholder="Address"></div>
                                <div class="mb-3"><label class="form-label">Contact No</label><input class="form-control" type="tel" required="" name="contactNo" placeholder="Contact No" minlength="10" maxlength="10"></div>
                                <div class="mb-3"><label class="form-label">Black Listed</label><select class="form-select" name="blackListed" required="">
                                        <option value="No" selected="">No</option>
                                        <option value="Yes">Yes</option>
                                    </select></div>
                                <div>
                                    <div class="row">
                                        <div class="col"><input class="btn btn-primary" type="submit" style="width: 100%;" name="Save" value="Save"></div>
                                    </div>
                                </div>
                            </form>
                            <?php 
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Escape user inputs for security
                                $CustomerCode = mysqli_real_escape_string($conn, $_POST['customerCode']);
                                $CustomerName = mysqli_real_escape_string($conn, $_POST['customerName']);
                                $Nic = mysqli_real_escape_string($conn, $_POST['nic']);
                                $Address = mysqli_real_escape_string($conn, $_POST['address']);
                                $ContactNo = mysqli_real_escape_string($conn, $_POST['contactNo']);
                                $BlackListed = mysqli_real_escape_string($conn, $_POST['blackListed']);
                            
                                // Check if the customer code starts with "C"
                                if (substr($CustomerCode, 0, 1) === 'C') {
                                    // Attempt insert query execution
                                    $sql = "SELECT customerCode FROM customer WHERE customerCode = '$CustomerCode'";
                                    $result = mysqli_query($conn, $sql);
                                    
                                    if (mysqli_num_rows($result) > 0) {
                                        // If the customer code already exists, show an error message
                                        echo "ERROR: Customer with code $CustomerCode already exists.";
                                    } else {
                                        // If the customer code doesn't exist, attempt insert query execution
                                        $sql = "INSERT INTO customer (customerCode, customerName, nic, address, contactNo, blackListed) VALUES ('$CustomerCode', '$CustomerName', '$Nic', '$Address', '$ContactNo', '$BlackListed')";
                                        
                                        if(mysqli_query($conn, $sql)){
                                            echo "Records added successfully.";
                                        } else{
                                            echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
                                        }
                                    }
                                } else {
                                    echo "ERROR: Customer code must start with 'C'.";
                                }
                                
                                mysqli_close($conn);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap1.min.js"></script>
    <script src="assets/bs-init1.js"></script>
    <script src="assets/theme1.js"></script>
</body>
</html>