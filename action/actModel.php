<?php
include("../db/dbConnection.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addModel') {
   

    $brand = trim($_POST['brand']);
    $modelName = trim($_POST['modelName']);
    

    // **Check if model already exists**
    $check_sql = "SELECT COUNT(*) as count FROM `model_tbl` WHERE `mod_brand_id` = '$brand' AND `mod_name` = '$modelName'";
    $result = $conn->query($check_sql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        $response['message'] = "Model name already exists!";
    } else {
        // **Insert new model**
        $insert_sql = "INSERT INTO `model_tbl` (`mod_brand_id`, `mod_name`) VALUES ('$brand', '$modelName')";
        
        if ($conn->query($insert_sql) === TRUE) {
            $response['success'] = true;
            $response['message'] = "Model added successfully!";
        } else {
            $response['message'] = "Error adding Model: " . $conn->error;
        }
    }

    echo json_encode($response);
    exit();
}



// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    
    $editId = $_POST['editId'];

    $selQuery = "SELECT `mod_id`, `mod_brand_id`, `mod_name` FROM `model_tbl` WHERE mod_id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Prepare university details array
        $electiveDetails = [
            'mod_id' => $row['mod_id'],
            'mod_brand_id' => $row['mod_brand_id'],
            'Mod_name' => $row['mod_name']
            
        ];

        echo json_encode($electiveDetails);
    } else {
        $response['message'] = "Error fetching Model details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }


    // Handle updating student details
    if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editModel') {
       
    
        $model_id = trim($_POST['model_id']);
        $brandEdit = trim($_POST['brandEdit']);
        $modelNameEdit = trim($_POST['modelNameEdit']);
        
     
    
        // **Check if another record exists with the same brand & model name (excluding current model_id)**
        $check_sql = "SELECT COUNT(*) as count FROM `model_tbl` 
                      WHERE `mod_brand_id` = '$brandEdit' AND `mod_name` = '$modelNameEdit' AND `mod_id` != '$model_id'";
        
        $result = $conn->query($check_sql);
        $row = $result->fetch_assoc();
    
        if ($row['count'] > 0) {
            $response['message'] = "Model name already exists!";
        } else {
            // **Update model if no duplicate exists**
            $editModel = "UPDATE `model_tbl` 
                          SET `mod_brand_id` = '$brandEdit', `mod_name` = '$modelNameEdit' 
                          WHERE `mod_id` = '$model_id'";
    
            if ($conn->query($editModel) === TRUE) {
                $_SESSION['message'] = "Model details updated successfully!";
                $response['success'] = true;
                $response['message'] = "Model details updated successfully!";
            } else {
                $response['message'] = "Error: " . $conn->error;
            }
        }
    
        echo json_encode($response);
        exit();
    }

        // // Handle deleting a client
            if (isset($_POST['deleteId'])) {
                $id = $_POST['deleteId'];
                

                $queryDel = "UPDATE `model_tbl` SET `mod_status`='Inactive' WHERE mod_id= $id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "Model details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "Model details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting Model details!";
                    $response['message'] = "Error: " . mysqli_error($conn);
                }

                echo json_encode($response);
                exit();
            }




            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();

