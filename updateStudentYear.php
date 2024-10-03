<?php
include("db/dbConnection.php");

session_start();
$createdBy = $_SESSION['userId'];
$centerId = $_SESSION['centerId'];

if (isset($_POST['studentId']) && isset($_POST['selectedYear'])) {
    $studentId = $_POST['studentId'];
    $selectedYear = $_POST['selectedYear'];

    // Retrieve course ID and application number based on student ID
    $studentQuery = "SELECT `stu_cou_id`, `stu_apply_no` FROM `jeno_student` WHERE `stu_id` = '$studentId'";
    $studentResult = $conn->query($studentQuery);

    if ($studentResult && $studentResult->num_rows > 0) {
        $studentRow = $studentResult->fetch_assoc();
        $courseName = $studentRow['stu_cou_id'];
        $applicationNo = $studentRow['stu_apply_no'];

        // Update student study year
        $updateStudentYear = "UPDATE `jeno_student` SET `stu_aca_year` = '$selectedYear' WHERE `stu_id` = '$studentId'";

        if ($conn->query($updateStudentYear) === TRUE) {
            // Retrieve course details including fees arrays
            $courseQuery = "SELECT `cou_university_fess`, `cou_study_fees` FROM `jeno_course` WHERE `cou_id` = '$courseName'";
            $courseResult = $conn->query($courseQuery);

            if ($courseResult && $courseResult->num_rows > 0) {
                $courseRow = $courseResult->fetch_assoc();
                $universityFeesArray = json_decode($courseRow['cou_university_fess'], true);
                $studyFeesArray = json_decode($courseRow['cou_study_fees'], true);

                // Determine the fees based on the academic year
                $academicYearIndex = intval($selectedYear) - 1;
                $universityFee = isset($universityFeesArray[$academicYearIndex]) ? $universityFeesArray[$academicYearIndex] : 0;
                $studyFee = isset($studyFeesArray[$academicYearIndex]) ? $studyFeesArray[$academicYearIndex] : 0;
            } else {
                $universityFee = 0;
                $studyFee = 0;
            }

            // Insert into fees table
            $fees_sql = "INSERT INTO `jeno_fees` (`fee_admision_id`, `fee_stu_id`, `fee_uni_fee_total`, `fee_sdy_fee_total`, `fee_stu_year`, `fee_center_id`, `fee_created_by`) 
            VALUES ('$applicationNo', '$studentId', '$universityFee', '$studyFee', '$selectedYear', '$centerId', '$createdBy')";

            if ($conn->query($fees_sql) === TRUE) {
                $newFeeId = $conn->insert_id;
                $response = array(
                    'success' => true,
                    'fee_id' => $newFeeId,
                );
            } else {
                $response['message'] = 'Error inserting fees: ' . $conn->error;
            }
        } else {
            $response = array('success' => false, 'message' => 'Error updating student year: ' . $conn->error);
        }
    } else {
        $response = array('success' => false, 'message' => 'Error retrieving course ID and application number: ' . $conn->error);
    }

    echo json_encode($response);
    exit();
}
?>
