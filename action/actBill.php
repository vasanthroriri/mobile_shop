<?php
session_start();
include "../class.php"; // Ensure your database connection is included here

if (isset($_POST['customerName']) && $_POST['customerName'] != '') {
    $customerName = mysqli_real_escape_string($conn, $_POST['customerName']);
    $customerPhone = mysqli_real_escape_string($conn, $_POST['customerPhone']);
    $billingAddress = mysqli_real_escape_string($conn, $_POST['billingAddress']);
    $products = mysqli_real_escape_string($conn, $_POST['products']);  // This will be a JSON string
    $totalPrice = (int)$_POST['totalPrice'];
    $gstNo = (int)$_POST['gstNo'];

    // Prepare the SQL query to insert data into the invoice table
    $query = "INSERT INTO invoice_tbl 
        (customer_name, customer_phone, billing_address, products, total_price, gst_no, created_at)
        VALUES ('$customerName', '$customerPhone', '$billingAddress', '$products', $totalPrice, $gstNo, NOW())";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Success response
        $response = array('success' => true, 'message' => 'Invoice created successfully.');

        // Decode the JSON products to an associative array
        $productDetails = json_decode($products, true);
        
        // Loop through each product to update stock
        foreach ($productDetails as $productId => $quantity) {
            // Prepare the SQL query to update stock quantity
            $updateQuery = "UPDATE stock_tbl SET quantity = quantity - $quantity WHERE product_id = $productId";
            mysqli_query($conn, $updateQuery); // Execute the update query
        }
    } else {
        // Error response
        $response = array('success' => false, 'message' => 'Error: ' . mysqli_error($conn));
    }

    // Return JSON response
    echo json_encode($response);
}