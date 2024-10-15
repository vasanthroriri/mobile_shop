<?php
session_start();
    
    include("class.php");
    
    
    // Call the function to fetch the report for the selected date
    $result = reportTable();
    $report_result = $result['result'];  // Get the report data
    $total_amount = $result['total_amount'];
    
    
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>
<body>
    <!-- Begin page -->
    <div class="wrapper">

        
        <!-- ========== Topbar Start ========== -->
        <?php include("top.php") ?>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

        <?php include("left.php"); ?>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        
        <div class="content-page">
            <div class="content">
            <div id="studentDetail"></div>
            <?php include "formBrand.php";?> <!---add Student popup--->

                <!-- Start Content-->
                <div class="container-fluid" id="StuContent" >

                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="bg-flower">
                                <img src="assets/images/flowers/img-3.png">
                            </div>

                            <div class="bg-flower-2">
                                <img src="assets/images/flowers/img-1.png">
                            </div>
        
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <form id="dateFilterForm" method="GET" action="">
                                        <div class="d-flex flex-wrap gap-2">
                                            <input type="date" id="reportDate" name="reportDate" class="form-control" value="<?php echo isset($_GET['reportDate']) ? $_GET['reportDate'] : date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>"> 
                                            
                                            <button type="submit" class="btn btn-info mb-3">
                                                <i class="bi bi-filter"></i> Filter by Date
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <h3 class="page-title">Report List</h3>   
                            </div>
                        </div>
                    </div>
                    <!-- Show total amount at the top -->
                    <div class="total-amount-box">
                        <h4>Total Amount for 
                            <?php 
                                // Check if a reportDate is set in the URL, else use the current date
                                $selectedDate = isset($_GET['reportDate']) ? $_GET['reportDate'] : date('Y-m-d');

                                // Convert the date to "Day Month Year" format
                                echo date('d F Y', strtotime($selectedDate)); 
                            ?>: 
                            <?php echo number_format($total_amount, 2); ?> <!-- Format to 2 decimal places -->
                        </h4>
                    </div>       
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Total Amount</th>
                                    
                                    
                      </tr>
                    </thead>
                    <tbody>
                <?php  
                     $total_amount = $result['total_amount'];  // Get the total amount for the selected date

                    $i =1;

                    while ($row = $report_result->fetch_assoc()) {
                        $id = $row['invoice_id'];
                        

            ?>

            <tr>
                        <td scope="row"><?php echo $i ; $i++ ?></td>
                        <td><?php echo date('d F Y', strtotime($row['invoice_date'])); ?></td>
                        <td><?php echo $row['customer_name'] ?></td>
                        <td><?php
                            // Decode the JSON data into a PHP array
                            $products = json_decode($row['products'], true);

                            // Check if the products data is valid and not empty
                            if (!empty($products)) {
                                foreach ($products as $product) {
                                    // Display the desired fields (e.g., brand, model, quantity, price, etc.)
                                    echo "Brand: " . $product['brand'] . "<br>";
                                    echo "Model: " . $product['model'] . "<br>";
                                    echo "Product: " . $product['product'] . "<br>";
                                    echo "Quantity: " . $product['quantity'] . "<br>";
                                    echo "Price: " . $product['price'] . "<br>";
                                    echo "<hr>"; // A separator between multiple products (if more exist in the JSON)
                                }
                            } else {
                                echo "No products available.";
                            }
                            ?></td>
                        <td><?php echo $row['total_price'] ?></td>
                        
                        
                        
                        
                      </tr>



        <?php } ?>
                   
                  
                        
                    </tbody>
                  </table>

                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div> <!-- end row-->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include("footer.php") ?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->


    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Datatables js -->
    <script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- Datatable Demo Aapp js -->
    <script src="assets/js/pages/demo.datatable-init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <!-------Start Add Student--->

    <script>

     // Ajax form submission
$('#addBrandForm').submit(function(event) {
    event.preventDefault(); // Prevent default form submission

    var form = this; // Get the form element
    var submitButton = $(this).find('button[type="submit"]'); // Get the submit button

    // Disable the submit button to avoid double click
    submitButton.prop('disabled', true);

    if (form.checkValidity() === false) {
        // If the form is invalid, display validation errors
        form.reportValidity();
        submitButton.prop('disabled', false); // Re-enable the button if validation fails
        return;
    }
    
    var formData = new FormData(this);

    $.ajax({
        url: 'action/actBrand.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            // Handle success response
            console.log(response);
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    timer: 2000
                }).then(function() {
                    $('#addUniversityModal').modal('hide');
                    $('#scroll-horizontal-datatable').load(location.href + ' #scroll-horizontal-datatable > *', function() {
                        $('#scroll-horizontal-datatable').DataTable().destroy();
                        $('#scroll-horizontal-datatable').DataTable({
                            "paging": true, // Enable pagination
                            "ordering": true, // Enable sorting
                            "searching": true // Enable searching
                        });
                    });
                    submitButton.prop('disabled', false); // Re-enable the button after success
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
                submitButton.prop('disabled', false); // Re-enable the button on error
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle error response
            alert('Error adding Brand: ' + textStatus);
            submitButton.prop('disabled', false); // Re-enable the button on AJAX error
        }
    });
});

        
    </script>
  
    <script>
    $(document).ready(function() {

        $('#addUniversityBtn').click(function() {

            $('#addUniversity').removeClass('was-validated');
            $('#addUniversity').addClass('needs-validation');
            $('#addUniversity')[0].reset(); // Reset the form
            $('#additionalInputs').empty();
            

            });


    });

 
    $('#backButton').click(function() {
        $('#universityView').addClass('d-none');
        $('#StuContent').show();
    });



    // edit function -------------------------
function editUiversity(editId) {
    // alert("afa");
    $('#editUniversity').removeClass('was-validated');
    $('#editUniversity').addClass('needs-validation');

    $.ajax({
        url: 'action/actBrand.php',
        method: 'POST',
        data: {
            editId: editId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            $('#editid').val(response.brand_id);
            $('#editBrandName').val(response.brand_name);
            
           
                    },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    }




       




        //Edit Student Ajax


document.addEventListener('DOMContentLoaded', function() {
    $('#editBrand').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

        var formData = new FormData(this);
        $.ajax({
            url: "action/actBrand.php",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                // Handle success response
                
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000
                    }).then(function() {
                      $('#editUniversityModal').modal('hide'); // Close the modal
                        
                        $('.modal-backdrop').remove(); // Remove the backdrop   
                          $('#scroll-horizontal-datatable').load(location.href + ' #scroll-horizontal-datatable > *', function() {
                               
                              $('#scroll-horizontal-datatable').DataTable().destroy();
                               
                                $('#scroll-horizontal-datatable').DataTable({
                                   "paging": true, // Enable pagination
                                   "ordering": true, // Enable sorting
                                    "searching": true // Enable searching
                               });
                            });
                      });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while Edit Brand data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });
    });


    function goDeleteUniversity(id)
        {
    //alert(id);
    if(confirm("Are you sure you want to delete Brand ?"))
    {
      $.ajax({
        url: 'action/actBrand.php',
        method: 'POST',
        data: {
          deleteId: id
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#scroll-horizontal-datatable').load(location.href + ' #scroll-horizontal-datatable > *', function() {
                               
                               $('#scroll-horizontal-datatable').DataTable().destroy();
                               
                                $('#scroll-horizontal-datatable').DataTable({
                                    "paging": true, // Enable pagination
                                    "ordering": true, // Enable sorting
                                    "searching": true // Enable searching
                                });
                            });
         

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    }
    }



 





    
</script>

</body>

</html>



