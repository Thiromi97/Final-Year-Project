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

if (!isset($_GET['customerCode'])) {
    echo 'error';
} else {
    $customerCode = trim($_GET['customerCode']);
}

$sql = "SELECT customerName,nic,address,contactNo,blackListed FROM customer WHERE customerCode = '$customerCode'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$customerName = $row['customerName'];
$nic = $row['nic'];
$address = $row['address'];
$contactNo = $row['contactNo'];
$blackListed = $row['blackListed'];

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
                            <h2 class="text-center mb-4">Edit Customer</h2>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?customerCode=' . $customerCode); ?>">
                                <div class="mb-3"><label class="form-label">Customer Code</label><input class="form-control" type="text" id="name-2" name="customerCode" placeholder="C" minlength="3" maxlength="3" required="" value="<?php echo $customerCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Customer Name</label><input class="form-control" type="text" id="name-3" name="customerName" maxlength="200" required="" placeholder="Customer Name" value="<?php echo $customerName; ?>"></div>
                                <div class="mb-3"><label class="form-label">NIC</label><input class="form-control" type="text" id="name-4" name="nic" maxlength="12" required="" placeholder="NIC" value="<?php echo $nic; ?>"></div>
                                <div class="mb-3"><label class="form-label">Address</label><input class="form-control" type="text" id="name-1" name="address" maxlength="200" required="" placeholder="Address"  value="<?php echo $address; ?>"></div>
                                <div class="mb-3"><label class="form-label">Contact No</label><input class="form-control" type="tel" required="" name="contactNo" placeholder="Contact No" minlength="10" maxlength="10"  value="<?php echo $contactNo; ?>"></div>
                                <div class="mb-3"><label class="form-label">Black Listed</label>
                                <select class="form-select" name="blackListed" required="">
                                        <option value="No" <?php if ($blackListed == 'No') echo 'selected'; ?>>No</option>
                                        <option value="Yes"<?php if ($blackListed == 'Yes') echo 'selected'; ?>>Yes</option>
                                    </select></div>
                                <div>
                                    <div class="row">
                                    <div><button class="btn btn-primary d-block w-100" type="submit">Save</button></div>
                                    </div>
                                </div>
                            </form>
                            <?php 
                                   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $customerName = $_POST['customerName'];
                                    $nic = $_POST['nic'];
                                    $address = $_POST['address'];
                                    $contactNo = $_POST['contactNo'];
                                    $blackListed = $_POST['blackListed'];
                                    $sql = "UPDATE customer SET customerName='$customerName', nic='$nic', address='$address', contactNo='$contactNo', blackListed='$blackListed' WHERE customerCode='$customerCode'";
                                    $result = mysqli_query($conn, $sql);
    
                                    if ($result) {
                                        echo "Customer details updated successfully.";
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