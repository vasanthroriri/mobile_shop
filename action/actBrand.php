<?php
include("../db/dbConnection.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addBrand') {
    $brandName = $_POST['brandName'];
   

    // Check if the university name already exists
    $check_sql = "SELECT COUNT(*) as count FROM `brand_tbl` WHERE `brand_name` = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $universityName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $exists = $row['count'] > 0;

    if ($exists) {
        $response['success'] = false;
        $response['message'] = "Brand name already exists!";
    } else {
        // Insert the new university if it doesn't exist
        $university_sql = "INSERT INTO `brand_tbl`
            (`brand_name`) 
            VALUES 
            (?)";

        $stmt = $conn->prepare($university_sql);
        $stmt->bind_param("s", $brandName);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Brand added successfully!";
        } else {
            $response['message'] = "Error adding Brand: " . $stmt->error;
        }
    }

    echo json_encode($response);
    exit();
}


// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    
    $editId = $_POST['editId'];

    $selQuery = "SELECT `brand_id`, `brand_name` FROM `brand_tbl` WHERE brand_id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Prepare university details array
        $universityDetails = [
            'brand_id' => $row['brand_id'],
            'brand_name' => $row['brand_name'],

        ];

        echo json_encode($universityDetails);
    } else {
        $response['message'] = "Error fetching Brand details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }


    // Handle updating student details
        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editBrand') {
            $editid = $_POST['editid'];
            $editBrandName = $_POST['editBrandName'];
           
  
            
            $editUniversity ="UPDATE `brand_tbl`
             SET `brand_name`='$editBrandName'
             WHERE brand_id = $editid";
            
            $universityres = mysqli_query($conn, $editUniversity);

                if ($universityres) {
                    $_SESSION['message'] = "Brand details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "Brand details Updated successfully!";
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
                $updatedBy = $_SESSION['userId'];

                $queryDel = "UPDATE `brand_tbl` SET `brand_status`='Inactive' WHERE brand_id = $id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "Brand details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "Brand details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting Brand details!";
                    $response['message'] = "Error: " . mysqli_error($conn);
                }

                echo json_encode($response);
                exit();
            }



           





            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();
