<?php
include "db/dbConnection.php";
session_start();

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    // Check if username exists
    $sql = "SELECT * FROM jeno_user WHERE user_username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "exists";
    } else {
        echo "not exists";
    }
}
$conn->close();
?>