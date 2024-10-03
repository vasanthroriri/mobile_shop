<?php
include("db/dbConnection.php");

// Check if employee id is provided
if(isset($_POST['id']) && $_POST['id'] != '') {
    $studentId = $_POST['id'];

    // Prepare and execute the SQL query
    $selQuery = "SELECT student_tbl.*,
    additional_details_tbl.*,
    course_tbl.*,
    payment_tbl.*,
    admin_tbl.*
     FROM student_tbl
    LEFT JOIN additional_details_tbl on student_tbl.stu_id=additional_details_tbl.stu_id
    LEFT JOIN course_tbl on student_tbl.course_id=course_tbl.course_id
    LEFT JOIN payment_tbl on student_tbl.stu_id=payment_tbl.stu_id
    LEFT JOIN admin_tbl on student_tbl.user_id=admin_tbl.user_id
    WHERE student_tbl.stu_id = '$studentId'";
    
    $result1 = $conn->query($selQuery);

    if($result1) {
        // Fetch employee details
        $row = mysqli_fetch_array($result1 , MYSQLI_ASSOC);
        $id = $row['stu_id']; 
        $e_id = $row['entity_id'];
        $fname = $row['first_name'];
        $lname=$row['last_name'];
        $gender=$row['stu_gender'];
        $location  = $row['address']; 
        $course_name=$row['course_name'];
        $mobile=$row['phone'];
        $email=$row['email'];
        $charge=$row['charge'];
        $image=$row['stu_image'];
        $course=$row['course_name']; 
        $aadhar=$row['aadhar'];
        $course_duration=$row['course_month'];
        $username=$row['username'];
        $password=$row['pass'];


        $name=$fname." ".$lname;    

    } else {
        echo "Error executing query: " . $conn->error;
    }
} else {
    // If employee id is not provided, redirect to employees.php
    header("Location: student.php");
    exit(); // Ensure script stops executing after redirection
}
?>
                 
      <div class="table-responsive">
          <form name="frm" method="post">
              <input type="hidden" name="hdnAction" value="">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Student Details</h4>
            </div>  
           <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card p-3">
                                <h4>Name</h4> 
                                <span class="detail"><?php echo $name;?></span>
                            </div>
                        </div>  
                         <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>Course Name</h4>
                                <span class="detail"><?php echo  $course ;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>Gender</h4>
                                <span class="detail"><?php echo  $gender ;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card p-3">
                                <h4>Place</h4>
                                <span class="detail"><?php echo $location;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card p-3">
                                <h4>Email Id</h4>
                                <span class="detail"><?php echo $email;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card p-3">
                                <h4>Mobile No.</h4>
                                <span class="detail"><?php echo  $mobile;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>Aadhar Number</h4>
                                <span class="detail"><?php echo $aadhar;?></span>
                            </div>
                        </div>
                       
                        <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>Course Duration</h4>
                                <span class="detail"><?php echo $course_duration;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>Course Charge</h4>
                                <span class="detail"><?php echo $charge;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>Username</h4>
                                <span class="detail"><?php echo $username;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>Password</h4>
                                <span class="detail"><?php echo $password;?></span>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="javascript:location.href='student.php'" >Back</button>
               
            </div> 
            </form>   
      </div>
    
