<!-- Modal -->
<div class="modal fade" id="addModelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate name="addModel" id="addModel" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addModel">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Model</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="brand" class="form-label"><b>Brand Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="brand" id="brand" required="required">
                                        
                                        <option value="">--Select the Brand--</option>
                                        <?php 
                                        
                                     $brand_result = brandTable(); // Call the function to fetch universities 
                                     while ($row = $brand_result->fetch_assoc()) {
                                     $id = $row['brand_id']; 
                                    $name = $row['brand_name'];    
                        
                                      ?>
                        
                        <option value="<?php echo $id;?>"><?php echo $name;?></option>

                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            


                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="modelName" class="form-label"><b>Model Name</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Model Name" name="modelName" id="modelName" required="required">
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

    <!-- Edit Model Modal -->
<div class="modal fade" id="editModelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="needs-validation" novalidate name="editModel" id="editModel" enctype="multipart/form-data">
                <input type="hidden" name="hdnAction" value="editModel">
                <input type="hidden" name="model_id" id="model_id"> <!-- Hidden input for Model ID -->
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabelEdit">Edit Model</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="brandEdit" class="form-label"><b>Brand Name</b><span class="text-danger">*</span></label>
                                <select class="form-control" name="brandEdit" id="brandEdit" required="required">
                                    <option value="">--Select the Brand--</option>
                                    <?php 
                                     $brand_result = brandTable(); // Call the function to fetch universities 
                                     while ($row = $brand_result->fetch_assoc()) {
                                     $id = $row['brand_id']; 
                                     $name = $row['brand_name'];    
                                     ?>
                                     <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                     <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="modelNameEdit" class="form-label"><b>Model Name</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Model Name" name="modelNameEdit" id="modelNameEdit" required="required">
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


   
