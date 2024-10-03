<?php 
include("db/dbConnection.php");


function getLocation() {
    global $conn; // Assuming $conn is your database connection variable


   // Query to retrieve course name based on course_id
   $location_query = "SELECT `loc_id`, `loc_name`, `loc_short_name` FROM `jeno_location` WHERE loc_status='Active';";

   // Execute the query
   $location_result = $conn->query($location_query);

   // Check if query was successful
   if ($location_result) {
       // Fetch the course name
       

       return $location_result;
   } else {
       // Query execution failed
       return "Query failed: " . $conn->error;
   }
}

function universityTable($location) {
    global $conn; // Assuming $conn is your database connection variable


   // Query to retrieve course name based on course_id
   $university_query = "SELECT * FROM `jeno_university` WHERE uni_status ='Active' AND `uni_center_id`= $location ;";

   // Execute the query
   $university_result = $conn->query($university_query);

   // Check if query was successful
   if ($university_result) {
       // Fetch the course name
       

       return $university_result;
   } else {
       // Query execution failed
       return "Query failed: " . $conn->error;
   }
}


function electiveTable() {
    global $conn; // Assuming $conn is your database connection variable


   // Query to retrieve course name based on course_id
   $elective_query = "SELECT a.*, b.*, c.* FROM `jeno_elective` AS a LEFT JOIN `jeno_course` AS b ON a.ele_cou_id = b.cou_id
   LEFT JOIN `jeno_university` AS c ON b.cou_uni_id = c.uni_id WHERE a.ele_status ='Active'";

   // Execute the query
   $elective_result = $conn->query($elective_query);

   // Check if query was successful
   if ($elective_result) {
       // Fetch the course name
       

       return $elective_result;
   } else {
       // Query execution failed
       return "Query failed: " . $conn->error;
   }
}


    //----course table ------------------

        
    function courseTable($location) {    
    global $conn; // Assuming $conn is your database connection variable


   // Query to retrieve course name based on course_id
   $course_query = "SELECT 
   a.cou_id 
   ,a.cou_uni_id
   , a.cou_name
   , a.cou_medium
   , a.cou_exam_type 
   ,a.cou_duration 
   ,b.uni_name 
   FROM jeno_course AS a LEFT JOIN jeno_university AS b ON a.cou_uni_id = b.uni_id  WHERE cou_status ='Active' AND cou_center_id = $location;";

   // Execute the query
   $course_result = $conn->query($course_query);

   // Check if query was successful
   if ($course_result) {
       // Fetch the course name
       

       return $course_result;
   } else {
       // Query execution failed
       return "Query failed: " . $conn->error;
   }
    }


    //----university Name table ------------------


    function universityName($uniID) {
        global $conn; // Assuming $conn is your database connection variable
    
        // Query to retrieve university name based on uni_id
        $Uni_name = "SELECT `uni_name` FROM `jeno_university` WHERE `uni_id` = $uniID";
    
        // Execute the query
        $result = $conn->query($Uni_name);
    
        // Check if query was successful and there is a result
        if ($result && $result->num_rows > 0) {
            // Fetch the university name
            $row = $result->fetch_assoc();
            return $row['uni_name'];
        } else {
            // Query execution failed or no results found
            return "No university found with the given ID.";
        }
    }


     //----course Name  ------------------


     function courseNameOnly($couonlyID) {
        global $conn; // Assuming $conn is your database connection variable
    
        // Query to retrieve university name based on uni_id
        $enquiry_name = "SELECT `cou_name` FROM `jeno_course` WHERE `cou_id` = $couonlyID";
    
        // Execute the query
        $enquiry_result = $conn->query($enquiry_name);
    
        // Check if query was successful and there is a result
        if ($enquiry_result && $enquiry_result->num_rows > 0) {
            // Fetch the university name
            $enquiry_row = $enquiry_result->fetch_assoc();
            return $enquiry_row['cou_name'];
        } else {
            // Query execution failed or no results found
            return "No Course found with the given ID.";
        }
    }


    //----elective Name  ------------------


    function electiveNameOnly($elective) {
        global $conn; // Assuming $conn is your database connection variable
    
        // Query to retrieve university name based on uni_id
        $elective_name = "SELECT `cou_id`, `cou_name`, `cou_exam_type`, `cou_duration` FROM `jeno_course` WHERE cou_id = $elective";
    
        // Execute the query
        $elective_result = $conn->query($elective_name);
    
        // Check if query was successful and there is a result
        if ($elective_result && $elective_result->num_rows > 0) {
            // Fetch the university name
            $elective_row = $elective_result->fetch_assoc();
            return $elective_row['cou_name'];
        } else {
            // Query execution failed or no results found
            return "No Course found with the given ID.";
        }
    }


    //----Enquiry table ------------------

        
    function enquiryTable($location) {    
        global $conn; // Assuming $conn is your database connection variable
    
    
       // Query to retrieve course name based on course_id
       $enquiry_query = "SELECT 
       `enq_id`
       , `enq_uni_id`
       , `enq_cou_id`
       , `enq_number`
       , `enq_stu_name`
       , `enq_email`
       , `enq_dob`
       , `enq_gender`
       , `enq_mobile`
       , `enq_address`
       , `enq_adminsion_status`
        FROM `jeno_enquiry`
         WHERE enq_status ='Active' AND enq_center_id = $location";
    
       // Execute the query
       $enquiry_result = $conn->query($enquiry_query);
    
       // Check if query was successful
       if ($enquiry_result) {
           // Fetch the course name
           
    
           return $enquiry_result;
       } else {
           // Query execution failed
           return "Query failed: " . $conn->error;
       }
        }

        //---course name and Id=---------------

        function courseName($couID , $location) {
            global $conn; // Assuming $conn is your database connection variable
        
            // Query to retrieve courses based on uni_id
            $cou_name = "SELECT `cou_id`, `cou_name` FROM `jeno_course` WHERE cou_uni_id = $couID AND cou_center_id = $location";
            
            // Execute the query
            $cou_result = $conn->query($cou_name);
            
            $courses = []; // Initialize an array to store course details
            
            // Check if query was successful and there is a result
            if ($cou_result && $cou_result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($cou_result)) {
                    // Push each course as an object into the courses array
                    $course = array(
                        'cou_id' => $row['cou_id'],
                        'cou_name' => $row['cou_name']
                    );
                    $courses[] = $course;
                }
            }
            
            return $courses;
        }



         //---elective name and Id=---------------

         function electiveName($eleID) {
            global $conn; // Assuming $conn is your database connection variable
        
            // Query to retrieve courses based on uni_id
            $ele_name = "SELECT `ele_id`, `ele_cou_id`, `ele_elective` FROM `jeno_elective` WHERE ele_cou_id =$eleID AND ele_lag_elec = 'E' AND ele_status = 'Active'";
            
            // Execute the query
            $ele_result = $conn->query($ele_name);
            
            $electives = []; // Initialize an array to store course details
            
            // Check if query was successful and there is a result
            if ($ele_result && $ele_result->num_rows > 0) {
                while ($ele_row = mysqli_fetch_assoc($ele_result)) {
                    // Push each course as an object into the courses array
                    $elective = array(
                        'ele_id' => $ele_row['ele_id'],
                        'ele_elective' => $ele_row['ele_elective']
                    );
                    $electives[] = $elective;
                }
            }
            
            return $electives;
        }


         //----transaction table ------------------

        
    function transactionTable($location) {    
        global $conn; // Assuming $conn is your database connection variable
    
    
       // Query to retrieve course name based on course_id
       $transaction_query = "SELECT 
       `tran_id`
       , `tran_category`
       , `tran_date`
       , `tran_amount`
       , `tran_method`
       , `tran_reason` 
       FROM `jeno_transaction`
        WHERE tran_status ='Active' AND tran_center_id = $location";
    
       // Execute the query
       $transaction_result = $conn->query($transaction_query);
    
       // Check if query was successful
       if ($transaction_result) {
           // Fetch the course name
           
    
           return $transaction_result;
       } else {
           // Query execution failed
           return "Query failed: " . $conn->error;
       }
        }

        function admission($location) {
            global $conn; // Assuming $conn is your database connection variable
        
        
           // Query to retrieve course name based on course_id
           $admission_query = "SELECT a.*, b.*, c.* FROM `jeno_student` AS a 
           LEFT JOIN jeno_university AS b 
           ON a.stu_uni_id=b.uni_id 
           LEFT JOIN jeno_course AS c ON a.stu_cou_id=c.cou_id 
           WHERE stu_status = 'Active' AND stu_center_id =$location";
        
           // Execute the query
           $admission_result = $conn->query($admission_query);
        
           // Check if query was successful
           if ($admission_result) {
               // Fetch the course name              
               return $admission_result;
           } else {
               // Query execution failed
               return "Query failed: " . $conn->error;
           }
        }


              //----elective language ------------------

        
    function subjectTable() {    
        global $conn; // Assuming $conn is your database connection variable
    
    
       // Query to retrieve course name based on course_id
       $subject_query = "SELECT `sub_id`, `sub_uni_id`, `sub_cou_id`, `sub_type` ,`sub_exam_patten` FROM `jeno_subject` WHERE sub_status = 'Active'";
    
       // Execute the query
       $subject_result = $conn->query($subject_query);
    // Check if query was successful
    if ($subject_result) {
        // Fetch the course name
        
 
        return $subject_result;
    } else {
        // Query execution failed
        return "Query failed: " . $conn->error;
    }
        }
        

        //--location name only get ---------------
        function locationName($locID) {
            global $conn; // Assuming $conn is your database connection variable
        
            // Query to retrieve university name based on uni_id
            $loc_name = "SELECT `loc_name` FROM `jeno_location` WHERE `loc_id` = $locID";
        
            // Execute the query
            $loc_result = $conn->query($loc_name);
        
            // Check if query was successful and there is a result
            if ($loc_result && $loc_result->num_rows > 0) {
                // Fetch the university name
                $loc = $loc_result->fetch_assoc();
                return $loc['loc_name'];
            } else {
                // Query execution failed or no results found
                return "No location found with the given ID.";
            }
        }



        //----------------------------------------------------------------------------------------
        function getTransactionAmounts($location, $date) {
            global $conn; // Assuming $conn is your database connection variable
        
            // Query to retrieve the sum of online transaction amounts
            $online_query = "SELECT 
                                SUM(`tran_amount`) as online_total
                             FROM `jeno_transaction`
                             WHERE tran_category ='Income'
                               AND tran_status ='Active'
                               AND tran_date = '$date'
                               AND tran_center_id = $location
                               AND tran_method = 'Online';";
        
            // Query to retrieve the sum of cash transaction amounts
            $cash_query = "SELECT 
                              SUM(`tran_amount`) as cash_total
                           FROM `jeno_transaction`
                           WHERE tran_category ='Income'
                             AND tran_status ='Active'
                             AND tran_date = '$date'
                             AND tran_center_id = $location
                             AND tran_method = 'Cash';";
        
            // Execute the queries
            $online_result = $conn->query($online_query);
            $cash_result = $conn->query($cash_query);
        
            $online_total = 0;
            $cash_total = 0;


            
        
            // Check if the online query was successful and there is a result
            if ($online_result && $online_result->num_rows > 0) {
                $row = $online_result->fetch_assoc();
                $online_total = $row['online_total'];
            }
        
            // Check if the cash query was successful and there is a result
            if ($cash_result && $cash_result->num_rows > 0) {


                $row = $cash_result->fetch_assoc();
                $cash_total = $row['cash_total'];
            }
        
            return [
                'online_total' => $online_total,
                'cash_total' => $cash_total
            ];
        }
?>
