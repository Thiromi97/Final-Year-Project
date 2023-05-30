<?php
 $itemCode = "";
 $billCode = "";
 $itemName = "";
 $quantity = "";
 $price = "";

// Check if itemCode parameter is present in the URL
if (isset($_GET['itemCode']) && isset($_GET['billCode'])) {
    $itemCode = trim($_GET['itemCode']) ;
    $billCode = trim($_GET['billCode']) ;

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
    $sql = "SELECT itemName,quantity,price FROM issued WHERE itemCode = '$itemCode' AND billCode = '$billCode' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $itemName = $row['itemName'];
        $quantity = $row['quantity'];
        $price = $row['price'];
    } else {
        echo "Issued record not found!";
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
    <title>Delete Issued</title>
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
                            <h5 class="text-center text-primary mb-4">Are you sure you want to delete this issued item?</h5>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3"><label class="form-label">Item Code</label><input class="form-control" type="text" id="name-1" name="itemCode" placeholder="" minlength="3" maxlength="3" required="" value="<?php echo $itemCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Bill Code</label><input class="form-control" type="text" id="name-2" name="billCode" placeholder="Bill Code(BXXX format)" minlength="4" maxlength="4" required="" value="<?php echo $billCode; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Item Name</label><input class="form-control" type="text" name="itemName" required="" value="<?php echo $itemName; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Quantity</label><input class="form-control" type="number" required="" name="quantity" placeholder="Quantity" value="<?php echo $quantity; ?>" readonly></div>
                                <div class="mb-3"><label class="form-label">Price</label><input class="form-control" type="number" name="price" required="" value="<?php echo $price; ?>" readonly></div>
                                <div>
                                    <div class="row row-cols-sm-2">
                                        <div class="col"><button class="btn btn-primary" type="submit" name="delete" style="margin: 0px;">Delete</button></div>
                                        <div class="col"><a class="btn btn-primary" href='issued.php'>Cancel</a></div>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['delete']) && isset($_POST['itemCode']) && isset($_POST['billCode'])) {
                                $itemCode = $_POST['itemCode'];
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
                                $sql = "DELETE FROM issued WHERE itemCode = '$itemCode' AND billCode = '$billCode'";

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