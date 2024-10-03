<?php
// Include database connection file
include("db/dbConnection.php");

// Check if employee id is provided
if(isset($_POST['id']) && $_POST['id'] != '') {
    $stuId = $_POST['id'];

    // Prepare and execute the SQL query to fetch employee details
    $selQuery = "SELECT a.*,b.* FROM `student_tbl` AS a LEFT JOIN admin_tbl AS b ON a.user_id=b.user_id WHERE a.stu_id =$stuId";
    $result = $conn->query($selQuery);

    if($result) {
        // If query is successful, fetch the employee details
        $row = $result->fetch_assoc();
        
        // Create an associative array to hold employee details
        $studentDoc = array(
            'stuId' => $row['stu_id'],
            'username' => $row['username'],
            'aadhar'=>$row['stu_aadhar'],
            'marksheet'=>$row['stu_marksheet'],
            
        );

        echo json_encode($studentDoc);
    } else {
        // If query fails, return an error message
        echo "Error executing query: " . $conn->error;
    }
} else {
    // If employee id is not provided, return an error message
    echo "Student ID not provided.";
}
?>
