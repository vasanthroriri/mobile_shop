<?php
include("../class.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];




    //---get course --------------------------

    // Handle fetching university details for editing
if (isset($_POST['universityID']) && $_POST['universityID'] != '') {
    
    $universityId = $_POST['universityID'];
    $centerId = $_SESSION['centerId'];

    $courseQuery = "SELECT `cou_id`, `cou_name` FROM `jeno_course` WHERE cou_uni_id = $universityId AND cou_center_id = $centerId;";
    $courseResult = mysqli_query($conn, $courseQuery);

    if ($courseResult) {
        while ($row = mysqli_fetch_assoc($courseResult)) {
            // Push each course as an object into the courses array
            $course = array(
                'cou_id' => $row['cou_id'],
                'cou_name' => $row['cou_name']
            );
            $courses[] = $course;
        }

        echo json_encode($courses);
    } else {
        $response['message'] = "Error fetching Course Name details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }



                        // Handle adding a university
                        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addTransaction') {
                            $category = $_POST['category'];
                            
                            $expenseReason = $_POST['expenseReason'];
                            $date = $_POST['date'];
                            $amount = $_POST['amount'];
                            $paidMethod = $_POST['paidMethod'];
                            $transactionId = $_POST['transactionId'];
                            $description = $_POST['description'];
                           
                            // Other fields
                            $uniCenterId = $_SESSION['centerId'];
                            $createdBy = $_SESSION['userId'];

                            

                            $university_sql = "INSERT INTO `jeno_transaction`
                            ( `tran_category`
                            , `tran_date`
                            , `tran_amount`
                            , `tran_method`
                            , `tran_transaction_id`
                            , `tran_description`
                            , `tran_reason`
                            , `tran_center_id`
                            , `tran_created_by`) 
                            VALUES 
                            ('$category'
                            ,'$date'
                            ,'$amount'
                            ,'$paidMethod'
                            ,'$transactionId'
                            ,'$description'
                            ,'$expenseReason'
                            ,'$uniCenterId'
                            ,'$createdBy')";

                            if ($conn->query($university_sql) === TRUE) {
                                $response['success'] = true;
                                $response['message'] = "transaction added successfully!";
                            } else {
                                $response['message'] = "Error adding transaction: " . $conn->error;
                            }

                            echo json_encode($response);
                            exit();
                        }


                // Handle fetching university details for editing
                if (isset($_POST['editId']) && $_POST['editId'] != '') {
                    $editId = $_POST['editId'];
                    $centerId = $_SESSION['centerId'];
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
                     WHERE tran_id = $editId AND tran_center_id =$centerId";

                    $result = mysqli_query($conn, $selQuery);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        

                        $courseDetails = [
                            'tran_id' => $row['tran_id'],
                            'tran_category' => $row['tran_category'],
                            'tran_date' => $row['tran_date'], // Course ID for pre-selecting the course in the dropdown
                            'tran_amount' => $row['tran_amount'],
                            'tran_method' => $row['tran_method'],
                            'tran_transaction_id' => $row['tran_transaction_id'],
                            'tran_description' => $row['tran_description'],
                            'tran_reason' => $row['tran_reason']
                           
                        ];

                        echo json_encode($courseDetails);
                    } else {
                        $response['message'] = "Error fetching transaction details: " . mysqli_error($conn);
                        echo json_encode($response);
                    }

                    exit();
                }


    // Handle updating student details
        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editTransaction') {
            $editTransactionId = $_POST['editTransactionId'];
            $editCategory = $_POST['editCategory'];
            $editExpenseReason = $_POST['editIncomeReason'];
            $editDate = $_POST['editDate'];
            $editAmount = $_POST['editAmount'];
            $editPaidMethod = $_POST['editPaidMethod'];
            $editTranId = $_POST['editTranId'];
            $editDescription = $_POST['editDescription'];
            
         
            // Other fields
            
            $updatedBy = $_SESSION['userId'];
    
 
            $editUniversity ="UPDATE `jeno_transaction` 
            SET 
            `tran_category`='$editCategory'
            ,`tran_date`='$editDate'
            ,`tran_amount`='$editAmount'
            ,`tran_method`='$editPaidMethod'
            ,`tran_transaction_id`='$editTranId'
            ,`tran_description`='$editDescription'
            ,`tran_reason`='$editExpenseReason'
            ,`tran_updated_by`='$updatedBy'
             WHERE `tran_id` = $editTransactionId;";
            
            $universityres = mysqli_query($conn, $editUniversity);

                if ($universityres) {
                    $_SESSION['message'] = "Transaction details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "Transaction details Updated successfully!";
                } 
                else {
                $response['message'] = "Error: " . mysqli_error($conn);
            }
            
            echo json_encode($response);
            exit();
        }


        // // Handle deleting a client
            if (isset($_POST['deleteId'])) {
                $id = $_POST['deleteId'];
                $updatedBy = $_SESSION['userId'];

                $queryDel = "UPDATE `jeno_transaction` SET `tran_updated_by`='$updatedBy',`tran_status`='Inactive' WHERE tran_id = $id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "Transaction details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "Transaction details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting Transaction details!";
                    $response['message'] = "Error: " . mysqli_error($conn);
                }

                echo json_encode($response);
                exit();
            }



            // Check if employee id is provided
            if(isset($_POST['id']) && $_POST['id'] != '') {
                $uniId = $_POST['id'];
                $centerId = $_SESSION['centerId'];

                // Prepare and execute the SQL query
                $selQuery = "SELECT 
                `tran_id`
                , `tran_category`
                , `tran_date`
                , `tran_amount`
                , `tran_method`
                , `tran_transaction_id`
                , `tran_description`
                , `tran_reason` 
                FROM `jeno_transaction` WHERE tran_id = $uniId AND tran_center_id =$centerId;";
                
                $result1 = $conn->query($selQuery);

                if($result1) {
                    $row = mysqli_fetch_assoc($result1);
                    $tran_date = date('d-m-Y', strtotime($row['tran_date']));

             // Prepare university details array
        $enquiryDetails = [

            'tran_id' => $row['tran_id'],
            'tran_category' => $row['tran_category'],
            'tran_date' => $tran_date,
            'tran_amount' => $row['tran_amount'],
            'tran_method' => $row['tran_method'],
            'tran_transaction_id' => $row['tran_transaction_id'],
            'tran_description' => $row['tran_description'],
            'tran_reason' => $row['tran_reason'],
            
        ];

          echo json_encode($enquiryDetails);
          exit();
                      
                } else {
                    echo "Error executing query: " . $conn->error;
                }
            }





            
// Handle fetching university details for editing
if (isset($_POST['university']) && $_POST['university'] != '') {

    $endDate = $_POST['endDate'];
    $startDate = $_POST['startDate'];
    $university = $_POST['university'];
    $location = $_POST['location'];

    // Fetch payment history data
    $select_pay = "SELECT 
        `pay_id`,
        `pay_admission_id`,
        `pay_student_name`,
        `pay_year`,
        `pay_paid_method`,
        `pay_study_fees`,
        `pay_total_amount`,
        `pay_balance`,
        `pay_date`,
        `pay_center_id` 
    FROM `jeno_payment_history`
    WHERE pay_status = 'Active' AND pay_center_id =$centerId
    AND pay_date BETWEEN '$startDate' AND '$endDate'";

    $pay_result = mysqli_query($conn, $select_pay);

    // Fetch transaction data
    $selQuery = "SELECT 
        `tran_id`,
        `tran_category`,
        `tran_date`,
        `tran_amount`,
        `tran_method`,
        `tran_transaction_id`,
        `tran_description`,
        `tran_reason`
    FROM `jeno_transaction`
    WHERE tran_status = 'Active' AND tran_center_id =$centerId
    AND tran_date BETWEEN '$startDate' AND '$endDate'";

    // Append condition for `tran_category` if `university` is not 'All'
    if ($university !== 'All') {
        $selQuery .= " AND `tran_category` = '$university'";
    }

    if ($location !== 'All') {
        $selQuery .= " AND tran_center_id = $location";
    }

    $tran_result = mysqli_query($conn, $selQuery);

    if ($pay_result && $tran_result) {
        $merged_data = [];

        // Process payment history data
        while ($row = $pay_result->fetch_assoc()) {
            $pay_date = date('d-m-Y', strtotime($row['pay_date']));
            $merged_data[] = [
                'type' => 'payment',
                'pay_id' => $row['pay_id'],
                'pay_admission_id' => $row['pay_admission_id'],
                'pay_student_name' => $row['pay_student_name'],
                'pay_year' => $row['pay_year'],
                'pay_paid_method' => $row['pay_paid_method'],
                'pay_study_fees' => $row['pay_study_fees'],
                'pay_total_amount' => $row['pay_total_amount'],
                'pay_balance' => $row['pay_balance'],
                'date' => $pay_date,
                'pay_center_id' => $row['pay_center_id']
            ];
        }

        // Process transaction data
        while ($row = $tran_result->fetch_assoc()) {
            $tran_date = date('d-m-Y', strtotime($row['tran_date']));
            $merged_data[] = [
                'type' => 'transaction',
                'tran_id' => $row['tran_id'],
                'tran_category' => $row['tran_category'],
                'tran_reason' => $row['tran_reason'],
                'tran_method' => $row['tran_method'],
                'tran_amount' => $row['tran_amount'],
                'date' => $tran_date,
                'tran_description' => $row['tran_description'],
                'tran_transaction_id' => $row['tran_transaction_id']
            ];
        }

        // Sort merged data by date
        usort($merged_data, function($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });

        echo json_encode($merged_data);
    } else {
        $response['message'] = "Error fetching data: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit();
}





            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();

