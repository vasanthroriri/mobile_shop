<?php
include("../class.php");

session_start();
header('Content-Type: application/json');

// Initialize the response array
$response = ['success' => false, 'message' => ''];


if (isset($_POST['data']) && $_POST['data'] != '') {
    // Construct the SQL queries for each table
    $selQuery1 = "SELECT 
                SUM(total_price) AS total_amount, 
                MONTHNAME(CURRENT_DATE()) AS month_name
            FROM 
                invoice_tbl 
            WHERE 
                invoice_status = 'Active' 
                AND MONTH(invoice_date) = MONTH(CURRENT_DATE()) 
                AND YEAR(invoice_date) = YEAR(CURRENT_DATE());";

   

    // Execute the queries
    $result1 = mysqli_query($conn, $selQuery1);



    if ($result1) {
        $row1 = mysqli_fetch_assoc($result1) ?? [];

       
        $fees = array(
            'total_amount' => $row1['total_amount'] ?? 0,
            'month_name' => $row1['month_name'] ?? '',
         
        );

        $response['success'] = true;
        $response['message'] = "Successfully retrieved report";
        $response['data'] = $fees;
    } else {
        $response['message'] = "Error fetching details: " . mysqli_error($conn);
    }
    echo json_encode($response);
    exit();
    } else {
        $response['message'] = 'Required parameter is missing.';
    }

//======================================================================================






        // Output JSON response
        echo json_encode($response);
        exit();
?>
