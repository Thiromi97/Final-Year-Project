<?php
 $itemCode = "";
 $itemName = "";
 $category = "";
// Check if itemCode parameter is present in the URL
if (isset($_GET['itemCode'])) {
    $itemCode = $_GET['itemCode'];

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
    $sql = "SELECT itemName, category, purchasePrice, marketPrice, quantity FROM inventory WHERE itemCode = '$itemCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $itemName = $row['itemName'];
        $category = $row['category'];
        $purchasePrice = $row['purchasePrice'];
        $marketPrice = $row['marketPrice'];
        $quantity = $row['quantity'];
    } else {
        echo "Item not found!";
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
                            <h2 class="text-center mb-4">Confirm Delete</h2>
                            <h5 class="text-center text-primary mb-4">Are you sure you want to delete this item?</h5>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="mb-3"><label class="form-label">Item Code</label><input class="form-control" type="text" id="name-2" name="itemCode" placeholder="Z" minlength="3" maxlength="3" required="" value="<?php echo $itemCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Item Name</label><input class="form-control" type="text" id="name-3" name="itemName" required="" placeholder="ItemName" value="<?php echo $itemName; ?>" readonly></div>
                                <div class="mb-3"></div>
                                <div class="mb-3"><label class="form-label">Category</label><select class="form-select" name="category" required="" value="Category">
                                        <option value="Supplies" <?php if ($category == 'Supplies') echo 'selected'; ?>>Supplies</option>
                                        <option value="Tools" <?php if ($category == 'Tools') echo 'selected'; ?>>Tools</option>
                                        <option value="Equipment" <?php if ($category == 'Equipment') echo 'selected'; ?>>Equipment</option>
                                    </select></div>
                                <div class="mb-3"><label class="form-label">Purchase Price</label><input class="form-control" type="number" name="purchasePrice" placeholder="$" required="" value="<?php echo $purchasePrice; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Market Price</label><input class="form-control" type="number" name="marketPrice" placeholder="$" required="" value="<?php echo $marketPrice; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Quantity</label><input class="form-control" type="number" name="quantity" required="" placeholder="Quantity" value="<?php echo $quantity; ?>" readonly></div>
                                <div>
                                    <div class="row row-cols-sm-2">
                                        <div class="col"><button class="btn btn-primary" type="submit" name="delete" style="margin: 0px;">Delete</button></div>
                                        <div class="col"><a class="btn btn-primary" href='inventory.php'>Cancel</a></div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['delete']) && isset($_POST['itemCode'])) {
                                $itemCode = $_POST['itemCode'];

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
                                $sql = "DELETE FROM inventory WHERE itemCode = '$itemCode'";

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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>