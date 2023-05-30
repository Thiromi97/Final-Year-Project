<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "scaffolding";

$conn = mysqli_connect($host, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['billCode'])) {
    echo 'error';
} else {
    $billCode = trim($_GET['billCode']);
}

$sql = "SELECT customerCode, billDate, totalAmount, paymentStatus, dueDate, remaningAmount FROM bill WHERE billCode = '$billCode'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$customerCode = $row['customerCode'];
$billDate = $row['billDate'];
$totalAmount = $row['totalAmount'];
$paymentStatus = $row['paymentStatus'];
$dueDate = $row['dueDate'];
$remainingAmount = $row['remaningAmount'];

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
                            <h2 class="text-center mb-4">Edit Bill</h2>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?billCode=' . $billCode); ?>">
                                <div class="mb-3"><label class="form-label">Bill Code</label><input class="form-control" type="text" id="name-2" name="billCode" placeholder="Bill Code(BXXX format)" minlength="4" maxlength="4" required="" value="<?php echo $billCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Customer Code</label><input class="form-control" type="text" id="name-1" name="customerCode" placeholder="Customer Code (CXX format)" minlength="3" maxlength="3" required="" value="<?php echo $customerCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Bill Date</label><input class="form-control" type="date" name="billDate" required="" value="<?php echo $billDate; ?>"></div>
                                <div class="mb-3"><label class="form-label">Total Amount</label><input class="form-control" type="number" required="" name="totalAmount" placeholder="Total Amount" value="<?php echo $totalAmount; ?>"></div>
                                <div class="mb-3"><label class="form-label">Payment Status</label><select class="form-select" name="paymentStatus" required="">
                                        <option value="Paid" <?php if ($paymentStatus == 'Paid') echo 'selected'; ?>>Paid</option>
                                        <option value="Partially paid" <?php if ($paymentStatus == 'Partially paid') echo 'selected'; ?>>Partially Paid</option>
                                        <option value="Unpaid" <?php if ($paymentStatus == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
                                    </select></div>
                                <div class="mb-3"><label class="form-label">Due Date</label><input class="form-control" type="date" name="dueDate" required="" value="<?php echo $dueDate; ?>"></div>
                                <div class="mb-3"><label class="form-label">Remaining Amount</label><input class="form-control" type="number" required="" name="remainingAmount" placeholder="Remaining Amount" value="<?php echo $remainingAmount; ?>"></div>
                                <div>
                                    <div class="row">
                                        <div class="col"><input class="btn btn-primary" type="submit" style="width: 100%;" name="Save" value="Save"></div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $customerCode = $_POST['customerCode'];
                                $billDate = $_POST['billDate'];
                                $totalAmount = $_POST['totalAmount'];
                                $paymentStatus = $_POST['paymentStatus'];
                                $dueDate = $_POST['dueDate'];
                                $remainingAmount = $_POST['remainingAmount'];
                                $sql = "UPDATE bill SET customerCode='$customerCode', billDate='$billDate', totalAmount='$totalAmount', paymentStatus='$paymentStatus', dueDate='$dueDate', remaningAmount='$remainingAmount' WHERE billCode='$billCode'";
                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    echo "Bill updated successfully.";
                                } else {
                                    echo "Error updating bill: " . mysqli_error($conn);
                                }
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
