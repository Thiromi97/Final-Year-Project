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

if (!isset($_GET['itemCode']) && !isset($_GET['billCode'])) {
    echo 'error';
} else {
    $itemCode = $_GET['itemCode'] ?? '';
    $billCode = $_GET['billCode'] ?? '';
}

$sql = "SELECT itemCode, billCode, itemName, quantity,price FROM issued WHERE itemCode='$itemCode' AND billCode = '$billCode'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$itemName = $row['itemName'];
$quantity = $row['quantity'];
$price = $row['price'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Edit Issued</title>
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
                            <h2 class="text-center mb-4">Edit Issued</h2>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?itemCode=' . $itemCode . '&billCode=' . $billCode); ?>">
                                <div class="mb-3"><label class="form-label">Item Code</label><input class="form-control" type="text" id="name-1" name="itemCode" placeholder="" minlength="3" maxlength="3" required="" value="<?php echo $itemCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Bill Code</label><input class="form-control" type="text" id="name-2" name="billCode" placeholder="Bill Code(BXXX format)" minlength="4" maxlength="4" required="" value="<?php echo $billCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Item Name</label><input class="form-control" type="text" name="itemName" required="" value="<?php echo $itemName; ?>"></div>
                                <div class="mb-3"><label class="form-label">Quantity</label><input class="form-control" type="number" required="" name="quantity" placeholder="Quantity" value="<?php echo $quantity; ?>"></div>
                                <div class="mb-3"><label class="form-label">Price</label><input class="form-control" type="number" name="price" required="" value="<?php echo $price; ?>"></div>
                                <div>
                                    <div class="row">
                                        <div class="col"><input class="btn btn-primary" type="submit" style="width: 100%;" name="Save" value="Save"></div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $itemName = $_POST['itemName'];
                                $quantity = $_POST['quantity'];
                                $price = $_POST['price'];
                                $sql = "UPDATE issued SET itemName='$itemName', quantity='$quantity', price='$price' WHERE itemCode='$itemCode' AND billCode='$billCode'";
                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    echo "issued updated successfully.";
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