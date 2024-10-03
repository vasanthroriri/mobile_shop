<?php
session_start();
    include("db/dbConnection.php");
    
    $selQuery = "SELECT student_tbl.*,
    additional_details_tbl.*,
    course_tbl.*
     FROM student_tbl
    LEFT JOIN additional_details_tbl on student_tbl.stu_id=additional_details_tbl.stu_id
    LEFT JOIN course_tbl on student_tbl.course_id=course_tbl.course_id
    WHERE student_tbl.stu_status = 'Active' and student_tbl.entity_id=1";
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
            <div id="studentDetail"></div>

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
                                          <button type="button" class="btn btn-primary mt-4" id="generatePdfBtn">Generate PDF</button>
                                          <button type="button" class="btn btn-success mt-4" id="generateExcelBtn">Generate Excel</button>
                                    </div>
                                </div>
                                <h4 class="page-title">Schedule</h4>  
                                <div class="row mt-3 mb-3">
                        <div class="col-md-2">
                            <label for="startDate" class="form-label">Start Date:</label>
                            <input type="date" class="form-control" id="startDate">
                        </div>
                        <div class="col-md-2">
                            <label for="endDate" class="form-label">End Date:</label>
                            <input type="date" class="form-control" id="endDate">
                        </div>
                        <div class="col-md-2">
                            <label for="startDate" class="form-label">Faculty</label>
                            <select id="universityFilter" class="form-control">
                            <option value="">All</option>
                            <option value="University1">Vasanth</option>
                            <option value="University2">Rajkumar</option>
                            <option value="University3">Anushiya</option>
                            <option value="University4">Subash</option>
                            <!-- Add more options as needed -->
                        </select>
                        </div>
                        <div class="col-md-2">
                            <label for="endDate" class="form-label">Subject</label>
                            <select id="universityFilter" class="form-control">
                            <option value="">All</option>
                            <option value="University1">Cloud Computing</option>
                            <option value="University2">Internet Protocol</option>
                            <option value="University3">Artificial Inteligence</option>
                            <option value="University4">POM</option>
                            <!-- Add more options as needed -->
                        </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary mt-4" id="searchBtn">Search</button>
                        </div>                        
                    </div> 
                            </div>
                        </div>
                    </div>

             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Faculty Name</th>
                                    <th scope="col">From Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Session</th>
                                    <th scope="col">Subject</th> 
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    // $i=1; while($row = mysqli_fetch_array($resQuery , MYSQLI_ASSOC)) { 
                    //     $id = $row['stu_id'];  $e_id = $row['entity_id']; $fname = $row['first_name'];$lname=$row['last_name'];  $blood = $row['stu_blood_group'];  $location  = $row['address']; $status = $row['stu_status'];  
                    //     $mobile=$row['phone'];$email=$row['email'];$cast=$row['stu_cast'];$religion=$row['stu_religion'];$mother_tongue=$row['stu_mother_tongue'];$native=$row['stu_native'];$image=$row['stu_image'];$course=$row['course_name'];         
                    //     $name=$fname.' '.$lname;
                        ?>
                     <tr>
                        <td>1</td>
                        <td>Vasanth</td>
                        <td>6-7-2024</td>
                        <td>8-7-2024</td>
                        <td>Morning</td>
                        <td>Web Development</td>
                      </tr>

                      <tr>
                        <td>2</td>
                        <td>Raj</td>
                        <td>6-7-2024</td>
                        <td>8-7-2024</td>
                        <td>Morning</td>
                        <td>Web Development</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>kathir</td>
                        <td>6-7-2024</td>
                        <td>8-7-2024</td>
                        <td>Morning</td>
                        <td>Web Development</td>
                      </tr>
                      <?php 
                    // }
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

$(document).ready(function () {
  $('#addStudentBtn').click(function () {
    $('#addStudentModal').modal('show'); // Show the modal
    resetForm('addStudent'); // Reset the form 
  });

function resetForm(formId) {
    document.getElementById(formId).reset(); // Reset the form
}

  
  $('#addStudent').off('submit').on('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    var formData = new FormData(this);
    $.ajax({
      url: "action/actStudent.php",
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
            resetForm('addStudent');
                    $('#addStudentModal').modal('hide');
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


//Edit Student Ajax


document.addEventListener('DOMContentLoaded', function() {
    $('#editStudent').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        $.ajax({
            url: "action/actStudent.php",
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
                      $('#editStudentModal').modal('hide'); // Close the modal
                        
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
                    text: 'An error occurred while Edit student data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });
});

//Student document ajax
$('#docStudent').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        $.ajax({
            url: "action/actStudent.php",
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
                      window.location.href="student.php";
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
                    text: 'An error occurred while Add Student Document.'
                });
                // Re-enable the submit button on error
                $('#docSubmit').prop('disabled', false);
            }
        });
    });




    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-104952515-1', 'auto');
    ga('send', 'pageview');
  </script>
<script>
    function goEditStudent(editId)
{ 
      $.ajax({
        url: 'action/actStudent.php',
        method: 'POST',
        data: {
          editId: editId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {

          $('#editid').val(response.stu_id);
          $('#editFname').val(response.first_name);
          $('#editLname').val(response.last_name);
         
          $('#editDob').val(response.dob);
          $('#editLocation').val(response.address);
          $('#editEmail').val(response.email);
          $('#editMobile').val(response.phone);
          $('#editAadhar').val(response.aadhar);
          $('#editCourse').val(response.course_id);
          $('#editMonth').val(response.course_month);
          $('#editGender').val(response.stu_gender);
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    
}


function goDeleteStudent(id)
{
    //alert(id);
    if(confirm("Are you sure you want to delete Student?"))
    {
      $.ajax({
        url: 'action/actStudent.php',
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
function goViewStudent(id)
{
    //location.href = "clientDetail.php?clientId="+id;
    $.ajax({
        url: 'studentDetail.php',
        method: 'POST',
        data: {
            id: id
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#StuContent').hide();
          $('#studentDetail').html(response);
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}

function goDocStu(id) 
  
  {
    $.ajax({
        url: 'getDocStudent.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#stuDocId').val(response.stuId);
          $('#userName').val(response.username);
          var baseUrl = window.location.origin + "/Admin/roriri software/document/students/"; 
          var aadharUrl = baseUrl + response.aadhar;
          var marksheetUrl = baseUrl + response.marksheet;
         // var bankUrl = baseUrl + response.bank;
                    
            // Set the href attribute and text content of the a tags with the constructed URLs
            $('#aadharLink').attr('href', aadharUrl).find('#aadharImg').text(response.aadhar);
            $('#marksheetLink').attr('href', marksheetUrl).find('#marksheetImg').text(response.marksheet);
           // $('#bankLink').attr('href', bankUrl).find('#bankImg').text(response.bank);
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



