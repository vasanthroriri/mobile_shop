<?php
include("../db/dbConnection.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addRack') {
    $rackNo = $_POST['rackNo'];
    $rackName = $_POST['rackName']; 

    // Check if the university name already exists
    $check_sql = "SELECT COUNT(*) as count FROM `rack_tbl` WHERE (`rack_no` = ? OR `rack_name` = ?) AND `status` = 'Active'";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $rackNo, $rackName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $exists = $row['count'] > 0;

    if ($exists) {
        $response['success'] = false;
        $response['message'] = "Rack number or name already exists!";
    } else {
        $rack_sql = "INSERT INTO `rack_tbl`
            (`rack_no`,
             `rack_name`) 
            VALUES 
            (?,?)";

        $stmt = $conn->prepare($rack_sql);
        $stmt->bind_param("ss", $rackNo, $rackName);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Rack added successfully!";
        } else {
            $response['message'] = "Error adding Rack: " . $stmt->error;
        }
    }

    echo json_encode($response);
    exit();
}

if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editRackId') {
    $rackId = $_POST['editId'];
    $rackNo = $_POST['rackNoEdit'];
    $rackName = $_POST['rackNameEdit']; 

    // Modify SQL query to exclude the current rackId from the check
    $check_sql = "SELECT COUNT(*) as count 
                  FROM `rack_tbl` 
                  WHERE (`rack_no` = ? OR `rack_name` = ?) 
                  AND `status` = 'Active' 
                  AND `rack_id` != ?"; // Exclude the current rackId

    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ssi", $rackNo, $rackName, $rackId); // Bind rackId as the third parameter to exclude it
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $exists = $row['count'] > 0;

    if ($exists) {
        $response['success'] = false;
        $response['message'] = "Rack number or name already exists!";
    } else {
        // Update the rack with the new rackNo and rackName
        $rack_sql = "UPDATE `rack_tbl`
                     SET `rack_no` = ?, `rack_name` = ?
                     WHERE `rack_id` = ?"; // Update based on the rack_id

        $stmt = $conn->prepare($rack_sql);
        $stmt->bind_param("ssi", $rackNo, $rackName, $rackId); // Bind rackId as the third parameter for updating the record

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Rack updated successfully!";
        } else {
            $response['message'] = "Error updating Rack: " . $stmt->error;
        }
    }

    echo json_encode($response);
    exit();
}

if (isset($_POST['deleteId'])) {
    $id  = $_POST['deleteId'];

    $queryDel = "UPDATE `rack_tbl` SET `status`='Inactive' WHERE rack_id = $id;";
    $reDel = mysqli_query($conn, $queryDel);

    if ($reDel) {
                    
        $_SESSION['message'] = "Rack details have been deleted successfully!";
        $response['success'] = true;
        $response['message'] = "Rack details have been deleted successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in deleting Rack details!";
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}
?>