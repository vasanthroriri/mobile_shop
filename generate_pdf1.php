<?php
require('fpdf/fpdf.php'); // Include FPDF library

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
        $products = json_decode($row['products'], true);

        // Calculate GST (12%)
        $gstAmount = $totalPrice * 0.12;
        $grandTotal = $totalPrice + $gstAmount;

        // Generate PDF using FPDF
        $pdf = new FPDF();
        $pdf->AddPage();
        
        // Set header style
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
        
        // Add line break
        $pdf->Ln(5);

        // Customer details
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Bill To:", 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $customerName, 0, 1);
        $pdf->Cell(0, 10, "Phone: " . $customerPhone, 0, 1);
        $pdf->Cell(0, 10, "Address: " . $billingAddress, 0, 1);
        
        // Add line break
        $pdf->Ln(10);

        // Products Table Header
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Product', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Brand', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Model', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Quantity', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Price', 1, 1, 'C');
        
        // Product details
        $pdf->SetFont('Arial', '', 12);
        foreach ($products as $product) {
            $pdf->Cell(40, 10, $product['product'], 1);
            $pdf->Cell(40, 10, $product['brand'], 1);
            $pdf->Cell(40, 10, $product['model'], 1);
            $pdf->Cell(30, 10, $product['quantity'], 1, 0, 'C');
            $pdf->Cell(40, 10, number_format($product['total'], 2), 1, 1, 'R');
        }
        
        // Add line break
        $pdf->Ln(5);

        // Total section
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(150, 10, "Subtotal:", 0, 0, 'R');
        $pdf->Cell(40, 10, number_format($totalPrice, 2), 0, 1, 'R');
        $pdf->Cell(150, 10, "GST (12%):", 0, 0, 'R');
        $pdf->Cell(40, 10, number_format($gstAmount, 2), 0, 1, 'R');
        $pdf->Cell(150, 10, "Grand Total:", 0, 0, 'R');
        $pdf->Cell(40, 10, number_format($grandTotal, 2), 0, 1, 'R');
        
        // Output PDF
        $pdf->Output('D', 'invoice_' . $invoice_id . '.pdf');
    } else {
        echo "Invoice not found!";
    }
} else {
    echo "Invalid request!";
}
?>
