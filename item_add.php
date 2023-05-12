<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scaffolding";

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
                            <h2 class="text-center mb-4">New Item</h2>
                            <form method="post" action="">
                                <div class="mb-3"><label class="form-label">Item Code</label><input class="form-control" type="text" id="name-2" name="itemCode" placeholder="Item Code(ZXX foramt)" minlength="3" maxlength="3" required=""></div>
                                <div class="mb-3"><label class="form-label">Item Name</label><input class="form-control" type="text" id="name-3" name="itemName" maxlength="200" required="" placeholder="ItemName"></div>
                                <div class="mb-3"></div>
                                <div class="mb-3"><label class="form-label">Category</label><select class="form-select" name="category" required="" value="Category">
                                        <option value="Supplies">Supplies</option>
                                        <option value="Tools">Tools</option>
                                        <option value="Equipment">Equipment</option>
                                    </select></div>
                                <div class="mb-3"><label class="form-label">Purchased Price</label><input class="form-control" type="number" name="purchasePrice"  placeholder="$" required=""></div>
                                <div class="mb-3"><label class="form-label">Market Price</label><input class="form-control" type="number" name="marketPrice"  placeholder="$" required=""></div>
                                <div class="mb-3"><label class="form-label">Quantity</label><input class="form-control" type="number" name="quantity"  required="" placeholder="Quantity"></div>
                                <div><button class="btn btn-primary d-block w-100" type="submit">Save</button></div>
                            </form>
                            <?php 
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Escape user inputs for security
                                $ItemCode = mysqli_real_escape_string($conn, $_POST['itemCode']);
                                $ItemName = mysqli_real_escape_string($conn, $_POST['itemName']);
                                $Category = mysqli_real_escape_string($conn, $_POST['category']);
                                $PurchasePrice = mysqli_real_escape_string($conn, $_POST['purchasePrice']);
                                $MarketPrice = mysqli_real_escape_string($conn, $_POST['marketPrice']);
                                $Quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
                                
                                 if (substr($ItemCode, 0, 1) === 'Z') {
                                    // Attempt insert query execution
                                    $sql = "SELECT itemCode FROM inventory WHERE itemCode = '$ItemCode'";
                                    $result = mysqli_query($conn, $sql);
                                    
                                    if (mysqli_num_rows($result) > 0) {
                                        echo "ERROR: Item with code $ItemCode already exists.";
                                    } else {
                                        $sql = "INSERT INTO inventory (itemCode, itemName,category,purchasePrice,marketPrice,quantity) VALUES ('$ItemCode', '$ItemName', '$Category', '$PurchasePrice', '$MarketPrice', '$Quantity')";
                                        
                                        if(mysqli_query($conn, $sql)){
                                            echo "Records added successfully.";
                                        } else{
                                            echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
                                        }
                                    }
                                } else {
                                    echo "ERROR: Item code must start with 'Z'.";
                                }
                                
                                mysqli_close($conn);
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