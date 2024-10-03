<!-- Modal -->
    <div class="modal fade" id="addFacultyfModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate name="frmAddStaff" id="addFaculty" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addFacultyId">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Faculty</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="staffName" class="form-label"><b>Name</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="staffName" id="staffName" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="gender" class="form-label"><b>Gender</b><span class="text-danger">*</span></label>
                                    <select class="form-control" id="gender" name="gender" required="required">
                                        <option value="">--Select the Gender--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Transgender">Transgender</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mobile" class="form-label"><b>Mobile No</b><span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" pattern="[0-9]{10}" placeholder="Enter Mobile No" name="mobile" id="mobile" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="form-label"><b>Email</b><span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" placeholder="Enter Email" name="email" id="email" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group pb-3">
                                    <label for="address" class="form-label"><b>Address</b><span class="text-danger">*</span></label>
                                    <textarea class="form-control" placeholder="Enter address" name="address" id="address" required="required"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="dateofjoin" class="form-label"><b>Date of Join</b></label>
                                    <input type="date" class="form-control" placeholder="Enter Date of Join" name="dateofjoin" id="dateofjoin">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="salary" class="form-label"><b>Salary (Per Day)</b></label>
                                    <input type="number" class="form-control" pattern="[0-9]{12}" placeholder="Enter Salary" name="salary" id="salary">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="qualification" class="form-label"><b>Qualification</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  placeholder="Enter Qualification" name="qualification" id="qualification" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="clgName" class="form-label"><b>College Name</b></label>
                                    <input type="text" class="form-control"  placeholder="Enter College Name" name="clgName" id="clgName">
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="aadhar" class="form-label"><b>Aadhar Card (JPG , JPEG , PNG )</b><span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" placeholder="Enter Aadhar" name="aadhar" id="aadhar" required="required" accept=".jpg,.jpeg,.png">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group pb-1">
                                    <label for="course" class="form-label"><b>Course</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="course" id="course" required="required">
                                        <option value="">--Select the Course--</option>
                                            <?php 
                                            $couQuery = "SELECT * FROM `jeno_course` WHERE cou_status='Active' AND cou_center_id = $centerId";
                                            $course_result = mysqli_query($conn , $couQuery);
                                            while ($row = $course_result->fetch_assoc()) {
                                                $id = $row['cou_id']; 
                                                $name = $row['cou_name'];    
                                            
                                            ?>
                                            
                                            <option value="<?php echo $id;?>"><?php echo $name;?></option>

                                            <?php } ?>
                                    </select>
                                </div>
                            </div> 
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <!-- ------------------------------------------------------------------------------------------------------------------ -->

    <!-- Modal -->
    <div class="modal fade" id="editFacultyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate name="frmEditStaff" id="editFaculty" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="editFaculty">
                    <input type="hidden" name="hdnFacultyId" id="facultyId">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Edit Faculty</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="staffNameEdit" class="form-label"><b>Name</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="staffNameEdit" id="staffNameEdit" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="genderEdit" class="form-label"><b>Gender</b><span class="text-danger">*</span></label>
                                    <select class="form-control" id="genderEdit" name="genderEdit" required="required">
                                        <option value="">--Select the Gender--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Transgender">Transgender</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mobileEdit" class="form-label"><b>Mobile No</b><span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" pattern="[0-9]{10}" placeholder="Enter Mobile No" name="mobileEdit" id="mobileEdit" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emailEdit" class="form-label"><b>Email</b><span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" placeholder="Enter Email" name="emailEdit" id="emailEdit" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group pb-3">
                                    <label for="addressEdit" class="form-label"><b>Address</b><span class="text-danger">*</span></label>
                                    <textarea class="form-control" placeholder="Enter address" name="addressEdit" id="addressEdit" required="required"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="dateofjoinEdit" class="form-label"><b>Date of Join</b></label>
                                    <input type="date" class="form-control" placeholder="Enter Date of Join" name="dateofjoinEdit" id="dateofjoinEdit">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="salaryEdit" class="form-label"><b>Salary (Per Day)</b></label>
                                    <input type="number" class="form-control" pattern="[0-9]{12}" placeholder="Enter Salary" name="salaryEdit" id="salaryEdit">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="qualificationEdit" class="form-label"><b>Qualification</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  placeholder="Enter Qualification" name="qualificationEdit" id="qualificationEdit" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="clgNameEdit" class="form-label"><b>College Name</b></label>
                                    <input type="text" class="form-control"  placeholder="Enter College Name" name="clgNameEdit" id="clgNameEdit">
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="aadharEdit" class="form-label"><b>Aadhar Card (JPG , JPEG , PNG )</b></label>
                                    <input type="file" class="form-control" placeholder="Enter Aadhar" name="aadharEdit" id="aadharEdit" accept=".jpg,.jpeg,.png">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group pb-1">
                                    <label for="courseEdit" class="form-label"><b>Course</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="courseEdit" id="courseEdit" required="required">
                                        <option value="">--Select the Course--</option>
                                            <?php 
                                            $couEditQuery = "SELECT * FROM `jeno_course` WHERE cou_status='Active' AND cou_center_id = $centerId";
                                            $courseResult = mysqli_query($conn , $couEditQuery);
                                            while ($row = $courseResult->fetch_assoc()) {
                                                $id = $row['cou_id']; 
                                                $name = $row['cou_name'];    
                                            
                                            ?>
                                            
                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>

                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
             
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <!-- --------------------------------------------------------------------------------------------------------------------------------------- -->

   <!-- View Modal -->

   <div class="d-none " id="facultyView">
        
        <form name="frmViewStaff" method="post">
            <div class="page-title-box">
            <h3 class="page-title">Faculty Details</h3>
            </div>  
            <div class="modal-footer mb-3">
                <button type="button" class="btn btn-danger" id="backButton">Back</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Faculty Name</h4> 
                            <span class="detail" id="staffNameView"></span>
                        </div>
                    </div> 
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Gender</h4> 
                            <span class="detail" id="genderView"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Mobile No</h4>
                            <span class="detail" id="mobileView"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Email</h4>
                            <span class="detail" id="emailView"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Date of Joining</h4> 
                            <span class="detail" id="dateofjoinView"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Salary</h4>
                            <span class="detail" id="salaryView"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Qualification</h4> 
                            <span class="detail" id="qualificationView"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>College Name</h4> 
                            <span class="detail" id="clgnameView"></span>
                        </div>
                    </div> 
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Address</h4> 
                            <span class="detail" id="addressView"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Aadhar card</h4>
                            <span class="detail"><a id="aadharView" href="#" target="_blank">View Aadhar Card</a></span>
                        </div>
                    </div> 
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Course</h4>
                            <span class="detail" id="courseView"></span>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>   
    </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------ -->