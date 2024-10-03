<!-- Modal -->
<div class="modal fade" id="docStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Add Student Documents</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="frmDocStudent" id="docStudent" class="form-horizontal">
                                                            <input type="hidden" name="hdnAction" value="docStudent">
                                                            <input type="hidden" name="userName" id="userName" value="">
                                                            <input type="hidden" name="stuDocId" id="stuDocId" value="">
                                                            <div class="row mb-3">
                                                                <label for="aadhar" class="col-3 col-form-label">Aadhar Card</label>
                                                                <div class="col-9">
                                                                    <input type="file" class="form-control" id="aadhar" name="aadhar" required>
                                                                    <a id="aadharLink" href="#" target="_blank"><span id="aadharImg"></span></a>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="mark" class="col-3 col-form-label">Mark Sheet Card</label>
                                                                <div class="col-9">
                                                                    <input type="file" class="form-control" id="marksheet" name="marksheet" required>
                                                                    <a id="marksheetLink" href="#" target="_blank"><span id="marksheetImg"></span></a>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="docSubmit">Submit</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>