
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


                        <div class="row">


                        <div class="col-sm-6 col-xxl-3">
                                <div class="card text-bg-primary border-primary">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <h5 class="text-white text-opacity-75 fw-normal mt-0" title="Booked Revenue">Total Income ( <span id="month"></span>)</h5>
                                                <h3 class="my-1 py-1" id="allIncome"></h3>
                                            </div>
                                            
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->


                            <?php 
                            
                            $select_qry ="SELECT 
                                            b.brand_name,
                                            d.product_name,
                                            c.name,
                                            a.product_quantity
                                        FROM 
                                            stock_tbl AS a 
                                            LEFT JOIN brand_tbl AS b on a.brand_id = b.brand_id
                                            LEFT JOIN product_type_tbl AS c ON a.product_type_id = c.id
                                            LEFT JOIN product_tbl AS d ON a.product_id = d.product_id
                                        WHERE 
                                            stock_status = 'Active' 
                                            AND product_quantity <= 3;";
                            
                            $product_result = $conn->query($select_qry);

                            while ($row = $product_result->fetch_assoc()) {
                            
                            ?>

                            <div class="col-sm-6 col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <h5 class="text-muted fw-normal mt-0" title="Campaign Sent"><?php echo $row['brand_name'] ." -" . $row['product_name'] ." -" .$row['name']?> </h5>
                                                <h3 class="my-1 py-1" > <?php echo $row['product_quantity'] ?></h3>
                                            </div>
                                            
                                        </div> <!-- end row-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->


                            <?php  } ?>
        

     

                       
                        
                <!-- ------------------------admin view ----------------- -->
                

      
                        </div>
                       
                        <!-- -----------------------admin view end -------------------- -->

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
             <?php include "footer.php" ?>
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
                
                $('#allIncome').text("₹" + response.data.total_amount);
                $('#month').text( response.data.month_name);
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


});
</script>

    </body>
</html> 