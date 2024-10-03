<?php
session_start();

    include "class.php";
    $centerId = $_SESSION['centerId'];
    $admission_result = admission($centerId); 
    
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
                
            <?php include "addAdmission.php"; ?>
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
                                        <button type="button" id="addAdmissionBtn" class="btn btn-info">
                                            Add New Admission
                                        </button>
                                    </div>
                                </div>
                                <h3 class="page-title">Admission</h3>   
                            </div>
                        </div>
                    </div>

       

             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Application No.</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">University</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Contact No</th>
                                    <th scope="col">Roll No</th> 
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1; while($row = mysqli_fetch_array($admission_result , MYSQLI_ASSOC)) { 
                        $id = $row['stu_id'];  $name = $row['stu_name']; $phone = $row['stu_phone'];  $university=$row['uni_name'];  
                        $course = $row['cou_name']; $enroll = $row['stu_enroll']; $apply = $row['stu_apply_no'];
                        ?>
                     <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $apply; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $university; ?></td>
                        <td><?php echo $course; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo !empty($enroll) ? $enroll : 'Pending'; ?></td>
                    
                        <td>
                            <button type="button" class="btn btn-circle btn-warning text-white modalBtn" id="editAdmissionBtn" onclick="goEditAdmission(<?php echo $id; ?>);"><i class='bi bi-pencil-square'></i></button>
                            <button class="btn btn-circle btn-success text-white" id="viewAdmissionBtn" onclick="goViewAdmission(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
                            <button class="btn btn-circle btn-danger text-white" onclick="goDeleteAdmission(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
                           
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

        <!-- Wizard Form Demo js -->
        <script src="assets/js/pages/demo.form-wizard.js"></script>

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
    <script src="assets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- Datatable Demo Aapp js -->
    <script src="assets/js/pages/demo.datatable-init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <script>
    $(document).ready(function() {
    // Show add admission modal on button click
    $('#addAdmissionBtn').on('click', function() {
        $('#addAdmission').removeClass('was-validated');
        $('#addAdmission').addClass('needs-validation');
        $('#applicationNo').removeClass('is-invalid is-valid');
        $('#language').attr('required', 'required');
        $('#addAdmission')[0].reset(); // Reset the form
        $('#StuContent').addClass('d-none');
        $('#addAdmissionModal').removeClass('d-none');
    });

    // Back to main content from add admission modal
    $('#addAdmissionModal').on('click', '#backToMainBtn', function() {
        $('#StuContent').removeClass('d-none');
        $('#addAdmissionModal').addClass('d-none');
    });

    // // Show edit admission modal on button click
    $(document).on('click', '#editAdmissionBtn', function() {
        $('#editAdmission').removeClass('was-validated');
        $('#editAdmission').addClass('needs-validation');
        $('#languageEdit').attr('required', 'required');
        $('#editAdmission')[0].reset(); // Reset the form
        $('#StuContent').addClass('d-none');
        $('#editAdmissionModal').removeClass('d-none');
    });

    // Back to main content from edit admission modal
    $('#editAdmissionModal').on('click', '#backToMainBtn1', function() {
        $('#StuContent').removeClass('d-none');
        $('#editAdmissionModal').addClass('d-none');
    });

    $(document).on('click', '#viewAdmissionBtn', function() {
        // $('#editAdmission').removeClass('was-validated');
        // $('#editAdmission').addClass('needs-validation');
        // $('#editAdmission')[0].reset(); // Reset the form
        $('#StuContent').addClass('d-none');
        $('#viewAdmissionModal').removeClass('d-none');
    });

    // Back to main content from edit admission modal
    $('#viewAdmissionModal').on('click', '#backToMainBtn2', function() {
        $('#StuContent').removeClass('d-none');
        $('#viewAdmissionModal').addClass('d-none');
    });

    var isApplicationNoValid = true;

    // Function to update the submit button state
    function updateSubmitButtonState() {
        if (isApplicationNoValid) {
            $('#submitBtn').prop('disabled', false); // Enable the button if valid
        } else {
            $('#submitBtn').prop('disabled', true); // Disable the button if invalid
        }
    }

    var today = new Date().toISOString().split('T')[0];
            var tenYearsAgo = new Date();
            tenYearsAgo.setFullYear(tenYearsAgo.getFullYear() - 10);
            var tenYearsAgoDate = tenYearsAgo.toISOString().split('T')[0];

            $('#admitDate').attr('max', today);
            $('#dob').attr('max', tenYearsAgoDate);
            $('#admitDateEdit').attr('max', today);
            $('#dobEdit').attr('max', tenYearsAgoDate);

    // Validate application number on input
    //$('#applicationNo').on('input', function() {
        //var applicationNo = $(this).val();
       // if (applicationNo.length > 0) {
            //$.ajax({
                //url: 'check_application.php', // The PHP script to check the application number
                //type: 'post',
               // data: { applicationNo: applicationNo },
               // success: function(response) {
                    // if (response == "exists") {
                    //     $('#applicationNo').removeClass('is-valid').addClass('is-invalid');
                    //     isApplicationNoValid = false; // Set the flag to false if the application number exists
                    // } else {
                    //     $('#applicationNo').removeClass('is-invalid').addClass('is-valid');
                    //     isApplicationNoValid = true; // Set the flag to true if the application number is valid
                    // }
    //                 updateSubmitButtonState(); // Update the button state based on validity
    //             }
    //         });
    //     } else {
    //         $('#applicationNo').removeClass('is-invalid is-valid');
    //         isApplicationNoValid = true; // Reset the flag if the input is empty
    //         updateSubmitButtonState(); // Update the button state
    //     }
    // });

    const $select = $('#applicationYear');
        const startYear = 2010;
        const currentYear = new Date().getFullYear();
        const endYear = currentYear + 5;

        for (let year = startYear; year <= endYear; year++) {
            $select.append(new Option(year, year));
        }
    
    $('#university').change(function() {
        var universityId = $(this).val();
        
        if (universityId === "") {
            $('#courseName').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
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
                $('#courseName').html(options); // Update the course dropdown
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });
    $('#courseName').change(function() {
        var courseId = $(this).val();

        if (courseId === "") {
            $('#language').html('<option value="">--Select the Specification--</option>'); // Clear the course dropdown
            $('#academicYear').html('<option value="">--Select Academic Year/Sem--</option>'); // Clear the academic year dropdown
            return; // No course selected, exit the function
        }

        $.ajax({
            url: "action/actAdmission.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { courseId: courseId },
            dataType: 'json',
            success: function(response) {
                var options = '<option value="">--Select the Specification--</option>';
                if (response.electives.length > 0) {
                    $.each(response.electives, function(index, elective) {
                        options += '<option value="' + elective.ele_id + '">' + elective.ele_elective + '</option>';
                    });
                    $('#language').attr('required', 'required'); // Add required attribute if electives are available
                } else {
                    $('#language').removeAttr('required'); // Remove required attribute if no electives
                }
                $('#language').html(options); // Update the elective dropdown

                // Assuming response contains course details
                var courseDuration = response.courseDuration; // e.g., 3
                var feesPattern = response.feesPattern; // e.g., 'sem'

                // Generate options for academic year/sem based on duration and pattern
                var academicYearOptions = '<option value="">--Select Academic Year/Sem--</option>';
                if (feesPattern === 'Semester') {
                    var totalSems = courseDuration * 2; // 2 semesters per year
                    for (var i = 1; i <= totalSems; i++) {
                        academicYearOptions += '<option value="' + i + '">' + i + ' Sem</option>';
                    }
                } else if (feesPattern === 'Year') {
                    for (var i = 1; i <= courseDuration; i++) {
                        academicYearOptions += '<option value="' + i + '">' + i + ' Year</option>';
                    }
                }
                $('#academicYear').html(academicYearOptions); // Update the academic year dropdown
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });
    $('#universityEdit').change(function() {
    var universityId = $(this).val();
    
    if (universityId === "") {
        $('#courseNameEdit').html('<option value="">--Select the Course--</option>'); // Clear the course dropdown
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
            $('#courseNameEdit').html(options); // Update the course dropdown
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed: " + status + ", " + error);
        }
    });
});

$('#courseNameEdit').change(function() {
    var courseId = $(this).val();
    
    if (courseId === "") {
        $('#languageEdit').html('<option value="">--Select the Specification--</option>'); // Clear the language dropdown
        $('#academicYearEdit').html('<option value="">--Select Academic Year/Sem--</option>'); // Clear the academic year dropdown
        return; // No course selected, exit the function
    }

    $.ajax({
        url: "action/actAdmission.php", // URL of the PHP script to handle the request
        type: "POST",
        data: { courseId: courseId },
        dataType: 'json',
        success: function(response) {
            var electiveOptions = '<option value="0">--Select the Specification--</option>';
            if (response.electives.length > 0) {
                $.each(response.electives, function(index, elective) {
                    electiveOptions += '<option value="' + elective.ele_id + '">' + elective.ele_elective + '</option>';
                });
                $('#languageEdit').attr('required', 'required'); // Add required attribute if electives are available
            } else {
                $('#languageEdit').removeAttr('required'); // Remove required attribute if no electives
            }
            $('#languageEdit').html(electiveOptions); // Update the language dropdown
            // Generate options for academic year/sem based on duration and pattern
            var academicYearOptions = '<option value="">--Select Academic Year/Sem--</option>';
            var courseDuration = response.courseDuration; // e.g., 3
            var feesPattern = response.feesPattern; // e.g., 'sem'

            if (feesPattern === 'Semester') {
                var totalSems = courseDuration * 2; // 2 semesters per year
                for (var i = 1; i <= totalSems; i++) {
                    academicYearOptions += '<option value="' + i + '">' + i + ' Sem</option>';
                }
            } else if (feesPattern === 'Year') {
                for (var i = 1; i <= courseDuration; i++) {
                    academicYearOptions += '<option value="' + i + '">' + i + ' Year</option>';
                }
            }

            $('#academicYearEdit').html(academicYearOptions); // Update the academic year dropdown
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed: " + status + ", " + error);
        }
    });
});

});


$('#addAdmission').off('submit').on('submit', function(e) {
    
    // Prevent default form submission to perform additional checks
    e.preventDefault(); 

    var form = this; // Get the form element
    if (form.checkValidity() === false) {
        // If the form is invalid, display validation errors
        form.reportValidity();
        return;
    }

    var formData = new FormData(form);

    // Proceed with form submission if everything is valid
    $.ajax({
        url: "action/actAdmission.php",
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
                    // Remove modal or form handling
                    // Ensure the form is not closed if not desired
                    $('#StuContent').removeClass('d-none');
                    $('#addAdmissionModal').addClass('d-none');
                    
                    // Reload the datatable to show updated data
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
        }
    });
});


function goEditAdmission(editId) {
    $.ajax({
        url: 'action/actAdmission.php',
        method: 'POST',
        data: { editId: editId },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            // Set the values for the fields
            $('#admissionId').val(response.stuId);
            $('#stuNameEdit').val(response.name);
            $('#mobileNoEdit').val(response.phone);
            $('#emailEdit').val(response.email);
            $('#universityEdit').val(response.uni_id).trigger('change'); // Trigger change to populate courses

            // Ensure that the course and language fields are populated correctly
            setTimeout(function() {
                $('#courseNameEdit').val(response.cou_id).trigger('change'); // Trigger change to populate electives

                setTimeout(function() {
                    $('#academicYearEdit').val(response.acaYear);
                    $('#languageEdit').val(response.language);
                    $('#mediumEdit').val(response.medium_id);
                    $('#yearTypeEdit').val(response.year_type);
                    $('#digilockerEdit').val(response.digilocker);
                    $('#admitDateEdit').val(response.admit_date);
                    $('#dobEdit').val(response.dob);
                    $('#genderEdit').val(response.gender);
                    $('#addressEdit').val(response.address);
                    $('#pincodeEdit').val(response.pincode);
                    $('#fathernameEdit').val(response.father_name);
                    $('#mothernameEdit').val(response.mother_name);
                    $('#aadharNumberEdit').val(response.aadhar_no);
                    $('#nationalityEdit').val(response.nationality);
                    $('#motherTongueEdit').val(response.mother_tongue);
                    $('#religionEdit').val(response.religion);
                    $('#casteEdit').val(response.caste);
                    $('#communityEdit').val(response.community);
                    $('#maritalEdit').val(response.marital_status);
                    $('#employedEdit').val(response.employed);
                    $('#qualificationEdit').val(response.qualification);
                    $('#previousEdit').val(response.institute);
                    $('#completedEdit').val(response.comp_year);
                    $('#studyEdit').val(response.study_field);
                    $('#gradeEdit').val(response.grade);
                    $('#enrollEdit').val(response.enroll);
                }, 500); // Adjust timeout if necessary
            }, 500); // Adjust timeout if necessary
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}


function goViewAdmission(id)
{
    $.ajax({
        url: 'action/actAdmission.php',
        method: 'POST',
        data: {
            viewId: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {

                    $('#studentImage').attr('src', response.photo ? 'assets/images/student/' + response.photo : 'assets/images/default.png');
                    $('#nameView').text(response.name);
                    $('#phoneView').text(response.phone);
                    $('#emailView').text(response.email);
                    $('#uni_idView').text(response.uni_id);
                    $('#cou_idView').text(response.cou_id);

                    var mediumText = '';
                    if (response.medium_id == 1) {
                        mediumText = 'Tamil';
                    } else if (response.medium_id == 2) {
                        mediumText = 'English';
                    }
                    // Set the text content of the element
                    $('#medium_idView').text(mediumText);
                    $('#applicationView').text(response.apply_no);
                    $('#acaYearView').text(response.acaYear);
                    $('#lagView').text(response.joinYear);
                    $('#enrollView').text(response.enroll ? response.enroll : 'Pending');
                    $('#yearTypeView').text(response.year_type ? response.year_type : '-');
                    $('#languageView').text(response.language ? response.language : '-');
                    $('#digilockerView').text(response.digilocker ? response.digilocker : '-');
                    $('#admitDateView').text(response.admit_date && response.admit_date !== '0000-00-00' ? response.admit_date : '-');
                    $('#dobView').text(response.dob && response.dob !== '0000-00-00' ? response.dob : '-');
                    $('#genderView').text(response.gender ? response.gender : '-');
                    $('#fatherNameView').text(response.father_name ? response.father_name : '-');
                    $('#motherNameView').text(response.mother_name ? response.mother_name : '-');
                    $('#aadharNoView').text(response.aadhar_no && response.aadhar_no !== '0' ? response.aadhar_no : '-');
                    $('#nationalityView').text(response.nationality ? response.nationality : '-');
                    $('#motherTongueView').text(response.mother_tongue ? response.mother_tongue : '-');
                    $('#religionView').text(response.religion ? response.religion : '-');
                    $('#casteView').text(response.caste ? response.caste : '-');
                    $('#communityView').text(response.community ? response.community : '-');
                    $('#maritalStatusView').text(response.marital_status ? response.marital_status : '-');
                    $('#employedView').text(response.employed ? response.employed : '-');
                    $('#qualificationView').text(response.qualification ? response.qualification : '-');
                    $('#instituteView').text(response.institute ? response.institute : '-');
                    $('#compYearView').text(response.comp_year ? response.comp_year : '-');
                    $('#studyFieldView').text(response.study_field ? response.study_field : '-');
                    $('#gradeView').text(response.grade ? response.grade : '-');
                    $('#addressView').text(response.address ? response.address : '-');
                    $('#pincodeView').text(response.pincode && response.pincode !== '0' ? response.pincode : '-');

                    var basePath = 'assets/images/student/';

                    // Update the anchor tags to open images in a new tab
                    $('#sslcView').attr('href', basePath + response.sslc).text(response.sslc);
                    $('#hscView').attr('href', basePath + response.hsc).text(response.hsc);
                    $('#communityCertView').attr('href', basePath + response.community_doc).text(response.community_doc);
                    $('#tcView').attr('href', basePath + response.tc).text(response.tc);
                    $('#aadharImageView').attr('href', basePath + response.aadhar_doc).text(response.aadhar_doc);
                    $('#studentImageView').attr('href', basePath + response.photo).text(response.photo);

                    var html = '';
                    response.student_fees.forEach(function(payment, index) {

                        var fess_total = parseFloat(payment.fee_uni_fee_total) + parseFloat(payment.fee_sdy_fee_total);
                var received_fees = parseFloat(payment.fee_uni_fee) + parseFloat(payment.fee_sty_fee);
                var balance = fess_total - received_fees;
                var status = balance === 0 ? "Complete" : "Pending";

                html += '<tr>';
                html += '<td>' + (index + 1) + '</td>'; // S.No.
                html += '<td>' + payment.fee_uni_fee_total + '</td>'; // University Fee Total
                html += '<td>' + payment.fee_uni_fee + '</td>'; // University Fee Received
                html += '<td>' + payment.fee_sdy_fee_total + '</td>'; // Study Center Fee Total
                html += '<td>' + payment.fee_sty_fee + '</td>'; // Study Center Fee Received
                html += '<td>' + balance + '</td>'; // Balance
                html += '<td>' + status + '</td>'; // Status
                html += '</tr>';
       });
                $('#feesStudent').html(html); // Append HTML to table body

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}

function goDeleteAdmission(id)
{
    if(confirm("Are you sure you want to delete Student?"))
    {
      $.ajax({
        url: 'action/actAdmission.php',
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
    $('#editAdmission').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

            var formData = new FormData(form);
        $.ajax({
            url: "action/actAdmission.php",
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
                        $('#StuContent').removeClass('d-none');
                        $('#editAdmissionModal').addClass('d-none');
                        
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


</script>


    

</body>

</html>



