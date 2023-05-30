<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scaffolding";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to retrieve the market price based on the item code
function getMarketPrice($connection, $itemCode) {
    $query = "SELECT marketPrice FROM inventory WHERE itemCode = '$itemCode'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['marketPrice'];
}

// Check if the itemCode parameter is set
if (isset($_GET['itemCode'])) {
    $itemCode = $_GET['itemCode'];
    $marketPrice = getMarketPrice($connection, $itemCode);
    echo $marketPrice;
}
?>
