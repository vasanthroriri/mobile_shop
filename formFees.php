
<!-- Modal -->
<div class="modal fade" id="addFeesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="needs-validation" novalidate name="addFees" id="addFees">
                <input type="hidden" name="hdnAction" value="addFees">
                <input type="hidden" name="feesid" id="feesid">
                <input type="hidden" name="studentId" id="studentId">
                <input type="hidden" name="feesType" id="feesType">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Add Fees</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row p-3">
                       <!-- Alert Container -->
                       <div id="alertContainer" class="mb-3"></div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="admissionId" class="form-label"><b>Admission Id</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  name="admissionId" id="admissionId" required="required" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="studentName" class="form-label"><b>Student Name</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  name="studentName" id="studentName" required="required" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="year" class="form-label"><b>Current Year/Sem</b><span class="text-danger">*</span></label>
                                <select class="form-control" name="year" id="year" required="required" disabled>
                                    <option value="">--Select Year--</option>
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="paidMethod" class="form-label"><b>Payment Method</b><span class="text-danger">*</span></label>
                                <select class="form-control" name="paidMethod" id="paidMethod" required="required">
                                    <option value="">--Select Payment Method--</option>
                                    <option value="Online">Online</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group pb-1">
                                <label for="transactionId" class="form-label"><b>Transaction Id</b></label>
                                <input type="text" class="form-control"  placeholder="Enter Transaction ID" name="transactionId" id="transactionId">
                            </div>
                        </div>

                        <!-- New input field for online payment method -->
                        <div class="col-sm-12" id="onlinePaymentDetails" style="display:none;">
                            <div class="form-group pb-1">
                                <label for="description" class="form-label"><b>Description</b></label>
                                <textarea class="form-control"  placeholder="Enter Description" name="description" id="description"></textarea>                                
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="universityPaid" class="form-label"><b>University Fees  </b><span class="text-danger" id="universityFees"> </span></label>
                                <input type="number" class="form-control"  placeholder="Enter amount" name="universityPaid" id="universityPaid" required="required">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="studyPaid" class="form-label"><b>Study Center Fees  </b><span class="text-danger" id="studyFees"> </span></label>
                                <input type="number" class="form-control"  placeholder="Enter amount" name="studyPaid" id="studyPaid" required="required">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="totalAmount" class="form-label"><b>Amount Paid</b></label>
                                <input type="number" class="form-control" name="totalAmount" id="totalAmount" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="balance" class="form-label"><b>Balance </b></label>
                                <input type="number" class="form-control" name="balance" id="balance" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="paidDate" class="form-label"><b>Paid Date</b><span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="paidDate" id="paidDate" required="required">
                            </div>
                        </div>                     
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateBtn">Submit</button>
                </div>
            </form>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->



<!-- Modal -->
<div class="modal fade" id="editFeesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form class="needs-validation" novalidate name="editFees" id="editFees">
                <input type="hidden" name="hdnAction" value="editFees">
                <input type="hidden" name="editFeesid" id="editFeesid">
                <input type="hidden" name="editStudentId" id="editStudentId">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Edit Fees</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row p-3">
                       

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="editAdmissionId" class="form-label"><b>Admission Id</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  name="editAdmissionId" id="editAdmissionId" required="required" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="editStudentName" class="form-label"><b>Student Name</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  name="editStudentName" id="editStudentName" required="required" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="editYear" class="form-label"><b>Year</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  name="editYear" id="editYear" required="required" readonly>
                            </div>
                        </div>
                       

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="editPaidMethod" class="form-label"><b>Payment Method</b><span class="text-danger">*</span></label>
                                <select class="form-control" name="editPaidMethod" id="editPaidMethod" required="required">
                                    <option value="">--Select Payment Method--</option>
                                    <option value="Online">Online</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group pb-1">
                                <label for="editTransactionId" class="form-label"><b>Transaction Id</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  placeholder="Enter Transaction ID" name="editTransactionId" id="editTransactionId" required="required">
                            </div>
                        </div>

                        <!-- New input field for online payment method -->
                        <div class="col-sm-12" id="onlinePaymentDetails" style="display:none;">
                            <div class="form-group pb-1">
                                <label for="editDescription" class="form-label"><b>Description</b><span class="text-danger">*</span></label>
                                <textarea class="form-control"  placeholder="Enter Description" name="editDescription" id="editDescription"></textarea>                                
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="editUniversityPaid" class="form-label"><b>University Fees  </b><span class="text-danger" id="universityFees"> </span></label>
                                <input type="number" class="form-control"  placeholder="Enter amount" name="editUniversityPaid" id="editUniversityPaid" required="required">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="editStudyPaid" class="form-label"><b>Study Center Fees  </b><span class="text-danger" id="studyFees"> </span></label>
                                <input type="number" class="form-control"  placeholder="Enter amount" name="editStudyPaid" id="editStudyPaid" required="required">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="editTotalAmount" class="form-label"><b>Amount Paid</b></label>
                                <input type="number" class="form-control" name="editTotalAmount" id="editTotalAmount" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="editbalance" class="form-label"><b>Balance </b></label>
                                <input type="number" class="form-control" name="editbalance" id="editbalance" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group pb-1">
                                <label for="editPaidDate" class="form-label"><b>Paid Date</b><span class="text-danger">*</span></label>
                                <input type="date" class="form-control"  name="editPaidDate" id="editPaidDate" required="required">
                            </div>
                        </div>

                        

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateBtn">Submit</button>
                </div>
            </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->


    <!-- <-- ---------------------------------------------------------------------> 


    <div class=" d-none" id="clientDetail">
    <div class="modal-footer mt-3">
                <button type="button" class="btn btn-danger" id="backButtonsubject">Back</button>
            </div>
    <form name="frm" method="post">
        <input type="hidden" name="hdnAction" value="">
        <div class="modal-header">
            <h4 class="modal-title mb-2" id="myModalLabel">Payment Details</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Admission Id</h4>
                        <span class="detail" id="viewAdmisionId"></span>
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
                        <h4>Current Year/Sem</h4>
                        <span class="detail" id="ViewYear"></span>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>University Total Fees</h4>
                        <span class="detail" id="viewUniversityTotalFees"></span>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Study Center Total Fees</h4>
                        <span class="detail" id="viewStudyCenterTotalFees"></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>University Paid Fees</h4>
                        <span class="detail" id="viewUniversityFees"></span>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Study Center Paid Fees</h4>
                        <span class="detail" id="viewStudyCenterFees"></span>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Total Fees</h4>
                        <span class="detail" id="viewTotalFees"></span>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Total Paid</h4>
                        <span class="detail" id="viewTotalPaid"></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Balance</h4>
                        <span class="detail text-danger" id="viewBalance"></span>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="modal-title" id="myModalLabel">Payment History</h3>
        <table id="scroll-horizontal-datatable1" class="table table-striped w-100 nowrap">
            <thead>
                <tr class="bg-light">
                    <th scope="col-1">S.No.</th>
                    <th scope="col">Study Year/Sem</th>
                    <th scope="col">Payment Date</th>
                    <th scope="col">Amount Received</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="paymentHistoryBody">
            </tbody>
        </table>
    </form>
</div>
