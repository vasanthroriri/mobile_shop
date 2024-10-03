<?php
include '../db/dbConnection.php'; // Adjust the path to your database connection file
session_start();
header('Content-Type: application/json');


if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']); // Sanitize input

    $sql = "SELECT ele_elective FROM jeno_elective WHERE ele_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = [
                'success' => true,
                'name' => $row['ele_elective']
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Name not found'
            ];
        }

        $stmt->close();
    } else {
        $response = [
            'success' => false,
            'message' => 'Database error'
        ];
    }

    echo json_encode($response);
    exit();
}




// Check if the request method is GET
if (isset($_POST['course_id']) && !empty($_POST['course_id'])) {


   



    $id = $_POST['course_id'];
    $centerId = $_SESSION['centerId'];

    // Define the function to fetch language report
    function landuageReport($id ,$centerId) {    
        global $conn; // Assuming $conn is your database connection variable

        // Query to retrieve elective languages
        $language_query = "SELECT `ele_id`, `ele_elective` FROM `jeno_elective` WHERE ele_cou_id = $id AND ele_center_id = $centerId  AND ele_status ='Active';";

        // Execute the query
        $language_result = $conn->query($language_query);

        $languages = []; // Initialize an array to store language details

        // Check if query was successful and there is a result
        if ($language_result && $language_result->num_rows > 0) {
            while ($lag_row = $language_result->fetch_assoc()) {
                // Push each language as an object into the languages array
                $languages[] = array(
                    'ele_id' => $lag_row['ele_id'],
                    'ele_elective' => $lag_row['ele_elective']
                );
            }
        }

        return $languages;
    }

    // Fetch the language report
    $languages = landuageReport($id ,$centerId);

    // Output the data as JSON
    echo json_encode($languages);
} else {
    // Handle incorrect request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
