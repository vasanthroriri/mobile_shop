
                <!-- Start Content-->
                <div class="container-fluid d-none" id="addAdmissionModal">
                <div class="col-xl-12">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="header-title">Admission Progress</h4>
                                            <button type="button" id="backToMainBtn" class="btn btn-secondary">
                                                Back to Main
                                            </button>
                                        </div>
                                        <form class="needs-validation" novalidate name="frmAddAdmission" id="addAdmission" enctype="multipart/form-data">
                                        <input type="hidden" name="hdnAction" value="addAdmission">

                                            <div id="rootwizard">

                                                <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                                    <li class="nav-item" data-target-form="#addAdmission">
                                                        <a href="#account-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-1">
                                                            <i class="ri-account-circle-line fw-normal fs-18 align-middle me-1"></i>
                                                            <span class="d-none d-sm-inline">Primary Info</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#profile-tab-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-1">
                                                            <i class="ri-profile-line fw-normal fs-18 align-middle me-1"></i>
                                                            <span class="d-none d-sm-inline">Seccondry Info</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            
                                                <div class="tab-content b-0 mb-0">

                                                    <div id="bar" class="progress mb-3" style="height: 7px;">
                                                        <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                                    </div>
                                            
                                                    <div class="tab-pane" id="account-2">
                                                        <div class="row">

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="stuName" class="form-label"><b>Name</b><span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Student Name" name="stuName" id="stuName" required="required">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="mobileNo" class="form-label"><b>Mobile No</b><span class="text-danger">*</span></label>
                                                            <input type="tel" class="form-control" pattern="[0-9]{10}" placeholder="Enter Mobile No" name="mobileNo" id="mobileNo" required="required">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                                <label for="email" class="form-label"><b>Email</b></label>
                                                                <input type="email" class="form-control" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" placeholder="Enter Email Id" name="email" id="email" required="required">
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-6">
                                                                <div class="form-group ">
                                                                    <label for="university" class="form-label"><b>University Name</b><span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="university" id="university" required="required">
                                                                        
                                                                        <option value="">--Select the University--</option>
                                                                        <?php 
                                                                        $uniCenterId = $_SESSION['centerId'];
                                                                    $university_result = universityTable($uniCenterId); // Call the function to fetch universities 
                                                                    while ($row = $university_result->fetch_assoc()) {
                                                                    $id = $row['uni_id']; 
                                                                    $name = $row['uni_name'];        
                                                        
                                                                    ?>
                                                        
                                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>

                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="courseName" class="form-label"><b>Course Name</b><span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="courseName" id="courseName" required="required">
                                                                    <option value="">--Select the Course--</option>

                                                                    </select>
                                                                 </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label for="medium" class="form-label"><b>Medium </b><span class="text-danger">*</span></label>
                                                            <select class="form-control" name="medium" id="medium" required="required">
                                                            <option value="">--Select the Medium--</option>
                                                            <option value="1">Tamil</option>
                                                            <option value="2">English</option>

                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group pb-1">
                                                                    <label for="academicYear" class="form-label"><b>Academic Year/Sem</b><span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="academicYear" id="academicYear" required="required">
                                                                        <option value="">--Select Academic Year/Sem--</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="applicationNo" class="form-label"><b>Application No.</b><span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Enter Student Application No." name="applicationNo" id="applicationNo" required="required">
                                                            <div class="invalid-feedback">
                                                                This Application No. is required or already exists.
                                                            </div>
                                                            </div>
                                                            </div> -->

                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label for="language" class="form-label"><b>Language / Elective </b><span class="text-danger">*</span></label>
                                                            <select class="form-control" name="language" id="language" required="required">
                                                            <option value="">--Select the Specification--</option>                                                           
                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group pb-1">
                                                                    <label for="applicationYear" class="form-label"><b>Application Year</b><span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="applicationYear" id="applicationYear" required="required">
                                                                        <option value="">--Select Application Year--</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group pb-1">
                                                                    <label for="applicationType" class="form-label"><b>Application Type</b><span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="applicationType" id="applicationType" required="required">
                                                                        <option value="">--Select Application Type--</option>
                                                                        <option value="AC">Academic Year</option>
                                                                        <option value="CA">Calander Year</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div> <!-- end row -->

                                                        <ul class="list-inline wizard mb-0">
                                                            <li class="next list-inline-item float-end">
                                                                <a href="javascript:void(0);" class="btn btn-info">Add More Info <i class="ri-arrow-right-line ms-1"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-pane" id="profile-tab-2">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <div class="form-group">
                                                            <label for="yearType" class="form-label"><b>Year Type</b></label>
                                                            <select class="form-control" name="yearType" id="yearType" >
                                                            <option value="">--Select the Type--</option>
                                                            <option value="Academic Year">Academic Year</option>
                                                            <option value="Calander Year">Calander Year</option>

                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="enroll" class="form-label"><b>Enrollment No.</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" placeholder="Enter Enrollment Number" name="enroll" id="enroll" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="digilocker" class="form-label"><b>Digilocker</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Digilocker Id" name="digilocker" id="digilocker" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group pb-1">
                                                                    <label for="admitDate" class="form-label"><b>Admission Date</b></label>
                                                                    <input type="date" class="form-control" placeholder="Enter Date of Admission" name="admitDate" id="admitDate">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group pb-1">
                                                                    <label for="dob" class="form-label"><b>Date of Birth</b></label>
                                                                    <input type="date" class="form-control" placeholder="Enter Date of Birth" name="dob" id="dob">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="gender" class="form-label"><b>Gender</b></label>
                                                            <select class="form-control" id="gender" name="gender" >
                                                            <option value="">--Select the Gender--</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Transgender">Transgender</option>
                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                            <div class="form-group pb-1">
                                                            <label for="address" class="form-label"><b>Address</b></label>
                                                            <textarea class="form-control" placeholder="Enter Address" name="address" id="address" ></textarea>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group pb-1">
                                                                    <label for="pincode" class="form-label"><b>Pincode</b></label>
                                                                    <input type="text" class="form-control" pattern="^\d{6}$" title="Please enter a 6-digit pincode" placeholder="Enter Pincode" name="pincode" id="pincode">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="fathername" class="form-label"><b>Father Name</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Father Name" name="fathername" id="fathername">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="mothername" class="form-label"><b>Mother Name</b> </label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Mother Name" name="mothername" id="mothername" >
                                                            </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="aadharNumber" class="form-label"><b>Aadhar Number</b></label>
                                                            <input type="text" class="form-control" pattern="[0-9]{16}" placeholder="Enter Aadhar Number" name="aadharNumber" id="aadharNumber" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="nationality" class="form-label"><b>Nationality</b></label>
                                                            <select class="form-control" name="nationality" id="nationality">
                                                                <option value="">--Select Nationality--</option>
                                                                <option value="India">India</option>
                                                                <option value="Sri Lanka">Sri Lanka</option>
                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="motherTongue" class="form-label"><b>Mother Tongue</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Mother Tongue" name="motherTongue" id="motherTongue" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="religion" class="form-label"><b>Religion</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Religion" name="religion" id="religion" >
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="caste" class="form-label"><b>Caste</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Caste" name="caste" id="caste">
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="community" class="form-label"><b>Community</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Community" name="community" id="community" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label for="marital" class="form-label"><b>Marital Status</b></label>
                                                            <select class="form-control" name="marital" id="marital">
                                                            <option value="">--Select the Marital Status--</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label for="employed" class="form-label"><b>Employed</b></label>
                                                            <select class="form-control" name="employed" id="employed" >
                                                            <option value="">--Select the Employed--</option>
                                                            <option value="Employed">Employed</option>
                                                            <option value="Unemployed">Unemployed</option>

                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="qualification" class="form-label"><b>Highest Qualifiaction</b></label>
                                                            <select class="form-control" id="qualification" name="qualification" >
                                                            <option value="">--Select the Qualifiaction--</option>
                                                            <option value="12">12TH</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="UG">UG</option>
                                                            <option value="PG">PG</option>
                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="previous" class="form-label"><b>Previous College / School Studied</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Previous College / School Studied" name="previous" id="previous" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="completed" class="form-label"><b>Year Of Completed</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Year Of Completed" name="completed" id="completed" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="study" class="form-label"><b>Major Field Of Study</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Major Field Of Study" name="study" id="study" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="grade" class="form-label"><b>CGPA / Grade</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter CGPA / Grade" name="grade" id="grade" >
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="sslc" class="form-label"><b>SSLC Marksheet</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter SSLC" name="sslc" id="sslc" accept=".jpg,.jpeg,.png">
                                                            </div>
                                                            </div>



                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="hsc" class="form-label"><b>HSC Marksheet</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter HSC" name="hsc" id="hsc" accept=".jpg,.jpeg,.png">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6"> 
                                                            <div class="form-group pb-1">
                                                            <label for="community" class="form-label"><b>Community Certificate</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Community" name="community" id="community" accept=".jpg,.jpeg,.png">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="tc" class="form-label"><b>Transfer Certificate</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter TC" name="tc" id="tc" accept=".jpg,.jpeg,.png" >
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="aadhar" class="form-label"><b>Aathar Card</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Aadhar" name="aadhar" id="aadhar" accept=".jpg,.jpeg,.png">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="photo" class="form-label"><b>Passport Size Photo</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Photo" name="photo" id="photo" accept=".jpg,.jpeg,.png">
                                                            </div>
                                                            </div>

                                                            </div> <!-- end row -->
                                                        <ul class="pager wizard mb-0 list-inline">
                                                            <li class="previous list-inline-item">
                                                                <button type="button" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i> Back to Profile</button>
                                                            </li>
                                                            <li class="next list-inline-item float-end">
                                                                <button type="submit" id="submitBtn" class="btn btn-info">Submit</button>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div> <!-- tab-content -->
                                            </div> <!-- end #progressbarwizard-->
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div>
                </div> <!-- content -->


            <!-- --------------------------------------- -->

                <!-- Start Content-->
                <div class="container-fluid d-none" id="editAdmissionModal">
                    <div class="col-xl-12">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="header-title">Edit Admission Progress</h4>
                                            <button type="button" id="backToMainBtn1" class="btn btn-secondary">
                                                Back to Main
                                            </button>
                                        </div>

                                        <form class="needs-validation" novalidate name="frmEditAdmission" id="editAdmission" enctype="multipart/form-data">
                                        <input type="hidden" name="hdnAction" value="editAdmission">
                                        <input type="hidden" name="hdnAdmissionId" id="admissionId">

                                            <div id="progressbarwizard">
                                                <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                                    <li class="nav-item" data-target-form="#editAdmission">
                                                        <a href="#first" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-1 active">
                                                            <i class="ri-account-circle-line fw-normal fs-18 align-middle me-1"></i>
                                                            <span class="d-none d-sm-inline">Primary Info</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" data-target-form="#profileForm">
                                                        <a href="#second" data-bs-toggle="tab" data-toggle="tab"  class="nav-link rounded-0 py-1">
                                                            <i class="ri-profile-line fw-normal fs-18 align-middle me-1"></i>
                                                            <span class="d-none d-sm-inline">Seccondry Info</span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content mb-0 b-0">

                                                    <div class="tab-pane active show" id="first">
                                                            <div class="row">
                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="stuNameEdit" class="form-label"><b>Name</b><span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" placeholder="Enter Student Name" name="stuNameEdit" id="stuNameEdit" required="required">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="mobileNoEdit" class="form-label"><b>Mobile No</b><span class="text-danger">*</span></label>
                                                            <input type="tel" class="form-control" pattern="[0-9]{10}" placeholder="Enter Mobile No" name="mobileNoEdit" id="mobileNoEdit" required="required">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                                <label for="emailEdit" class="form-label"><b>Email</b></label>
                                                                <input type="email" class="form-control" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" placeholder="Enter Email Id" name="emailEdit" id="emailEdit" required="required">
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-6">
                                                                <div class="form-group ">
                                                                    <label for="universityEdit" class="form-label"><b>University Name</b><span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="universityEdit" id="universityEdit" required="required">
                                                                        
                                                                        <option value="">--Select the University--</option>
                                                                        <?php 
                                                                        $uniCenterId = $_SESSION['centerId'];
                                                                    $university_result = universityTable($uniCenterId); // Call the function to fetch universities 
                                                                    while ($row = $university_result->fetch_assoc()) {
                                                                    $id = $row['uni_id']; 
                                                                    $name = $row['uni_name'];    
                                                        
                                                                    ?>
                                                        
                                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>

                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="courseNameEdit" class="form-label"><b>Course Name</b><span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="courseNameEdit" id="courseNameEdit" required="required">
                                                                    <option value="">--Select the Course--</option>

                                                                    </select>
                                                                 </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label for="mediumEdit" class="form-label"><b>Medium </b><span class="text-danger">*</span></label>
                                                            <select class="form-control" name="mediumEdit" id="mediumEdit" required="required">
                                                            <option value="">--Select the Medium--</option>
                                                            <option value="1">Tamil</option>
                                                            <option value="2">English</option>

                                                            </select>
                                                            </div>
                                                            </div><!-- end col -->

                                                            <div class="col-sm-6">
                                                                <div class="form-group pb-1">
                                                                    <label for="academicYearEdit" class="form-label"><b>Academic Year/Sem</b><span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="academicYearEdit" id="academicYearEdit" required="required">
                                                                        <option value="">--Select Academic Year/Sem--</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label for="languageEdit" class="form-label"><b>Language / Elective </b><span class="text-danger">*</span></label>
                                                            <select class="form-control" name="languageEdit" id="languageEdit" required="required">
                                                            <option value="0">--Select the Specification--</option>                                                           
                                                            </select>
                                                            </div>
                                                            </div>

                                                            </div> <!-- end row -->
                                                        <ul class="list-inline wizard mb-0">
                                                            <li class="next list-inline-item float-end">
                                                                <a href="javascript:void(0);" class="btn btn-info">Add More Info <i class="ri-arrow-right-line ms-1"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-pane fade" id="second">
                                                        <form id="profileForm" method="post" action="#" class="form-horizontal">
                                                            <div class="row">
                                                            <div class="col-sm-4">
                                                            <div class="form-group">
                                                            <label for="yearTypeEdit" class="form-label"><b>Year Type</b></label>
                                                            <select class="form-control" name="yearTypeEdit" id="yearTypeEdit" >
                                                            <option value="">--Select the Type--</option>
                                                            <option value="Academic Year">Academic Year</option>
                                                            <option value="Calander Year">Calander Year</option>

                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="enrollEdit" class="form-label"><b>Enrollment No.</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" placeholder="Enter Enrollment Number" name="enrollEdit" id="enrollEdit" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="digilockerEdit" class="form-label"><b>Digilocker</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Digilocker Id" name="digilockerEdit" id="digilockerEdit" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group pb-1">
                                                                    <label for="admitDateEdit" class="form-label"><b>Admission Date</b></label>
                                                                    <input type="date" class="form-control" placeholder="Enter Date of Admission" name="admitDateEdit" id="admitDateEdit">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group pb-1">
                                                                    <label for="dobEdit" class="form-label"><b>Date of Birth</b></label>
                                                                    <input type="date" class="form-control" placeholder="Enter Date of Birth" name="dobEdit" id="dobEdit">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="genderEdit" class="form-label"><b>Gender</b></label>
                                                            <select class="form-control" id="genderEdit" name="genderEdit" >
                                                            <option value="">--Select the Gender--</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Transgender">Transgender</option>
                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                            <div class="form-group pb-1">
                                                            <label for="addressEdit" class="form-label"><b>Address</b></label>
                                                            <textarea class="form-control" placeholder="Enter Address" name="addressEdit" id="addressEdit" ></textarea>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="pincodeEdit" class="form-label"><b>Pincode</b></label>
                                                            <input type="text" class="form-control" pattern="^\d{6}$" title="Please enter a 6-digit pincode" placeholder="Enter Pincode" name="pincodeEdit" id="pincodeEdit" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="fathernameEdit" class="form-label"><b>Father Name</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Father Name" name="fathernameEdit" id="fathernameEdit">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="mothernameEdit" class="form-label"><b>Mother Name</b> </label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Mother Name" name="mothernameEdit" id="mothernameEdit" >
                                                            </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="aadharNumberEdit" class="form-label"><b>Aadhar Number</b></label>
                                                            <input type="text" class="form-control" pattern="^\d{16}$" placeholder="Enter Aadhar Number" name="aadharNumberEdit" id="aadharNumberEdit" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="nationalityEdit" class="form-label"><b>Nationality</b></label>
                                                            <select class="form-control" name="nationalityEdit" id="nationalityEdit">
                                                                <option value="">--Select Nationality--</option>
                                                                <option value="India">India</option>
                                                                <option value="Sri Lanka">Sri Lanka</option>
                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="motherTongueEdit" class="form-label"><b>Mother Tongue</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Mother Tongue" name="motherTongueEdit" id="motherTongueEdit" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="religionEdit" class="form-label"><b>Religion</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Religion" name="religionEdit" id="religionEdit" >
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="casteEdit" class="form-label"><b>Caste</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Caste" name="casteEdit" id="casteEdit">
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                            <div class="form-group pb-1">
                                                            <label for="communityEdit" class="form-label"><b>Community</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Community" name="communityEdit" id="communityEdit" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label for="maritalEdit" class="form-label"><b>Marital Status</b></label>
                                                            <select class="form-control" name="maritalEdit" id="maritalEdit">
                                                            <option value="">--Select the Marital Status--</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <label for="employedEdit" class="form-label"><b>Employed</b></label>
                                                            <select class="form-control" name="employedEdit" id="employedEdit" >
                                                            <option value="">--Select the Empoloyed--</option>
                                                            <option value="Employed">Employed</option>
                                                            <option value="Unemployed">Unemployed</option>

                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="qualificationEdit" class="form-label"><b>Highest Qualifiaction</b></label>
                                                            <select class="form-control" id="qualificationEdit" name="qualificationEdit" >
                                                            <option value="">--Select the Qualifiaction--</option>
                                                            <option value="12">12TH</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="UG">UG</option>
                                                            <option value="PG">PG</option>
                                                            </select>
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="previousEdit" class="form-label"><b>Previous College / School Studied</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Previous College / School Studied" name="previousEdit" id="previousEdit" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="completedEdit" class="form-label"><b>Year Of Completed</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Year Of Completed" name="completedEdit" id="completedEdit" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="studyEdit" class="form-label"><b>Major Field Of Study</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Major Field Of Study" name="studyEdit" id="studyEdit" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="gradeEdit" class="form-label"><b>CGPA / Grade</b></label>
                                                            <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter CGPA / Grade" name="gradeEdit" id="gradeEdit" >
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="sslcEdit" class="form-label"><b>SSLC Marksheet</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter SSLC" name="sslcEdit" id="sslcEdit" accept=".jpg,.jpeg,.png">
                                                            </div>
                                                            </div>



                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="hscEdit" class="form-label"><b>HSC Marksheet</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter HSC" name="hscEdit" id="hscEdit"  accept=".jpg,.jpeg,.png">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6"> 
                                                            <div class="form-group pb-1">
                                                            <label for="communityEdit" class="form-label"><b>Community Certificate</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Community" name="communityEdit" id="communityEdit" accept=".jpg,.jpeg,.png" >
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="tcEdit" class="form-label"><b>Transfer Certificate</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter TC" name="tcEdit" id="tcEdit" accept=".jpg,.jpeg,.png" >
                                                            </div>
                                                            </div>


                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="aadharEdit" class="form-label"><b>Aathar Card</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Aadhar" name="aadharEdit" id="aadharEdit" accept=".jpg,.jpeg,.png">
                                                            </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                            <div class="form-group pb-1">
                                                            <label for="photoEdit" class="form-label"><b>Passport Size Photo</b>(Allowed formats: jpg, jpeg, png)</label>
                                                            <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Photo" name="photoEdit" id="photoEdit"  accept=".jpg,.jpeg,.png">
                                                            </div>
                                                            </div>
                                                                <!-- end col -->
                                                            </div>
                                                            <!-- end row -->
                                                        </form>
                                                        <ul class="pager wizard mb-0 list-inline">
                                                            <li class="previous list-inline-item">
                                                                <button type="button" class="btn btn-light"><i class="ri-arrow-left-line me-1"></i> Back to Profile </button>
                                                            </li>
                                                            <li class="next list-inline-item float-end">
                                                                <button type="submit" class="btn btn-info">Submit</button>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div> <!-- tab-content -->
                                            </div> <!-- end #rootwizard-->
                                        </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div>
                </div> <!-- content -->
            <!----------------------------------------->
      
            
<!-- Start Content-->
                    <div class="container-fluid d-none" id="viewAdmissionModal"> 
                        
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" id="backToMainBtn2" class="btn btn-secondary">
                                        Back to Main
                                        </button>
                                    </div>
                                </div>
                                <h3 class="page-title">View Student Details</h3>   
                            </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="row g-0 align-items-center">
                                    <div class="col-md-2">
                                    <img id="studentImage" src="" alt="Student Image" class="img-fluid avatar-xxl rounded" />
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <div class="table-responsive-sm">
                                                <table class="table table-centered table-borderless mb-0">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>:</th>
                                                        <td id="nameView"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone</th>
                                                        <th>:</th>
                                                        <td id="phoneView"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email Id</th>
                                                        <th>:</th>
                                                        <td id="emailView"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Academic Year</th>
                                                        <th>:</th>
                                                        <td id="acaYearView"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Application No.</th>
                                                        <th>:</th>
                                                        <td id="applicationView"></td>
                                                    </tr>
                                                </table>
                                            </div> <!-- end table-responsive-->
                                        </div> <!-- end card-body-->
                                    </div> <!-- end col -->
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <div class="table-responsive-sm">
                                                <table class="table table-centered table-borderless mb-0">
                                                    <tr>
                                                        <th>University Name</th>
                                                        <th>:</th>
                                                        <td id="uni_idView"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Course Name</th>
                                                        <th>:</th>
                                                        <td id="cou_idView"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Medium</th>
                                                        <th>:</th>
                                                        <td id="medium_idView"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Joining Year</th>
                                                        <th>:</th>
                                                        <td id="lagView"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Enrollment No.</th>
                                                        <th>:</th>
                                                        <td id="enrollView"></td>
                                                    </tr>
                                                </table>
                                            </div> <!-- end table-responsive-->
                                        </div> <!-- end card-body-->
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                            
                                <div class="col-lg-12">
                                    <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        Fees Details
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-centered table-borderless mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">S.No.</th>
                                                                        <th scope="col">University fees Total</th>
                                                                        <th scope="col">University Received Fees</th>
                                                                        <th scope="col">Study Center Total</th>
                                                                        <th scope="col">Study Received</th>
                                                                        <th scope="col">Balance</th>
                                                                        <th scope="col">Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="feesStudent">
                                                                    
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Personal Details
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                            <div class="row g-0">
                                                                <div class="col-md-4">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive-sm">
                                                                            <table class="table table-centered table-borderless mb-0">
                                                                                <tr>
                                                                                    <th>Year Type</th>
                                                                                    <th>:</th>
                                                                                    <td id="yearTypeView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Language / Elective</th>
                                                                                    <th>:</th>
                                                                                    <td id="languageView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Digilocker</th>
                                                                                    <th>:</th>
                                                                                    <td id="digilockerView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Admission Date</th>
                                                                                    <th>:</th>
                                                                                    <td id="admitDateView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Date of Birth</th>
                                                                                    <th>:</th>
                                                                                    <td id="dobView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Gender</th>
                                                                                    <th>:</th>
                                                                                    <td id="genderView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Father Name</th>
                                                                                    <th>:</th>
                                                                                    <td id="fatherNameView"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div> <!-- end table-responsive-->
                                                                    </div> <!-- end card-body-->
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive-sm">
                                                                            <table class="table table-centered table-borderless mb-0">
                                                                                <tr>
                                                                                    <th>Mother Name</th>
                                                                                    <th>:</th>
                                                                                    <td id="motherNameView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Aadhar Number</th>
                                                                                    <th>:</th>
                                                                                    <td id="aadharNoView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Nationality</th>
                                                                                    <th>:</th>
                                                                                    <td id="nationalityView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Mother Tongue</th>
                                                                                    <th>:</th>
                                                                                    <td id="motherTongueView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Religion</th>
                                                                                    <th>:</th>
                                                                                    <td id="religionView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Caste</th>
                                                                                    <th>:</th>
                                                                                    <td id="casteView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Community</th>
                                                                                    <th>:</th>
                                                                                    <td id="communityView"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div> <!-- end table-responsive-->
                                                                    </div> <!-- end card-body-->
                                                                </div> <!-- end col -->
                                                                <div class="col-md-4">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive-sm">
                                                                            <table class="table table-centered table-borderless mb-0">
                                                                                <tr>
                                                                                    <th>Marital Status</th>
                                                                                    <th>:</th>
                                                                                    <td id="maritalStatusView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Employed</th>
                                                                                    <th>:</th>
                                                                                    <td id="employedView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Highest Qualification</th>
                                                                                    <th>:</th>
                                                                                    <td id="qualificationView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Previous Institute</th>
                                                                                    <th>:</th>
                                                                                    <td id="instituteView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Year Of Completion</th>
                                                                                    <th>:</th>
                                                                                    <td id="compYearView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Major Field Of Study</th>
                                                                                    <th>:</th>
                                                                                    <td id="studyFieldView"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>CGPA / Grade</th>
                                                                                    <th>:</th>
                                                                                    <td id="gradeView"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div> <!-- end table-responsive-->
                                                                    </div> <!-- end card-body-->
                                                                </div> <!-- end col -->
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive-sm">
                                                                            <table class="table table-centered table-borderless mb-0">
                                                                                <tr>
                                                                                    <th class="col-2">Address</th>
                                                                                    <th class="col-1">:</th>
                                                                                    <td class="col-5" id="addressView"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div> <!-- end table-responsive-->
                                                                    </div> <!-- end card-body-->
                                                                </div> <!-- end col -->
                                                                <div class="col-md-4">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive-sm">
                                                                            <table class="table table-centered table-borderless mb-0">
                                                                                    <tr>
                                                                                        <th>Pincode</th>
                                                                                        <th>:</th>
                                                                                        <td id="pincodeView"></td>
                                                                                    </tr>
                                                                            </table>
                                                                        </div> <!-- end table-responsive-->
                                                                    </div> <!-- end card-body-->
                                                                </div> <!-- end col -->
                                                            </div> <!-- end row-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Document Details
                                                    </button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                            <div class="row g-0 align-items-center">
                                                                <div class="col-md-6">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive-sm">
                                                                            <table class="table table-centered table-borderless mb-0">
                                                                                <tr>
                                                                                    <th>SSLC Certificate</th>
                                                                                    <th>:</th>
                                                                                    <td><a id="sslcView" href="#" target="_blank"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>HSC Certificate</th>
                                                                                    <th>:</th>
                                                                                    <td><a id="hscView" href="#" target="_blank"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Community Certificate</th>
                                                                                    <th>:</th>
                                                                                    <td><a id="communityCertView" href="#" target="_blank"></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div> <!-- end table-responsive-->
                                                                    </div> <!-- end card-body-->
                                                                </div> <!-- end col -->
                                                                <div class="col-md-6">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive-sm">
                                                                            <table class="table table-centered table-borderless mb-0">
                                                                                <tr>
                                                                                    <th>Transfer Certificate</th>
                                                                                    <th>:</th>
                                                                                    <td><a id="tcView" href="#" target="_blank"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Aadhar Image</th>
                                                                                    <th>:</th>
                                                                                    <td><a id="aadharImageView" href="#" target="_blank"></a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Student Image</th>
                                                                                    <th>:</th>
                                                                                    <td><a id="studentImageView" href="#" target="_blank"></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div> <!-- end table-responsive-->
                                                                    </div> <!-- end card-body-->
                                                                </div> <!-- end col -->
                                                            </div> <!-- end row-->
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                     </div> <!-- content -->
  