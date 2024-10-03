                                   <!-- Modal -->
                                   <div class="modal fade" id="editStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmEditStudent" id="editStudent">
                    <input type="hidden" name="hdnAction" value="editStudent">
                    <input type="hidden" name="editid" id="editid">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Edit Student</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-3">
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="fname" class="form-label"><b>First Name</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Student First Name" name="editFname" id="editFname" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="lname" class="form-label"><b>Last Name</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Student Last Name" name="editLname" id="editLname" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="Course" class="form-label"><b>Course</b></label>
                                    <select class="form-control" id="editCourse" name="editCourse" required="required">
                                         
                                        <option value="1">Internship</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="Course" class="form-label"><b>Months Duration </b></label>
                                    <select class="form-control" id="editMonth" name="editMonth" required="required">
                                        <option>----select----</option>
                                        <option value="3">3 Months</option>
                                        <option value="6">6 Months</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="gender" class="form-label"><b>Gender</b></label>
                                    <select class="form-control" id="editGender" name="editGender" required="required">
                                         <option>----select----</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="dob" class="form-label"><b>Date of Birth</b></label>
                                    <input type="date" class="form-control" placeholder="Enter Date of Birth" name="editDob" id="editDob" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="location" class="form-label"><b>Location</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Location" name="editLocation" id="editLocation" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="mobile" class="form-label"><b>Mobile No</b></label>
                                    <input type="number" class="form-control" placeholder="Enter Mobile No" name="editMobile" id="editMobile" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="email" class="form-label"><b>Email</b></label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="editEmail" id="editEmail" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="aadhar" class="form-label"><b>Aadhar Number</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Aadhar Number" name="editAadhar" id="editAadhar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateBtn">Save changes</button>
                    </div>
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->