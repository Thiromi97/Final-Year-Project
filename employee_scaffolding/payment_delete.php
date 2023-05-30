<?php
$paymentCode = "";
$billCode = "";
$customerCode = "";
$paymentDate = "";
$paymentAmount = "";
$isRefund = "";

// Check if paymentCode parameter is present in the URL
if (isset($_GET['paymentCode'])) {
    $paymentCode = $_GET['paymentCode'];

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

    // Get the payment details from the payment table
    $sql = "SELECT paymentCode, billCode, customerCode, paymentDate, paymentAmount, isRefund FROM payment WHERE paymentCode = '$paymentCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $paymentCode = $row['paymentCode'];
        $billCode = $row['billCode'];
        $customerCode = $row['customerCode'];
        $paymentDate = $row['paymentDate'];
        $paymentAmount = $row['paymentAmount'];
        $isRefund = $row['isRefund'];
    } else {
        echo "Payment not found!";
    }

    $conn->close();
}

// Check if the delete button is clicked
if (isset($_POST['delete']) && isset($_POST['paymentCode'])) {
    $paymentCode = $_POST['paymentCode'];

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

    // Delete the record from the payment table
    $sql = "DELETE FROM payment WHERE paymentCode = '$paymentCode'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Delete Payment</title>
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
                            <h5 class="text-center text-primary mb-4">Are you sure you want to delete this payment details?</h5>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3"><label class="form-label">Payment Code</label><input class="form-control" type="text" id="name-0" name="paymentCode" placeholder="" required="" value="<?php echo $paymentCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Bill Code</label><input class="form-control" type="text" id="name-1" name="billCode" placeholder="" required="" value="<?php echo $billCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Customer Code</label><input class="form-control" type="text" id="name-2" name="customerCode" placeholder="C" minlength="3" maxlength="3" required="" value="<?php echo $customerCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Payment Date</label><input class="form-control" type="date" id="name-4" name="paymentDate"  required="" placeholder="" value="<?php echo $paymentDate; ?>"></div>
                                <div class="mb-3"><label class="form-label">Payment Amount</label><input class="form-control" type="number" id="name-5" name="paymentAmount" maxlength="200" required="" placeholder="Payment Amount"  value="<?php echo $paymentAmount; ?>"></div>
                                <div class="mb-3"><label class="form-label">Is Refund</label>
                                <select class="form-select" name="isRefund" required="">
                                        <option value="No" <?php if ($isRefund == 'No') echo 'selected'; ?>>No</option>
                                        <option value="Yes"<?php if ($isRefund == 'Yes') echo 'selected'; ?>>Yes</option>
                                    </select></div>
                                <div>
                                <div class="row row-cols-sm-2">
                                <div class="col"><button class="btn btn-primary" type="submit" name="delete" style="margin: 0px;">Delete</button></div>
                                        <div class="col"><a class="btn btn-primary" href='payment.php'>Cancel</a></div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['delete']) && isset($_POST['paymentCode'])) {
                                $itemCode = $_POST['paymentCode'];

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

                                // Delete the record from the inventory table
                                $sql = "DELETE FROM payment WHERE paymentCode = '$paymentCode'";

                                if ($conn->query($sql) === TRUE) {
                                    echo "Record deleted successfully";
                            
                                } else {
                                    echo "Error deleting record: " . $conn->error;
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