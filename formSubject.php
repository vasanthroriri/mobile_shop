<!-- Start Content-->
<div class="container-fluid d-none" id="addSubjectModal">
    <div class="card overflow-hidden">
        <div class="card-body">
            <h4 class="header-title">Add Subject</h4>
            <form class="needs-validation" novalidate  name="frmAddSubject" id="addSubject" enctype="multipart/form-data">
            <div class="col-12 text-end">
                    <button type="button" id="backButton" class="btn btn-danger">Back</button>
                </div>
                <input type="hidden" name="hdnAction" value="addSubject">
                <input type="hidden" name="subType" id="subType" value="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="university" class="form-label"><b>University Name</b><span class="text-danger">*</span></label>
                            <select class="form-control" name="university" id="university" required>
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
                            <select class="form-control" name="course" id="course" required>
                                <option value="">--Select the Course--</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 " id="electiveDiv" style="display:none;">
                        <div class="form-group">
                            <label for="elective" class="form-label"><b>Elective</b><span class="text-danger" >*</span></label>
                            <select class="form-control" name="elective" id="elective" >
                                <option value="">--Select the Category--</option>
                              
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label for="year" class="form-label"><b>Year / Semester</b><span class="text-danger">*</span></label>
                        <select class="form-control" name="year" id="year" required>
                            <option value="">--Select the Year--</option>
                        </select>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="button" id="addInputButton" class="btn btn-primary">Add Subject</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" id="addElectiveButton" class="btn btn-primary">Add Additional Subject</button>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-5">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <h4 id="subjectsHeader" class="header-title">Subjects</h4>
                                <div id="additionalInputs"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <h4 id="languageSubjectsHeader" class="header-title">Additional Subjects</h4>
                                <div id="electiveInputs"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" id="cancelButton" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- //---------------------------------------------------------------------------------------------------------- -->

    <!-- Start Content-->
<div class="container-fluid d-none" id="editSubjectModal">
    <div class="card overflow-hidden">
        <div class="card-body">
            <h4 class="header-title">Edit Subject</h4>
            <form class="needs-validation" novalidate  name="frmEditSubject" id="editSubject" enctype="multipart/form-data">
            <div class="col-12 text-end">
                    <button type="button" id="editBackButton" class="btn btn-danger">Back</button>
                </div>
                <input type="hidden" name="hdnAction" value="editSubject">
                <input type="hidden" name="editSubType" id="editSubType" value="">
                <input type="hidden" name="editSubId" id="editSubId" value="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="editUniversity" class="form-label"><b>University Name</b><span class="text-danger">*</span></label>
                            <select class="form-control" name="editUniversity" id="editUniversity" required disabled>
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
                            <select class="form-control" name="editCourse" id="editCourse" required disabled>
                                <option value="">--Select the Course--</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 " id="editElectiveDiv" style="display:none;">
                        <div class="form-group">
                            <label for="editElective" class="form-label"><b>Elective</b><span class="text-danger" >*</span></label>
                            <select class="form-control" name="editElective" id="editElective" disabled >
                                <option value="">--Select the Category--</option>
                              
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label for="editYear" class="form-label"><b>Year / Semester</b><span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="editYear" id="editYear" readonly>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="button" id="editAddInputButton" class="btn btn-primary">Add Subject</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" id="editAddElectiveButton" class="btn btn-primary">Add  Subject</button>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-5">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <h4 id="subjectsHeader" class="header-title">Subjects</h4>
                                <div id="editLanguageInputs"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <h4 id="languageSubjectsHeader" class="header-title">Additional Subjects</h4>
                                <div id="editElectiveInputs"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" id="editCancelButton" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ------------------------------------------------------------------------------------------------------------------------------- -->


<div class=" d-none " id="SubjectView">
        
        <form name="frm" method="post">
            <input type="hidden" name="hdnAction" value="">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Subject Details</h4>
            </div>  
            <div class="modal-footer mb-3">
                <button type="button" class="btn btn-danger" id="backButtonSubject">Back</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>University Name</h4> 
                            <span class="detail" id="viewUniversityName"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3" >
                        <div class="card p-3">
                            <h4>Course Name</h4>
                            <span class="detail" id="viewCourseName"></span>
                        </div>
                    </div>
                    <div class="col-sm-3 d-none" id="viewElectiveDiv">
                        <div class="card p-3">
                            <h4>Elective</h4>
                            <span class="detail" id="viewElective"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Year / Semester</h4>
                            <span class="detail" id="viewyearSemester"></span>
                        </div>
                    </div>

                
                    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Subject Details</h3>
            <div id="viewSubjectInputs"></div>
        </div>
        <div class="col-md-6">
            <h3>Elective Subject Details</h3>
            <div id="viewAdditionSubjectInputs"></div>
        </div>
    </div>
</div>
                    
                </div>
            </div>
            
        </form>   
    </div>



