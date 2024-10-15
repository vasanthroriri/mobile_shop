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
        $date=$row['invoice_date'];
        $products = json_decode($row['products'], true);

        // Calculate GST (12%)
        $gstAmount = $totalPrice * 0.12;
        $grandTotal = $totalPrice + $gstAmount;

        // Generate PDF using TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Company');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice Details');
        $pdf->SetKeywords('TCPDF, PDF, invoice');

        // Set margins
        $pdf->SetMargins(15, 15, 15); // left, top, right
        $pdf->SetAutoPageBreak(TRUE, 15); // auto page break

        // Add a page
        $pdf->AddPage();

        // Set header style
        $pdf->SetFont('helvetica', 'B', 20);
        $pdf->Cell(0, 15, 'INVOICE', 0, 1, 'C');
        $pdf->Ln(5);

        // Company logo (optional)
        $pdf->Image('path/to/logo.png', 10, 10, 30, '', 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);
        
        // Customer details
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, "Bill To:", 0, 1);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, $customerName, 0, 1);
        $pdf->Cell(0, 10, "Phone: " . $customerPhone, 0, 1);
        $pdf->Cell(0, 10, "Address: " . $billingAddress, 0, 1);
        $pdf->Cell(0, 10, "Date: " . date('d F Y', strtotime($date)), 0, 1);
        
        // Add line break
        $pdf->Ln(10);

        // Products Table Header
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(50, 10, 'Product', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Brand', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Model', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Quantity', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Price', 1, 1, 'C');

        // Product details
        $pdf->SetFont('helvetica', '', 12);
        foreach ($products as $product) {
            $pdf->Cell(50, 10, $product['product'], 1);
            $pdf->Cell(40, 10, $product['brand'], 1);
            $pdf->Cell(40, 10, $product['model'], 1);
            $pdf->Cell(30, 10, $product['quantity'], 1, 0, 'C');
            $pdf->Cell(30, 10,  number_format($product['total'], 2), 1, 1, 'R');
        }

        // Add line break
        $pdf->Ln(5);

    // Use the installed DejaVu Sans font
    $pdf->SetFont('DejaVu Sans', '', 12); // Change to the font you installed

    // Total section
    $pdf->SetFont('DejaVu Sans', 'B', 12);
    $pdf->Cell(150, 10, "Subtotal:", 0, 0, 'R');
    $pdf->Cell(30, 10, '₹' . number_format($totalPrice, 2), 0, 1, 'R');
    $pdf->Cell(150, 10, "GST (12%):", 0, 0, 'R');
    $pdf->Cell(30, 10, '₹' . number_format($gstAmount, 2), 0, 1, 'R');
    $pdf->Cell(150, 10, "Grand Total:", 0, 0, 'R');
    $pdf->Cell(30, 10, '₹' . number_format($grandTotal, 2), 0, 1, 'R');

        // Output PDF
        $pdf->Output('invoice_' . $invoice_id . '.pdf', 'I'); // Change 'I' to 'D' for download

    } else {
        echo "Invoice not found!";
    }
} else {
    echo "Invalid request!";
}
?>
