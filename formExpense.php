    
    <!-- Modal -->
    <div class="modal fade" id="addExpenseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmAddExpense" id="addExpense" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addExpense">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Expense</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Expense</b></label>
                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Expense Reason" name="course" id="course" required="required">
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Amount</b></label>
                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Expense Amount" name="course" id="course" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                            <div class="form-group pb-1">
                                <label for="paidMethod" class="form-label"><b>Paid Method</b></label>
                                <select class="form-control" name="paidMethod" id="paidMethod" required="required">
                                    <option value="">--Select Payment Method--</option>
                                    <option value="online">Online</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                        </div>

                         <!-- New input field for online payment method -->
                         <div class="col-sm-12" id="onlinePaymentDetails" style="display:none;">
                            <div class="form-group pb-1">
                                <label for="Description" class="form-label"><b>Description</b></label>
                                <textarea class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces"  placeholder="Enter Description" name="Description" id="Description"></textarea>                                
                            </div>
                        </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Transaction Id</b></label>
                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Expense Amount" name="course" id="course" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Ex.Date</b></label>
                                    <input type="date" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Expense Date" name="course" id="course" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Bill Img</b></label>
                                    <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" name="course" id="course" required="required">
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
    <div class="modal fade" id="editExpenseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmEditExpense" id="editExpense">
                    <input type="hidden" name="hdnAction" value="editExpense">
                    <input type="hidden" name="editid" id="editid">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Edit Expense</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row">
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Expense</b></label>
                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Expense Reason" name="course" id="course" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Amount</b></label>
                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Expense Amount" name="course" id="course" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                            <div class="form-group pb-1">
                                <label for="paidMethod" class="form-label"><b>Paid Method</b></label>
                                <select class="form-control" name="paidMethod" id="paidMethod" required="required">
                                    <option value="">--Select Payment Method--</option>
                                    <option value="online">Online</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                        </div>

                         <!-- New input field for online payment method -->
                         <div class="col-sm-12" id="onlinePaymentDetails" style="display:none;">
                            <div class="form-group pb-1">
                                <label for="Description" class="form-label"><b>Description</b></label>
                                <textarea class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces"  placeholder="Enter Description" name="Description" id="Description"></textarea>                                
                            </div>
                        </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Transaction Id</b></label>
                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Expense Amount" name="course" id="course" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Ex.Date</b></label>
                                    <input type="date" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" placeholder="Enter Expense Date" name="course" id="course" required="required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course" class="form-label"><b>Bill Img</b></label>
                                    <input type="file" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" name="course" id="course" required="required">
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

    <!-- --------------------------------------------------------------------------------------------------------------------------------------- -->

 