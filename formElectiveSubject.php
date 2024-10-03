<!-- Modal -->
<div class="modal fade" id="addElectiveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate name="addElective" id="addElective" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addElective">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Elective Subject</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row ">
                            <div class="col-sm-12">
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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="courseName" class="form-label"><b>Course Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="courseName" id="courseName" required="required">
                                    <option value="">--Select the Course--</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="electiveLanguage" class="form-label"><b>Elective / Language</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="electiveLanguage" id="electiveLanguage" required="required">
                                    <option value="">--Select Elective OR Language--</option>
                                    <option value="E">Elective</option>
                                    <option value="L">Language</option>

                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="universityName" class="form-label"><b>Elective Subject Name</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Elective Subject Name" name="electiveName" id="electiveName" required="required">
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
             <div class="modal fade" id="editElectiveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form class="needs-validation" novalidate name="editElective" id="editElective" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="editElective">
                    <input type="hidden" name="editid" id="editid">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Edit Elective Subject</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row ">
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="editCourseName" class="form-label"><b>Course Name</b><span class="text-danger">*</span></label>
                                    
                                    <select class="form-control" name="editCourseName" id="editCourseName" required disabled>
                                            
                                            <?php
                                            $query = "SELECT cou_id , cou_name FROM `jeno_course` WHERE cou_status = 'Active';";
                                            $result = $conn->query($query);
                                            
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $course_id = $row['cou_id'];
                                                    $course_name = $row['cou_name'];
                                                    echo '<option value="' . $course_id . '">' . $course_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="editElectiveName" class="form-label"><b>Elective Subject Name</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Elective Subject Name" name="editElectiveName" id="editElectiveName" required="required">
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

   
