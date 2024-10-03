<?php
session_start();
    
    include "class.php";
    $curseId = $_SESSION['centerId'];
    $course_result = courseTable($curseId); 
    
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
            <?php include "formClgCourse.php" ;?>

                <!-- Start Content-->
                <div class="container-fluid" id="courseContent">

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
                                        <button type="button" id="addCourseBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                                            Add New Course
                                        </button>
                                    </div>
                                </div>
                                <h4 class="page-title">Courses List</h4>   
                            </div>
                        </div>
                    </div>

                    
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">University</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Exam Type</th>
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody> 
                      <?php

                    $i =1;

              while ($row = $course_result->fetch_assoc()) {
                  $id = $row['cou_id'];
                  

              ?>  
                      <tr>
                      <td ><?php echo $i ; $i++ ?></td>
                        <td><?php echo $row['uni_name'] ?></td>
                        <td><?php echo $row['cou_name'] ?></td>
                        <td><?php echo $row['cou_duration'] ." Years" ?></td>
                        <td><?php echo $row['cou_exam_type'] ?></td>
                    
                        <td>
                        <?php if ($user_role == 'Admin') { ?>
                            <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="editCourse(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editCourseModal"><i class='bi bi-pencil-square'></i></button>
                            <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewCourse(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteCourse(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="editCourse(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editCourseModal"><i class='bi bi-pencil-square'></i></button>
                                <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewCourse(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
                           <?php } ?>
                        </td>
                      </tr> 
                      <?php }  ?>  

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
      
      $('#addCourseBtn').click(function() {

        $('#addCourse').removeClass('was-validated');
        $('#addCourse').addClass('needs-validation');
        $('#addCourse')[0].reset(); // Reset the form
        $('#additionalInputs').empty();
        
    });

    $('#backButtoncourse').click(function() {
        $('#CourseView').addClass('d-none');
        $('#courseContent').show();

    });


    $(document).ready(function () {
 

  $('#addCourse').off('submit').on('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    
    var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

    var formData = new FormData(this);
    $.ajax({
      url: "action/actCourse.php",
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
            
                    $('#addCourseModal').modal('hide');
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
          text: 'An error occurred while adding Student data.'
        });
        // Re-enable the submit button on error
        $('#submitBtn').prop('disabled', false);
      }
    });
  });
  });

      // edit function -------------------------
function editCourse(editId) {
    // alert("afa");
    $('#editCourse').removeClass('was-validated');
    $('#editCourse').addClass('needs-validation');

    $.ajax({
        url: 'action/actCourse.php',
        method: 'POST',
        data: {
            editId: editId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            $('#editCouseId').val(response.cou_id);
            $('#editUniversity').val(response.cou_uni_id);
            $('#editCourseName').val(response.cou_name);
            $('#editMedium').val(response.cou_medium);
            $('#editExamType').val(response.cou_exam_type);
            $('#editFessType').val(response.cou_fees_type);
            $('#ediDuration').val(response.cou_duration);

            
        // Clear previous input fields
$('#editCourseInputs').empty();

// Assuming cou_university_fess, cou_study_fees, and cou_total_fees arrays are of equal length and matched by index
if (Array.isArray(response.cou_university_fess) && Array.isArray(response.cou_study_fees) && Array.isArray(response.cou_total_fees)) {
    response.cou_university_fess.forEach(function(universityFee, index) {
        var studyFee = response.cou_study_fees[index];
        var totalFee = response.cou_total_fees[index];

        
        var newInputDiv = $('<div class="row mb-3"></div>'); // Added mb-3 class for some margin

        var input1Div = $('<div class="col-sm-4"></div>');
        var input1Label = $('<label class="form-label"><b>University Fees</b></label>');
        var input1 = $('<input type="number" class="form-control university-fees" name="editUniversityFees[]" required>').val(universityFee);
        input1Div.append(input1Label);
        input1Div.append(input1);

        var input2Div = $('<div class="col-sm-4"></div>');
        var input2Label = $('<label class="form-label"><b>Study Center Fees</b></label>');
        var input2 = $('<input type="number" class="form-control study-center-fees" name="editStudyFees[]" required>').val(studyFee);
        input2Div.append(input2Label);
        input2Div.append(input2);

        var input3Div = $('<div class="col-sm-4"></div>');
        var input3Label = $('<label class="form-label"><b>Total Fees</b></label>');
        var input3 = $('<input type="number" class="form-control total-fees" name="editTotalFees[]" readonly required>').val(totalFee);
        input3Div.append(input3Label);
        input3Div.append(input3);

        newInputDiv.append(input1Div);
        newInputDiv.append(input2Div);
        newInputDiv.append(input3Div);
        
        $('#editCourseInputs').append(newInputDiv);

        // Add event listeners to update total fees
        (function(input1, input2, input3) {
            input1.add(input2).on('input', function() {
                var universityFees = parseFloat(input1.val()) || 0;
                var studyCenterFees = parseFloat(input2.val()) || 0;
                input3.val(universityFees + studyCenterFees);
            });
        })(input1, input2, input3);
                });
            } else {
                // If not arrays or lengths do not match, handle the error accordingly
                console.error('Department and contact arrays are not properly matched.');
            }
                    },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}





    //Edit Update Course Ajax


document.addEventListener('DOMContentLoaded', function() {
    $('#editCourse').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        $('#editFessType').prop('disabled', false);
        $('#ediDuration').prop('disabled', false);
        

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }


        var formData = new FormData(this);
        $.ajax({
            url: "action/actCourse.php",
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
                      $('#editCourseModal').modal('hide'); // Close the modal
                        
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
                    text: 'An error occurred while Edit Course data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });
    });



    
    function goViewCourse(id) 
    {
    //   alert('sdafda');
    //location.href = "clientDetail.php?clientId="+id;
    $.ajax({
        url: 'action/actCourse.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          
          $('#courseContent').hide();
          $('#CourseView').removeClass('d-none');
        
          $('#viewUniversityName').text(response.cou_uni_id);
          $('#viewCourseName').text(response.cou_name);
          $('#viewMedium').text(response.cou_medium);
          $('#viewExamType').text(response.cou_exam_type);
          $('#viewFeesType').text(response.cou_fees_type);
          $('#viewDuration').text(response.cou_duration + " " + response.cou_fees_type);

     // Clear previous input fields
     $('#viewCourseInputs').empty();

             // Check if cou_university_fess and cou_study_fees are arrays
             if (Array.isArray(response.cou_university_fess) && Array.isArray(response.cou_study_fees)) {
                let duration = parseInt(response.cou_duration, 10); // Convert duration to integer
                let feeType = response.cou_fees_type; // Get the fee type (Year/Semester)

                // Calculate and display fees
                for (let i = 1; i <= duration; i++) {
                    let universityFee = 0;
                    let studyCenterFee = 0;

                    if (feeType === 'Year') {
                        universityFee = response.cou_university_fess[i - 1] ?? 0;
                        studyCenterFee = response.cou_study_fees[i - 1] ?? 0;
                    } else if (feeType === 'Semester') {
                        universityFee = response.cou_university_fess[(i - 1) * 2] ?? 0 + response.cou_university_fess[(i - 1) * 2 + 1] ?? 0;
                        studyCenterFee = response.cou_study_fees[(i - 1) * 2] ?? 0 + response.cou_study_fees[(i - 1) * 2 + 1] ?? 0;
                    }

                    var newInputDiv = $('<div class="row mb-3"></div>'); // Added mb-3 class for some margin

                    var input1Div = $('<div class="col-sm-4"></div>');
                    var input1Card = $('<div class="card p-3"></div>');
                    var input1Label1 = $('<h5> ' + i + ' ' + feeType + '</h5>');
                    var input1Label = $('<h4>University Fees for </h4>');
                    var input1 = $('<span class="detail"></span>').text('₹ ' + parseFloat(universityFee).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                    input1Card.append(input1Label1);
                    input1Card.append(input1Label);
                    input1Card.append(input1);
                    input1Div.append(input1Card);

                    var input2Div = $('<div class="col-sm-4"></div>');
                    var input2Card = $('<div class="card p-3"></div>');
                    var input2Label1 = $('<h5> ' + i + ' ' + feeType + '</h5>');
                    var input2Label = $('<h4>Study Center Fees for </h4>');
                    var input2 = $('<span class="detail"></span>').text('₹ ' + parseFloat(studyCenterFee).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                    input2Card.append(input2Label1);
                    input2Card.append(input2Label);
                    input2Card.append(input2);
                    input2Div.append(input2Card);

                    newInputDiv.append(input1Div);
                    newInputDiv.append(input2Div);

                    // Calculate the total fees
                    var totalFees = parseFloat(universityFee) + parseFloat(studyCenterFee);

                    // Create the total fees div
                    var totalFeesDiv = $('<div class="col-4 mt-3"></div>');
                    var totalFeesCard = $('<div class="card p-3"></div>');
                    var totalFeesLabel = $('<h4>Total Fees</h4>');
                    var totalFeesSpan = $('<span class="detail"></span>').text('₹ ' + parseFloat(totalFees).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                    totalFeesCard.append(totalFeesLabel);
                    totalFeesCard.append(totalFeesSpan);
                    totalFeesDiv.append(totalFeesCard);

                    // Append the total fees div to the new input div
                    newInputDiv.append(totalFeesDiv);

                    $('#viewCourseInputs').append(newInputDiv);
                }
            } else {
                // If not arrays or lengths do not match, handle the error accordingly
                console.error('Fees and contact arrays are not properly matched.');
            }

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    }



    function goDeleteCourse(id)
        {
    //alert(id);
    if(confirm("Are you sure you want to delete Course?"))
    {
      $.ajax({
        url: 'action/actCourse.php',
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

  


<script>
    $(document).ready(function() {
        $('#duration, #fessType').on('input change', function() {
            $('#additionalInputs').empty(); // Clear previous inputs
            var duration = parseInt($('#duration').val()) || 0;
            var graduationType = $('#fessType').val();
            
            var totalSemesters = (graduationType === 'Semester') ? duration * 2 : duration;

            for (var i = 1; i <= totalSemesters; i++) {
                var yearText;
                if (graduationType === 'Semester') {
                    yearText = 'Semester ' + i;
                } else {
                    switch (i) {
                        case 1:
                            yearText = '1st Year';
                            break;
                        case 2:
                            yearText = '2nd Year';
                            break;
                        case 3:
                            yearText = '3rd Year';
                            break;
                        default:
                            yearText = i + 'th Year';
                            break;
                    }
                }

                var newInputDiv = $('<div class="row m-2"></div>');

                var yearDiv = $('<div class="col-sm-12"><label class="form-label"><b>' + yearText + '</b></label></div>');

                var input1Div = $('<div class="col-sm-4"></div>');
                var input1Label = $('<label class="form-label"><b>University Fees</b></label>');
                var input1 = $('<input type="number" class="form-control university-fees" name="universityFees[]" placeholder="Enter University Fees" required>');
                input1Div.append(input1Label);
                input1Div.append(input1);

                var input2Div = $('<div class="col-sm-4"></div>');
                var input2Label = $('<label class="form-label"><b>Study Center Fees</b></label>');
                var input2 = $('<input type="number" class="form-control study-center-fees" name="studyCenterFees[]" placeholder="Enter Study Center Fees" required>');
                input2Div.append(input2Label);
                input2Div.append(input2);

                var input3Div = $('<div class="col-sm-4"></div>');
                var input3Label = $('<label class="form-label"><b>Total Fees</b></label>');
                var input3 = $('<input type="number" class="form-control total-fees" name="totalFees[]" readonly placeholder="Total Fees" required>');
                input3Div.append(input3Label);
                input3Div.append(input3);

                newInputDiv.append(yearDiv);
                newInputDiv.append(input1Div);
                newInputDiv.append(input2Div);
                newInputDiv.append(input3Div);

                $('#additionalInputs').append(newInputDiv);

                // Add event listeners to update total fees
                (function(input1, input2, input3) {
                    input1.add(input2).on('input', function() {
                        var universityFees = parseFloat(input1.val()) || 0;
                        var studyCenterFees = parseFloat(input2.val()) || 0;
                        input3.val(universityFees + studyCenterFees);
                    });
                })(input1, input2, input3);
            }
        });
    });
</script>




</body>

</html>



