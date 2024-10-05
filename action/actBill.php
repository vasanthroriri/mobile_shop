<?php
session_start();
include "class.php"; // Ensure your database connection is included here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = mysqli_real_escape_string($conn, $_POST['customerName']);
    $customerPhone = mysqli_real_escape_string($conn, $_POST['customerPhone']);
    $billingAddress = mysqli_real_escape_string($conn, $_POST['billingAddress']);
    $products = mysqli_real_escape_string($conn, $_POST['products']);  // This will be a JSON string
    $totalPrice = (int)$_POST['totalPrice'];
    $gstNo = (int)$_POST['gstNo'];
    
    // Set default invoice status as 'Pending'
    $invoiceStatus = 'Pending'; 

    // Prepare the SQL query to insert data into the invoice table
    $query = "INSERT INTO invoice 
        (customer_name, customer_phone, billing_address, products, total_price, gst_no, invoice_status, created_at)
        VALUES ('$customerName', '$customerPhone', '$billingAddress', '$products', $totalPrice, $gstNo, '$invoiceStatus', NOW())";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Success response
        $response = array('success' => true, 'message' => 'Invoice created successfully.');
    } else {
        // Error response
        $response = array('success' => false, 'message' => 'Error: ' . mysqli_error($conn));
    }

    // Return JSON response
    echo json_encode($response);
}