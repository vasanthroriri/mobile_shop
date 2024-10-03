

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
    
    // Check if the university filter is set to 'All' or is empty
    if ($university == 'All' || empty($university)) {
        // Include all universities
        $universityFilterCondition = '1=1'; // This condition always evaluates to true
    } else {
        // Filter by the selected university
        $universityFilterCondition = "b.stu_uni_id = '" . $conn->real_escape_string($university) . "'";
    }
    
    // Construct the SQL query
    $selQuery = "SELECT 
        a.fee_id, 
        a.fee_admision_id, 
        a.fee_stu_id, 
        a.fee_uni_fee_total, 
        a.fee_uni_fee, 
        a.fee_sdy_fee_total, 
        a.fee_sty_fee, 
        c.pay_total_amount,
        b.stu_uni_id ,
        b.stu_name ,
        c.pay_year ,
        c.pay_date
    FROM 
        jeno_fees AS a 
        LEFT JOIN jeno_student AS b ON a.fee_stu_id = b.stu_id 
        LEFT JOIN jeno_payment_history AS c ON a.fee_admision_id = c.pay_admission_id
    WHERE 
        ($universityFilterCondition)
        AND c.pay_date BETWEEN '$startDate' AND '$endDate'";

    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        
        
        $fees = [];

        while ($row = $result->fetch_assoc()) {
            $pay_date = date('d-m-Y', strtotime($row['pay_date']));
            $fees[] = [
                'fee_id' => $row['fee_id'],
                'fee_admision_id' => $row['fee_admision_id'],
                'StuName' => $row['stu_name'],
                'pay_year' => $row['pay_year'],
                'uni_name' => universityName($row['stu_uni_id']),
                'fee_stu_id' => $row['fee_stu_id'], // Course ID for pre-selecting the course in the dropdown            
                'fee_uni_fee' => $row['fee_uni_fee'],
                'fee_sty_fee' => $row['fee_sty_fee'],
                'pay_total_amount' => $row['pay_total_amount'],
                'pay_date' => $pay_date,
                
                
            ];


            

        }
       

        echo json_encode($fees);
    } else {
        $response['message'] = "Error fetching Enquiry details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit();
}
