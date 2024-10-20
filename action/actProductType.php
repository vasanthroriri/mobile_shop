<?php
include("../db/dbConnection.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addProductType') {

    $productName = $_POST['productName'];
    $productType = $_POST['productType'];

    $elective_sql = "INSERT INTO `product_type_tbl`
    (`pro_id`
    ,`name`)
     VALUES 
     ('$productName'
     ,'$productType')";

    if ($conn->query($elective_sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Product Type added successfully!";
    } else {
        $response['message'] = "Error adding Product Type: " . $conn->error;
    }

    echo json_encode($response);
    exit();
}



// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    
    $editId = $_POST['editId'];

    $selQuery = "SELECT `id`, `pro_id`, `name` FROM `product_type_tbl` WHERE id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Prepare university details array
        $electiveDetails = [
            'id' => $row['id'],
            'pro_id' => $row['pro_id'],
            'name' => $row['name']
            
        ];

        echo json_encode($electiveDetails);
    } else {
        $response['message'] = "Error fetching Product Type details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }


    // Handle updating student details
        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editProductType') {

            $productType_id = $_POST['productType_id'];
            $productNameEdit = $_POST['productNameEdit'];
            $productTypeEdit = $_POST['productTypeEdit'];
            
           
            $editModel ="UPDATE `product_type_tbl` 
            SET `pro_id`='$productNameEdit',`name`='$productTypeEdit' WHERE id = $productType_id";
            
            $model_result = mysqli_query($conn, $editModel);

                if ($model_result) {
                    $_SESSION['message'] = "Product Type details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "Product Type details Updated successfully!";
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
                

                $queryDel = "UPDATE `product_type_tbl` SET `status`='Inactive' WHERE id= $id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "Product Type details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "Product Type details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting Product Type details!";
                    $response['message'] = "Error: " . mysqli_error($conn);
                }

                echo json_encode($response);
                exit();
            }




            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();

