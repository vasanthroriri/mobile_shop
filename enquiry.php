<?php
session_start();
include("class.php");
$centerId = $_SESSION['centerId'];
$enquiry_result = enquiryTable($centerId);
    
?>
<!DOCTYPE html>
<html lang="en">

<?php include("head2.php"); ?>
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
            <?php include("formEnquiry.php");?> <!---add Student popup--->

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
                                        <button type="button" id="addEnquiryBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addEnquiryModal">
                                            Add New Enquiry
                                        </button>
                                    </div>
                                </div>
                                <h3 class="page-title">Enquiry</h3>   
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row mb-3">
                   <div class="col-md-5">
                   <label for="universityFilter">University</label>
                  <select id="universityFilter" class="form-control">
                <option value="">--All University--</option>
                                        <?php 
                                        $uniCenterId = $_SESSION['centerId'];
                                     $university_result = universityTable($uniCenterId); // Call the function to fetch universities 
                                     while ($row = $university_result->fetch_assoc()) {
                                     $id = $row['uni_id']; 
                                    $name = $row['uni_name'];    
                        
                                      ?>
                        
                        <option value="<?php  $name;?>"><?php  $name;?></option>

                        <?php } ?>
            
        </select>
    </div>                 
    </div> -->

             
             
             
             
             <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-light">
                        <th scope="col-1">S.No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">University</th>
                        <th scope="col">Course</th>                                    
                        <th scope="col">Contact No</th>
                        <th scope="col">Status</th> 
                        <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>

                    <?php  

                        $i =1;

                        while ($row = $enquiry_result->fetch_assoc()) {
                            $id = $row['enq_id'];
                            

                        ?>

                    
                     <tr>
                        <td><?php echo $i ; $i++ ?></td>
                        <td><?php echo $row['enq_stu_name'] ?></td>
                        <td><?php echo  universityName($row['enq_uni_id']) ?></td>
                        <td><?php echo courseNameOnly($row['enq_cou_id']) ?></td>
                        <td><?php echo $row['enq_mobile'] ?></td>
                        <td><?php echo $row['enq_adminsion_status'] ?></td>
                    
                        <td>
                            <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="editEnquiry(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editEnquiryModal"><i class='bi bi-pencil-square'></i></button>
                            <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewEnquiry(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteEnquiry(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
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

                <!--   pdf and excel print  -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>


    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <script>

$(document).ready(function() {
    var table = $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: function (index, data, node) {
                        // Exclude the last column (Action) from export
                        return index !== 6;
                    }
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: function (index, data, node) {
                        // Exclude the last column (Action) from export
                        return index !== 6;
                    }
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: function (index, data, node) {
                        // Exclude the last column (Action) from export
                        return index !== 6;
                    }
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: function (index, data, node) {
                        // Exclude the last column (Action) from export
                        return index !== 6;
                    }
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: function (index, data, node) {
                        // Exclude the last column (Action) from export
                        return index !== 6;
                    }
                }
            }
        ]
    });
});

        // Event listener for the university filter dropdown
        // $('#universityFilter').on('change', function() {
        //     var selectedUniversity = $(this).val();
        //     if (selectedUniversity) {
        //         table.column(2).search(selectedUniversity).draw();
        //     } else {
        //         table.column(2).search('').draw();
        //     }
        // });
        var today = new Date().toISOString().split('T')[0];

// Calculate the date 10 years ago
var tenYearsAgo = new Date();
tenYearsAgo.setFullYear(tenYearsAgo.getFullYear() - 10);
var tenYearsAgoDate = tenYearsAgo.toISOString().split('T')[0];

// Set the max attribute for the DOB input
document.getElementById('dob').setAttribute('max', tenYearsAgoDate);
document.getElementById('editDob').setAttribute('max', tenYearsAgoDate);
 

        $('#addEnquiryBtn').click(function() {

            $('#addEnquiry').removeClass('was-validated');
            $('#addEnquiry').addClass('needs-validation');
            $('#addEnquiry')[0].reset(); // Reset the form
            // $('#fessType').val('');

            });

            $('#backButtonEnquiry').click(function() {
            $('#enquiryView').addClass('d-none');
            $('#StuContent').show();

            });


            $(document).ready(function() {
    $('#university').change(function() {
        var universityId = $(this).val();
        
        if (universityId === "") {
            $('#course').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
            return; // No university selected, exit the function
        }

        $.ajax({
            url: "action/actEnquiry.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { universityID: universityId },
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


    $('#editUniversity').change(function() {
        var universityId = $(this).val();
        // alert(universityId);
        
        if (universityId === "") {
            $('#editCourse').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
            return; // No university selected, exit the function
        }

        $.ajax({
            url: "action/actEnquiry.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { universityID: universityId },
            dataType: 'json',
            success: function(response) {
                
                var options = '<option value="">--Select the Course--</option>';
                
                 // Loop through each course in the response and append to options
                 $.each(response, function(index, course) {
                    options += '<option value="' + course.cou_id + '">' + course.cou_name + '</option>';
                });
                $('#editCourse').html(options); // Update the course dropdown
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });


    });




     // Ajax form submission
     $('#addEnquiry').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }
            
            var formData = new FormData(this);

            $.ajax({
                url: 'action/actEnquiry.php',
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
            $('#addEnquiryModal').modal('hide');
            $('#example').load(location.href + ' #example > *', function() {
              $('#example').DataTable().destroy();
              $('#example').DataTable({
                "paging": true, // Enable pagination
                "ordering": true, // Enable sorting
                "searching": true, // Enable searching
                dom: 'Bfrtip', // Define the elements that should be included in the DataTable
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print' // Include buttons for copy, CSV, Excel, PDF, and print
    ]
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


        



          // edit function -------------------------
    function editEnquiry(editId) {

        $('#editEnquiry').removeClass('was-validated');
            $('#editEnquiry').addClass('needs-validation');

    $.ajax({
        url: 'action/actEnquiry.php',
        method: 'POST',
        data: {
            editId: editId
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            $('#editEnquiryId').val(response.enq_id);
            $('#editName').val(response.enq_stu_name);
            $('#editGender').val(response.enq_gender);
            $('#editDob').val(response.enq_dob);
            $('#editMobile').val(response.enq_mobile);
            $('#editEmail').val(response.enq_email);
            $('#editAddress').val(response.enq_address);
            $('#editUniversity').val(response.enq_uni_id);
            
            $('#editMedium').val(response.enq_medium);
            


            var options = '<option value="">--Select the Course--</option>';
                
                // Loop through each course in the response and append to options
                $.each(response.enq_courses, function(index, course) {
                   options += '<option value="' + course.cou_id + '">' + course.cou_name + '</option>';
               });
               $('#editCourse').html(options); // Update the course dropdown
               $('#editCourse').val(response.enq_cou_id);
           
                    },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    }




          //Edit update Enquiry form Ajax


document.addEventListener('DOMContentLoaded', function() {
    $('#editEnquiry').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

        var formData = new FormData(this);
        $.ajax({
            url: "action/actEnquiry.php",
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
                      $('#editEnquiryModal').modal('hide'); // Close the modal
                        
                        $('.modal-backdrop').remove(); // Remove the backdrop   
                          $('#example').load(location.href + ' #example > *', function() {
                               
                              $('#example').DataTable().destroy();
                               
                                $('#example').DataTable({
                                   "paging": true, // Enable pagination
                                   "ordering": true, // Enable sorting
                                    "searching": true, // Enable searching
                                    dom: 'Bfrtip', // Define the elements that should be included in the DataTable
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print' // Include buttons for copy, CSV, Excel, PDF, and print
    ]
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





    //----delete ---
    function goDeleteEnquiry(id)
        {
    //alert(id);
    if(confirm("Are you sure you want to delete enquiry?"))
    {
      $.ajax({
        url: 'action/actEnquiry.php',
        method: 'POST',
        data: {
          deleteId: id
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#example').load(location.href + ' #example > *', function() {
                               
                               $('#example').DataTable().destroy();
                               
                                $('#example').DataTable({
                                    "paging": true, // Enable pagination
                                    "ordering": true, // Enable sorting
                                    "searching": true, // Enable searching
                                    dom: 'Bfrtip', // Define the elements that should be included in the DataTable
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print' // Include buttons for copy, CSV, Excel, PDF, and print
    ]
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


    function goViewEnquiry(id)
{
    //location.href = "clientDetail.php?clientId="+id;
    $.ajax({
        url: 'action/actEnquiry.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          
          $('#StuContent').hide();
          $('#enquiryView').removeClass('d-none');
        
          $('#viewStudentName').text(response.enq_stu_name);
          $('#viewGender').text(response.enq_gender);
          $('#viewDob').text(response.enq_dob);
          $('#viewMobileNo').text(response.enq_mobile);
          $('#viewEmail').text(response.enq_email);
          $('#viewAddress').text(response.enq_address);
          $('#viewUniversityName').text(response.enq_uni_id);
          $('#viewCourseName').text(response.enq_cou_id);
          $('#viewMedium').text(response.enq_medium);
          $('#viewAddmissionStatus').text(response.enq_adminsion_status);

    

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



