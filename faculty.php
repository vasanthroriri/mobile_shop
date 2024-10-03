<?php
session_start();
    include("db/dbConnection.php");
    $centerId = $_SESSION['centerId'];
    $selQuery = "SELECT 
    a.*
    , b.*
     FROM `jeno_faculty` AS a
      LEFT JOIN `jeno_course` AS b
       ON a.fac_cou_id = b.cou_id 
       WHERE a.fac_status = 'Active'
        AND a. 	fac_center_id = $centerId";

    $resQuery = mysqli_query($conn , $selQuery);
    
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

            <?php include "formFaculty.php";?> <!---add formFaculty popup--->

                <!-- Start Content-->
                <div class="container-fluid" id="FacContent">

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
                                        <button type="button" id="addFacultytBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addFacultyfModal">
                                            Add New Faculty
                                        </button>
                                    </div>
                                </div>
                                <h4 class="page-title">Faculties</h4>   
                            </div>
                        </div>
                    </div>
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Faculty Name</th>
                                    <th scope="col">Qualification</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th> 
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i=1; while($row = mysqli_fetch_array($resQuery , MYSQLI_ASSOC)) { 
                        $id = $row['fac_id'];  $name = $row['fac_name']; 
                        $qualification = $row['fac_qualification'];   $cou_name=$row['cou_name'];  
                        $email = $row['fac_email'];  $mobile  = $row['fac_mobile']; 
                        ?>
                     <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $qualification; ?></td>
                        <td><?php echo $cou_name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $mobile; ?></td>
      
                        <td>
                            <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="goEditFaculty(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editFacultyModal"><i class='bi bi-pencil-square'></i></button>
                            <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewFaculty(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteFaculty(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                      <?php
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

// Function to set the max attribute to today's date
function setMaxDate() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('dateofjoin').setAttribute('max', today);
        document.getElementById('dateofjoinEdit').setAttribute('max', today);
    }

    // Call setMaxDate when the window loads
    window.onload = setMaxDate;

</script>
    <script>

$(document).ready(function () {

  $('#addFacultytBtn').click(function() {

  $('#addFaculty').removeClass('was-validated');
  $('#addFaculty').addClass('needs-validation');
  $('#addFaculty')[0].reset(); // Reset the form

  });

  $('#backButton').click(function() {
    $('#facultyView').addClass('d-none');
    $('#FacContent').show();
  });
  

  $('#addFaculty').off('submit').on('submit', function(e) {

    e.preventDefault(); 

    var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

            var formData = new FormData(form);

    $.ajax({
      url: "action/actFaculty.php",
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
            $('#addFacultyfModal').modal('hide');
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
          text: 'An error occurred while adding Faculty data.'
        });
        // Re-enable the submit button on error
        $('#submitBtn').prop('disabled', false);
      }
    });
  });


});

function goEditFaculty(editId)
{ 
      $.ajax({
        url: 'action/actFaculty.php',
        method: 'POST',
        data: {
          editId: editId
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {

          $('#editFaculty').removeClass('was-validated');
          $('#editFaculty').addClass('needs-validation');
          $('#editFaculty')[0].reset(); // Reset the form

          $('#facultyId').val(response.facId);
          $('#staffNameEdit').val(response.name);
          $('#genderEdit').val(response.gender);
          $('#mobileEdit').val(response.mobile);
          $('#emailEdit').val(response.email);
          $('#addressEdit').val(response.address);
          $('#dateofjoinEdit').val(response.date_of_join);
          $('#salaryEdit').val(response.salary);
          $('#qualificationEdit').val(response.qualification);
          $('#clgNameEdit').val(response.clg);
          $('#courseEdit').val(response.cou_id);
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    
}

function goViewFaculty(id)
{
    $.ajax({
        url: 'action/actFaculty.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          
          $('#FacContent').hide();
          $('#facultyView').removeClass('d-none');
        
          $('#staffNameView').text(response.nameView);
          $('#mobileView').text(response.mobileView);
          $('#emailView').text(response.emailView);
          $('#addressView').text(response.addressView);
          $('#genderView').text(response.genderView);
          $('#qualificationView').text(response.qualificationView);
          $('#salaryView').text(response.salaryView);
          $('#dateofjoinView').text(response.date_of_joinView);
          $('#clgnameView').text(response.clgView);
          $('#courseView').text(response.cou_nameView);

          var aadharImageUrl = 'assets/images/faculty/' + response.aadharView;

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


function goDeleteFaculty(id)
{
    if(confirm("Are you sure you want to delete Faculty?"))
    {
      $.ajax({
        url: 'action/actFaculty.php',
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


document.addEventListener('DOMContentLoaded', function() {
    $('#editFaculty').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

            var formData = new FormData(form);
        $.ajax({
            url: "action/actFaculty.php",
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
                      $('#editFacultyModal').modal('hide'); // Close the modal
                        
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
                    text: 'An error occurred while Edit Faculty data.'
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



