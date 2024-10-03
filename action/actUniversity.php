<?php
include("../db/dbConnection.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addUniversity') {
    $universityName = $_POST['universityName'];
    $studyCode = $_POST['studyCode'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];
    // Other fields
    $uniCenterId = $_SESSION['centerId'];
    $createdBy = $_SESSION['userId'];

    // JSON encode arrays
    $dep = json_encode($department);
    $con = json_encode($contact);

    // Check if the university name already exists
    $check_sql = "SELECT COUNT(*) as count FROM `jeno_university` WHERE `uni_name` = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $universityName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $exists = $row['count'] > 0;

    if ($exists) {
        $response['success'] = false;
        $response['message'] = "University name already exists!";
    } else {
        // Insert the new university if it doesn't exist
        $university_sql = "INSERT INTO `jeno_university`
            (`uni_study_code`, `uni_name`, `uni_department`, `uni_contact`, `uni_center_id`, `uni_created_by`) 
            VALUES 
            (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($university_sql);
        $stmt->bind_param("ssssii", $studyCode, $universityName, $dep, $con, $uniCenterId, $createdBy);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "University added successfully!";
        } else {
            $response['message'] = "Error adding university: " . $stmt->error;
        }
    }

    echo json_encode($response);
    exit();
}


// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    
    $editId = $_POST['editId'];

    $selQuery = "SELECT `uni_id`, `uni_study_code`, `uni_name`, `uni_department`, `uni_contact` FROM `jeno_university` WHERE uni_id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Prepare university details array
        $universityDetails = [
            'uni_id' => $row['uni_id'],
            'uni_study_code' => $row['uni_study_code'],
            'uni_name' => $row['uni_name'],
            'uni_department' => json_decode($row['uni_department']), // Decode JSON string to array
            'uni_contact' => json_decode($row['uni_contact']) // Decode JSON string to array
        ];

        echo json_encode($universityDetails);
    } else {
        $response['message'] = "Error fetching university details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }


    // Handle updating student details
        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editUniversity') {
            $editid = $_POST['editid'];
            $editUniversityName = $_POST['editUniversityName'];
            $editStudyCode = $_POST['editStudyCode'];
            $editdepartment = $_POST['editdepartment'];
            $editcontact = $_POST['editcontact'];
            // Other fields
            
            $updatedBy = $_SESSION['userId'];
            $uniCenterId = $_SESSION['centerId'];
            // JSON encode arrays
            $editdep = json_encode($editdepartment);
            $editcon = json_encode($editcontact);
            
            
            $editUniversity ="UPDATE `jeno_university`
             SET 
             `uni_study_code`='$editStudyCode'
             ,`uni_name`='$editUniversityName'
             ,`uni_department`='$editdep'
             ,`uni_contact`='$editcon'
             ,`uni_center_id`='$uniCenterId'
             ,`uni_updated_by`='$updatedBy' 
             WHERE uni_id = $editid";
            
            $universityres = mysqli_query($conn, $editUniversity);

                if ($universityres) {
                    $_SESSION['message'] = "University details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "University details Updated successfully!";
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

                $queryDel = "UPDATE `jeno_university` SET `uni_updated_by`='$updatedBy',`uni_status`='Inactive' WHERE uni_id = $id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "University details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "University details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting University details!";
                    $response['message'] = "Error: " . mysqli_error($conn);
                }

                echo json_encode($response);
                exit();
            }



            // Check if employee id is provided
            if(isset($_POST['id']) && $_POST['id'] != '') {
                $uniId = $_POST['id'];

                // Prepare and execute the SQL query
                $selQuery = "SELECT `uni_id`, `uni_study_code`, `uni_name`, `uni_department`, `uni_contact` FROM `jeno_university` WHERE uni_id = $uniId;";
                
                $result1 = $conn->query($selQuery);

                if($result1) {
                    $row = mysqli_fetch_assoc($result1);

             // Prepare university details array
        $universityDetails = [
            'uni_id' => $row['uni_id'],
            'uni_study_code' => $row['uni_study_code'],
            'uni_name' => $row['uni_name'],
            'uni_department' => json_decode($row['uni_department']), // Decode JSON string to array
            'uni_contact' => json_decode($row['uni_contact']) // Decode JSON string to array
        ];

          echo json_encode($universityDetails);
          exit();
                      
                } else {
                    echo "Error executing query: " . $conn->error;
                }
            }





            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();
