<?php
session_start();
include("db/dbConnection.php");

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['truncate'])) {
    try {
        // Disable foreign key checks to avoid constraint violations
        $conn->query("SET FOREIGN_KEY_CHECKS = 0");

        // Fetch all table names
        $sql = "SHOW TABLES";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Loop through all tables and truncate each one except 'jeno_location'
            while ($row = $result->fetch_array()) {
                $table = $row[0];
                if ($table != 'jeno_location') {
                    $truncate_sql = "TRUNCATE TABLE `$table`";
                    if ($conn->query($truncate_sql) !== TRUE) {
                        throw new Exception("Error truncating table $table: " . $conn->error . "<br>");
                    }
                }
            }
        } else {
            echo "No tables found in the database.";
        }

        // Re-enable foreign key checks
        $conn->query("SET FOREIGN_KEY_CHECKS = 1");

        // Insert four new rows into the jeno_user table
        $insert_sql = "INSERT INTO jeno_user (user_name, user_username, user_password, user_role, user_center_id, user_created_at, user_created_by, user_updated_at, user_updated_by, user_status) VALUES
                       ('admin', 'admin1', 'admin', 'Admin', 1, NOW(), 0, NOW(), 0, 'Active'),
                       ('admin', 'admin2', 'admin', 'Admin', 2, NOW(), 0, NOW(), 0, 'Active'),
                       ('staff', 'staff1', 'staff', 'Staff', 1, NOW(), 0, NOW(), 0, 'Active'),
                       ('staff', 'staff2', 'staff', 'Staff', 2, NOW(), 0, NOW(), 0, 'Active')";

        if ($conn->query($insert_sql) !== TRUE) {
            throw new Exception("Error inserting new rows: " . $conn->error . "<br>");
        }

        echo "All tables truncated (except jeno_location) and new rows inserted successfully.";

    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body>
    <div class="container">
        <!-- Your existing form content here -->

        <!-- Truncate Tables Button -->
        <button id="truncateButton" class="btn btn-danger" onclick="truncateTables()">Truncate All Tables</button>

        <!-- Existing form code for managing forms -->
        <form class="needs-validation" novalidate name="frmEditAdmission" id="editAdmission" enctype="multipart/form-data">
            <!-- Form fields go here -->
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function truncateTables() {
            if (confirm('Are you sure you want to truncate all tables (except jeno_location) and reset data?')) {
                $.ajax({
                    url: '', // Same page URL
                    type: 'POST',
                    data: { truncate: true },
                    success: function(response) {
                        alert(response);
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            }
        }
    </script>
</body>
</html>
