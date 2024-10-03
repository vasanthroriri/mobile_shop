
<!-- Modal -->
    <div class="modal fade" id="addEnquiryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate  id="addEnquiry" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addEnquiry">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Enquiry</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-3">
                        <div class="col-sm-12">
                                <div class="form-group pb-1">
                                    <label for="name" class="form-label"><b> Name</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  placeholder="Enter First Name" name="name" id="name" required="required">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group pb-1">
                                    <label for="gender" class="form-label"><b>Gender</b></label>
                                    <select class="form-control" id="gender" name="gender" >
                                         <option value="">----select----</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Transgender">Transgender</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group pb-1">
                                    <label for="dob" class="form-label"><b>Date of Birth</b></label>
                                    <input type="date" class="form-control" placeholder="Enter Date of Birth" name="dob" id="dob" >
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group pb-1">
                                    <label for="mobile" class="form-label"><b>Mobile No</b><span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" pattern="[0-9]{10}" placeholder="Enter Mobile No" name="mobile" id="mobile" required="required">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group pb-1">
                                    <label for="email" class="form-label"><b>Email</b></label>
                                    <input type="email" class="form-control" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" placeholder="Enter Email" name="email" id="email">
                                </div>
                            </div>
                           
                            
                            <div class="col-sm-12">
                                <div class="form-group pb-1">
                                    <label for="address" class="form-label"><b>Address</b></label>
                                    <textarea class="form-control" placeholder="Enter address" name="address" id="address"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label for="university" class="form-label"><b>University Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="university" id="university" onchange="fetchCourses()" required="required">
                                        
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
                                    <label for="course" class="form-label"><b>Course Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="course" id="course" required="required">
                                    <option value="">--Select the Course--</option>

                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="year" class="form-label"><b>Year</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="year" id="year" required="required">
                                        <option value="">--Select the Year--</option>
                                        <option value="1">1 st Year</option>
                                        <option value="2">2 nd Year</option>
                                        <option value="3">3 rd Year</option>
                                    </select>
                                </div>
                            </div>    -->
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="medium" class="form-label"><b>Medium</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="medium" id="medium" required="required">
                                        <option value="">--Select the Medium--</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="English">English</option>
                                        
                                    </select>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="enquiryAdd" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <!-- ------------------------------------------------------------------------------------------------------------------ -->

        <!-- Modal -->
             <div class="modal fade" id="editEnquiryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form class="needs-validation" novalidate  id="editEnquiry" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="editEnquiry">
                    <input type="hidden" name="editEnquiryId" id="editEnquiryId">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Edit Enquiry</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-3">
                        <div class="col-sm-12">
                                <div class="form-group pb-1">
                                    <label for="name" class="form-label"><b> Name</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  placeholder="Enter First Name" name="editName" id="editName" required="required">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group pb-1">
                                    <label for="editGender" class="form-label"><b>Gender</b></label>
                                    <select class="form-control" id="editGender" name="editGender" >
                                         <option value="">----select----</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Transgender">Transgender</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group pb-1">
                                    <label for="editDob" class="form-label"><b>Date of Birth</b></label>
                                    <input type="date" class="form-control" placeholder="Enter Date of Birth" name="editDob" id="editDob" >
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group pb-1">
                                    <label for="editMobile" class="form-label"><b>Mobile No</b><span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" pattern="[0-9]{10}" placeholder="Enter Mobile No" name="editMobile" id="editMobile" required="required">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group pb-1">
                                    <label for="editEmail" class="form-label"><b>Email</b></label>
                                    <input type="email" class="form-control" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" placeholder="Enter Email" name="editEmail" id="editEmail" >
                                </div>
                            </div>
                           
                            
                            <div class="col-sm-12">
                                <div class="form-group pb-1">
                                    <label for="editAddress" class="form-label"><b>Address</b></label>
                                    <textarea class="form-control" placeholder="Enter address" name="editAddress" id="editAddress" ></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label for="editUniversity" class="form-label"><b>University Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="editUniversity" id="editUniversity" onchange="fetchCourses()" required="required">
                                        
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
                                    <label for="editCourse" class="form-label"><b>Course Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="editCourse" id="editCourse"  required="required">
                                    <option value="">--Select the Course--</option>
                                   
                        
                       

                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="year" class="form-label"><b>Year</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="year" id="year" required="required">
                                        <option value="">--Select the Year--</option>
                                        <option value="1">1 st Year</option>
                                        <option value="2">2 nd Year</option>
                                        <option value="3">3 rd Year</option>
                                    </select>
                                </div>
                            </div>    -->
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editMedium" class="form-label"><b>Medium</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="editMedium" id="editMedium" required="required">
                                        <option value="">--Select the Medium--</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="English">English</option>
                                        
                                    </select>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
                                        
    <div class="d-none " id="enquiryView">
        
        <form name="frm" method="post">
            <input type="hidden" name="hdnAction" value="">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Enquiry Details</h3>
            </div>  
            <div class="modal-footer mb-3">
                <button type="button" class="btn btn-danger" id="backButtonEnquiry">Back</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Student Name</h4> 
                            <span class="detail" id="viewStudentName"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Gender</h4>
                            <span class="detail" id="viewGender"></span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Date Of Birth</h4>
                            <span class="detail" id="viewDob"></span>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Mobile No</h4>
                            <span class="detail" id="viewMobileNo"></span>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Email</h4>
                            <span class="detail" id="viewEmail"></span>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Address</h4>
                            <span class="detail" id="viewAddress"></span>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>University Name</h4>
                            <span class="detail" id="viewUniversityName"></span>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Course Name</h4>
                            <span class="detail" id="viewCourseName"></span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Medium</h4>
                            <span class="detail" id="viewMedium"></span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Adminsion status</h4>
                            <span class="detail" id="viewAddmissionStatus"></span>
                        </div>
                    </div>

                    
                </div>
            </div>
            
        </form>   
    </div>