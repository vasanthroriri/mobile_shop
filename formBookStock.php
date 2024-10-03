    
    <!-- Modal -->
    <div class="modal fade" id="addStockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmAddStock" id="addStock" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addStock">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Book Stock</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row">
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="medium" class="form-label"><b>Student Roll No</b></label>
                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Book Count" name="course" id="course" required="required">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                            <div class="form-group pb-1">
                                         <label class="form-label"><b>Books</b></label><br>
                                                <div class="row">
                                                 <div class="col-sm-4 ">
                                                  <div class="form-check">
                                            <input class="form-check-input" type="radio" name="books" id="notReceived" value="notReceived" checked required>
                                                 <label class="form-check-label" for="notReceived">
                                                 Not Received
                                                 </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="books" id="received" value="received" required>
                                                    <label class="form-check-label" for="received">
                                                    Received
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>


                                    <div class="col-sm-12">
                                            <div class="form-group pb-1">
                                         <label class="form-label"><b>ID Card</b></label><br>
                                                <div class="row">
                                                 <div class="col-sm-4 ">
                                                  <div class="form-check">
                                            <input class="form-check-input" type="radio" name="idCard" id="notReceived" value="notReceived" checked required>
                                                 <label class="form-check-label" for="notReceived">
                                                 Not Received
                                                 </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="idCard" id="received" value="received" required>
                                                    <label class="form-check-label" for="received">
                                                    Received
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>


                        
                          
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="medium" class="form-label"><b>Date</b></label>
                                    <input type="date" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter In-Stock Date" name="course" id="course" required="required">
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
    <div class="modal fade" id="editStockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form name="frmAddStock" id="editStock" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="editStock">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Book Stock</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row">
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="medium" class="form-label"><b>Student Roll No</b></label>
                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Book Count" name="course" id="course" required="required">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                            <div class="form-group pb-1">
                                         <label class="form-label"><b>Books</b></label><br>
                                                <div class="row">
                                                 <div class="col-sm-4 ">
                                                  <div class="form-check">
                                            <input class="form-check-input" type="radio" name="notReceived" id="notReceived" value="notReceived" checked required>
                                                 <label class="form-check-label" for="notReceived">
                                                 Not Received
                                                 </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="books" id="received" value="received" required>
                                                    <label class="form-check-label" for="received">
                                                    Received
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>


                                    <div class="col-sm-12">
                                            <div class="form-group pb-1">
                                         <label class="form-label"><b>ID Card</b></label><br>
                                                <div class="row">
                                                 <div class="col-sm-4 ">
                                                  <div class="form-check">
                                            <input class="form-check-input" type="radio" name="notReceived" id="notReceived" value="notReceived" checked required>
                                                 <label class="form-check-label" for="notReceived">
                                                 Not Received
                                                 </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="books" id="received" value="received" required>
                                                    <label class="form-check-label" for="received">
                                                    Received
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                        
                          
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="medium" class="form-label"><b>Date</b></label>
                                    <input type="date" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter In-Stock Date" name="course" id="course" required="required">
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

 