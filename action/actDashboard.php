<?php
include("../class.php");

session_start();
header('Content-Type: application/json');

// Initialize the response array
$response = ['success' => false, 'message' => ''];

$centerId = $_SESSION['centerId'];

if (isset($_POST['data']) && $_POST['data'] != '') {
    // Construct the SQL queries for each table
    $selQuery1 = "SELECT COUNT(*) AS total_active_students 
                  FROM `jeno_student` AS a 
                  LEFT JOIN jeno_university AS b ON a.stu_uni_id = b.uni_id
                  WHERE a.stu_status = 'Active' AND b.uni_status = 'Active' AND a.stu_center_id = $centerId;";

    $selQuery2 = "SELECT COUNT(*) AS total_active_enquiry
                  FROM `jeno_enquiry`
                  WHERE `enq_status` = 'Active' AND enq_center_id = $centerId;";

    $selQuery3 = "SELECT COUNT(*) AS total_active_admission
                  FROM `jeno_student`
                  WHERE `stu_status` = 'Active' AND stu_center_id = $centerId;";

    $selQuery4 = "SELECT COUNT(*) AS total_active_faculty
                  FROM `jeno_faculty`
                  WHERE `fac_status` = 'Active' AND fac_center_id = $centerId;";

    $selQuery5 = "SELECT COUNT(*) AS total_active_staff
                  FROM `jeno_staff`
                  WHERE `stf_status` = 'Active' AND sft_center_id = $centerId;";  

    $selQuery6 = "SELECT `tran_amount` 
                  FROM `jeno_transaction` 
                  WHERE tran_status = 'Active' AND tran_category = 'Expense' AND tran_center_id = $centerId;";  

    $selQuery7 = "SELECT `tran_amount` 
                  FROM `jeno_transaction` 
                  WHERE tran_status = 'Active' AND tran_category = 'Income' AND tran_center_id = $centerId;";  

    $selQuery8 = "SELECT `fee_uni_fee_total`, `fee_uni_fee`, `fee_sdy_fee_total`, `fee_sty_fee` 
                  FROM `jeno_fees` 
                  WHERE fee_status = 'Active' AND fee_center_id = $centerId";  

    $selQuery9 = "SELECT COUNT(*) AS total_active_university
                  FROM `jeno_university`
                  WHERE `uni_status` = 'Active' AND uni_center_id = $centerId;";

    $selQuery10 = "SELECT COUNT(*) AS total_active_course
                 FROM `jeno_course`
                 WHERE `cou_status` = 'Active' AND cou_center_id = $centerId;";

    // Execute the queries
    $result1 = mysqli_query($conn, $selQuery1);
    $result2 = mysqli_query($conn, $selQuery2);
    $result3 = mysqli_query($conn, $selQuery3);
    $result4 = mysqli_query($conn, $selQuery4);
    $result5 = mysqli_query($conn, $selQuery5);
    $result6 = mysqli_query($conn, $selQuery6);
    $result7 = mysqli_query($conn, $selQuery7);
    $result8 = mysqli_query($conn, $selQuery8);
    $result9 = mysqli_query($conn, $selQuery9);
    $result10 = mysqli_query($conn, $selQuery10);


    if ($result1 && $result2 && $result3 && $result4 && $result5 && $result6 && $result7 && $result8 && $result9 && $result10) {
        $row1 = mysqli_fetch_assoc($result1) ?? [];
        $row2 = mysqli_fetch_assoc($result2) ?? [];
        $row3 = mysqli_fetch_assoc($result3) ?? [];
        $row4 = mysqli_fetch_assoc($result4) ?? [];
        $row5 = mysqli_fetch_assoc($result5) ?? [];
        $row6 = mysqli_fetch_assoc($result6) ?? [];
        $row7 = mysqli_fetch_assoc($result7) ?? [];
        $row8 = mysqli_fetch_assoc($result8) ?? [];
        $row9 = mysqli_fetch_assoc($result9) ?? [];
        $row10 = mysqli_fetch_assoc($result10) ?? [];

        $tran_income = $row7['tran_amount'] ?? 0;
        $fee_uni_fee = $row8['fee_uni_fee'] ?? 0;
        $fee_sty_fee = $row8['fee_sty_fee'] ?? 0;

        $received_total = $fee_uni_fee + $fee_sty_fee;
        $total_income = $tran_income + $received_total;

        $fees = array(
            'total_active_students' => $row1['total_active_students'] ?? 0,
            'total_active_enquiry' => $row2['total_active_enquiry'] ?? 0,
            'total_active_admission' => $row3['total_active_admission'] ?? 0,
            'total_active_faculty' => $row4['total_active_faculty'] ?? 0,
            'total_active_staff' => $row5['total_active_staff'] ?? 0,
            'tran_amount_expense' => $row6['tran_amount'] ?? 0,
            'total_income' => $total_income,
            'total_active_university' => $row9['total_active_university'] ?? 0,
            'total_active_course' => $row10['total_active_course'] ?? 0
        );

        $response['success'] = true;
        $response['message'] = "Successfully retrieved report";
        $response['data'] = $fees;
    } else {
        $response['message'] = "Error fetching details: " . mysqli_error($conn);
    }
    echo json_encode($response);
    exit();
    } else {
        $response['message'] = 'Required parameter is missing.';
    }

//======================================================================================

    if (isset($_POST['university']) && $_POST['university'] != '') {
        
        $id=$_POST['university'];
            $date =date("Y/m/d");

        $selQuery1 = "SELECT COUNT(*) AS total_active_student 
        FROM `jeno_stu_additional` AS a 
        LEFT JOIN jeno_student AS b 
        ON a.add_stu_id = b.stu_id 
        LEFT JOIN jeno_university AS c
         ON b.stu_uni_id = c.uni_id 
         WHERE add_admit_date BETWEEN '$date' AND '$date' 
         AND add_status ='Active' AND c.uni_id = $id AND C.uni_center_id = $centerId; ";

        $selQuery2 = "SELECT COUNT(*) AS total_active_enquiry 
                    FROM `jeno_enquiry` AS a
                    LEFT JOIN jeno_university AS b ON a.enq_uni_id = b.uni_id
                    WHERE a.enq_date BETWEEN '$date' AND '$date'
                    AND a.enq_status = 'Active' 
                    AND a.enq_uni_id = $id AND a.enq_center_id = $centerId;";  
                         
                         
         $selQuery3 = "SELECT `tran_amount` 
                         FROM `jeno_transaction` 
                         WHERE tran_status = 'Active' AND tran_category = 'Expense' AND tran_date BETWEEN '$date' AND '$date' AND tran_center_id = $centerId";  
            
            $selQuery4 = "SELECT SUM(pay_study_fees) AS total_income
             FROM `jeno_payment_history` AS a
              LEFT JOIN jeno_student AS b
               ON a.pay_admission_id = b.stu_apply_no 
               LEFT JOIN jeno_university AS c
                ON b.stu_uni_id = c.uni_id 
                WHERE pay_date BETWEEN '2024-08-01' AND '2024-08-05'
                 AND pay_status = 'Active'
                  AND b.stu_uni_id = $id AND C.uni_center_id = $centerId;"; 

        $result1 = mysqli_query($conn, $selQuery1);
        $result2 = mysqli_query($conn, $selQuery2);
        $result3 = mysqli_query($conn, $selQuery3);
        $result4 = mysqli_query($conn, $selQuery4);
    
        

        if ($result1 && $result2 && $result3 && $result4) {
            $row1 = mysqli_fetch_assoc($result1) ?? [];
            $row2 = mysqli_fetch_assoc($result2) ?? [];
            $row3 = mysqli_fetch_assoc($result3) ?? [];
            $row4 = mysqli_fetch_assoc($result4) ?? [];
            

    
            $fees = array(
                'total_active_student' => $row1['total_active_student'] ?? 0,
                'total_active_enquiry' => $row2['total_active_enquiry'] ?? 0,            
                'tran_amount_expense' => $row3['tran_amount'] ?? 0,
                'total_income' => $row4['total_income'] ?? 0,
                
            );
    
            $response['success'] = true;
            $response['message'] = "Successfully retrieved report";
            $response['data'] = $fees;
        } else {
            $response['message'] = "Error fetching details: " . mysqli_error($conn);
        }
        echo json_encode($response);
        exit();
        } else {
            $response['message'] = 'Required parameter is missing.';


    }





        // Output JSON response
        echo json_encode($response);
        exit();
?>
