<?php
include("../db/dbConnection.php");
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = mysqli_real_escape_string($conn, $_POST['customerName']);
    $customerPhone = mysqli_real_escape_string($conn, $_POST['customerPhone']);
    $billingAddress = mysqli_real_escape_string($conn, $_POST['billingAddress']);
    $products = mysqli_real_escape_string($conn, $_POST['products']);  // This will be a JSON string
    $totalPrice = (int)$_POST['totalPrice'];
    $gstNo = (int)$_POST['gstNo'];
    
    
    // Prepare the SQL query to insert data into the invoice table
    $query = "INSERT INTO invoice_tbl 
        (customer_name, customer_phone, billing_address, products, total_price, gst_no)
        VALUES ('$customerName', '$customerPhone', '$billingAddress', '$products', $totalPrice, $gstNo)";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Success response
        $response['success'] = true;
        $response['message'] = "Bill Created successfully!";
        
    } else {
        // Error response
        $response['message'] = "Error adding Product: " . $query->error;
    }

    // Return JSON response
    echo json_encode($response);
}