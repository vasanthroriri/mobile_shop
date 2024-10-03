<?php
include "db/dbConnection.php";
session_start();

if (isset($_POST['applicationNo']) && $_POST['applicationNo'] !='') {
    $applicationNo = $_POST['applicationNo'];
    // Check if application number exists
    $sql = "SELECT * FROM jeno_student WHERE stu_apply_no = '$applicationNo'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "exists";
    } else {
        echo "not exists";
    }
}
$conn->close();
?>