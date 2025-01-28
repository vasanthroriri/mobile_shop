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
        $billNo = $row['gst_no'];
        $products = json_decode($row['products'], true);

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
                <div style="text-align: center; font-size: 16px; font-weight: bold; margin: 2px 0; line-height: 1.2;">SAKTHI MOBILES</div>
                <div style="text-align: center; font-size: 10px; margin: 2px 0; line-height: 0.5;">Hema Theatre(Opp), Kalakad. Cell : 8870607304, 9626165143</div>
                <div style="text-align: center; font-size: 12px; margin: 2px 0; line-height: 0.7;">GST No : 33FCLPR2117B1ZX</div>
                <table width="100%" style="border-collapse: separate; border-spacing: 0 5px;">
                    <tr>
                        <td width="20%" style="text-align: left;">
                            Customer Name
                        </td>
                        <td width="3%" style="text-align: left;">
                            :
                        </td>
                        <td width="37%" style="text-align: left;">
                            ' . $customerName . '
                        </td>
                        <td width="20%" style="text-align: right;">
                            Bill No.
                        </td>
                        <td width="3%" style="text-align: right;">
                            :
                        </td>
                        <td width="15%" style="text-align: left;">
                            ' . $billNo . '
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="text-align: left;">
                            Phone No.
                        </td>
                        <td width="3%" style="text-align: left;">
                            :
                        </td>
                        <td width="37%" style="text-align: left;">
                            ' . $customerPhone . '
                        </td>
                        <td width="20%" style="text-align: right;">
                            Date
                        </td>
                        <td width="3%" style="text-align: right;">
                            :
                        </td>
                        <td width="15%" style="text-align: left;">
                            ' . date('d M Y', strtotime($date)) . '
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" style="text-align: left;">
                            Address
                        </td>
                        <td width="3%" style="text-align: left;">
                            :
                        </td>
                        <td width="37%" style="text-align: left;">
                            ' . $billingAddress . '
                        </td>
                        <td width="20%" style="text-align: right;">
                            Time
                        </td>
                        <td width="3%" style="text-align: right;">
                            :
                        </td>
                        <td width="15%" style="text-align: left;">
                            ' . date('H:i:s', strtotime($date)) . '
                        </td>
                    </tr>
                </table>

                <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                    <thead>
                        <tr style="background-color: #f1f1f1;">
                            <th style="text-align: center; width: 60%;">Product</th>
                            <th style="text-align: center; width: 20%;">Quantity</th>
                            <th style="text-align: center; width: 20%;">Price</th>
                        </tr>
                    </thead>
                    <tbody>';

        // Loop through the products and generate rows
        foreach ($products as $product) {

            $netRate = $product['total'] / (1 + 0.18);
            $gstAmount = $product['total'] - $netRate;
            $cgstAmount = $gstAmount/2;
            $sgstAmount = $gstAmount/2;
            // Add details to the model if the product is "mobile"
            if (($product['product']) === 'Mobile') {
                $modelDetails =  $product['details'];
            }
            $html .= '
                <tr>
                    <td style="text-align: center; width: 60%;">' . $product['product'] . ' - ' . $product['brand'] .' - '. $product['model'] . '</td>
                    <td style="text-align: center; width: 20%;">' . $product['quantity'] . '</td>
                    <td style="text-align: right; width: 20%;">
                        <span style="font-family: dejavusans;">₹</span>' . number_format($netRate, 2) . '
                    </td>
                </tr>'; 
        }

        $html .= '</tbody></table>';

        // Total section
        $html .= '
            <table border="0" cellpadding="5" cellspacing="0" style="width: 100%; margin-top: 15px; text-align: right;">
                <tr>
                    <td rowspan="2" colspan="3" style="text-align: left;">'. $modelDetails .'</td>
                    <td>CGST (9%) :</td>
                    <td><span style="font-family: dejavusans;">₹</span>' . number_format($cgstAmount, 2) . '</td>
                </tr>
                <tr>
                    <td>SGST (9%) :</td>
                    <td><span style="font-family: dejavusans;">₹</span>' . number_format($sgstAmount, 2) . '</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Grand Total :</strong></td>
                    <td><strong><span style="font-family: dejavusans;">₹</span>' . number_format($product['total'], 2) . '</strong></td>
                </tr>
            </table>
            <div style="margin-top: 30px; font-size: 10px; text-align: left;">
                <strong><u>Terms and Conditions:</u></strong><br>
                1. Goods once sold will not be taken back or exchanged.<br>
                2. Warranty is provided as per the manufacturer\'s policy.<br>
                3. Payment should be made in full before delivery.<br>
                4. Please keep this invoice safe for warranty and service claims.<br>
            </div><br>
                <table width="100%">
                    <tr>
                        <td style="text-align: left; width: 50%;">
                            <strong>Customer\'s Signature</strong>
                        </td>
                        <td style="text-align: right; width: 48%;">
                            <strong>Shop Owner\'s Signature</strong>
                        </td>
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
