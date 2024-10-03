<?php
include("../class.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];




    //---get course --------------------------

    // Handle fetching university details for editing
if (isset($_POST['universityID']) && $_POST['universityID'] != '') {
    
    $universityId = $_POST['universityID'];
    $centerId = $_SESSION['centerId'];
    

    $courseQuery = "SELECT `cou_id`, `cou_name` FROM `jeno_course` WHERE cou_uni_id = $universityId AND cou_center_id =$centerId ;";
    $courseResult = mysqli_query($conn, $courseQuery);

    if ($courseResult) {
        while ($row = mysqli_fetch_assoc($courseResult)) {
            // Push each course as an object into the courses array
            $course = array(
                'cou_id' => $row['cou_id'],
                'cou_name' => $row['cou_name']
            );
            $courses[] = $course;
        }

        echo json_encode($courses);
    } else {
        $response['message'] = "Error fetching Course Name details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }



// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addEnquiry') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $university = $_POST['university'];
    $course = $_POST['course'];
    $medium = $_POST['medium'];
    // Other fields
    $uniCenterId = $_SESSION['centerId'];
    $createdBy = $_SESSION['userId'];
    $date =date("Y/m/d");

    

    $university_sql = "INSERT INTO `jeno_enquiry`
    ( `enq_uni_id`
    , `enq_cou_id`
    , `enq_stu_name`
    , `enq_email`
    , `enq_dob`
    , `enq_gender`
    , `enq_mobile`
    , `enq_address`
    , `enq_medium`
    , `enq_date`
    , `enq_center_id`
    , `enq_created_by`) 
    VALUES 
    ('$university'
    ,'$course'
    ,'$name'
    ,'$email'
    ,'$dob'
    ,'$gender'
    ,'$mobile'
    ,'$address'
    ,'$medium'
    ,'$date'
    ,'$uniCenterId'
    ,'$createdBy')";

    if ($conn->query($university_sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Enquiry added successfully!";
    } else {
        $response['message'] = "Error adding Enquiry: " . $conn->error;
    }

    echo json_encode($response);
    exit();
}


// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    $editId = $_POST['editId'];
    $centerId = $_SESSION['centerId'];

    $selQuery = "SELECT `enq_id`, `enq_uni_id`, `enq_cou_id`, `enq_stu_name`, `enq_email`, 
        `enq_dob`, `enq_gender`, `enq_mobile`, `enq_address`, `enq_medium` 
        FROM `jeno_enquiry` WHERE enq_id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $courseName = courseName($row['enq_uni_id'] ,$centerId);

        $courseDetails = [
            'enq_id' => $row['enq_id'],
            'enq_uni_id' => $row['enq_uni_id'],
            'enq_courses' => $courseName,
            'enq_cou_id' => $row['enq_cou_id'], // Course ID for pre-selecting the course in the dropdown
            'enq_stu_name' => $row['enq_stu_name'],
            'enq_email' => $row['enq_email'],
            'enq_dob' => $row['enq_dob'],
            'enq_gender' => $row['enq_gender'],
            'enq_mobile' => $row['enq_mobile'],
            'enq_address' => $row['enq_address'],
            'enq_medium' => $row['enq_medium']
        ];

        echo json_encode($courseDetails);
    } else {
        $response['message'] = "Error fetching Enquiry details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit();
}


    // Handle updating student details
        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editEnquiry') {
            $editEnquiryId = $_POST['editEnquiryId'];
            $editName = $_POST['editName'];
            $editGender = $_POST['editGender'];
            $editDob = $_POST['editDob'];
            $editMobile = $_POST['editMobile'];
            $editEmail = $_POST['editEmail'];
            $editAddress = $_POST['editAddress'];
            $editUniversity = $_POST['editUniversity'];
            $editCourse = $_POST['editCourse'];
            $editMedium = $_POST['editMedium'];
            // Other fields
            
            $updatedBy = $_SESSION['userId'];
    
 
            $editUniversity ="UPDATE `jeno_enquiry`
             SET 
             `enq_uni_id`='$editUniversity'
             ,`enq_cou_id`='$editCourse'
             ,`enq_stu_name`='$editName'
             ,`enq_email`='$editEmail'
             ,`enq_dob`='$editDob'
             ,`enq_gender`='$editGender'
             ,`enq_mobile`='$editMobile'
             ,`enq_address`='$editAddress'
             ,`enq_medium`='$editMedium'
             ,`enq_updated_by`='$updatedBy'
              WHERE enq_id = $editEnquiryId";
            
            $universityres = mysqli_query($conn, $editUniversity);

                if ($universityres) {
                    $_SESSION['message'] = "Enquiry details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "Enquiry details Updated successfully!";
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

                $queryDel = "UPDATE `jeno_enquiry` SET `enq_updated_by`='$updatedBy',`enq_status`='Inactive' WHERE enq_id = $id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "Enquiry details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "Enquiry details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting Enquiry details!";
                    $response['message'] = "Error: " . mysqli_error($conn);
                }

                echo json_encode($response);
                exit();
            }



            // Check if employee id is provided
            if(isset($_POST['id']) && $_POST['id'] != '') {
                $uniId = $_POST['id'];

                // Prepare and execute the SQL query
                $selQuery = "SELECT  
                `enq_uni_id`
                , `enq_cou_id`
                , `enq_stu_name`
                , `enq_email`
                , `enq_dob`
                , `enq_gender`
                , `enq_mobile`
                , `enq_address`
                , `enq_medium`
                , `enq_adminsion_status`
                 FROM `jeno_enquiry`
                  WHERE enq_id = $uniId;";
                
                $result1 = $conn->query($selQuery);

                if($result1) {
                    $row = mysqli_fetch_assoc($result1);

             // Prepare university details array
        $enquiryDetails = [
            'enq_uni_id' => universityName($row['enq_uni_id']),
            'enq_cou_id' => courseNameOnly($row['enq_cou_id']),
            'enq_stu_name' => $row['enq_stu_name'],
            'enq_email' => $row['enq_email'],
            'enq_dob' => $row['enq_dob'],
            'enq_gender' => $row['enq_gender'],
            'enq_mobile' => $row['enq_mobile'],
            'enq_address' => $row['enq_address'],
            'enq_medium' => $row['enq_medium'],
            'enq_adminsion_status' => $row['enq_adminsion_status'],
            
        ];

          echo json_encode($enquiryDetails);
          exit();
                      
                } else {
                    echo "Error executing query: " . $conn->error;
                }
            }





            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();

