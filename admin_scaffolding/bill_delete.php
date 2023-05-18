<?php
$billCode = "";
$customerCode = "";
$billDate = "";
$totalAmount = "";
$paymentStatus = "";
$dueDate = "";
$remainingAmount = "";

// Check if itemCode parameter is present in the URL
if (isset($_GET['billCode'])) {
    $billCode = $_GET['billCode'];

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
    $sql = "SELECT customerCode, billDate, totalAmount,paymentStatus,dueDate,remaningAmount FROM bill WHERE billCode = '$billCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customerCode = $row['customerCode'];
        $billDate = $row['billDate'];
        $totalAmount = $row['totalAmount'];
        $paymentStatus = $row['paymentStatus'];
        $dueDate = $row['dueDate'];
        $remainingAmount = $row['remaningAmount'];
    } else {
        echo "Bill not found!";
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
    <title>Edit Bill</title>
    <link rel="stylesheet" href="assets/bootstrap1.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
</head>

<body>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card mb-5">
                    <div class="card-body p-sm-5">
                    <h2 class="text-center mb-4">Confirm Delete</h2>
                    <h5 class="text-center text-primary mb-4">Are you sure you want to delete this bill?</h5>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="mb-3"><label class="form-label">Bill Code</label><input class="form-control" type="text" id="name-2" name="billCode" placeholder="Bill Code(BXXX format)" minlength="4" maxlength="4" required="" value="<?php echo $billCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Customer Code</label><input class="form-control" type="text" id="name-1" name="customerCode" placeholder="Customer Code (CXX format)" minlength="3" maxlength="3" required="" value="<?php echo $customerCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Bill Date</label><input class="form-control" type="date" name="billDate" required="" value="<?php echo $billDate; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Total Amount</label><input class="form-control" type="number" required="" name="totalAmount" placeholder="Total Amount" value="<?php echo $totalAmount; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Payment Status</label><select class="form-select" name="paymentStatus" required="">
                                        <option value="Paid" <?php if ($paymentStatus == 'Paid') echo 'selected'; ?>>Paid</option>
                                        <option value="Partially paid" <?php if ($paymentStatus == 'Partially paid') echo 'selected'; ?>>Partially Paid</option>
                                        <option value="Unpaid" <?php if ($paymentStatus == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
                                    </select></div>
                                <div class="mb-3"><label class="form-label">Due Date</label><input class="form-control" type="date" name="dueDate" required="" value="<?php echo $dueDate; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Remaining Amount</label><input class="form-control" type="number" required="" name="remainingAmount" placeholder="Remaining Amount" value="<?php echo $remainingAmount; ?>" readonly></div>
                                <div>
                                <div class="row row-cols-sm-2">
                                        <div class="col"><button class="btn btn-primary" type="submit" name="delete" style="margin: 0px;">Delete</button></div>
                                        <div class="col"><a class="btn btn-primary" href='bill.php'>Cancel</a></div>
                                    </div>
                                </div>
                            </form> 
                            <?php
                            if (isset($_POST['delete']) && isset($_POST['billCode'])) {
                                $billCode = $_POST['billCode'];

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
                                $sql = "DELETE FROM bill WHERE billCode = '$billCode'";

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