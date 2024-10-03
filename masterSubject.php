<?php
session_start();
    include "class.php";
    
    $subject_result = subjectTable();
    
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
            <?php include("formSubject.php");?>
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
                                        <button type="button" id="addSubjectBtn" class="btn btn-info">
                                            Add New Subject
                                        </button>
                                    </div>
                                </div>
                                <h4 class="page-title">Subjects</h4>   
                            </div>
                        </div>
                    </div>

                   
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">University </th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Year / Semester</th>
                                    
                                      <th scope="col">Action</th>
                                    
                                    
                                    
                      </tr>
                    </thead>
                    <tbody>

                    <?php  

                        $i =1;

                        while ($row = $subject_result->fetch_assoc()) {
                            $id = $row['sub_id'];
                            

                        ?>


                        <tr>
                        <td><?php echo $i ; $i++ ?></td>
                        <td><?php echo universityName($row['sub_uni_id']) ?></td>
                        <td><?php echo courseNameOnly($row['sub_cou_id']) ?></td>
                        <td><?php echo $row['sub_exam_patten'] ?></td>

                        <td>
                            <?php if ($user_role == 'Admin') { ?>
                            <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="editSubject(<?php echo $id; ?>);"><i class='bi bi-pencil-square'></i></button>
                            <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewCourse(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteSubject(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
                            <?php } else{ ?>
                                <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewCourse(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
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
 $(document).ready(function() {

  //---------------------form reset start-------------------
    $('#backButton').on('click', function() {
      $('#addSubject').removeClass('was-validated');
            $('#addSubject').addClass('needs-validation');
            $('#addSubject')[0].reset(); // Reset the form
            $('#additionalInputs').empty();
            $('#electiveInputs').empty();

        $('#addSubjectModal').addClass('d-none');
        $('#StuContent').removeClass('d-none');
    });

    $('#addSubjectBtn').on('click', function() {
      $('#addSubject').removeClass('was-validated');
            $('#addSubject').addClass('needs-validation');
            $('#addSubject')[0].reset(); // Reset the form
            $('#additionalInputs').empty();
            $('#electiveInputs').empty();


        $('#StuContent').addClass('d-none');
        $('#addSubjectModal').removeClass('d-none');
    });

    $('#editBackButton').on('click', function() {
   
        $('#editSubjectModal').addClass('d-none');
        $('#StuContent').removeClass('d-none');
    });

    $('#cancelButton').on('click', function() {

      $('#addSubject').removeClass('was-validated');
            $('#addSubject').addClass('needs-validation');
            $('#addSubject')[0].reset(); // Reset the form

        $('#addSubjectModal').addClass('d-none');
        $('#StuContent').removeClass('d-none');
    });

    $('#editCancelButton').on('click', function() {


  $('#editSubjectModal').addClass('d-none');
  $('#StuContent').removeClass('d-none');
});


//---------------------form reset end -------------------

      //-----------university select course load start -----------------------------

      $('#university').change(function() {
        var universityId = $(this).val();
        
        if (universityId === "") {
            $('#course').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
            return; // No university selected, exit the function
        }

        $.ajax({
            url: "action/actSubject.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { universitySub: universityId },
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

    //-----------course select elective load end -----------------------------



          //-----------university select course load start -----------------------------

          $('#course').change(function() {
        var electiveId = $(this).val();
        
        if (electiveId === "") {
            $('#elective').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
            $('#electiveDiv').hide(); // Hide the elective div if no course is selected
            $('#addElectiveButton').attr('data-type', '');
            return; // No course selected, exit the function
        }

        $.ajax({
            url: "action/actSubject.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { electiveSub: electiveId },
            dataType: 'json',
            success: function(response) {
                  // Handle course details
                if (response.course) {
                    var duration = response.course.cou_duration;
                    var examType = response.course.cou_exam_type;

                    var options = '<option value="">--Select--</option>';
                    
                    if (examType === 'Year') {
                        for (var i = 1; i <= duration; i++) {
                            options += '<option value="' + i + '">' + i + ' st Year</option>';
                        }
                    } else if (examType === 'Semester') {
                        for (var i = 1; i <= (duration * 2); i++) {
                            options += '<option value="' + i + '">' + i + ' st Semester</option>';
                        }
                    }

                    $('#year').html(options);
                }
                
                     // Handle elective details
                     if (response.electives && response.electives.length > 0) {
                        var electiveOptions = '<option value="">--Select the Course--</option>';
                        var hasElectives = false;

                        // Loop through each course in the response and append to options
                        $.each(response.electives, function(index, course) {
                            if (course.ele_lag_elec === 'E') {
                                hasElectives = true;
                                electiveOptions += '<option value="' + course.ele_id + '">' + course.ele_elective + '</option>';
                            }
                        });

                        if (hasElectives) {
                            $('#electiveDiv').show(); // Show the elective div if there are electives
                            $('#elective').html(electiveOptions); // Update the course dropdown
                            $('#addElectiveButton').attr('data-type', 'elective');
                            $('#subType').val("Elective");
                        } else {
                            $('#electiveDiv').hide(); // Hide the elective div if no electives
                            $('#elective').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
                            $('#addElectiveButton').attr('data-type', 'language'); // Set the data-type for language
                            $('#subType').val("language");
                        }
                    } else {
                        $('#electiveDiv').hide(); // Hide the elective div if no courses
                        $('#elective').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
                        $('#addElectiveButton').attr('data-type', 'language'); // Set the data-type for language
                        $('#subType').val("language");
                    }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });

    //-----------course select elective load end -----------------------------

       
    $('#addInputButton').click(function() {
        var newInputDiv = $('<div class="row mt-3"></div>');

        var inputDiv1 = $('<div class="col-sm-5"></div>');
        var inputLabel1 = $('<label class="form-label"><b>Subject Code</b></label>');
        var input1 = $('<input type="text" class="form-control" name="newInputSubjectCode[]" required>');
        inputDiv1.append(inputLabel1);
        inputDiv1.append(input1);
        newInputDiv.append(inputDiv1);

        var inputDiv2 = $('<div class="col-sm-5"></div>');
        var inputLabel2 = $('<label class="form-label"><b>Subject Name</b></label>');
        var input2 = $('<input type="text" class="form-control" name="newInputSubjectName[]" required>');
        inputDiv2.append(inputLabel2);
        inputDiv2.append(input2);
        newInputDiv.append(inputDiv2);

        var deleteButtonDiv = $('<div class="col-sm-2 d-flex align-items-end"></div>');
        var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
        deleteButton.click(function() {
            newInputDiv.remove();
        });
        deleteButtonDiv.append(deleteButton);

        newInputDiv.append(deleteButtonDiv);

        $('#additionalInputs').append(newInputDiv);
    });

    $('#addElectiveButton').click(function() {
        var buttonType = $(this).attr('data-type');

        if (buttonType === 'language') {
            var newInputDiv = $('<div class="row mt-3"></div>');

            var inputDiv1 = $('<div class="col-sm-3"></div>');
    var inputLabel1 = $('<label class="form-label"><b>Language Name</b></label>');
    var input1 = $('<select class="form-control" name="newInputLanguageSubjectCode[]" required></select>');

    var course_id = $('#course').val();
     // Fetch options and append to the dropdown (you can adjust this part to fetch dynamically if needed)
     $.ajax({
        url: 'action/actLanguage.php', // PHP file to fetch languages
        method: 'POST',
        data: { course_id: course_id },
        dataType: 'json',
        success: function(data) {
            input1.append('<option value="">--Select Language--</option>');
            $.each(data, function(index, language) {
                input1.append('<option value="' + language.ele_id + '">' + language.ele_elective + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch languages:', status, error);
        }
    });

            inputDiv1.append(inputLabel1);
            inputDiv1.append(input1);
            newInputDiv.append(inputDiv1);

            var inputDiv2 = $('<div class="col-sm-4"></div>');
            var inputLabel2 = $('<label class="form-label"><b>Language Subject Code</b></label>');
            var input2 = $('<input type="text" class="form-control" name="newInputLanguageSubjectName[]" required>');
            inputDiv2.append(inputLabel2);
            inputDiv2.append(input2);
            newInputDiv.append(inputDiv2);

            var inputDiv3 = $('<div class="col-sm-4"></div>');
            var inputLabel3 = $('<label class="form-label"><b>Language Subject Name</b></label>');
            var input3 = $('<input type="text" class="form-control" name="newInputLanguageSubjectType[]" required>');
            inputDiv3.append(inputLabel3);
            inputDiv3.append(input3);
            newInputDiv.append(inputDiv3);

            var deleteButtonDiv = $('<div class="col-sm-1 d-flex align-items-end"></div>');
            var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
            deleteButton.click(function() {
                newInputDiv.remove();
            });
            deleteButtonDiv.append(deleteButton);

            newInputDiv.append(deleteButtonDiv);

            $('#electiveInputs').append(newInputDiv);
        } else if (buttonType === 'elective') {
            var newInputDiv = $('<div class="row mt-3"></div>');

            var inputDiv1 = $('<div class="col-sm-4"></div>');
            var inputLabel1 = $('<label class="form-label"><b>Elective Subject Code</b></label>');
            var input1 = $('<input type="text" class="form-control" name="newInputElectiveSubjectCode[]">');
            inputDiv1.append(inputLabel1);
            inputDiv1.append(input1);
            newInputDiv.append(inputDiv1);

            var inputDiv2 = $('<div class="col-sm-4"></div>');
            var inputLabel2 = $('<label class="form-label"><b>Elective Subject Name</b></label>');
            var input2 = $('<input type="text" class="form-control" name="newInputElectiveSubjectName[]">');
            inputDiv2.append(inputLabel2);
            inputDiv2.append(input2);
            newInputDiv.append(inputDiv2);

            var deleteButtonDiv = $('<div class="col-sm-2 d-flex align-items-end"></div>');
            var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
            deleteButton.click(function() {
                newInputDiv.remove();
            });
            deleteButtonDiv.append(deleteButton);

            newInputDiv.append(deleteButtonDiv);

            $('#electiveInputs').append(newInputDiv);
        }
    });


    $('#editAddInputButton').click(function() {
        var newInputDiv = $('<div class="row mt-3"></div>');

        var inputDiv1 = $('<div class="col-sm-4"></div>');
        var inputLabel1 = $('<label class="form-label"><b>Subject Code</b></label>');
        var input1 = $('<input type="text" class="form-control" name="editSubjectCode[]" required>');
        inputDiv1.append(inputLabel1);
        inputDiv1.append(input1);
        newInputDiv.append(inputDiv1);

        var inputDiv2 = $('<div class="col-sm-4"></div>');
        var inputLabel2 = $('<label class="form-label"><b>Subject Name</b></label>');
        var input2 = $('<input type="text" class="form-control" name="editSubjectName[]" required>');
        inputDiv2.append(inputLabel2);
        inputDiv2.append(input2);
        newInputDiv.append(inputDiv2);

        var deleteButtonDiv = $('<div class="col-sm-3 d-flex align-items-end"></div>');
        var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
        deleteButton.click(function() {
            newInputDiv.remove();
        });
        deleteButtonDiv.append(deleteButton);

        newInputDiv.append(deleteButtonDiv);

        $('#editLanguageInputs').append(newInputDiv);
    });

    $('#editAddElectiveButton').click(function() {
        var buttonType = $(this).attr('data-type');

        if (buttonType === 'language') {
            var newInputDiv = $('<div class="row mt-3"></div>');

            var inputDiv1 = $('<div class="col-sm-3"></div>');
    var inputLabel1 = $('<label class="form-label"><b>Language Name</b></label>');
    var input1 = $('<select class="form-control" name="editAdditionLanguageName[]" required></select>');

     // Fetch options and append to the dropdown (you can adjust this part to fetch dynamically if needed)
     $.ajax({
        url: 'action/actLanguage.php', // PHP file to fetch languages
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            input1.append('<option value="">--Select Language--</option>');
            $.each(data, function(index, language) {
                input1.append('<option value="' + language.ele_id + '">' + language.ele_elective + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch languages:', status, error);
        }
    });

            inputDiv1.append(inputLabel1);
            inputDiv1.append(input1);
            newInputDiv.append(inputDiv1);

            var inputDiv2 = $('<div class="col-sm-4"></div>');
            var inputLabel2 = $('<label class="form-label"><b>Language Subject Code</b></label>');
            var input2 = $('<input type="text" class="form-control" name="editAdditionSubCode[]" required>');
            inputDiv2.append(inputLabel2);
            inputDiv2.append(input2);
            newInputDiv.append(inputDiv2);

            var inputDiv3 = $('<div class="col-sm-4"></div>');
            var inputLabel3 = $('<label class="form-label"><b>Language Subject Name</b></label>');
            var input3 = $('<input type="text" class="form-control" name="editAdditionSubName[]" required>');
            inputDiv3.append(inputLabel3);
            inputDiv3.append(input3);
            newInputDiv.append(inputDiv3);

            var deleteButtonDiv = $('<div class="col-sm-1 d-flex align-items-end"></div>');
            var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
            deleteButton.click(function() {
                newInputDiv.remove();
            });
            deleteButtonDiv.append(deleteButton);

            newInputDiv.append(deleteButtonDiv);

            $('#editElectiveInputs').append(newInputDiv);
        } else if (buttonType === 'elective') {
            var newInputDiv = $('<div class="row mt-3"></div>');

            var inputDiv1 = $('<div class="col-sm-4"></div>');
            var inputLabel1 = $('<label class="form-label"><b>Elective Subject Code</b></label>');
            var input1 = $('<input type="text" class="form-control" name="editAdditionSubCode[]">');
            inputDiv1.append(inputLabel1);
            inputDiv1.append(input1);
            newInputDiv.append(inputDiv1);

            var inputDiv2 = $('<div class="col-sm-4"></div>');
            var inputLabel2 = $('<label class="form-label"><b>Elective Subject Name</b></label>');
            var input2 = $('<input type="text" class="form-control" name="editAdditionSubName[]">');
            inputDiv2.append(inputLabel2);
            inputDiv2.append(input2);
            newInputDiv.append(inputDiv2);

            var deleteButtonDiv = $('<div class="col-sm-2 d-flex align-items-end"></div>');
            var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
            deleteButton.click(function() {
                newInputDiv.remove();
            });
            deleteButtonDiv.append(deleteButton);

            newInputDiv.append(deleteButtonDiv);

            $('#editElectiveInputs').append(newInputDiv);
        }
    });
});




// Ajax form submission
$('#addSubject').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }
            
            var formData = new FormData(this);

            $.ajax({
                url: 'action/actSubject.php',
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

            $('#addSubjectModal').addClass('d-none');
            $('#StuContent').removeClass('d-none');
            
            // $('#addSubject').modal('hide');
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



        //----------------edit subject ----------------------------------

              // edit function -------------------------
    function editSubject(editId) {

        $('#editSubject').removeClass('was-validated');
            $('#editSubject').addClass('needs-validation');

    $('#StuContent').addClass('d-none');
    $('#editSubjectModal').removeClass('d-none');
    
    $.ajax({
        url: 'action/actSubject.php',
        method: 'POST',
        data: { editId: editId },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                console.error('Error:', response.error);
                return;
            }

            $('#editSubId').val(response.sub_id);
            $('#editUniversity').val(response.sub_uni_id);
            
            $('#editElective').val(response.sub_ele_id);
            $('#editSubType').val(response.sub_type);
            

            $('#editYear').val(response.sub_exam_patten);

            var options = '<option value="">--Select the Course--</option>';
                
                // Loop through each course in the response and append to options
                $.each(response.enq_courses, function(index, course) {
                   options += '<option value="' + course.cou_id + '">' + course.cou_name + '</option>';
               });
               $('#editCourse').html(options); // Update the course dropdown
               $('#editCourse').val(response.sub_cou_id);

     

            

            // alert(response.sub_subject_code);

              
        // Clear previous input fields
        $('#editLanguageInputs').empty();
        $('#editElectiveInputs').empty();

        if (Array.isArray(response.sub_subject_code) && Array.isArray(response.sub_subject_name)) {
                response.sub_subject_code.forEach(function(subjectCode, index) {
                    var subjectName = response.sub_subject_name[index];
                    var newInputDiv = $('<div class="row mb-3"></div>');

                    var input1Div = $('<div class="col-sm-4"></div>');
                    var input1Label = $('<label class="form-label"><b>Subject Code</b></label>');
                    var input1 = $('<input type="text" class="form-control" name="editSubjectCode[]" required>').val(subjectCode);
                    input1Div.append(input1Label);
                    input1Div.append(input1);

                    var input2Div = $('<div class="col-sm-4"></div>');
                    var input2Label = $('<label class="form-label"><b>Subject Name</b></label>');
                    var input2 = $('<input type="text" class="form-control" name="editSubjectName[]" required>').val(subjectName);
                    input2Div.append(input2Label);
                    input2Div.append(input2);

                    var deleteButtonDiv = $('<div class="col-sm-4 d-flex align-items-end"></div>');
                    var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
                    deleteButton.click(function() {
                        newInputDiv.remove();
                    });
                    deleteButtonDiv.append(deleteButton);

                    newInputDiv.append(input1Div);
                    newInputDiv.append(input2Div);
                    newInputDiv.append(deleteButtonDiv);

                    $('#editLanguageInputs').append(newInputDiv);
                });
            } else {
                console.error('sub_subject_code or sub_subject_name is not an array.');
            }

            if (Array.isArray(response.sub_addition_lag_name) && response.sub_addition_lag_name.length > 0) {
                $('#editAddElectiveButton').attr('data-type', 'language');

                fetchLanguages(response.sub_cou_id, function(languages) {
                    response.sub_addition_lag_name.forEach(function(languageName, index) {
                        var subCode = response.sub_addition_sub_code[index];
                        var subName = response.sub_addition_sub_name[index];
                        var newInputDiv = createLanguageInputDiv(languageName, subCode, subName, languages);
                        $('#editElectiveInputs').append(newInputDiv);
                    });
                });
            } else {
                if (Array.isArray(response.sub_addition_sub_code) && Array.isArray(response.sub_addition_sub_name)) {
                    $('#editAddElectiveButton').attr('data-type', 'elective');
                    $('#editElectiveDiv').show();

                    var electiveOptions = '<option value="">--Select the Elective--</option>';
                    $.each(response.elective_course, function(index, elective) {
                        electiveOptions += '<option value="' + elective.ele_id + '">' + elective.ele_elective + '</option>';
                    });
                    $('#editElective').html(electiveOptions);
                    $('#editElective').val(response.sub_ele_id);

                    response.sub_addition_sub_code.forEach(function(subCode, index) {
                        var subName = response.sub_addition_sub_name[index];
                        var newInputDiv = createElectiveInputDiv(subCode, subName);
                        $('#editElectiveInputs').append(newInputDiv);
                    });
                } else {
                    console.error('sub_addition_sub_code or sub_addition_sub_name is not an array.');
                }
            }
        }
    });
}

function fetchLanguages(course_id, callback) {
    $.ajax({
        url: 'action/actLanguage.php',
        method: 'POST',
        data: { course_id: course_id },
        dataType: 'json',
        success: function(data) {
            callback(data);
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch languages:', status, error);
        }
    });
}

function createLanguageInputDiv(languageName, subCode, subName, languages) {
    
    var newInputDiv = $('<div class="row mt-3"></div>');

    var inputDiv1 = $('<div class="col-sm-3"></div>');
    var inputLabel1 = $('<label class="form-label"><b>Language Name</b></label>');
    var input1 = $('<select class="form-control" name="editAdditionLanguageName[]" required></select>');

    input1.append('<option value="">--Select Language--</option>');
    languages.forEach(function(language) {
        var option = $('<option></option>').val(language.ele_id).text(language.ele_elective);
        if (language.ele_id === languageName) {
            option.attr('selected', 'selected');
        }
        input1.append(option);
    });

    inputDiv1.append(inputLabel1);
    inputDiv1.append(input1);

    var input2Div = $('<div class="col-sm-3"></div>');
    var input2Label = $('<label class="form-label"><b>Subject Code</b></label>');
    var input2 = $('<input type="text" class="form-control" name="editAdditionSubCode[]" required>').val(subCode);
    input2Div.append(input2Label);
    input2Div.append(input2);

    var input3Div = $('<div class="col-sm-3"></div>');
    var input3Label = $('<label class="form-label"><b>Subject Name</b></label>');
    var input3 = $('<input type="text" class="form-control" name="editAdditionSubName[]" required>').val(subName);
    input3Div.append(input3Label);
    input3Div.append(input3);

    var deleteButtonDiv = $('<div class="col-sm-3 d-flex align-items-end"></div>');
    var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
    deleteButton.click(function() {
        newInputDiv.remove();
    });
    deleteButtonDiv.append(deleteButton);

    newInputDiv.append(inputDiv1);
    newInputDiv.append(input2Div);
    newInputDiv.append(input3Div);
    newInputDiv.append(deleteButtonDiv);

    return newInputDiv;
}

function createElectiveInputDiv(subCode, subName) {
    var newInputDiv = $('<div class="row mb-3"></div>');

    var input1Div = $('<div class="col-sm-4"></div>');
    var input1Label = $('<label class="form-label"><b>Elective Subject Code</b></label>');
    var input1 = $('<input type="text" class="form-control" name="editAdditionSubCode[]" required>').val(subCode);
    input1Div.append(input1Label);
    input1Div.append(input1);

    var input2Div = $('<div class="col-sm-4"></div>');
    var input2Label = $('<label class="form-label"><b>Elective Subject Name</b></label>');
    var input2 = $('<input type="text" class="form-control" name="editAdditionSubName[]" required>').val(subName);
    input2Div.append(input2Label);
    input2Div.append(input2);

    var deleteButtonDiv = $('<div class="col-sm-4 d-flex align-items-end"></div>');
    var deleteButton = $('<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>');
    deleteButton.click(function() {
        newInputDiv.remove();
    });
    deleteButtonDiv.append(deleteButton);

    newInputDiv.append(input1Div);
    newInputDiv.append(input2Div);
    newInputDiv.append(deleteButtonDiv);

    return newInputDiv;
}


        


 
   
          //Edit update subject form Ajax


          document.addEventListener('DOMContentLoaded', function() {
    $('#editSubject').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }
       
        $('#editElective').prop('disabled', false);
        $('#editCourse').prop('disabled', false);
        $('#editUniversity').prop('disabled', false);
        
        // Create a FormData object
        var formData = new FormData(this);
        
        
        $.ajax({
            url: "action/actSubject.php",
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
                        $('#editSubjectModal').addClass('d-none');
                        $('#StuContent').removeClass('d-none');
                        
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
                    text: 'An error occurred while editing subject data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });
});


$('#backButtonSubject').click(function() {
        $('#SubjectView').addClass('d-none');
        $('#StuContent').show();

    });


    // Function to fetch name from the server based on ID
function fetchNameById(id, callback) {
    $.ajax({
        url: 'action/actLanguage.php', // Replace with your actual server endpoint
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                callback(response.name);
            } else {
                console.error('Failed to fetch name for ID:', id);
                callback('Unknown');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching name:', textStatus, errorThrown);
            callback('Error');
        }
    });
}


function goViewCourse(id) 
    {
    //location.href = "clientDetail.php?clientId="+id;
    $.ajax({
        url: 'action/actSubject.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          
          $('#StuContent').hide();
          $('#SubjectView').removeClass('d-none');
        
          $('#viewUniversityName').text(response.sub_uni_id);
          $('#viewCourseName').text(response.sub_cou_id);
          
          $('#viewyearSemester').text(response.sub_exam_patten);
        //   $('#viewFeesType').text(response.cou_fees_type);
        //   $('#viewDuration').text(response.cou_duration +" Years");
  // Clear previous input fields
  $('#viewSubjectInputs').empty();
    $('#viewAdditionSubjectInputs').empty();

    // Directly assume sub_subject_code and sub_subject_name are arrays of equal length
    if (Array.isArray(response.sub_subject_code) && Array.isArray(response.sub_subject_name)) {
        response.sub_subject_code.forEach(function(subjectCode, index) {
            var subjectName = response.sub_subject_name[index];
            
            var newInputDiv = $('<div class="row mb-3 detail-card"></div>'); // Added mb-3 class for some margin

            var input1Div = $('<div class="col-sm-6"></div>');
            var input1Card = $('<div class="card p-3"></div>');
            var input1Label = $('<h4>Subject Code</h4>');
            var input1 = $('<span class="detail"></span>').text(subjectCode);
            input1Card.append(input1Label);
            input1Card.append(input1);
            input1Div.append(input1Card);

            var input2Div = $('<div class="col-sm-6"></div>');
            var input2Card = $('<div class="card p-3"></div>');
            var input2Label = $('<h4>Subject Name</h4>');
            var input2 = $('<span class="detail"></span>').text(subjectName);
            input2Card.append(input2Label);
            input2Card.append(input2);
            input2Div.append(input2Card);

            newInputDiv.append(input1Div);
            newInputDiv.append(input2Div);

            $('#viewSubjectInputs').append(newInputDiv);
        });
    } else {
        console.error('sub_subject_code or sub_subject_name is not an array.');
    }

    // Check if sub_addition_lag_name is not empty and add those inputs
    if (Array.isArray(response.sub_addition_lag_name) && response.sub_addition_lag_name.length > 0) {
        response.sub_addition_lag_name.forEach(function(languageName, index) {
            var subCode = response.sub_addition_sub_code[index];
            var subName = response.sub_addition_sub_name[index];

            var newInputDiv = $('<div class="row mb-3 detail-card"></div>'); // Added mb-3 class for some margin

            var input1Div = $('<div class="col-sm-4"></div>');
            var input1Card = $('<div class="card p-3"></div>');
            var input1Label = $('<h4>Additional Language Name</h4>');
            var input1 = $('<span class="detail"></span>').text('languageName');
            input1Card.append(input1Label);
            input1Card.append(input1);
            input1Div.append(input1Card);

            fetchNameById(languageName, function(name) {
            input1.text(name);
        });

            var input2Div = $('<div class="col-sm-4"></div>');
            var input2Card = $('<div class="card p-3"></div>');
            var input2Label = $('<h4>Subject Code</h4>');
            var input2 = $('<span class="detail"></span>').text(subCode);
            input2Card.append(input2Label);
            input2Card.append(input2);
            input2Div.append(input2Card);

            var input3Div = $('<div class="col-sm-4"></div>');
            var input3Card = $('<div class="card p-3"></div>');
            var input3Label = $('<h4>Subject Name</h4>');
            var input3 = $('<span class="detail"></span>').text(subName);
            input3Card.append(input3Label);
            input3Card.append(input3);
            input3Div.append(input3Card);

            newInputDiv.append(input1Div);
            newInputDiv.append(input2Div);
            newInputDiv.append(input3Div);

            $('#viewAdditionSubjectInputs').append(newInputDiv);
                   
        
        });
    } else {
        if (Array.isArray(response.sub_addition_sub_code) && Array.isArray(response.sub_addition_sub_name)) {
            $('#viewElectiveDiv').removeClass("d-none");
           
            $('#viewElective').text(response.ele_elective);

            response.sub_addition_sub_code.forEach(function(subCode, index) {
                var subName = response.sub_addition_sub_name[index];

                var newInputDiv = $('<div class="row mb-3 detail-card"></div>'); // Added mb-3 class for some margin

                var input1Div = $('<div class="col-sm-6"></div>');
                var input1Card = $('<div class="card p-3"></div>');
                var input1Label = $('<h4>Elective Subject Code</h4>');
                var input1 = $('<span class="detail"></span>').text(subCode);
                input1Card.append(input1Label);
                input1Card.append(input1);
                input1Div.append(input1Card);

                var input2Div = $('<div class="col-sm-6"></div>');
                var input2Card = $('<div class="card p-3"></div>');
                var input2Label = $('<h4>Elective Subject Name</h4>');
                var input2 = $('<span class="detail"></span>').text(subName);
                input2Card.append(input2Label);
                input2Card.append(input2);
                input2Div.append(input2Card);

                newInputDiv.append(input1Div);
                newInputDiv.append(input2Div);

                $('#viewAdditionSubjectInputs').append(newInputDiv);

          
            });
        } else {
            console.error('sub_addition_sub_code or sub_addition_sub_name is not an array.');
        }
    }   },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    }

    function goDeleteSubject(id)
        {
    //alert(id);
    if(confirm("Are you sure you want to delete Subject?"))
    {
      $.ajax({
        url: 'action/actSubject.php',
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
    document.getElementById('addSubjectBtn').addEventListener('click', function() {
        document.getElementById('StuContent').classList.add('d-none');
        document.getElementById('addSubjectModal').classList.remove('d-none');

    });
    document.getElementById('backToMainBtn').addEventListener('click', function() {
            document.getElementById('StuContent').classList.remove('d-none');
            document.getElementById('addSubjectModal').classList.add('d-none');
        });
</script>
     

</body>

</html>



