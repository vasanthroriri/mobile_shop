<?php
session_start();

  include "class.php";
    
    // $stock_result = stockTable(); // Call the function to fetch products 
    
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>
<body>
<style>
.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
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
    $productDetails = ""; // Initialize a string to store product details
    $tooltipContent = ""; // Tooltip content for full product details

    foreach ($products as $product) {
        $brandName = $product['brand'];
        $modelName = $product['model'];
        $productName = $product['product'];
        $amount = $product['total'];

        // Add each product's details to the tooltip
        $tooltipContent .= "$brandName $modelName: $productName - $amount\n";

        // Concatenate product details for truncated display
        $productDetails .= "<div><strong>$brandName $modelName</strong>: $productName - $amount</div>";
    }

    // Output one row per invoice
    echo "<tr class='bg-light'>
        <td>{$serialNumber}</td>
        <td>{$row['customer_name']}</td>
        <td>{$row['customer_phone']}</td>
        <td>
            <div 
                class='text-truncate' 
                style='max-width: 200px;' 
                data-bs-toggle='tooltip' 
                data-bs-placement='top' 
                title='" . htmlspecialchars($tooltipContent) . "'>
                $productDetails
            </div>
        </td>
        <td>{$row['total_price']}</td>
        <td>
            <button class='btn btn-primary btn-sm' onclick='viewInvoiceDetails({$row['invoice_id']})'>
                <i class='bi bi-eye-fill'></i>
            </button>
            <button class='btn btn-warning btn-sm' onclick=\"window.open('generate_pdf.php?invoice_id={$row['invoice_id']}', '_blank')\">Download</button>
        </td>
    </tr>";

    $serialNumber++;
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
    
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> -->
  <script src="js/sweetalert.js"></script>

    <!-- Datatable Demo Aapp js -->
    <script src="assets/js/pages/demo.datatable-init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
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
  

});









</script>
    

</body>

</html>



