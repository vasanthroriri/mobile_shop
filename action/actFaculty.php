<?php
include "../db/dbConnection.php";
session_start();

$userId = $_SESSION['userId'];

if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addFacultyId' && $_POST['staffName'] != '') {

    $targetDir = "../assets/images/faculty/";

    if (!empty($_FILES["aadhar"]["name"])) {
        $fileName = $_FILES["aadhar"]["name"];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check if the file extension is allowed
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
        }

        // Get current date and time
        $currentDateTime = date("Ymd_His");
        $newFileName = $currentDateTime . '.' . $fileExtension;
        $targetFilePath = $targetDir . $newFileName;

        // Upload file to server
        if (move_uploaded_file($_FILES["aadhar"]["tmp_name"], $targetFilePath)) {
            // File uploaded successfully
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $name = $_POST['staffName'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $dateofjoin = $_POST['dateofjoin'];
    $salary = $_POST['salary'];
    $qualification = $_POST['qualification'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $aadhar = $newFileName;
    $clgName = $_POST['clgName'];
    $course = $_POST['course'];
    $centerId = $_SESSION['centerId'];

        
            $faculty_insert = "INSERT INTO jeno_faculty 
            (fac_name
            , fac_gender
            , fac_mobile
            , fac_email
            , fac_address
            , fac_date_of_join
            , fac_salary
            , fac_qualification
            , fac_clg, fac_aadhar
            , fac_cou_id
            , fac_center_id
            , fac_created_by) 
            VALUES 
            ('$name'
            , '$gender'
            , '$mobile'
            , '$email'
            , '$address'
            , '$dateofjoin'
            , '$salary'
            , '$qualification'
            , '$clgName'
            , '$aadhar'
            , '$course'
            , '$centerId'
            , '$userId')";
            
            if ($conn->query($faculty_insert) === TRUE) {
                $_SESSION['message'] = "Faculty details added successfully!";
                $response['success'] = true;
                $response['message'] = "Faculty details added successfully!";
            } else {
                $response['message'] = "Error: " . $faculty_insert . "<br>" . $conn->error;
            }

    echo json_encode($response);
    exit();
}


if (isset($_POST['editId']) && $_POST['editId'] != '') {
    $editId = $_POST['editId'];

    $selQuery = "SELECT * FROM `jeno_faculty` WHERE fac_id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        $facultyDetails = array(
            'facId' => $row['fac_id'],
            'name' => $row['fac_name'],
            'gender' => $row['fac_gender'],
            'mobile' => $row['fac_mobile'],
            'email' => $row['fac_email'],
            'address' => $row['fac_address'],
            'date_of_join' => $row['fac_date_of_join'],
            'salary' => $row['fac_salary'],
            'qualification' => $row['fac_qualification'],
            'clg' => $row['fac_clg'],
            'cou_id' => $row['fac_cou_id'],
        );

        echo json_encode($facultyDetails);
    } else {
        $response['message'] = "Error executing query: " . mysqli_error($conn);
        echo json_encode($response);
    }
    exit();
}


// Handle updating faculty details
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editFaculty' && $_POST['hdnFacultyId'] != '') {

    $targetDir = "../assets/images/faculty/";
    $newFileName = '';

    if (!empty($_FILES["aadharEdit"]["name"])) {
        $fileName = $_FILES["aadharEdit"]["name"];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check if the file extension is allowed
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
            exit();
        }

        // Get current date and time
        $currentDateTime = date("Ymd_His");
        $newFileName = $currentDateTime . '.' . $fileExtension;
        $targetFilePath = $targetDir . $newFileName;

        // Upload file to server
        if (!move_uploaded_file($_FILES["aadharEdit"]["tmp_name"], $targetFilePath)) {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }

    $facId = $_POST['hdnFacultyId'];
    $name = $_POST['staffNameEdit'];
    $gender = $_POST['genderEdit'];
    $mobile = $_POST['mobileEdit'];
    $dateofjoin = $_POST['dateofjoinEdit'];
    $salary = $_POST['salaryEdit'];
    $qualification = $_POST['qualificationEdit'];
    $email = $_POST['emailEdit'];
    $address = $_POST['addressEdit'];
    $clgName = $_POST['clgNameEdit'];
    $course = $_POST['courseEdit'];

    // Base query
    $updateQuery = "UPDATE jeno_faculty 
    SET 
        fac_name = '$name',
        fac_gender = '$gender',
        fac_mobile = '$mobile',
        fac_date_of_join = '$dateofjoin',
        fac_salary = '$salary',
        fac_qualification = '$qualification',
        fac_email = '$email',
        fac_address = '$address',
        fac_clg = '$clgName',
        fac_cou_id = '$course',
        fac_updated_by = '$userId'";

    if (!empty($newFileName)) {
        $updateQuery .= ", fac_aadhar = '$newFileName'";
    }

    $updateQuery .= " WHERE fac_id = $facId";

    if ($conn->query($updateQuery) === TRUE) {
        $_SESSION['message'] = "Faculty details updated successfully!";
        $response['success'] = true;
        $response['message'] = "Faculty details updated successfully!";
    } else {
        $response['message'] = "Error: " . $updateQuery . "<br>" . $conn->error;
    }
    
    echo json_encode($response);
    exit();
}



if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $queryDel = "UPDATE `jeno_faculty` 
                 SET fac_status = 'Inactive'
                 WHERE `fac_id` = $id;";
    $reDel = mysqli_query($conn, $queryDel);

    if ($reDel) {
        $_SESSION['message'] = "Faculty details have been deleted successfully!";
        $response['success'] = true;
        $response['message'] = "Faculty details have been deleted successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in deleting Faculty details!";
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}

if(isset($_POST['id']) && $_POST['id'] != '') {
    $facultyId = $_POST['id'];

    // Prepare and execute the SQL query
    $selQuery1 = "SELECT a.*, b.* FROM `jeno_faculty` AS a LEFT JOIN `jeno_course` AS b ON a.fac_cou_id = b.cou_id WHERE a.fac_id = $facultyId";
    
    $result1 = $conn->query($selQuery1);

    if($result1) {
        $row = mysqli_fetch_assoc($result1);

    // Prepare university details array
    $facultyDetails1 = [
           
            'facIdView' => $row['fac_id'],
            'nameView' => $row['fac_name'],
            'genderView' => $row['fac_gender'],
            'mobileView' => $row['fac_mobile'],
            'emailView' => $row['fac_email'],
            'addressView' => $row['fac_address'],
            'date_of_joinView' => $row['fac_date_of_join'],
            'salaryView' => $row['fac_salary'],
            'qualificationView' => $row['fac_qualification'],
            'aadharView' => $row['fac_aadhar'],
            'clgView' => $row['fac_clg'],
            'cou_nameView' => $row['cou_name'],
    ];

    echo json_encode($facultyDetails1);
    exit();
          
    } else {
        echo "Error executing query: " . $conn->error;
    }
}
