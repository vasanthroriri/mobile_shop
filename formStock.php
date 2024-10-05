<!-- Modal -->
<div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="needs-validation" novalidate name="frmAddProduct" id="addProduct" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addProductId">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Product</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="brand" class="form-label"><b>Brand</b><span class="text-danger">*</span></label>
                                    <select class="form-control" id="brand" name="brand" required="required">
                                        <option value="">--Select the Brand--</option>
                                        <?php 
                                            $product_result = brandTable(); // Call the function to fetch universities 
                                            while ($row = $product_result->fetch_assoc()) {
                                            $id = $row['brand_id']; 
                                            $name = $row['brand_name'];    
                                
                                            ?>
                                
                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="modelName" class="form-label"><b>Model Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="modelName" id="modelName" required="required">
                                    <option value="">--Select the Model--</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="productName" class="form-label"><b>Product Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" id="productName" name="productName" required="required">
                                        <option value="">--Select the Product--</option>
                                        <?php 
                                            $product_result = productTable(); // Call the function to fetch universities 
                                            while ($row = $product_result->fetch_assoc()) {
                                            $id = $row['product_id']; 
                                            $name = $row['product_name'];    
                                
                                            ?>
                                
                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="quantity" class="form-label"><b>Product Quantity</b><span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Enter Product Quantity" name="quantity" id="quantity" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="price" class="form-label"><b>Product Price</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Product Price" name="price" id="price" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="place" class="form-label"><b>Place</b><span class="text-danger">*</span></label>
                                    <select class="form-control" id="place" name="place" required="required">
                                        <option value="">--Select the Place--</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emiNo" class="form-label"><b>EMI No</b></label>
                                    <input type="text" class="form-control" placeholder="Enter EMI No." name="emiNo" id="emiNo">
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
    <div class="modal fade" id="editProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form class="needs-validation" novalidate name="frmEditProduct" id="editProduct" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addEditId">
                    <input type="hidden" name="hdnProductId" id="productIdEdit">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Edit Product</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-3">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="brandEdit" class="form-label"><b>Brand</b><span class="text-danger">*</span></label>
                                    <select class="form-control" id="brandEdit" name="brandEdit" required="required">
                                        <option value="">--Select the Brand--</option>
                                        <?php 
                                            $product_result = brandTable(); // Call the function to fetch universities 
                                            while ($row = $product_result->fetch_assoc()) {
                                            $id = $row['brand_id']; 
                                            $name = $row['brand_name'];    
                                
                                            ?>
                                
                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editModelName" class="form-label"><b>Model Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="editModelName" id="editModelName" required="required">
                                    <option value="">--Select the Model--</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="productNameEdit" class="form-label"><b>Product Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" id="productNameEdit" name="productNameEdit" required="required">
                                        <option value="">--Select the Product--</option>
                                        <?php 
                                            $product_result = productTable(); // Call the function to fetch universities 
                                            while ($row = $product_result->fetch_assoc()) {
                                            $id = $row['product_id']; 
                                            $name = $row['product_name'];    
                                
                                            ?>
                                
                                        <option value="<?php echo $id;?>"><?php echo $name;?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="quantityEdit" class="form-label"><b>Product Quantity</b><span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Enter Product Quantity" name="quantityEdit" id="quantityEdit" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="priceEdit" class="form-label"><b>Product Price</b><span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Product Price" name="priceEdit" id="priceEdit" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="placeEdit" class="form-label"><b>Place</b><span class="text-danger">*</span></label>
                                    <select class="form-control" id="placeEdit" name="placeEdit" required="required">
                                        <option value="">--Select the Place--</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emiNoEdit" class="form-label"><b>EMI No</b></label>
                                    <input type="text" class="form-control" placeholder="Enter EMI No." name="emiNoEdit" id="emiNoEdit">
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


    <!-- View Modal -->

 <div class=" d-none " id="productView">
        
        <form name="frmViewProduct" method="post">
            <div class="page-title-box">
            <h3 class="page-title">Product Details</h3>
            </div>  
            <div class="modal-footer mb-3">
                <button type="button" class="btn btn-danger" id="backButton">Back</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Product Name</h4> 
                            <span class="detail" id="productNameView"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Brand</h4>
                            <span class="detail" id="brandView"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Model</h4> 
                            <span class="detail" id="modelView"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Price</h4>
                            <span class="detail" id="priceView"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Quantity</h4> 
                            <span class="detail" id="quantityView"></span>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>Place</h4>
                            <span class="detail" id="placeView"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card p-3">
                            <h4>EMI No</h4> 
                            <span class="detail" id="emiView"></span>
                        </div>
                    </div>  
                    
                </div>
            </div>
            
        </form>   
    </div>
        
