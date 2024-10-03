<?php
include("../class.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];






    //---get course --------------------------

    // Handle fetching university details for editing
if (isset($_POST['universitySub']) && $_POST['universitySub'] != '') {
    
    $universitySub = $_POST['universitySub'];
    $centerId = $_SESSION['centerId'];

    $universitySubQuery = "SELECT `cou_id`, `cou_name` FROM `jeno_course` WHERE cou_uni_id = $universitySub AND cou_center_id = $centerId AND cou_status = 'Active';";
    $universitySubResult = mysqli_query($conn, $universitySubQuery);

    if ($universitySubResult) {
        while ($subRow = mysqli_fetch_assoc($universitySubResult)) {
            // Push each course as an object into the courses array
            $courseSub = array(
                'cou_id' => $subRow['cou_id'],
                'cou_name' => $subRow['cou_name']
            );
            $coursesSub[] = $courseSub;
        }

        echo json_encode($coursesSub);
    } else {
        $response['message'] = "Error fetching Course Name details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }

    //-----get elective pepar -------------------------------
// Handle fetching university details for editing
if (isset($_POST['electiveSub']) && $_POST['electiveSub'] != '') {
    $electiveSub = $_POST['electiveSub'];
    $centerId = $_SESSION['centerId'];

    // Query to fetch course details
    $courseQuery = "SELECT `cou_id`, `cou_name`, `cou_exam_type`, `cou_duration` FROM `jeno_course` WHERE cou_id = $electiveSub AND cou_center_id = $centerId ;";
    $courseResult = mysqli_query($conn, $courseQuery);

    // Query to fetch elective details
    $electiveQuery = "SELECT `ele_id`, `ele_elective`, `ele_lag_elec` FROM `jeno_elective` WHERE ele_center_id = $centerId  AND ele_cou_id = $electiveSub  AND ele_status = 'Active';";
    $electiveResult = mysqli_query($conn, $electiveQuery);

    // Initialize response array
    $response = array(
        'course' => null,
        'electives' => array()
    );

    // Fetch course details
    if ($courseResult && mysqli_num_rows($courseResult) > 0) {
        $response['course'] = mysqli_fetch_assoc($courseResult);
    } else {
        $response['message'] = "Error fetching course details: " . mysqli_error($conn);
        echo json_encode($response);
        exit();
    }

    // Fetch elective details
    if ($electiveResult) {
        while ($elecRow = mysqli_fetch_assoc($electiveResult)) {
            $electSub = array(
                'ele_id' => $elecRow['ele_id'],
                'ele_elective' => $elecRow['ele_elective'],
                'ele_lag_elec' => $elecRow['ele_lag_elec']
            );
            $response['electives'][] = $electSub;
        }
    } else {
        $response['message'] = "Error fetching elective details: " . mysqli_error($conn);
        echo json_encode($response);
        exit();
    }

    // Send response as JSON
    echo json_encode($response);
    exit(); 
}




// Handle adding a university
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addSubject') {
    $university = $_POST['university'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $subType = $_POST['subType'];
    
    $newInputSubjectCode = $_POST['newInputSubjectCode'];
    $newInputSubjectName = $_POST['newInputSubjectName'];

    $uniCenterId = $_SESSION['centerId'];
    $createdBy = $_SESSION['userId'];

    $subjectCode =json_encode($newInputSubjectCode);
    $subjectName =json_encode($newInputSubjectName);
     // Other fields
     $uniCenterId = $_SESSION['centerId'];
     $createdBy = $_SESSION['userId'];

        if($subType === "Elective"){
            $elective = $_POST['elective'];
            $newInputElectiveSubjectCode = $_POST['newInputElectiveSubjectCode'];
            $newInputElectiveSubjectName = $_POST['newInputElectiveSubjectName'];

            $ElectiveSubjectCode =json_encode($newInputElectiveSubjectCode);
            $ElectiveSubjectName =json_encode($newInputElectiveSubjectName);

            $university_sql = "INSERT INTO `jeno_subject`
            ( `sub_uni_id`
            , `sub_cou_id`
            , `sub_ele_id`
            , `sub_exam_patten`
            , `sub_subject_code`
            , `sub_subject_name`
            , `sub_addition_sub_code`
            , `sub_addition_sub_name`
            , `sub_type`
            , `sub_center_id`    
            , `sub_created_by`) VALUES 
        
            ('$university'
            ,'$course'
            ,'$elective'
            ,'$year'
            ,'$subjectCode'
            ,'$subjectName'
            ,'$ElectiveSubjectCode'
            ,'$ElectiveSubjectName'
            ,'$subType'
            ,'$uniCenterId'
            ,'$createdBy')";
        

        } if($subType === "language"){
    $newInputLanguageSubjectCode = $_POST['newInputLanguageSubjectCode'];
    $newInputLanguageSubjectName = $_POST['newInputLanguageSubjectName'];
    $newInputLanguageSubjectType = $_POST['newInputLanguageSubjectType'];

    $LanguageSubjectCode =json_encode($newInputLanguageSubjectCode);
    $LanguageSubjectName =json_encode($newInputLanguageSubjectName);
    $LanguageSubjectType =json_encode($newInputLanguageSubjectType);
    

    $university_sql = "INSERT INTO `jeno_subject`
    ( `sub_uni_id`
    , `sub_cou_id`
    , `sub_exam_patten`
    , `sub_subject_code`
    , `sub_subject_name`
    , `sub_addition_lag_name`
    , `sub_addition_sub_code`
    , `sub_addition_sub_name`
    , `sub_type`
    , `sub_center_id`    
    , `sub_created_by`) VALUES 

    ('$university'
    ,'$course'
    ,'$year'
    ,'$subjectCode'
    ,'$subjectName'
    ,'$LanguageSubjectCode'
    ,'$LanguageSubjectName'
    ,'$LanguageSubjectType'
    ,'$subType'
    ,'$uniCenterId'
    ,'$createdBy')";
            
            }
        



    if ($conn->query($university_sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Subject added successfully!";
    } else {
        $response['message'] = "Error adding Subject: " . $conn->error;
    }

    echo json_encode($response);
    exit();
}


// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    $editId = $_POST['editId'];

    $selQuery = "SELECT 
    `sub_id`
    , `sub_uni_id`
    , `sub_cou_id`
    , `sub_ele_id`
    , `sub_exam_patten`
    , `sub_subject_code`
    , `sub_subject_name`
    , `sub_addition_lag_name`
    , `sub_addition_sub_code`
    , `sub_addition_sub_name`
    , `sub_type`
     FROM `jeno_subject`
      WHERE sub_id = $editId";
    $result = mysqli_query($conn, $selQuery);
    

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $courseName = courseName($row['sub_uni_id']);
        $electiveName = electiveName($row['sub_cou_id']);


        if(!empty($row['sub_addition_lag_name'])){
            $courseDetails = [
                'sub_id' => $row['sub_id'],
                'sub_uni_id' => $row['sub_uni_id'],
                'enq_courses' => $courseName,
                'elective_course' => $electiveName,
                'sub_cou_id' => $row['sub_cou_id'],
                'sub_ele_id' => $row['sub_ele_id'],
                'sub_exam_patten' => $row['sub_exam_patten'],
                'sub_subject_code' => json_decode($row['sub_subject_code']),
                'sub_subject_name' => json_decode($row['sub_subject_name']),
                'sub_addition_lag_name' => json_decode($row['sub_addition_lag_name']),
                'sub_addition_sub_code' => json_decode($row['sub_addition_sub_code']),
                'sub_addition_sub_name' => json_decode($row['sub_addition_sub_name']),
                'sub_type' => $row['sub_type'],
            ];
        } else {
            $courseDetails = [
                'sub_id' => $row['sub_id'],
                'sub_uni_id' => $row['sub_uni_id'],
                'enq_courses' => $courseName,
                'elective_course' => $electiveName,
                'sub_cou_id' => $row['sub_cou_id'],
                'sub_ele_id' => $row['sub_ele_id'],
                'sub_exam_patten' => $row['sub_exam_patten'],
                'sub_subject_code' => json_decode($row['sub_subject_code']),
                'sub_subject_name' => json_decode($row['sub_subject_name']),
                'sub_addition_sub_code' => json_decode($row['sub_addition_sub_code']),
                'sub_addition_sub_name' => json_decode($row['sub_addition_sub_name']),
                'sub_type' => $row['sub_type'],
            ];
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 'JSON decode error: ' . json_last_error_msg();
        } else {
            echo json_encode($courseDetails);
        }

    } else {
        $response['message'] = "Error fetching Sunbject details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit();
}


    // Handle updating student details
        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editSubject') {
            $editSubId = $_POST['editSubId'];
            $editUniversity = $_POST['editUniversity'];
            $editCourse = $_POST['editCourse'];
            $editYear = $_POST['editYear'];
            $editSubType = $_POST['editSubType'];
            
            $editSubjectCode = $_POST['editSubjectCode'];
            $editSubjectName = $_POST['editSubjectName'];
        
           
        
            $subjectCode =json_encode($editSubjectCode);
            $subjectName =json_encode($editSubjectName);
             // Other fields
            //  $uniCenterId = $_SESSION['centerId'];
             $updatedBy = $_SESSION['userId'];
        
                if($editSubType === "Elective"){
                    $editElective = $_POST['editElective'];
                    $editAdditionSubCode = $_POST['editAdditionSubCode'];
                    $editAdditionSubName = $_POST['editAdditionSubName'];
        
                    $ElectiveSubjectCode =json_encode($editAdditionSubCode);
                    $ElectiveSubjectName =json_encode($editAdditionSubName);
        
                    $university_sql = "UPDATE `jeno_subject` 
                    SET `sub_uni_id`='$editUniversity'
                    ,`sub_cou_id`='$editCourse'
                    ,`sub_ele_id`='$editElective'
                    ,`sub_exam_patten`='$editYear'
                    ,`sub_subject_code`='$subjectCode'
                    ,`sub_subject_name`='$subjectName'
                    ,`sub_addition_sub_code`='$ElectiveSubjectCode'
                    ,`sub_addition_sub_name`='$ElectiveSubjectName'
                    ,`sub_type`='$editSubType'
                    ,`sub_updated_by`='$updatedBy' 
                    WHERE sub_id =$editSubId";
                
        
                } if($editSubType === "Language"){
            $editAdditionLanguageName = $_POST['editAdditionLanguageName'];
            $editAdditionSubCode = $_POST['editAdditionSubCode'];
            $editAdditionSubName = $_POST['editAdditionSubName'];
        
            $LanguageSubjectCode =json_encode($editAdditionLanguageName);
            $LanguageSubjectName =json_encode($editAdditionSubCode);
            $LanguageSubjectType =json_encode($editAdditionSubName);
            
        
            $university_sql = "UPDATE `jeno_subject` 
            SET `sub_uni_id`='$editUniversity'
            ,`sub_cou_id`='$editCourse'
            ,`sub_exam_patten`='$editYear'
            ,`sub_subject_code`='$subjectCode'
            ,`sub_subject_name`='$subjectName'
            ,`sub_addition_lag_name`='$LanguageSubjectCode'
            ,`sub_addition_sub_code`='$LanguageSubjectName'
            ,`sub_addition_sub_name`='$LanguageSubjectType'
            ,`sub_type`='$editSubType'
            ,`sub_updated_by`='$updatedBy' 
            WHERE sub_id =$editSubId";
                    
                    }
            
            $universityres = mysqli_query($conn, $university_sql);

                if ($universityres) {
                    $_SESSION['message'] = "Subject details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "Subject details Updated successfully!";
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

                $queryDel = "UPDATE `jeno_subject` SET `sub_updated_by`='$updatedBy',`sub_status`='Inactive' WHERE sub_id = $id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "Subject details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "Subject details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting Subject details!";
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
                a.sub_uni_id
                , a.sub_cou_id
                , a.sub_ele_id
                , a.sub_exam_patten
                , a.sub_subject_code
                , a.sub_subject_name
                , a.sub_addition_lag_name
                , a.sub_addition_sub_code
                , a.sub_addition_sub_name
                , a.sub_type 
                ,b.ele_elective 
                FROM `jeno_subject` AS a 
                LEFT JOIN jeno_elective AS b
                 ON a.sub_ele_id = b.ele_id 
                 WHERE a.sub_id = $uniId;";
             
                
                $result1 = $conn->query($selQuery);

                if($result1) {
                    $row = mysqli_fetch_assoc($result1);

                    if(!empty($row['sub_addition_lag_name'])){

                   
                     
             // Prepare university details array
        $enquiryDetails = [
            'sub_uni_id' => universityName($row['sub_uni_id']),
            'sub_cou_id' => courseNameOnly($row['sub_cou_id']),
            'ele_elective' => $row['ele_elective'],
            'sub_exam_patten' => $row['sub_exam_patten'],
            'sub_subject_code' => json_decode($row['sub_subject_code']),
            'sub_subject_name' => json_decode($row['sub_subject_name']),
            'sub_addition_lag_name' => json_decode($row['sub_addition_lag_name']),
            'sub_addition_sub_code' => json_decode($row['sub_addition_sub_code']),
            'sub_addition_sub_name' => json_decode($row['sub_addition_sub_name']),
            'sub_type' => $row['sub_type'],
            
        ];

        

    }else {
              // Prepare university details array
              $enquiryDetails = [
                'sub_uni_id' => universityName($row['sub_uni_id']),
                'sub_cou_id' => courseNameOnly($row['sub_cou_id']),
                'ele_elective' => $row['ele_elective'],
                'sub_exam_patten' => $row['sub_exam_patten'],
                'sub_subject_code' => json_decode($row['sub_subject_code']),
                'sub_subject_name' => json_decode($row['sub_subject_name']),
                'sub_addition_sub_code' => json_decode($row['sub_addition_sub_code']),
                'sub_addition_sub_name' => json_decode($row['sub_addition_sub_name']),
                'sub_type' => $row['sub_type'],
                
            ];


    }

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

