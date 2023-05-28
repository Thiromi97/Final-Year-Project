<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "scaffolding";

$successMessage = '';
$errorMessage = '';

$conn = mysqli_connect($host, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['itemCode'])) {
    echo 'error';
} else {
    $itemCode = trim($_GET['itemCode']);
}

$sql = "SELECT itemName, category, purchasePrice, marketPrice, quantity FROM inventory WHERE itemCode = '$itemCode'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$itemName = $row['itemName'];
$category = $row['category'];
$purchasePrice = $row['purchasePrice'];
$marketPrice = $row['marketPrice'];
$quantity = $row['quantity'];

?>

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
                            <h2 class="text-center mb-4">Edit Item</h2>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?itemCode=' . $itemCode); ?>">
                                <div class="mb-3"><label class="form-label">Item Code</label><input class="form-control" type="text" id="name-2" name="itemCode" placeholder="" minlength="3" maxlength="3" required="" value="<?php echo $itemCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Item Name</label><input class="form-control" type="text" id="name-3" name="itemName" required="" placeholder="ItemName" value="<?php echo $itemName; ?>"></div>
                                <div class="mb-3"></div>
                                <div class="mb-3"><label class="form-label">Category</label><select class="form-select" name="category" required="" value="Category">
                                        <option value="Supplies" <?php if ($category == 'Supplies') echo 'selected'; ?>>Supplies</option>
                                        <option value="Tools" <?php if ($category == 'Tools') echo 'selected'; ?>>Tools</option>
                                        <option value="Equipment" <?php if ($category == 'Equipment') echo 'selected'; ?>>Equipment</option>
                                    </select></div>
                                <div class="mb-3"><label class="form-label">Purchase Price</label><input class="form-control" type="number" name="purchasePrice" placeholder="" required="" value="<?php echo $purchasePrice; ?>"></div>
                                <div class="mb-3"><label class="form-label">Market Price</label><input class="form-control" type="number" name="marketPrice" placeholder="" required="" value="<?php echo $marketPrice; ?>"></div>
                                <div class="mb-3"><label class="form-label">Quantity</label><input class="form-control" type="number" name="quantity" required="" placeholder="" value="<?php echo $quantity; ?>"></div>
                                <div><button class="btn btn-primary d-block w-100" type="submit">Save</button></div>
                            </form>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $itemName = $_POST['itemName'];
                                $category = $_POST['category'];
                                $purchasePrice = $_POST['purchasePrice'];
                                $marketPrice = $_POST['marketPrice'];
                                $quantity = $_POST['quantity'];
                                $sql = "UPDATE inventory SET itemName='$itemName', category='$category', purchasePrice='$purchasePrice', marketPrice='$marketPrice', quantity='$quantity' WHERE itemCode='$itemCode'";
                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    $successMessage = "Item updated successfully.";
                                } else {
                                    $errorMessage= "Error updating item: " . mysqli_error($conn);
                                }
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
    <script src="assets/bootstrap1.min.js"></script>
    <script src="assets/bs-init1.js"></script>
    <script src="assets/theme1.js"></script>
</body>
</html>