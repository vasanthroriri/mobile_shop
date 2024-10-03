<?php
session_start();
    include "class.php" ;
    
    $selQuery = "SELECT * FROM `jeno_staff` WHERE stf_status='Active'";
    $resQuery = mysqli_query($conn , $selQuery); 
    
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

            <?php include "formStaff.php" ;?> <!---add Staff popup--->
                <!-- Start Content-->
                <div class="container-fluid" id="StaffContent">

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
                                        <button type="button" id="addStaffBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                                            Add New Staff
                                        </button>
                                    </div>
                                </div>
                                <h3 class="page-title">Staff</h3>   
                            </div>
                        </div>
                    </div>

             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Date of Joining</th>
                                    <th scope="col">Email ID</th> 
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; while($row = mysqli_fetch_array($resQuery , MYSQLI_ASSOC)) { 
                        $id = $row['stf_id'];  
                        $stf_name = $row['stf_name'];
                        $stf_mobile=$row['stf_mobile']; 
                        $stf_role = $row['stf_role'];  
                        $stf_joining_date  = $row['stf_joining_date']; 
                        $stf_email = $row['stf_email'];  

                        $date = new DateTime($stf_joining_date);
                        $formattedDate = $date->format('d-m-Y');
                        ?>
                     <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $stf_name; ?></td>
                        <td><?php echo $stf_mobile; ?></td>
                        <td><?php echo $stf_role; ?></td>
                        <td><?php echo $formattedDate; ?></td>
                        <td><?php echo $stf_email; ?></td>
                    
                        <td>
                            <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="goEditStaff(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editStaffModal"><i class='bi bi-pencil-square'></i></button>
                            <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewStaff(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteStaff(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
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

    // Function to set the max attribute to today's date
    function setMaxDate() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('dateofjoin').setAttribute('max', today);
            document.getElementById('dateofjoinEdit').setAttribute('max', today);
        }

        // Call setMaxDate when the window loads
        window.onload = setMaxDate;

        document.addEventListener('DOMContentLoaded', (event) => {
    const dobInput = document.getElementById('dob');
    const dobInput1 = document.getElementById('dobEdit');
    const today = new Date();
    const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
    const maxDate = eighteenYearsAgo.toISOString().split('T')[0];
    dobInput.setAttribute('max', maxDate);
    dobInput1.setAttribute('max', maxDate);
    });

    </script>

  <script>

    
    $(document).ready(function () {

     

      $('#addStaffBtn').click(function() {

      $('#addStaff').removeClass('was-validated');
      $('#addStaff').addClass('needs-validation');
      $('#username').removeClass('is-invalid is-valid');
      $('#addStaff')[0].reset(); // Reset the form

      });

      $('#backButton').click(function() {
        $('#staffView').addClass('d-none');
        $('#StaffContent').show();
    });
  
  $('#addStaff').off('submit').on('submit', function(e) {
    if (!isUsernameValid) {
        e.preventDefault();
        $('#username').focus(); // Set focus to the invalid input
        return false;
    }

    e.preventDefault(); 

    var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

            var formData = new FormData(form);

    $.ajax({
      url: "action/actStaff.php",
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
            $('#addStaffModal').modal('hide');
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
          text: 'An error occurred while adding Staff data.'
        });
        // Re-enable the submit button on error
        $('#submitBtn').prop('disabled', false);
      }
    });
  });


  var isUsernameValid = true; // Flag to track username validity

$('#username').on('input', function() {
    var username = $(this).val();
    if (username.length > 0) {
        $.ajax({
            url: 'check_username.php',
            type: 'post',
            data: { username: username },
            success: function(response) {
              if (response == "exists") {
                    $('#username').removeClass('is-valid').addClass('is-invalid');
                    isUsernameValid = false; // Set the flag to false if the username exists
                } else {
                    $('#username').removeClass('is-invalid').addClass('is-valid');
                    isUsernameValid = true; // Set the flag to true if the username is valid
                }
            }
        });
    } else {
        $('#username').removeClass('is-invalid is-valid');
        isUsernameValid = true; // Reset the flag if the input is empty
    }
});

});


function goEditStaff(editId)
{ 
      $.ajax({
        url: 'action/actStaff.php',
        method: 'POST',
        data: {
          editId: editId
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {

          $('#editStaff').removeClass('was-validated');
          $('#editStaff').addClass('needs-validation');
          $('#editStaff')[0].reset(); // Reset the form

          $('#staffId').val(response.stfId);
          $('#staffNameEdit').val(response.name);
          $('#dobEdit').val(response.birth);
          $('#mobileEdit').val(response.mobile);
          $('#emailEdit').val(response.email);
          $('#addressEdit').val(response.address);
          $('#genderEdit').val(response.gender);
          $('#designationEdit').val(response.role);
          $('#salaryEdit').val(response.salary);
          $('#dateofjoinEdit').val(response.joining_date);
          $('#editLocation').val(response.sft_center_id);
          $('#usernameEdit').val(response.username).prop('disabled', true);
          $('#passwordEdit').val(response.password);
          // Remove the 'required' attribute from the aadhar field
          $('#aadharEdit').removeAttr('required');
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    
}

function goDeleteStaff(id)
{
    if(confirm("Are you sure you want to delete Staff?"))
    {
      $.ajax({
        url: 'action/actStaff.php',
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

function goViewStaff(id)
{
    $.ajax({
        url: 'action/actStaff.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          
          $('#StaffContent').hide();
          $('#staffView').removeClass('d-none');
        
          $('#staffNameView').text(response.nameView);
          $('#dobView').text(response.birthView);
          $('#mobileView').text(response.mobileView);
          $('#emailView').text(response.emailView);
          $('#addressView').text(response.addressView);
          $('#genderView').text(response.genderView);
          $('#designationView').text(response.roleView);
          $('#salaryView').text(response.salaryView);
          $('#dateofjoinView').text(response.joining_dateView);
          $('#usernameView').text(response.usernameView);
          $('#passwordView').text(response.passwordView);
          $('#viewLocation').text(response.center_name);

          var aadharImageUrl = 'assets/images/staff/' + response.aadharView;

            // Create a link for the Aadhar card
            $('#aadharView')
                .attr('href', aadharImageUrl)
                .attr('target', '_blank')
                .text('View Aadhar Card');

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}



document.addEventListener('DOMContentLoaded', function() {
    $('#editStaff').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

            var formData = new FormData(form);
        $.ajax({
            url: "action/actStaff.php",
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
                      $('#editStaffModal').modal('hide'); // Close the modal
                        
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



