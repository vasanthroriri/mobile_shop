<?php
include("../db/dbConnection.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addModel') {
    $brand = $_POST['brand'];
    $modelName = $_POST['modelName'];

    $elective_sql = "INSERT INTO `modale_tbl`
    (`mod_brand_id`
    ,`Mod_name`)
     VALUES 
     ('$brand'
     ,'$modelName')";

    if ($conn->query($elective_sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Model added successfully!";
    } else {
        $response['message'] = "Error adding Model: " . $conn->error;
    }

    echo json_encode($response);
    exit();
}



// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    
    $editId = $_POST['editId'];

    $selQuery = "SELECT `mod_id`, `mod_brand_id`, `Mod_name` FROM `modale_tbl` WHERE mod_id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Prepare university details array
        $electiveDetails = [
            'mod_id' => $row['mod_id'],
            'mod_brand_id' => $row['mod_brand_id'],
            'Mod_name' => $row['Mod_name']
            
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
            $model_id = $_POST['model_id'];
            $brandEdit = $_POST['brandEdit'];
            $modelNameEdit = $_POST['modelNameEdit'];
            
           
            $editModel ="UPDATE `modale_tbl` 
            SET `mod_brand_id`='$brandEdit',`Mod_name`='$modelNameEdit' WHERE mod_id = $model_id";
            
            $model_result = mysqli_query($conn, $editModel);

                if ($model_result) {
                    $_SESSION['message'] = "Model details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "Model details Updated successfully!";
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
                

                $queryDel = "UPDATE `modale_tbl` SET `mod_status`='Inactive' WHERE mod_id= $id;";
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

