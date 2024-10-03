
<?php
session_start();
include "class.php";
$user_role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">

   <?php include("head.php"); ?>

    <body>
        <!-- Begin page -->
        <div class="wrapper">

            
            <!-- ========== Topbar Start ========== -->
            <?php include("top.php") ?>
            <!-- ========== Topbar End ========== -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">

                <!-- Brand Logo Light -->
                <?php include("left.php"); ?>
            </div>
            <!-- ========== Left Sidebar End ========== -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="bg-flower">
                                    <img src="assets/images/flowers/img-3.png">
                                </div>

                                <div class="bg-flower-2">
                                    <img src="assets/images/flowers/img-1.png">
                                </div>

                                <div class="page-title-box">                                    
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                               
                            </div>
                        </div>

                        <!-- Filters -->
      <!-- <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="universityFilter">University</label>
                        <select id="universityFilter" class="form-control">
                            <option value="">All</option>
                            <option value="University1">University Of Madras</option>
                            <option value="University2">Anna University</option>
                            <option value="University3">MS University</option>
                            <option value="University4">Alagappa University</option>
                            
                        </select>
                    </div>                 
                </div> -->

                        <div class="row">
        

                        <div class="col-sm-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total University </h5>
                                                <h3 class="my-1 py-1" id="allUniversity"></h3>
                                            </div>
                                            
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
        
                            <div class="col-sm-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Total Courses </h5>
                                                <h3 class="my-1 py-1" id="allCourses"></h3>
                                            </div>
                                            
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-sm-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Total Faculties </h5>
                                                <h3 class="my-1 py-1" id="allfaculty"></h3>
                                            </div>
                                            
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-sm-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Total Staff </h5>
                                                <h3 class="my-1 py-1" id="allStaff"></h3>
                                            </div>
                                            
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-sm-12">
                                     <div class="form-group ">
                                    <label for="university" class="form-label"><b>University Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="actDashboard" id="university" required="required">
                                    
                             <option value="All">--Select the University--</option>
                                 <?php 
                              $uniCenterId = $_SESSION['centerId'];
                                $university_result = universityTable($uniCenterId); // Call the function to fetch universities 
                                  while ($row = $university_result->fetch_assoc()) {
                                  $id = $row['uni_id']; 
                                  $name = $row['uni_name'];        
                                                
                                    ?>
                                                       
                                 <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                   <?php } ?>
                                   </select>
                                  </div>
                             </div>

                           
        
                            <div class="col-sm-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Total Enquiries </h5>
                                                <h3 class="my-1 py-1" id="allEnquiry"></h3>
                                            </div>
                                            
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                           

                           
                            <div class="col-sm-6 col-xxl-3">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Total Admission</h5>
                                                <h3 class="my-1 py-1" id="allAdmission">259</h3>                                               
                                            </div>
                                            
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        
                <!-- ------------------------admin view ----------------- -->
                

        <?php if ($user_role == 'Admin') { ?>
                            
        
                          

                            

                            <div class="col-sm-6 col-xxl-3">
                                <div class="card text-bg-primary border-primary">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-white text-opacity-75 fw-normal mt-0 text-truncate" title="Booked Revenue">Total Income</h5>
                                                <h3 class="my-1 py-1" id="allIncome"></h3>
                                            </div>
                                            
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-sm-6 col-xxl-3">
                                <div class="card text-bg-primary border-primary">
                                    <div class="card-body bg-danger">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h5 class="text-white text-opacity-75 fw-normal mt-0 text-truncate" title="Booked Revenue">Total Expense</h5>
                                                <h3 class="my-1 py-1" id="allExpense"></h3>
                                            </div>
                                           
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                         <?php } ?>
                        </div>
                       
                        <!-- -----------------------admin view end -------------------- -->

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
             <?php include("footer.php") ?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

                 
        
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Daterangepicker js -->
        <script src="assets/vendor/daterangepicker/moment.min.js"></script>
        <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
        
        <!-- Apex Charts js -->
        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>

        <!-- Vector Map js -->
        <script src="assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

        <!-- Dashboard App js -->
        <script src="assets/js/pages/demo.dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
$(document).ready(function() {
    $.ajax({
        url: 'action/actDashboard.php',
        method: 'POST',
        data: {
            data: "AllData"
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.success) {
                // Assuming response contains the total_active_students count
                // $('#allStudent').text(response.data.total_active_students);
                $('#allEnquiry').text(response.data.total_active_enquiry);
                $('#allAdmission').text(response.data.total_active_admission);
                $('#allfaculty').text(response.data.total_active_faculty);
                $('#allStaff').text(response.data.total_active_staff);
                $('#allExpense').text("₹" + response.data.tran_amount_expense);
                $('#allIncome').text("₹" + response.data.total_income);
                $('#allUniversity').text(response.data.total_active_university);
                $('#allCourses').text(response.data.total_active_course);
                // Other response data can be set here similarly
            } else {
                console.error('Failed to fetch data:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX request failed:', status, error);
            console.error('Response text:', xhr.responseText);
        }
    });

    //----------onchange university --------------------------

    $('#university').change(function() {
        var universityId = $(this).val();
        
        

        $.ajax({
            url: "action/actDashboard.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { university: universityId },
            dataType: 'json',
            success: function(response) {
                
                // $('#allStudent').text(response.data.total_active_students);
                $('#allEnquiry').text(response.data.total_active_enquiry);
                $('#allAdmission').text(response.data.total_active_admission);
                $('#allExpense').text("₹" + response.data.tran_amount_expense);
                $('#allIncome').text("₹" + response.data.total_income);

            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });

});
</script>

    </body>
</html> 