<?php
session_start();
    include("db/dbConnection.php");
    $centerId = $_SESSION['centerId'];
    
    $selQuery = "SELECT 
    a.*
    , b.fac_name
    , c.cou_name 
    FROM `jeno_schedule` AS a
    LEFT JOIN jeno_faculty AS b
    ON a.sch_fac_id = b.fac_id 
    LEFT JOIN jeno_course AS c
    ON a.sch_cou_id = c.cou_id 
    WHERE a.sch_status = 'Active' AND a.sch_center_id = $centerId";
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

            <?php include "formSchedule.php";?> <!---add formSchedule popup--->

                <!-- Start Content-->
                <div class="container-fluid" id="ScheduleContent">

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
                                        <button type="button" id="addScheduleBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                                            Add New Schedule
                                        </button>
                                    </div>
                                </div>
                                <h3 class="page-title">Schedules</h3>   
                            </div>
                        </div>
                    </div>             
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Faculty Name</th>
                                    <th scope="col">Schedule Date</th>
                                    <th scope="col">Session</th>
                                    <th scope="col">Timing</th>
                                    <th scope="col">Course</th> 
                                    <th scope="col">Subject</th>
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i=1; while($row = mysqli_fetch_array($resQuery , MYSQLI_ASSOC)) { 
                        $id = $row['sch_id'];  $name = $row['fac_name']; 
                        $date = $row['sch_date']; $session=$row['sch_session'];  
                        $timing = $row['sch_timing'];  $course  = $row['cou_name']; $subject = $row['sch_sub_id']; 
                        $subject_names = json_decode($subject, true); // If it's JSON array
                        if (is_array($subject_names)) {
                            $subject = implode(', ', $subject_names); // Convert array to comma-separated string
                        } 
                        ?>
                     <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $session; ?></td>
                        <td><?php echo $timing; ?></td>
                        <td><?php echo $course; ?></td>
                        <td class="text-wrap"><?php echo $subject; ?></td>

                        <td>
                            <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="goEditSchedule(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editScheduleModal"><i class='bi bi-pencil-square'></i></button>
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteSchedule(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
                           
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

    <!--  Select2 Plugin Js -->
    <script src="assets/vendor/select2/js/select2.min.js"></script>

    <!-- Datatable Demo Aapp js -->
    <script src="assets/js/pages/demo.datatable-init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

<script>

$(document).ready(function () {

$('#addScheduleBtn').click(function() {

$('#addSchedule').removeClass('was-validated');
$('#addSchedule').addClass('needs-validation');
$('#addSchedule')[0].reset(); // Reset the form

});

$('#university').change(function() {
        var universityId = $(this).val();
        
        if (universityId === "") {
            $('#course').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
            return; // No university selected, exit the function
        }

        $.ajax({
            url: "action/actAdmission.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { university: universityId },
            dataType: 'json',
            success: function(response) {
                
                var options = '<option value="">--Select the Course--</option>';
                
                 // Loop through each course in the response and append to options
                 $.each(response, function(index, course) {
                    options += '<option value="' + course.cou_id + '">' + course.cou_name + '</option>';
                });
                $('#course').html(options); // Update the course dropdown
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });

$('#course').change(function() {
        var courseId = $(this).val();
        if (courseId === "") {
            $('#subject').html('<option value="">--Select the Subject--</option>'); // Clear the course dropdown
            return; // No university selected, exit the function
        }
            $.ajax({
                type: 'POST',
                url: 'action/actSchedule.php', // The PHP file that fetches the subjects
                data: {course_id: courseId},
                success: function(response) {
                    $('#subject').html(response);
                }
            });
       
    });

    $('#universityEdit').change(function() {
    var universityId = $(this).val();
    
    if (universityId === "") {
        $('#courseEdit').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
        return; // No university selected, exit the function
    }

    $.ajax({
        url: "action/actAdmission.php", // URL of the PHP script to handle the request
        type: "POST",
        data: { university: universityId },
        dataType: 'json',
        success: function(response) {
            
            var options = '<option value="">--Select the Course--</option>';
            
             // Loop through each course in the response and append to options
             $.each(response, function(index, course) {
                options += '<option value="' + course.cou_id + '">' + course.cou_name + '</option>';
            });
            $('#courseEdit').html(options); // Update the course dropdown
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed: " + status + ", " + error);
        }
    });
});

   
$('#addSchedule').off('submit').on('submit', function(e) {

  e.preventDefault(); 

  var form = this; // Get the form element
          if (form.checkValidity() === false) {
              // If the form is invalid, display validation errors
              form.reportValidity();
              return;
          }

          var formData = new FormData(form);

  $.ajax({
    url: "action/actSchedule.php",
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
          $('#addScheduleModal').modal('hide');
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
        text: 'An error occurred while adding Schedule data.'
      });
      // Re-enable the submit button on error
      $('#submitBtn').prop('disabled', false);
    }
  });
});


});

function goEditSchedule(editId) {
    $.ajax({
        url: 'action/actSchedule.php',
        method: 'POST',
        data: {
            editId: editId
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            $('#editSchedule').removeClass('was-validated');
            $('#editSchedule').addClass('needs-validation');
            $('#editSchedule')[0].reset(); // Reset the form

            $('#scheduleId').val(response.schId);
            $('#facultyNameEdit').val(response.name);
            $('#fromDateEdit').val(response.date);
            $('#sessionEdit').val(response.session);
            $('#timingEdit').val(response.timing);
            $('#universityEdit').val(response.uniId).trigger('change');
            setTimeout(function() {
            $('#courseEdit').val(response.couId);
            $('#courseEdit').trigger('change'); // This will trigger the change event to load subjects

            // Fetch subjects based on the selected course and set selected subjects
            $.ajax({
                type: 'POST',
                url: 'action/actSchedule.php', // PHP file to fetch subjects
                data: { course_id: response.couId },
                success: function(subjectsResponse) {
                    $('#subjectEdit').html(subjectsResponse); // Populate the multi-select dropdown

                    // Parse the JSON-encoded string to get the selected subjects
                    var selectedSubjects = JSON.parse(response.subId);
                    $('#subjectEdit').val(selectedSubjects).trigger('change');

                    $('#subjectEdit').select2(); // Reinitialize select2
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', status, error);
                }
            });
        }, 500)

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}


function goDeleteSchedule(id)
{
    if(confirm("Are you sure you want to delete Schedule?"))
    {
      $.ajax({
        url: 'action/actSchedule.php',
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
    $('#editSchedule').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

            var formData = new FormData(form);
        $.ajax({
            url: "action/actSchedule.php",
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
                      $('#editScheduleModal').modal('hide'); // Close the modal
                        
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
                    text: 'An error occurred while Edit Schedule data.'
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



