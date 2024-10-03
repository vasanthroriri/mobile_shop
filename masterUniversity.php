<?php
session_start();
    
    include("class.php");
    $uniCenterId = $_SESSION['centerId'];
    $university_result = universityTable($uniCenterId); // Call the function to fetch universities 
    
    
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
            <?php include("formUniversity.php");?> <!---add Student popup--->

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
                                        <button type="button" id="addUniversityBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addUniversityModal">
                                            Add New University
                                        </button>
                                    </div>
                                </div>
                                <h3 class="page-title">University List</h3>   
                            </div>
                        </div>
                    </div>

             
             
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">University Name</th>
                                    <th scope="col">Study Center Code</th>
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                <?php  

                    $i =1;

                    while ($row = $university_result->fetch_assoc()) {
                        $id = $row['uni_id'];
                        

            ?>

            <tr>
                        <td scope="row"><?php echo $i ; $i++ ?></td>
                        <td><?php echo $row['uni_name'] ?></td>
                        <td><?php echo $row['uni_study_code'] ?></td>
                        <td>
                        <?php if ($user_role == 'Admin') { ?>
                            <button  class="btn btn-circle btn-warning text-white modalBtn" onclick="editUiversity(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editUniversityModal"><i class='bi bi-pencil-square'></i></button>
                               <button onclick="goViewUniversity(<?php echo $row['uni_id']; ?>);" class="btn btn-circle btn-success text-white modalBtn" ><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteUniversity(<?php echo $row['uni_id']; ?>);"><i class="bi bi-trash"></i></button>
                            <?php } else { ?>
                            <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewUniversity(<?php echo $row['uni_id']; ?>);"><i class="bi bi-eye-fill"></i></button>
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

    <!-------Start Add Student--->
  
    <script>
    $(document).ready(function() {

        $('#addUniversityBtn').click(function() {

            $('#addUniversity').removeClass('was-validated');
            $('#addUniversity').addClass('needs-validation');
            $('#addUniversity')[0].reset(); // Reset the form
            $('#additionalInputs').empty();
            

            });


        $('#addInputButton').click(function() {
            var newInputDiv = $('<div class="row"></div>');

            var input1Div = $('<div class="col-sm-5"></div>');
            var input1Label = $('<label class="form-label"><b>Department</b></label>');
            var input1 = $('<input type="text" class="form-control" name="department[]" required>');
            input1Div.append(input1Label);
            input1Div.append(input1);

            var input2Div = $('<div class="col-sm-5"></div>');
            var input2Label = $('<label class="form-label"><b>Contact No.</b></label>');
            var input2 = $('<input type="tel" class="form-control" pattern="[0-9]{10}" name="contact[]" required>');
            input2Div.append(input2Label);
            input2Div.append(input2);

            var deleteButtonDiv = $('<div class="col-sm-2 d-flex align-items-end"></div>');
            var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
            deleteButton.click(function() {
                newInputDiv.remove();
            });
            deleteButtonDiv.append(deleteButton);

            newInputDiv.append(input1Div);
            newInputDiv.append(input2Div);
            newInputDiv.append(deleteButtonDiv);

            $('#additionalInputs').append(newInputDiv);
        });

        //---------------------------------------------------------------------------------------------------\

        $('#editInputButton').click(function() {
            var newInputDiv = $('<div class="row"></div>');

            var input1Div = $('<div class="col-sm-5"></div>');
            var input1Label = $('<label class="form-label"><b>Department</b></label>');
            var input1 = $('<input type="text" class="form-control" name="editdepartment[]" required>');
            input1Div.append(input1Label);
            input1Div.append(input1);

            var input2Div = $('<div class="col-sm-5"></div>');
            var input2Label = $('<label class="form-label"><b>Contact No.</b></label>');
            var input2 = $('<input type="tel" class="form-control" pattern="[0-9]{10}" name="editcontact[]" required>');
            input2Div.append(input2Label);
            input2Div.append(input2);

            var deleteButtonDiv = $('<div class="col-sm-2 d-flex align-items-end"></div>');
            var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
            deleteButton.click(function() {
                newInputDiv.remove();
            });
            deleteButtonDiv.append(deleteButton);

            newInputDiv.append(input1Div);
            newInputDiv.append(input2Div);
            newInputDiv.append(deleteButtonDiv);

            $('#editItionalInputs').append(newInputDiv);
        });


    });

 
    $('#backButton').click(function() {
        $('#universityView').addClass('d-none');
        $('#StuContent').show();
    });



    // edit function -------------------------
function editUiversity(editId) {
    // alert("afa");
    $('#editUniversity').removeClass('was-validated');
    $('#editUniversity').addClass('needs-validation');

    $.ajax({
        url: 'action/actUniversity.php',
        method: 'POST',
        data: {
            editId: editId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            $('#editid').val(response.uni_id);
            $('#editUniversityName').val(response.uni_name);
            $('#editStudyCode').val(response.uni_study_code);
            
            // Clear previous input fields
        $('#editItionalInputs').empty();

            // Assuming uni_department and uni_contact arrays are of equal length and matched by index
            if (Array.isArray(response.uni_department) && Array.isArray(response.uni_contact)) {
                response.uni_department.forEach(function(department, index) {
                    var contact = response.uni_contact[index];
                    var newInputDiv = $('<div class="row mb-3"></div>'); // Added mb-3 class for some margin

                    var input1Div = $('<div class="col-sm-5"></div>');
                    var input1Label = $('<label class="form-label"><b>Department</b></label>');
                    var input1 = $('<input type="text" class="form-control" name="editdepartment[]" required>').val(department);
                    input1Div.append(input1Label);
                    input1Div.append(input1);

                    var input2Div = $('<div class="col-sm-5"></div>');
                    var input2Label = $('<label class="form-label"><b>Contact No.</b></label>');
                    var input2 = $('<input type="tel" class="form-control" pattern="[0-9]{10}" name="editcontact[]" required>').val(contact);
                    input2Div.append(input2Label);
                    input2Div.append(input2);

                    var deleteButtonDiv = $('<div class="col-sm-2 d-flex align-items-end"></div>');
                    var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
                    deleteButton.click(function() {
                        newInputDiv.remove();
                    });
                    deleteButtonDiv.append(deleteButton);

                    newInputDiv.append(input1Div);
                    newInputDiv.append(input2Div);
                    newInputDiv.append(deleteButtonDiv);

                    $('#editItionalInputs').append(newInputDiv);
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




       // Ajax form submission
       $('#addUniversity').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }
            
            var formData = new FormData(this);

            $.ajax({
                url: 'action/actUniversity.php',
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
            $('#addUniversityModal').modal('hide');
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
                    alert('Error adding university: ' + textStatus);
                }
            });
        });





        //Edit Student Ajax


document.addEventListener('DOMContentLoaded', function() {
    $('#editUniversity').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

        var formData = new FormData(this);
        $.ajax({
            url: "action/actUniversity.php",
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
                      $('#editUniversityModal').modal('hide'); // Close the modal
                        
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


    function goDeleteUniversity(id)
        {
    //alert(id);
    if(confirm("Are you sure you want to delete university?"))
    {
      $.ajax({
        url: 'action/actUniversity.php',
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



    function goViewUniversity(id)
{
    //location.href = "clientDetail.php?clientId="+id;
    $.ajax({
        url: 'action/actUniversity.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          
          $('#StuContent').hide();
          $('#universityView').removeClass('d-none');
        
          $('#viewUniversityName').text(response.uni_name);
          $('#viewStudyCenterCode').text(response.uni_study_code);

     // Clear previous input fields
     $('#viewuniversity').empty();

            // Assuming uni_department and uni_contact arrays are of equal length and matched by index
            if (Array.isArray(response.uni_department) && Array.isArray(response.uni_contact)) {
                response.uni_department.forEach(function(department, index) {
                    var contact = response.uni_contact[index];
                    var newInputDiv = $('<div class="row mb-3"></div>'); // Added mb-3 class for some margin

                    var input1Div = $('<div class="col-sm-6"></div>');
                    var input1Card = $('<div class="card p-3"></div>');
                    var input1Label = $('<h4>Department</h4>');
                    var input1 = $('<span class="detail"></span>').text(department);
                    input1Card.append(input1Label);
                    input1Card.append(input1);
                    input1Div.append(input1Card);

                    var input2Div = $('<div class="col-sm-6"></div>');
                    var input2Card = $('<div class="card p-3"></div>');
                    var input2Label = $('<h4>Contact</h4>');
                    var input2 = $('<span class="detail"></span>').text(contact);
                    input2Card.append(input2Label);
                    input2Card.append(input2);
                    input2Div.append(input2Card);

                    newInputDiv.append(input1Div);
                    newInputDiv.append(input2Div);

                    $('#viewuniversity').append(newInputDiv);
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





    
</script>

</body>

</html>



