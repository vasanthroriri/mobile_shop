<?php
include("../db/dbConnection.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addProduct') {
    $productName = $_POST['productName'];
   

    // Check if the university name already exists
    $check_sql = "SELECT COUNT(*) as count FROM `product_tbl` WHERE `product_name` = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $productName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $exists = $row['count'] > 0;

    if ($exists) {
        $response['success'] = false;
        $response['message'] = "Product name already exists!";
    } else {
        // Insert the new university if it doesn't exist
        $product_sql = "INSERT INTO `product_tbl`
            (`product_name`) 
            VALUES 
            (?)";

        $stmt = $conn->prepare($product_sql);
        $stmt->bind_param("s", $productName);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Product added successfully!";
        } else {
            $response['message'] = "Error adding Product: " . $stmt->error;
        }
    }

    echo json_encode($response);
    exit();
}


// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    
    $editId = $_POST['editId'];

    $selQuery = "SELECT `product_id`, `product_name` FROM `product_tbl` WHERE product_id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Prepare university details array
        $productDetails = [
            'brand_id' => $row['product_id'],
            'brand_name' => $row['product_name'],

        ];

        echo json_encode($productDetails);
    } else {
        $response['message'] = "Error fetching Brand details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }


    // Handle updating student details
        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editProduct') {
            $editid = $_POST['editid'];
            $editProductName = $_POST['editProductName'];
           
  
            
            $editProduct ="UPDATE `product_tbl`
             SET `product_name`='$editProductName'
             WHERE product_id = $editid";
            
            $productres = mysqli_query($conn, $editProduct);

                if ($productres) {
                    $_SESSION['message'] = "Product details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "Product details Updated successfully!";
                } 
                else {
                $response['message'] = "Error: " . mysqli_error($conn);
            }
            
            echo json_encode($response);
            exit();
        }


        // // Handle deleting a client
            if (isset($_POST['deleteId'])) {
                $id = $_POST['deleteId'];
                

                $queryDel = "UPDATE `product_tbl` SET `product_status`='Inactive' WHERE product_id = $id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "Product details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "Product details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting Product details!";
                    $response['message'] = "Error: " . mysqli_error($conn);
                }

                echo json_encode($response);
                exit();
            }



           





            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();
