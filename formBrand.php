<!-- Modal -->
<div class="modal fade" id="addUniversityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="needs-validation" novalidate name="addBrandForm" id="addBrandForm" enctype="multipart/form-data">
                <input type="hidden" name="hdnAction" value="addBrand">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Add Brand</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="brandName" class="form-label"><b>Brand Name</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Brand Name" name="brandName" id="brandName" required>
                                <div class="invalid-feedback">Please provide a brand name.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- ------------------------------------------------------------------------------------------------------------------ -->

        <!-- Modal -->
             <div class="modal fade" id="editUniversityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate name="editBrand" id="editBrand">
                    <input type="hidden" name="hdnAction" value="editBrand">
                    <input type="hidden" name="editid" id="editid">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Edit Brand</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="editBrandName" class="form-label"><b>Brand Name</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Brand Name" name="editBrandName" id="editBrandName" required="required">
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

    
