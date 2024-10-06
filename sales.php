<?php
session_start();

  include "class.php";
    
    $stock_result = stockTable(); // Call the function to fetch products 
    
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>
<body>
    <!-- Begin page -->
    <div class="wrapper">

        
        <!-- ========== Topbar Start ========== -->
        <?php include "top.php" ?>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

        <?php include "left.php"; ?>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        
        <div class="content-page">
            <div class="content">

            <div class="modal fade" id="invoiceDetailsModal" tabindex="-1" aria-labelledby="invoiceDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="invoiceDetailsModalLabel">Bill Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="invoiceDetailsBody">
        <!-- Invoice details will be loaded here via AJAX -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
                <!-- Start Content-->
                <div class="container-fluid" id="ProductContent">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="bg-flower">
                                <img src="assets/images/flowers/img-3.png">
                            </div>

                            <div class="bg-flower-2">
                                <img src="assets/images/flowers/img-1.png">
                            </div>
        
                            <div class="page-title-box">
                                
                                <h3 class="page-title">Sales List</h3>   
                            </div>
                        </div>
                    </div>

                                    <!-- Modal for displaying invoice details -->


             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Costomer Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Amount</th> 
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
                   // Query to fetch invoices with active status
                            $query = "
                                SELECT 
                                    invoice_id, 
                                    customer_name, 
                                    customer_phone, 
                                    products, 
                                    total_price 
                                FROM 
                                    invoice_tbl 
                                WHERE 
                                    invoice_status = 'Active' 
                                ORDER BY 
                                    invoice_id DESC;
                            ";

                            $result = mysqli_query($conn, $query);
                            $serialNumber = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                            $products = json_decode($row['products'], true); // Decode JSON products data

                            foreach ($products as $product) {
                                $brandName = $product['brand'];  
                                $modelName = $product['model'];     // Extract brand from JSON
                                $productName = $product['product'];  // Extract product name from JSON
                                $amount = $product['total'];         // Extract amount from JSON

                                echo "<tr class='bg-light'>
                                        <td>{$serialNumber}</td>
                                        <td>{$row['customer_name']}</td>
                                        <td>{$row['customer_phone']}</td>
                                        <td>{$brandName} {$modelName}</td>
                                        <td>{$productName}</td>
                                        <td>{$amount}</td>
                                        <td>
                                            <!-- Add actions such as View, Edit, or Delete here -->
                                           <button class='btn btn-primary btn-sm' onclick='viewInvoiceDetails({$row['invoice_id']})'>
                                            <i class='bi bi-eye-fill'></i></button>
                                         <button class='btn btn-warning btn-sm' onclick=\"window.location.href='generate_pdf.php?invoice_id={$row['invoice_id']}'\">Download</button>
                                            
                                        </td>
                                    </tr>";
                                $serialNumber++;
                            }
                            }
                                                ?>
                    </tbody>
                  </table>

                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div> <!-- end row-->


    

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include "footer.php"; ?>
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
    <script>

function viewInvoiceDetails(invoiceId) {
    // Fetch invoice details via AJAX
    $.ajax({
        url: 'action/actSales.php', // PHP script to fetch invoice details
        type: 'GET',
        data: { invoice_id: invoiceId },
        dataType: 'html', // Expect HTML response
        success: function(response) {
            // Load the response into the modal body
            $('#invoiceDetailsBody').html(response);
            // Show the modal
            $('#invoiceDetailsModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching invoice details:', error);
        }
    });
}

      $('#brand').change(function() {
        var brandId = $(this).val();
        
        if (brandId === "") {
            $('#modelName').html('<option value="">--Select the Model--</option>'); // Clear the course dropdown
            return; // No university selected, exit the function
        }

        $.ajax({
            url: "action/actStock.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { brand: brandId },
            dataType: 'json',
            success: function(response) {
                
                var options = '<option value="">--Select the Model--</option>';
                
                 // Loop through each course in the response and append to options
                 $.each(response, function(index, course) {
                    options += '<option value="' + course.mod_id + '">' + course.mod_name + '</option>';
                });
                $('#modelName').html(options); // Update the course dropdown
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });


    $('#brandEdit').change(function() {
        var brandId = $(this).val();
        
        if (brandId === "") {
            $('#editModelName').html('<option value="">--Select the Model--</option>'); // Clear the course dropdown
            return; // No university selected, exit the function
        }

        $.ajax({
            url: "action/actStock.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { brand: brandId },
            dataType: 'json',
            success: function(response) {
                
                var options = '<option value="">--Select the Model--</option>';
                
                 // Loop through each course in the response and append to options
                 $.each(response, function(index, course) {
                    options += '<option value="' + course.mod_id + '">' + course.mod_name + '</option>';
                });
                $('#editModelName').html(options); // Update the course dropdown
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });
    </script>


  <script>

    
    $(document).ready(function () {

     

      $('#addProductBtn').click(function() {

      $('#addProduct').removeClass('was-validated');
      $('#addProduct').addClass('needs-validation');
      $('#addProduct')[0].reset(); // Reset the form

      });

      $('#backButton').click(function() {
        $('#productView').addClass('d-none');
        $('#ProductContent').show();
    });
  
  $('#addProduct').off('submit').on('submit', function(e) {
    e.preventDefault(); 

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

            var formData = new FormData(form);

    $.ajax({
      url: "action/actStock.php",
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
});


function goEditStock(editId) {
    $.ajax({
        url: 'action/actStock.php',
        method: 'POST',
        data: {
            editId: editId
        },
        dataType: 'json', // Expecting JSON response
        success: function(response) {
            $('#editProduct').removeClass('was-validated');
            $('#editProduct').addClass('needs-validation');
            $('#editProduct')[0].reset(); // Reset the form
            
            // Assign the response data to variables
            var brandId = response.brand_id; // Assign correctly

            // First AJAX call for model options based on brand
            $.ajax({
                url: "action/actStock.php",
                type: "POST",
                data: { brand: brandId },
                dataType: 'json',
                success: function(modelResponse) {
                    // Populate the models dropdown
                    var options = '<option value="">--Select the Model--</option>';
                    $.each(modelResponse, function(index, model) {
                        options += '<option value="' + model.mod_id + '">' + model.mod_name + '</option>';
                    });
                    $('#editModelName').html(options); // Update the models dropdown
                    
                    // After populating the dropdown, set the selected value
                    $('#editModelName').val(response.model_id);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request for model data failed: " + status + ", " + error);
                }
            });

            // Set the other form fields
            $('#productIdEdit').val(response.stock_id);
            $('#brandEdit').val(brandId); // Brand ID
            $('#editModelName').val(response.model_id); // model ID
            $('#productNameEdit').val(response.product_id);
            $('#quantityEdit').val(response.product_quantity);
            $('#priceEdit').val(response.product_price);
            $('#placeEdit').val(response.place);
            $('#emiNoEdit').val(response.emi_no);
        },
        error: function(xhr, status, error) {
            console.error('AJAX request failed:', status, error);
        }
    });
}

function goDeleteStock(id)
{
    if(confirm("Are you sure you want to delete Product?"))
    {
      $.ajax({
        url: 'action/actStock.php',
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

function goViewStock(id)
{
    $.ajax({
        url: 'action/actStock.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          
          $('#ProductContent').hide();
          $('#productView').removeClass('d-none');
        
          $('#productNameView').text(response.ProductNameView);
          $('#modelView').text(response.modelView);
          $('#quantityView').text(response.quantityView);
          $('#priceView').text(response.priceView);
          $('#placeView').text(response.placeView);
          $('#emiView').text(response.emiView);
          $('#brandView').text(response.brandNameView);
          

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}



document.addEventListener('DOMContentLoaded', function() {
    $('#editProduct').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

            var formData = new FormData(form);
        $.ajax({
            url: "action/actStock.php",
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
                    text: 'An error occurred while Edit staff data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });
});


</script>
    

</body>

</html>



