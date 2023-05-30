<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scaffolding";

$successMessage = '';
$errorMessage = '';

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
    <title>scaffolding</title>
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
                            <h2 class="text-center mb-4">New Return</h2>
                            <form method="post" action="">
                                <div class="mb-3"><label class="form-label">Bill Code</label><input class="form-control" type="text" id="name-2" name="billCode" placeholder="Bill Code(BXXX foramt)" minlength="4" maxlength="4" required=""></div>
                                <div class="mb-3"><label class="form-label">Item Code</label><input class="form-control" type="text" id="name-3" name="itemCode" maxlength="3" required="Item Code(ZXX format)" placeholder="ItemCode" required=""></div>
                                <div class="mb-3"><label class="form-label">Return Quantity</label><input class="form-control" type="number" name="returnQuantity"  placeholder="Return Quantity" required=""></div>
                                <!-- <div class="mb-3"><label class="form-label">Total Price</label><input class="form-control" type="number" name="totalPrice"  placeholder="Total Price" required=""></div> -->
                                <div class="mb-3"><label class="form-label">Return Date</label><input class="form-control" type="date" name="returnDate"  required="" placeholder="Return Date" required=""></div>
                                <div><button class="btn btn-primary d-block w-100" type="submit">Save</button></div>
                            </form>
                            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $BillCode = mysqli_real_escape_string($conn, $_POST['billCode']);
    $ItemCode = mysqli_real_escape_string($conn, $_POST['itemCode']);
    $ReturnQuantity = mysqli_real_escape_string($conn, $_POST['returnQuantity']);
    $ReturnDate = mysqli_real_escape_string($conn, $_POST['returnDate']);

    if (substr($BillCode, 0, 1) === 'B' && substr($ItemCode, 0, 1) === 'Z') {
        // Check if the return quantity is less than or equal to the quantity in the issued table
        $quantitySql = "SELECT issued.quantity, inventory.marketPrice, bill.customerCode FROM issued 
                        INNER JOIN inventory ON issued.itemCode = inventory.itemCode 
                        INNER JOIN bill ON issued.billCode = bill.billCode
                        WHERE issued.billCode = '$BillCode' AND issued.itemCode = '$ItemCode'";
        $quantityResult = mysqli_query($conn, $quantitySql);

        if (mysqli_num_rows($quantityResult) > 0) {
            $row = mysqli_fetch_assoc($quantityResult);
            $issuedQuantity = $row['quantity'];
            $marketPrice = $row['marketPrice'];
            $TotalPrice = $ReturnQuantity * $marketPrice;
            $customerCode = $row['customerCode'];

            if ($ReturnQuantity <= $issuedQuantity) {
                // Perform the INSERT query to add the record to the returned table
                $insertReturnedSql = "INSERT INTO returned (billCode, itemCode, returnQuantity, totalPrice, returnDate) 
                                      VALUES ('$BillCode', '$ItemCode', '$ReturnQuantity', '$TotalPrice', '$ReturnDate')";

                if (mysqli_query($conn, $insertReturnedSql)) {
                    $successMessage= "Record added successfully to the returned table.";

                    // Get the last inserted returnId
                    $returnId = mysqli_insert_id($conn);

                    // Perform the INSERT query to add the record to the refund table
                    $insertRefundSql = "INSERT INTO refund (returnId, billCode, customerCode, refundDate, refundAmount) 
                                        VALUES ('$returnId', '$BillCode', '$customerCode', '$ReturnDate', '$TotalPrice')";

                    if (mysqli_query($conn, $insertRefundSql)) {
                        $successMessage= "Record added successfully to the refund table and return table.";
                    } else {
                        $errorMessage="ERROR: Could not execute the INSERT query for refund table: " . mysqli_error($conn);
                    }
                } else {
                    $errorMessage= "ERROR: Could not execute the INSERT query for returned table: " . mysqli_error($conn);
                }
            } else {
                $errorMessage= "ERROR: Return quantity cannot exceed the issued quantity.";
            }
        } else {
            $errorMessage= "ERROR: No record found with the specified billCode and itemCode in the issued table.";
        }
    } else {
        $errorMessage= "ERROR: Bill code must start with 'B' and item code must start with 'Z'.";
    }

    mysqli_close($conn);
}
?>




                        </div>
                    </div>
                    <?php
        if (!empty($successMessage)) {
                        echo '<div class="alert alert-success">' . $successMessage . '</div>';
                    }
                    if (!empty($errorMessage)) {
                        echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>