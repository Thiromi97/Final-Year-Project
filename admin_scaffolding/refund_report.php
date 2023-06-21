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

// Fetch refund and return data from the database
$sql = "SELECT r.returnId, r.returnDate, r.returnQuantity, r.totalPrice, b.billCode, c.customerName
        FROM returned r
        INNER JOIN bill b ON r.billCode = b.billCode
        INNER JOIN customer c ON b.customerCode = c.customerCode";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Company');
    $pdf->SetTitle('Refund and Return Report');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Add a page
    $pdf->AddPage();

    // Output the refund and return report table
    $html = "<h2>Refund and Return Report</h2>";
    $html .= "<table>
                <tr>
                    <th>Return ID</th>
                    <th>Return Date</th>
                    <th>Return Quantity</th>
                    <th>Total Price</th>
                    <th>Bill Code</th>
                    <th>Customer Name</th>
                </tr>";

    while ($row = $result->fetch_assoc()) {
        $html .= "<tr>
                    <td>".$row["returnId"]."</td>
                    <td>".$row["returnDate"]."</td>
                    <td>".$row["returnQuantity"]."</td>
                    <td>".$row["totalPrice"]."</td>
                    <td>".$row["billCode"]."</td>
                    <td>".$row["customerName"]."</td>
                </tr>";
    }

    $html .= "</table>";

    // Write the HTML content to the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output the PDF
    $pdf->Output('refund_return_report.pdf', 'I');
} else {
    echo "No refund and return data available.";
}

// Close database connection
$conn->close();
?>
