<?php
ob_start(); // Start output buffering

require_once('tcpdf/tcpdf.php');

// Check if the paymentCode parameter is present in the URL
if (isset($_GET['refundId'])) {
    $refundId = $_GET['refundId'];

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

    // Fetch the payment details from the payment table based on the paymentCode
    $sql = "SELECT * FROM refund WHERE refundId = '$refundId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Retrieve the payment details
        $row = $result->fetch_assoc();
        $returnId = $row["returnId"];
        $billCode = $row["billCode"];
        $customerCode = $row["customerCode"];
        $refundDate = $row["refundDate"];
        $refundAmount = $row["refundAmount"];
        
        $itemListQuery = "SELECT itemCode, itemName, quantity, price FROM issued WHERE billCode = '$billCode'";
        $itemListResult = mysqli_query($conn, $itemListQuery);
?>