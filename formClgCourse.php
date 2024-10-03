    
    <!-- Modal -->
    <div class="modal fade" id="addCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form class="needs-validation" novalidate name="frmAddCourse" id="addCourse" enctype="multipart/form-data">
    <input type="hidden" name="hdnAction" value="addCourse">
    <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Add Course</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body p-3">
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
                    <label for="courseName" class="form-label"><b>Course Name</b><span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="courseName" id="courseName" required placeholder="Enter Course Name">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="medium" class="form-label"><b>Medium</b><span class="text-danger">*</span></label>
                    <select class="form-control" name="medium" id="medium" required>
                        <option value="">--Select the Medium--</option>
                        <option value="Tamil">Tamil</option>
                        <option value="English">English</option>
                        <option value="Both">Both</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="examType" class="form-label"><b>Exam Type</b><span class="text-danger">*</span></label>
                    <select class="form-control" name="examType" id="examType" required>
                        <option value="">--Select the Exam Type--</option>
                        <option value="Year">Year</option>
                        <option value="Semester">Semester</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="fessType" class="form-label"><b>Fees Type</b><span class="text-danger">*</span></label>
                    <select class="form-control" name="fessType" id="fessType" required>
                        <option value="">--Select the Fees Type--</option>
                        <option value="Year">Year</option>
                        <option value="Semester">Semester</option>
                    </select>
                </div>
            </div>

          
            <div class="col-sm-6">
                    <div class="form-group">
                        <label for="duration" class="form-label"><b>Duration (Years)</b></label>
                        <select class="form-control" name="duration" id="duration" required>
                            <option value="">--Select the Duration--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
        </div>
        <hr>
        <div id="additionalInputs"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="addcourseSub" class="btn btn-primary">Save changes</button>
    </div>
</form>

            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <!-- ------------------------------------------------------------------------------------------------------------------ -->

    <!-- Modal -->
    <div class="modal fade" id="editCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form class="needs-validation" novalidate name="frmEditCourse" id="editCourse" enctype="multipart/form-data">
    <input type="hidden" name="hdnAction" value="editCourse">
    <input type="hidden" name="editCouseId" id="editCouseId">
    <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Edit Course</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body p-3">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="editUniversity" class="form-label"><b>University Name</b><span class="text-danger">*</span></label>
                    <select class="form-control" name="editUniversity" id="editUniversity" required>
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
                    <label for="editCourseName" class="form-label"><b>Course Name</b><span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="editCourseName" id="editCourseName" required placeholder="Enter Course Name" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="editMedium" class="form-label"><b>Medium</b><span class="text-danger">*</span></label>
                    <select class="form-control" name="editMedium" id="editMedium" required>
                        <option value="">--Select the Medium--</option>
                        <option value="Tamil">Tamil</option>
                        <option value="English">English</option>
                        <option value="Both">Both</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="editExamType" class="form-label"><b>Exam Type</b><span class="text-danger">*</span></label>
                    <select class="form-control" name="editExamType" id="editExamType" required>
                        <option value="">--Select the Exam Type--</option>
                        <option value="Year">Year</option>
                        <option value="Semester">Semester</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="editFessType" class="form-label"><b>Fees Type</b><span class="text-danger">*</span></label>
                    <select class="form-control" name="editFessType" id="editFessType" required disabled>
                        <option value="">--Select the Fees Type--</option>
                        <option value="Year">Year</option>
                        <option value="Semester">Semester</option>
                    </select>
                </div>
            </div>

          
            <div class="col-sm-6">
                    <div class="form-group">
                        <label for="ediDuration" class="form-label"><b>Duration (Years)</b></label>
                        <select class="form-control" name="ediDuration" id="ediDuration" required disabled>
                            <option value="">--Select the Duration--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
        </div>
        <hr>
        <div id="editCourseInputs"></div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="editcourseSub" class="btn btn-primary">Save changes</button>
    </div>
</form>

            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->

    <!-- --------------------------------------------------------------------------------------------------------------------------------------- -->

    <div class="d-none " id="CourseView">
        
        <form name="frm" method="post">
            <input type="hidden" name="hdnAction" value="">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Course Details</h4>
            </div>  
            <div class="modal-footer mb-3">
                <button type="button" class="btn btn-danger" id="backButtoncourse">Back</button>
            </div>
            <div class="modal-body">
                <div class="row">
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
                            <h4>Exam Type</h4>
                            <span class="detail" id="viewExamType"></span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Fees Type</h4>
                            <span class="detail" id="viewFeesType"></span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Duration </h4>
                            <span class="detail" id="viewDuration"></span>
                        </div>
                    </div>
                
                <div id="viewCourseInputs"></div>
                    
                </div>
            </div>
            
        </form>   
    </div>