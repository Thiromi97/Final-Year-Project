<?php
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
        $billDetailsQuery = "SELECT totalAmount, paymentStatus, remaningAmount FROM bill WHERE billCode = '$billCode'";
        $billDetailsResult = mysqli_query($conn, $billDetailsQuery);
        $billDetails = mysqli_fetch_assoc($billDetailsResult);

        // Prepare the invoice content
        $invoiceContent = "
        <html>
        <head>
            <title>Invoice</title>
            <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body>
            <div class='container'>
                <h1 class='text-center'>Invoice</h1>
                <table class='table table-bordered'>
                    <tr>
                        <th>Payment Code</th>
                        <td>{$paymentCode}</td>
                    </tr>
                    <tr>
                        <th>Bill Code</th>
                        <td>{$billCode}</td>
                    </tr>
                    <tr>
                        <th>Customer Code</th>
                        <td>{$customerCode}</td>
                    </tr>
                    <tr>
                        <th>Payment Date</th>
                        <td>{$paymentDate}</td>
                    </tr>
                    <tr>
                        <th>Payment Amount</th>
                        <td>{$paymentAmount}</td>
                    </tr>
                    <tr>
                        <th>Is Refund</th>
                        <td>{$isRefund}</td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td>{$billDetails['totalAmount']}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>{$billDetails['paymentStatus']}</td>
                    </tr>
                    <tr>
                        <th>Remaining Amount</th>
                        <td>{$billDetails['remaningAmount']}</td>
                    </tr>
                </table>
                <h2>Item List</h2>
                <table class='table table-bordered'>
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
            </div>
        </body>
        </html>";

        // Create a new TCPDF instance
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('TCPDF');
        $pdf->SetAuthor('Your Company');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        // Set default header data
        $pdf->SetHeaderData('', 0, 'Invoice', '');

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(true, 10);

        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add a page
        $pdf->AddPage();

        // Write the invoice content to the PDF
        $pdf->writeHTML($invoiceContent, true, false, true, false, '');

        // Output the PDF for download
        $pdf->Output('Invoice.pdf', 'D');

    } else {
        echo "Payment details not found.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid paymentCode parameter.";
}
?>
