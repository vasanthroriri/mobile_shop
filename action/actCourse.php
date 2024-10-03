<?php
include "../class.php";


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addCourse') {
    $universityId = $_POST['university'];
    $courseName = $_POST['courseName'];
    $medium = $_POST['medium'];
    $examType = $_POST['examType'];
    $fessType = $_POST['fessType'];
    $duration = $_POST['duration'];


    $universityFees = $_POST['universityFees'];
    $studyCenterFees = $_POST['studyCenterFees'];
    $totalFees = $_POST['totalFees'];
    // Other fields
    $centerId = $_SESSION['centerId'];
    $createdBy = $_SESSION['userId'];

    // JSON encode arrays
    $uniFees = json_encode($universityFees);
    $stuFees = json_encode($studyCenterFees);
    $totFees = json_encode($totalFees);

    $course_sql = "INSERT INTO `jeno_course`
    (`cou_uni_id`
    , `cou_name`
    , `cou_medium`
    , `cou_exam_type`
    , `cou_fees_type`
    , `cou_duration`
    , `cou_university_fess`
    , `cou_study_fees`
    , `cou_total_fees`
    , `cou_center_id`
    , `cou_created_by`) 
    VALUES (
    '$universityId'
    ,'$courseName'
    ,'$medium'
    ,'$examType'
    ,'$fessType'
    ,'$duration'
    ,'$uniFees'
    ,'$stuFees'
    ,'$totFees'
    ,'$centerId'
    ,'$createdBy')";

    if ($conn->query($course_sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Course added successfully!";
    } else {
        $response['message'] = "Error adding Course: " . $conn->error;
    }

    echo json_encode($response);
    exit();
}

// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    
    $editId = $_POST['editId'];

    $selQuery = "SELECT `cou_id`
    , `cou_uni_id`
    , `cou_name`
    , `cou_medium`
    , `cou_exam_type`
    , `cou_fees_type`
    , `cou_duration`
    , `cou_university_fess`
    , `cou_study_fees`
    , `cou_total_fees` 
    FROM `jeno_course` WHERE cou_id = $editId";

    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Prepare university details array
        $courseDetails = [
            'cou_id' => $row['cou_id'],
            'cou_uni_id' => $row['cou_uni_id'],
            'cou_name' => $row['cou_name'],
            'cou_medium' => $row['cou_medium'],
            'cou_exam_type' => $row['cou_exam_type'],
            'cou_fees_type' => $row['cou_fees_type'],
            'cou_duration' => $row['cou_duration'],
            'cou_university_fess' => json_decode($row['cou_university_fess']), // Decode JSON string to array
            'cou_study_fees' => json_decode($row['cou_study_fees']), // Decode JSON string to array
            'cou_total_fees' => json_decode($row['cou_total_fees']), // Decode JSON string to array
        ];

        echo json_encode($courseDetails);
    } else {
        $response['message'] = "Error fetching Course details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }


    // Handle updating student details
        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editCourse') {
            $editCouseId = $_POST['editCouseId'];
            $editUniversity = $_POST['editUniversity'];
            $editCourseName = $_POST['editCourseName'];
            $editMedium = $_POST['editMedium'];
            $editExamType = $_POST['editExamType'];
            $editFessType = $_POST['editFessType'];
            $ediDuration = $_POST['ediDuration'];
            $editUniversityFees = $_POST['editUniversityFees'];
            $editStudyFees = $_POST['editStudyFees'];
            $editTotalFees = $_POST['editTotalFees'];

            // Other fields
            
            $updatedBy = $_SESSION['userId'];
        
            // JSON encode arrays
            $editUniversityFee = json_encode($editUniversityFees);
            $editStudyFee = json_encode($editStudyFees);
            $editTotalFee = json_encode($editTotalFees);
            
            
            $editUniversity ="UPDATE `jeno_course`
                SET 
                    `cou_uni_id` = '$editUniversity',
                    `cou_name` = '$editCourseName',
                    `cou_medium` = '$editMedium',
                    `cou_exam_type` = '$editExamType',
                    `cou_fees_type` = '$editFessType',
                    `cou_duration` = '$ediDuration',
                    `cou_university_fess` = '$editUniversityFee',
                    `cou_study_fees` = '$editStudyFee',
                    `cou_total_fees` = '$editTotalFee',
                    `cou_created_by` = '$updatedBy'
                WHERE 
                    `cou_id` = '$editCouseId';";
            
            $universityres = mysqli_query($conn, $editUniversity);

                if ($universityres) {
                    $_SESSION['message'] = "Course details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "Course details Updated successfully!";
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

                $queryDel = "UPDATE `jeno_course` SET `cou_updated_by`='$updatedBy',`cou_status`='Inactive' WHERE cou_id =$id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "Course details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "Course details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting Course details!";
                    $response['message'] = "Error: " . mysqli_error($conn);
                }

                echo json_encode($response);
                exit();
            }



            // Check if employee id is provided
            if(isset($_POST['id']) && $_POST['id'] != '') {
                $uniId = $_POST['id'];

                // Prepare and execute the SQL query
                $selQuery = "SELECT `cou_id`
                , `cou_uni_id`
                , `cou_name`
                , `cou_medium`
                , `cou_exam_type`
                , `cou_fees_type`
                , `cou_duration`
                , `cou_university_fess`
                , `cou_study_fees`
                , `cou_total_fees` 
                FROM `jeno_course` WHERE cou_id = $uniId";
                
                $result1 = $conn->query($selQuery);

                if($result1) {
                    $row = mysqli_fetch_assoc($result1);
                    
           // Prepare university details array
        $courseViewDetails = [
            'cou_id' => $row['cou_id'],
            'cou_uni_id' => universityName($row['cou_uni_id']),
            'cou_name' => $row['cou_name'],
            'cou_medium' => $row['cou_medium'],
            'cou_exam_type' => $row['cou_exam_type'],
            'cou_fees_type' => $row['cou_fees_type'],
            'cou_duration' => $row['cou_duration'],
            'cou_university_fess' => json_decode($row['cou_university_fess']), // Decode JSON string to array
            'cou_study_fees' => json_decode($row['cou_study_fees']), // Decode JSON string to array
            'cou_total_fees' => json_decode($row['cou_total_fees']), // Decode JSON string to array
        ];

          echo json_encode($courseViewDetails);
          exit();
                      
                } else {
                    echo "Error executing query: " . $conn->error;
                }
            }





            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();


    
    
