<?php
require_once('tcpdf/tcpdf.php');

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

// Fetch sales data from the database
$sql = "SELECT b.billCode, c.customerName, b.billDate, b.totalAmount, b.paymentStatus
        FROM bill b
        INNER JOIN customer c ON b.customerCode = c.customerCode";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Company');
    $pdf->SetTitle('Sales Report');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Add a page
    $pdf->AddPage();

    // Output the sales report table
    $html = "<h2>Sales Report</h2>";
    $html .= "<table>
                <tr>
                    <th>Bill Code</th>
                    <th>Customer Name</th>
                    <th>Bill Date</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                </tr>";

    while ($row = $result->fetch_assoc()) {
        $html .= "<tr>
                    <td>".$row["billCode"]."</td>
                    <td>".$row["customerName"]."</td>
                    <td>".$row["billDate"]."</td>
                    <td>".$row["totalAmount"]."</td>
                    <td>".$row["paymentStatus"]."</td>
                </tr>";
    }

    $html .= "</table>";

    // Write the HTML content to the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output the PDF
    $pdf->Output('sales_report.pdf', 'I');
} else {
    echo "No sales data available.";
}

// Close database connection
$conn->close();
?>
