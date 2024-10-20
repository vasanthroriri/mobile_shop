<!-- Modal -->
<div class="modal fade" id="addModelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate name="addModel" id="addModel" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addProductType">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Product Type</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row ">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="productName" class="form-label"><b>Product Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="productName" id="productName" required="required">
                                        
                                        <option value="">--Select the Product Name--</option>
                                        <?php 
                                        
                                     $brand_result = prodectTypeList(); // Call the function to fetch universities 
                                     while ($row = $brand_result->fetch_assoc()) {
                                     $id = $row['product_id']; 
                                    $name = $row['product_name'];    
                        
                                      ?>
                        
                        <option value="<?php echo $id;?>"><?php echo $name;?></option>

                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            


                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productType" class="form-label"><b>Product Type</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Product Type" name="productType" id="productType" required="required">
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
                <input type="hidden" name="hdnAction" value="editProductType">
                <input type="hidden" name="productType_id" id="model_id"> <!-- Hidden input for Model ID -->
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabelEdit">Edit Model</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="productNameEdit" class="form-label"><b>Product Name</b><span class="text-danger">*</span></label>
                                <select class="form-control" name="productNameEdit" id="productNameEdit" required="required">
                                    <option value="">--Select the Product Name--</option>
                                    <?php 
                                     $brand_result = prodectTypeList(); // Call the function to fetch universities 
                                     while ($row = $brand_result->fetch_assoc()) {
                                     $id = $row['product_id']; 
                                     $name = $row['product_name'];    
                                     ?>
                                     <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                     <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="productTypeEdit" class="form-label"><b>Product Type</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Model Name" name="productTypeEdit" id="productTypeEdit" required="required">
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


   
