

<?php
include("../class.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];


// Handle fetching university details for editing
if (isset($_POST['university']) && $_POST['university'] != '') {

    $endDate = $_POST['endDate'];
    $startDate = $_POST['startDate'];
    $university = $_POST['university'];
    
    
        
        $selQuery = "SELECT 
        `tran_id`
        , `tran_category`
        , `tran_date`
        , `tran_amount`
        , `tran_method`
        , `tran_transaction_id`
        , `tran_description`
        , `tran_reason`
         FROM `jeno_transaction` 
         WHERE tran_date BETWEEN '2024-7-17' 
         AND '2024-7-24' AND tran_status = 'Active'";

          // Append the category filter if applicable
    if ($university == 'Income') {
        $selQuery .= " AND tran_category = 'Income'";
    } elseif ($university == 'Expense') {
        $selQuery .= " AND tran_category = 'Expense'";
    }
        

  

    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        
        $fees = [];

        while ($row = $result->fetch_assoc()) {

            $fees[] = [
                'tran_id' => $row['tran_id'],
                'fee_admision_id' => $row['tran_category'],
                'tran_category' => 'Admission',
                'tran_date' =>$row['tran_date'],
                'tran_amount' => $row['tran_amount'], // Course ID for pre-selecting the course in the dropdown            
                'tran_method' => $row['tran_method'],
                'tran_transaction_id' => $row['tran_transaction_id'],
                'tran_reason' => $row['tran_reason'],
                
            ];


            

        }
       

        echo json_encode($fees);
    } else {
        $response['message'] = "Error fetching Enquiry details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit();
}
