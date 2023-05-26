<?php
$customerCode = "";
$customerName = "";
$nic = "";
$address = "";
$contactNo = "";
$blackListed = "";

// Check if itemCode parameter is present in the URL
if (isset($_GET['customerCode'])) {
    $customerCode = $_GET['customerCode'];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "scaffolding";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the item details from the inventory table
    $sql = "SELECT customerName, nic, address, contactNo, blackListed FROM customer WHERE customerCode = '$customerCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customerName = $row['customerName'];
        $nic = $row['nic'];
        $address = $row['address'];
        $contactNo = $row['contactNo'];
        $blackListed = $row['blackListed'];
    } else {
        echo "Customer not found!";
    }
    $conn->close();
}

?>
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
                            <h2 class="text-center mb-4">Confirm Delete</h2>
                            <h5 class="text-center text-primary mb-4">Are you sure you want to black list this customer?</h5>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="mb-3"><label class="form-label">Customer Code</label><input class="form-control" type="text" id="name-2" name="customerCode" placeholder="Customer Code(CXX foramt)" minlength="3" maxlength="3" required="" value="<?php echo $customerCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Customer Name</label><input class="form-control" type="text" id="name-3" name="customerName" maxlength="200" required="" placeholder="Customer Name" value="<?php echo $customerName; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">NIC</label><input class="form-control" type="text" id="name-4" name="nic" maxlength="12" required="" placeholder="NIC" value="<?php echo $nic; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Address</label><input class="form-control" type="text" id="name-1" name="address" maxlength="200" required="" placeholder="Address" value="<?php echo $address; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Contact No</label><input class="form-control" type="tel" required="" name="contactNo" placeholder="Contact No" minlength="10" maxlength="10" value="<?php echo $contactNo; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Black Listed</label>
                                    <select class="form-select" name="blackListed" required="">
                                        <option value="No" <?php if ($blackListed == 'No') echo 'selected'; ?>>No</option>
                                        <option value="Yes" <?php if ($blackListed == 'Yes') echo 'selected'; ?>>Yes</option>
                                    </select>
                                </div>
                                <div class="row row-cols-sm-2">
                                        <div class="col"><button class="btn btn-primary" type="submit" name="blackList" style="margin: 0px;">BlackListed</button></div>
                                        <div class="col"><a class="btn btn-primary" href='customer.php'>Cancel</a></div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['blackList']) && isset($_POST['customerCode'])) {
                                $customerCode = $_POST['customerCode'];

                                // Connect to the database
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "scaffolding";
                                $blackListed = 'Yes';

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Delete the record from the inventory table
                                $sql = "UPDATE customer SET blackListed = '$blackListed' WHERE customerCode = '$customerCode'";

                                if ($conn->query($sql) === TRUE) {
                                    echo "Record black listed successfully";
                            
                                } else {
                                    echo "Error blacklisting the record: " . $conn->error;
                                }

                                // Close the database connection
                                $conn->close();
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