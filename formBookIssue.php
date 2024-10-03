    
    <!-- Modal -->
    <div class="modal fade" id="addBookIssueModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate name="frmAddStock" id="addBookissue" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addBookissue">
                    <input type="hidden" name="typeExam" id="typeExam">
                    <input type="hidden" name="studentId" id="studentId">
                    <input type="hidden" name="bookId" id="bookId">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Book Issue</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row">
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="admissionId" class="form-label"><b>Admission Id</b></label>
                                    <input type="text" class="form-control"   name="admissionId" id="admissionId" required="required" readonly>
                                </div>
                            </div>

                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="studentName" class="form-label"><b>Student Name</b></label>
                                    <input type="text" class="form-control" name="studentName" id="studentName" required="required" readonly>
                                </div>
                            </div>

                            <div class="col-lg-12">
                            <div class="form-group">
                                            <label for="courseyear" class="form-label"><b>Year of Study</b></label>
                                            <select class="form-control" name="courseyear" id="courseyear" >
                                                        
                                                        
                                                
                                            </select>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-sm-12">
                                            <div class="form-group pb-1">
                                                <label class="form-label"><b>ID from University</b></label><br>
                                                        <div class="row">
                                                        <div class="col-sm-4 ">
                                                        <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="bookReceived" id="bookNotReceived" value="Not Received" checked required>
                                                        <label class="form-check-label" for="bookNotReceived">
                                                        Not Received
                                                        </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="bookReceived" id="bookReceived" value="Received" required>
                                                            <label class="form-check-label" for="bookReceived">
                                                            Received
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-lg-12">
                                            <label for="bookUniReceived" class="form-label"><b>University book Received</b></label>
                                            <select class="select2 form-control select2-multiple" name="bookUniReceived[]" id="bookUniReceived" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                                      
                                                
                                            </select>
                                        </div> <!-- end col -->




                                        <div class="col-lg-12">
                                            <label for="bookIssue" class="form-label"><b>Issued Book List</b></label>
                                            <select class="select2 form-control select2-multiple" name="bookIssue[]" id="bookIssue" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                                      
                                                
                                            </select>
                                        </div> <!-- end col -->





                                        <div class="col-sm-12">
                                            <div class="form-group pb-1">
                                                <label class="form-label"><b>ID Card</b></label><br>
                                                        <div class="row">
                                                        <div class="col-sm-4 ">
                                                        <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="idCard" id="notIssue" value="Not Issued" checked required>
                                                        <label class="form-check-label" for="notIssue">
                                                        Not Issued
                                                        </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="idCard" id="Issue" value="Issued" required>
                                                            <label class="form-check-label" for="Issue">
                                                            Issued
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
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

   
    <!-- --------------------------------------------------------------------------------------------------------------------------------------- -->

     
   

    <!-- ------------------------------------------------------------------------------------------------------------------ -->

    <div class="d-none " id="bookView">
        
        <form name="frm" method="post">
            <input type="hidden" name="hdnAction" value="">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Book Details</h4>
            </div>  
            <div class="modal-footer mb-3">
                <button type="button" class="btn btn-danger" id="backButtonBook">Back</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Admission Id</h4> 
                            <span class="detail" id="viewAdmissionId"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Student Name</h4>
                            <span class="detail" id="viewStudentName"></span>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>ID Card University</h4>
                            <span class="detail" id="viewIdCardUni"></span>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="card p-3">
                            <h4>ID Card Student</h4>
                            <span class="detail" id="viewIdCardStu"></span>
                        </div>
                    </div>

                

                    <div class="col-sm-5">
                        <div class="card p-3">
                            <h3>University Received Books </h3>
                            <div id="viewUniBook"></div>
                            
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="card p-3">
                            <h3>Student Received Books </h3>
                            <div id="viewStuBook"></div>
                            
                        </div>
                    </div>
                
                
                    
                </div>
            </div>
            
        </form>   
    </div>

    <!-- --------------------------------------------------------------------------------------------------------------------------------------- -->

 