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

if (!isset($_GET['paymentCode'])) {
    echo 'error';
} else {
    $paymentCode = trim($_GET['paymentCode']);
}

$sql = "SELECT billCode,customerCode,paymentDate,paymentAmount,isRefund FROM payment WHERE paymentCode = '$paymentCode'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$billCode = $row['billCode'];
$customerCode = $row['customerCode'];
$paymentDate = $row['paymentDate'];
$paymentAmount = $row['paymentAmount'];
$isRefund = $row['isRefund'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Payment Edit</title>
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
                            <h2 class="text-center mb-4">Edit Payment</h2>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?paymentCode=' . $paymentCode); ?>">
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
                                    <div class="row">
                                    <div><button class="btn btn-primary d-block w-100" type="submit">Save</button></div>
                                    </div>
                                </div>
                            </form>
                            <?php 
                                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $paymentDate = $_POST['paymentDate'];
                                    $paymentAmount = $_POST['paymentAmount'];
                                    $isRefund = $_POST['isRefund'];
                                
                                    $sql = "UPDATE payment SET paymentDate='$paymentDate', paymentAmount='$paymentAmount', isRefund='$isRefund' WHERE paymentCode='$paymentCode'";
                                    $result = mysqli_query($conn, $sql);
                                
                                    if ($result) {
                                        echo "Payment details updated successfully.";
                                    } else {
                                        echo "Error updating item: " . mysqli_error($conn);
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