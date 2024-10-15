<?php
session_start();
    
    include("class.php");
    
    $product_result = productTable(); // Call the function to fetch universities 
    
    
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
            <?php include "formProduct.php";?> <!---add Student popup--->

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
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" id="addUniversityBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                        <i class="bi bi-plus-square"></i> Product
                                        </button>
                                    </div>
                                </div>
                                <h3 class="page-title">Product List</h3>   
                            </div>
                        </div>
                    </div>

             
             
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Product Name</th>
                                    <!-- <th scope="col">Study Center Code</th> -->
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                <?php  

                    $i =1;

                    while ($row = $product_result->fetch_assoc()) {
                        $id = $row['product_id'];
                        

            ?>

            <tr>
                        <td scope="row"><?php echo $i ; $i++ ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        
                        <td>
                        
                            <button  class="btn btn-circle btn-warning text-white modalBtn" onclick="goEditProduct(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class='bi bi-pencil-square'></i></button>
                           
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteProduct(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
                            
                           
                            

                        </td>
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
$('#addProductForm').submit(function(event) {
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
        url: 'action/actProduct.php',
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
                    $('#addProductModal').modal('hide');
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
function goEditProduct(editId) {
    // alert("afa");
    $('#editProduct').removeClass('was-validated');
    $('#editProduct').addClass('needs-validation');

    $.ajax({
        url: 'action/actProduct.php',
        method: 'POST',
        data: {
            editId: editId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            $('#editid').val(response.brand_id);
            $('#editProductName').val(response.brand_name);
            
           
                    },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    }

        //Edit Student Ajax


document.addEventListener('DOMContentLoaded', function() {
    $('#editProduct').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

        var formData = new FormData(this);
        $.ajax({
            url: "action/actProduct.php",
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
                      $('#editProductModal').modal('hide'); // Close the modal
                        
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
                    text: 'An error occurred while Edit Product data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });
    });


    function goDeleteProduct(id)
        {
    //alert(id);
    if(confirm("Are you sure you want to delete Product ?"))
    {
      $.ajax({
        url: 'action/actProduct.php',
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



