<?php
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

        // Show a confirmation message and ask the user to confirm the deletion
        echo "<h2>Confirm Delete</h2>";
        echo "<p>Are you sure you want to delete the following item?</p>";
        echo "<ul>";
        echo "<li><strong>Item Code:</strong> $itemCode</li>";
        echo "<li><strong>Item Name:</strong> $itemName</li>";
        echo "<li><strong>Category:</strong> $category</li>";
        echo "<li><strong>Purchase Price:</strong> $purchasePrice</li>";
        echo "<li><strong>Market Price:</strong> $marketPrice</li>";
        echo "<li><strong>Quantity:</strong> $quantity</li>";
        echo "</ul>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='itemCode' value='$itemCode'>";
        echo "<button type='submit' name='delete' class='btn btn-danger'>Delete</button>";
        echo "<a href='inventory.php' class='btn btn-primary'>Cancel</a>";
        echo "</form>";
    } else {
        echo "Item not found!";
    }

    // Close the database connection
    $conn->close();
}

// If the Delete button is clicked and the itemCode parameter is present, delete the record from the inventory table
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
