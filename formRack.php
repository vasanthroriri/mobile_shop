<!-- Modal -->
<div class="modal fade" id="addRackModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="needs-validation" novalidate name="addRackForm" id="addRackForm">
                <input type="hidden" name="hdnAction" value="addRack">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Add Rack</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="rackNo" class="form-label"><b>Rack Number</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Rack Number" name="rackNo" id="rackNo" required>
                                <div class="invalid-feedback">Please provide a Rack Number.</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="rackName" class="form-label"><b>Rack Name</b></label>
                                <input type="text" class="form-control" placeholder="Enter Rack Name" name="rackName" id="rackName">
                                <div class="invalid-feedback">Please provide a Rack Name.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="subitBtn" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

     <!-- Modal -->
     <div class="modal fade" id="editRackModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate name="editRack" id="editRack">
                    <input type="hidden" name="hdnAction" value="editRackId">
                    <input type="hidden" name="editId" id="editId">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Edit Rack</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="rackNoEdit" class="form-label"><b>Rack Number</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Rack Number" name="rackNoEdit" id="rackNoEdit" required>
                                    <div class="invalid-feedback">Please provide a Rack Number.</div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="rackNameEdit" class="form-label"><b>Rack Name</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Rack Name" name="rackNameEdit" id="rackNameEdit">
                                    <div class="invalid-feedback">Please provide a Rack Name.</div>
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