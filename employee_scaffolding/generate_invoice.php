<?php
ob_start(); // Start output buffering

require_once('tcpdf/tcpdf.php');

// Check if the paymentCode parameter is present in the URL
if (isset($_GET['paymentCode'])) {
    $paymentCode = $_GET['paymentCode'];

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
    $sql = "SELECT * FROM payment WHERE paymentCode = '$paymentCode'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Retrieve the payment details
        $row = $result->fetch_assoc();
        $billCode = $row["billCode"];
        $customerCode = $row["customerCode"];
        $paymentDate = $row["paymentDate"];
        $paymentAmount = $row["paymentAmount"];
        $isRefund = $row["isRefund"];

        // Retrieve the item list from the issued table based on the bill code
        $itemListQuery = "SELECT itemCode, itemName, quantity, price FROM issued WHERE billCode = '$billCode'";
        $itemListResult = mysqli_query($conn, $itemListQuery);

        // Retrieve bill details from the bill table based on the bill code
        $billDetailsQuery = "SELECT billDate, totalAmount, paymentStatus, remaningAmount FROM bill WHERE billCode = '$billCode'";
        $billDetailsResult = mysqli_query($conn, $billDetailsQuery);
        $billDetails = mysqli_fetch_assoc($billDetailsResult);

        // Retrieve customer details from the customer table based on the customer code
        $customerQuery = "SELECT customerName, address FROM customer WHERE customerCode = '$customerCode'";
        $customerResult = mysqli_query($conn, $customerQuery);
        $customerDetails = mysqli_fetch_assoc($customerResult);

        // Prepare the invoice content
        $invoiceContent = "
        <html>
        <head>
            <title>Invoice</title>
            <html>
            <head>
                <title>Invoice</title>
                <style>
    body {
        font-family: 'Helvetica', sans-serif;
        font-size: 8px;
        color: #333;
        background-color: #f5f5f5;
    }

    .container {
        max-width: 400px; /* Adjust the width as needed */
        margin: 0 auto;
        padding: 15px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 15px;
        color: #4a90e2;
        font-size: 14px; /* Increase the font size if needed */
    }

    h2 {
        font-size: 12px; /* Increase the font size if needed */
        margin-bottom: 5px;
        color: #333;
    }

    h3 {
        margin-top: 0;
        color: #666;
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .invoice-header i {
        max-width: 150px;
        height: auto;
    }

    .invoice-addresses {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .invoice-address {
        width: 45%;
    }

    .invoice-details {
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    th,
    td {
        padding: 6px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        font-weight: bold;
        background-color: #4a90e2;
        color: #fff;
    }

    .invoice-total {
        margin-top: 15px;
        text-align: right;
    }

    .invoice-footer {
        margin-top: 15px;
        text-align: center;
        color: #666;
    }
</style>

        </head>
        <body>
            <div class='container'>
                <h1>Invoice</h1>
                <div class='invoice-header'>
                    <i class='fas fa-dice-d20' style='font-size: 18px;'></i>
                    <h2>Asian Engineers</h2>
                </div>
                <div class='invoice-addresses'>
                    <div class='invoice-address'>
                        <h3>Billing Address:</h3>
                        <p>Asian Enginners</p>
                        <p>Kandy,Sri Lanka</p>
                    </div>
                    <div class='invoice-address'>
                        <h3>Customer Address:</h3>
                        <p>{$customerDetails['customerName']}</p>
                        <p>{$customerDetails['address']}</p>
                    </div>
                </div>
                <div class='invoice-details'>
                    <h3>Invoice Details:</h3>
                    <table>
                        <tr>
                            <th>Payment Code</th>
                            <td>{$paymentCode}</td>
                            <th>Bill Date</th>
                            <td>{$billDetails['billDate']}</td>
                        </tr>
                        <tr>
                            <th>Bill Code</th>
                            <td>{$billCode}</td>
                            <th>Total Amount</th>
                            <td>{$billDetails['totalAmount']}</td>
                        </tr>
                        <tr>
                            <th>Customer Code</th>
                            <td>{$customerCode}</td>
                            <th>Payment Status</th>
                            <td>{$billDetails['paymentStatus']}</td>
                        </tr>
                        <tr>
                            <th>Payment Date</th>
                            <td>{$paymentDate}</td>
                            <th>Remaining Amount</th>
                            <td>{$billDetails['remaningAmount']}</td>
                        </tr>
                        <tr>
                            <th>Payment Amount</th>
                            <td>{$paymentAmount}</td>
                            <th></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Is Refund</th>
                            <td>{$isRefund}</td>
                            <th></th>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <h2>Item List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>";

        while ($item = mysqli_fetch_assoc($itemListResult)) {
            $invoiceContent .= "
                        <tr>
                            <td>{$item['itemCode']}</td>
                            <td>{$item['itemName']}</td>
                            <td>{$item['quantity']}</td>
                            <td>{$item['price']}</td>
                        </tr>";
        }

        $invoiceContent .= "
                    </tbody>
                </table>
                <div class='invoice-total'>
                    <h3>Total Amount: {$billDetails['totalAmount']}</h3>
                </div>
                <div class='invoice-footer'>
                    <p>Thank you for your business!</p>
                </div>
            </div>
        </body>
        </html>";

        // Generate PDF using TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Asian Engineers');
        $pdf->SetTitle('Invoice');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->writeHTML($invoiceContent, true, false, true, false, '');
        $pdf->Output('invoice.pdf', 'I');

        // Close database connection
        $conn->close();
    } else {
        echo "No payment found for the provided payment code.";
    }
} else {
    echo "No payment code provided.";
}
?>
