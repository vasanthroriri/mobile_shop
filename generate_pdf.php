<?php
require('TCPDF/tcpdf.php'); // Include TCPDF library

// Database connection
include("db/dbConnection.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if invoice_id is set
if (isset($_GET['invoice_id'])) {
    $invoice_id = (int)$_GET['invoice_id'];

    // Fetch invoice details from the database
    $query = "SELECT * FROM invoice_tbl WHERE invoice_id = $invoice_id";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        // Prepare invoice data
        $customerName = $row['customer_name'];
        $customerPhone = $row['customer_phone'];
        $billingAddress = $row['billing_address'];
        $totalPrice = $row['total_price'];
        $date = $row['invoice_date'];
        $products = json_decode($row['products'], true);

        // Calculate GST (12%)
        $gstAmount = $totalPrice * 0.12;
        $grandTotal = $totalPrice + $gstAmount;

        // Generate PDF using TCPDF
        $pdf = new TCPDF('L', 'mm', 'A5'); // Set page size to A5
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sakthi Mobiles');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice Details');
        $pdf->SetKeywords('TCPDF, PDF, invoice');

        // Set margins for A5 page
        $pdf->SetMargins(5, 5, 5, 5); // left, top, right
        $pdf->SetAutoPageBreak(TRUE, 5); // auto page break

        // Add a page
        $pdf->AddPage();

        // Set header style
        $pdf->SetFont('helvetica', 'B', 12);

        // Start of the box for margins
        $html = '
            <div style="border: 1px solid black; padding: 5px;">
                <h3 style="text-align: center;">SAKTHI MOBILES</h3>
                <h4 style="text-align: center;">Hema Theatre(Opp), Kalakad. Cell : 8870607304</h4>
                <h4 style="text-align: center;">GST No : 33FCLPR2117B1ZX</h4>
                <table width="90%">
                    <tr>
                        <td width="50%">
                            Customer Name : ' . $customerName . '<br>
                            Address : ' . $billingAddress . '<br>
                            Phone No. : ' . $customerPhone . '
                        </td>
                        <td width="50%" style="text-align: right; vertical-align: top;">
                            <p><strong>Date: </strong>' . date('d F Y', strtotime($date)) . '</p>
                        </td>
                    </tr>
                </table>

                <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                    <thead>
                        <tr style="background-color: #f1f1f1;">
                            <th style="text-align: center; width: 50%;">Product</th>
                            <th style="text-align: center; width: 20%;">Brand</th>
                            <th style="text-align: center; width: 20%;">Model</th>
                            <th style="text-align: center; width: 10%;">Quantity</th>
                            <th style="text-align: center; width: 15%;">Price</th>
                        </tr>
                    </thead>
                    <tbody>';

        // Loop through the products and generate rows
        foreach ($products as $product) {
            $html .= '
                <tr>
                    <td>' . $product['product'] . '</td>
                    <td>' . $product['brand'] . '</td>
                    <td>' . $product['model'] . '</td>
                    <td style="text-align: center;">' . $product['quantity'] . '</td>
                    <td style="text-align: right;">₹' . number_format($product['total'], 2) . '</td>
                </tr>';
        }

        $html .= '</tbody></table>';

        // Total section
        $html .= '
            <table border="0" cellpadding="5" cellspacing="0" style="width: 100%; margin-top: 15px; text-align: right;">
                <tr>
                    <td style="width: 85%;">Subtotal:</td>
                    <td>₹' . number_format($totalPrice, 2) . '</td>
                </tr>
                <tr>
                    <td>GST (12%):</td>
                    <td>₹' . number_format($gstAmount, 2) . '</td>
                </tr>
                <tr>
                    <td><strong>Grand Total:</strong></td>
                    <td><strong>₹' . number_format($grandTotal, 2) . '</strong></td>
                </tr>
            </table>
        </div>'; // End of the box

        // Write HTML to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdf->Output('invoice_' . $invoice_id . '.pdf', 'I'); // Change 'I' to 'D' for download

    } else {
        echo "Invoice not found!";
    }
} else {
    echo "Invalid request!";
}
?>
