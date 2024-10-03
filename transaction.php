<?php
session_start();
include("class.php");
    $centerId = $_SESSION['centerId'];
    $transactionResult = transactionTable($centerId);
    $current_date = date('Y-m-d');
    // Create a DateTime object for the current date
    $date = new DateTime($current_date);

    // Subtract one day from the current date
    $date->modify('-1 day');

    // Get the modified date in 'Y-m-d' format
    $previous_date = $date->format('Y-m-d');
    $openingBalance = getTransactionAmounts($centerId,$previous_date);
    
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

        <?php include("left.php"); ?>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        
        <div class="content-page">
            <div class="content">
            <?php include("formTransaction.php");?>

                <!-- Start Content-->
                <div class="container-fluid" id="StuContent">

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
                            <div class="page-title-right">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" id="addEnquiryBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addaddTransactionModal">
                                            Add New Transaction
                                        </button>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                <h3 class="page-title col-2">Transaction</h3> 
                                <h4 class="col-6 mt-4 text-success">Today Opening Balance - Cash : <span class="text-info"><?php echo $openingBalance['online_total'] ?></span> Online : <span class="text-info"><?php echo $openingBalance['cash_total'] ?></span></h4>
                                </div>
                                
                               
                            </div>
                        </div>
                    </div>

             
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Transaction Type</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php  

                        $i =1;

                        while ($row = $transactionResult->fetch_assoc()) {
                            $id = $row['tran_id'];
                            $date = new DateTime($row['tran_date']);
                            $formattedDate = $date->format('d-m-Y');

                        ?>

                    
                     <tr>
                        <td><?php echo $i ; $i++ ?></td>
                        <td><?php echo $row['tran_category'] ?></td>
                        <td><?php echo $row['tran_reason'] ?></td>
                        <td><?php echo $row['tran_amount'] ?></td>
                        <td><?php echo $formattedDate ?></td>
                        <td><?php echo $row['tran_method'] ?></td>
                    
                        <td>
                        <?php if ($user_role == 'Admin') { ?>
                            <button  class="btn btn-circle btn-warning text-white modalBtn" onclick="editTran(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editExpenseModal"><i class='bi bi-pencil-square'></i></button>
                               <button onclick="goViewTransaction(<?php echo $id; ?>);" class="btn btn-circle btn-success text-white modalBtn" ><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteTransaction(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
                            <?php } else { ?>
                            <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewTransaction(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
                            <?php } ?>
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

<script>

    // Function to set the max attribute to today's date
    function setMaxDate() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('date').setAttribute('max', today);
            document.getElementById('editDate').setAttribute('max', today);
        }

        // Call setMaxDate when the window loads
        window.onload = setMaxDate;

      

    </script>

    <script>

    
            // Function to handle editing a transaction
            function editTran(editId) {
                $.ajax({
                    url: 'action/actTransaction.php',
                    method: 'POST',
                    data: { editId: editId },
                    dataType: 'json', // Specify the expected data type as JSON
                    success: function(response) {
                        console.log(response); // Debugging console log
                        $('#editTransactionId').val(response.tran_id);
                        $('#editCategory').val(response.tran_category);
                        $('#editIncomeReasonInput').val(response.tran_reason);
                        $('#editDate').val(response.tran_date);
                        $('#editAmount').val(response.tran_amount);
                        $('#editPaidMethod').val(response.tran_method);
                        $('#editTranId').val(response.tran_transaction_id);
                        $('#editDescription').val(response.tran_description);


            //             if (response.tran_reason) {
            //     $('#editExpenseReason').show();
            //     $('#editexpenseReasonInput').val(response.tran_reason);
            // } else {
            //     $('#editExpenseReason').hide();
            //     $('#editexpenseReasonInput').val(''); // Clear the field
            // }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request failed:', status, error); // Debugging console log
                    }
                });
            }
  




             //Edit update Enquiry form Ajax


document.addEventListener('DOMContentLoaded', function() {
    $('#editTransaction').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        $.ajax({
            url: "action/actTransaction.php",
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
                      $('#editExpenseModal').modal('hide'); // Close the modal
                        
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
                    text: 'An error occurred while Edit Enquiry data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });
    });





  


 
</script>

  <script>

      $('#addEnquiryBtn').click(function() {

      $('#addTransaction').removeClass('was-validated');
      $('#addTransaction').addClass('needs-validation');
      $('#addTransaction')[0].reset(); // Reset the form
      // $('#fessType').val('');

      });

      $('#backButtonTransaction').click(function() {
      $('#transactionView').addClass('d-none');
      $('#StuContent').show();

      });


       // Ajax form submission
     $('#addTransaction').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }
            
            var formData = new FormData(this);

            $.ajax({
                url: 'action/actTransaction.php',
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
            $('#addaddTransactionModal').modal('hide');
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
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    alert('Error adding Enquiry: ' + textStatus);
                }
            });
        });



        
        
    //----delete ---
    function goDeleteTransaction(id)
        {
    //alert(id);
    if(confirm("Are you sure you want to delete Transaction?"))
    {
      $.ajax({
        url: 'action/actTransaction.php',
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

        
          

     //------view page -----------------------------


     function goViewTransaction(id)
{
    //location.href = "clientDetail.php?clientId="+id;
    $.ajax({
        url: 'action/actTransaction.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          
          $('#StuContent').hide();
          $('#transactionView').removeClass('d-none');
        
          $('#viewCategory').text(response.tran_category);
          $('#viewExpenseReason').text(response.tran_reason);
          $('#viewDate').text(response.tran_date);
          $('#viewAmount').text(response.tran_amount);
          $('#viewPaidMethod').text(response.tran_method);
          $('#viewTransactionId').text(response.tran_transaction_id);
          $('#viewDescription').text(response.tran_description);

        // Show the receipt div and update the href attribute if the category is 'Income'
         if (response.tran_category === 'Income') {
                $('#incomeReceiptDiv').removeClass('d-none'); // Show the div and remove d-none class
                $('#incomeReceipt').attr('href', 'action/actIncomeReceipt.php?tran_id=' + response.tran_id);
            } else{
                $('#incomeReceiptDiv').addClass('d-none'); // Show the div and remove d-none class
            }
    

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}




          


  </script> 

    

    

</body>

</html>



