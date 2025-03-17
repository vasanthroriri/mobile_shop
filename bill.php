<?php
session_start();
    include "class.php" ;
    

    
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>
<body>
   <!-- Begin page -->
<div class="wrapper">

<!-- ========== Topbar Start ========== -->
<?php include "top.php" ?>
<!-- ========== Topbar End ========== -->

<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">
    <?php include "left.php"; ?>
</div>
<!-- ========== Left Sidebar End ========== -->

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid" id="StaffContent">
            <div class="container mt-4">
                <h2 class="text-center">Mobile Billing Form</h2>

                <!-- Billing Form -->
                <form id="billingForm" class="needs-validation" novalidate>
                    <input type="hidden" class="form-control" id="details" name="details">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" required>
                            <div class="invalid-feedback">Please enter customer name.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customerPhone" class="form-label">Customer Phone</label>
                            <input type="tel" class="form-control" id="customerPhone" required pattern="^[0-9]{10}$" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            <div class="invalid-feedback">Please enter customer phone number.</div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="billingAddress" class="form-label">Billing Address</label>
                        <textarea class="form-control" id="billingAddress" rows="3" required></textarea>
                        <div class="invalid-feedback">Please enter billing address.</div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            Add Product
                        </button>
                    </div>
                </form>
                <div id="emptyCartAlert" class="alert alert-warning alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Cart is empty!</strong> Please add products to the cart before submitting your billing.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- Cart Table -->
                <h4 class="mt-4">Cart</h4>
                <table class="table table-bordered" id="cartTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Model Name</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cartTableBody"></tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">Total:</th>
                            <th id="totalAmount">0</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="mb-">
                    <button type="button" class="btn btn-success" id="submitBilling">Submit Billing</button>
                </div>
            </div>
            
            <!-- Add Product Modal -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="addProductForm" class="needs-validation" novalidate>
                        
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
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
                                    <div class="invalid-feedback">Please enter Brand.</div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="modelName" class="form-label"><b>Model Name</b><span class="text-danger">*</span></label>
                                    <select class="form-control" name="modelName" id="modelName" required="required">
                                        <option value="">--Select the Model--</option>
                                    </select>
                                    <div class="invalid-feedback">Please enter Model.</div>
                                </div>
                            </div>

                                <div class="col-sm-12">
                                    <div class="form-group ">
                                        <label for="productName" class="form-label"><b>Product Name</b><span class="text-danger">*</span></label>
                                        <select class="form-control" name="productName" id="productName" required="required">
                                            
                                            <option value="">--Select the Product--</option>
                                            <?php 
                                            
                                        $product_result = prodectTable(); // Call the function to fetch universities 
                                        while ($pro = $product_result->fetch_assoc()) {
                                        $id = $pro['product_id']; 
                                        $name = $pro['product_name'];    
                            
                                        ?>
                            
                            <option value="<?php echo $id;?>"><?php echo $name;?></option>

                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback" id="productInvalid">Please enter Product.</div>
                                        <div class="invalid-feedback" id="modelBrandInvalid">Please select both Model and Brand.</div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group ">
                                        <label for="productType" class="form-label"><b>Product Type</b></label>
                                        <select class="form-control" name="productType" id="productType" >
                                            
                                            <option value="">--Select the Product Type--</option>
                        
                                        </select>
                                        <div class="invalid-feedback" id="productTypeInvalid">Please enter Product Type.</div>  
                                        <div class="invalid-feedback" id="productTypeInvalid">Please select both Product.</div>                                      
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productQuantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="productQuantity" required>
                                    <div class="invalid-feedback">Please enter quantity.</div>
                                    <span id="quantityError" class="text-danger" style="display:none;">Quantity exceeds available stock.</span>
                                </div>
                            </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input type="hidden" class="form-control" id="actualPrice" required>
                                    <input type="number" class="form-control" id="productPrice" required>
                                    <div class="invalid-feedback">Please enter price.</div>
                                    <div class="invalid-feedback" id="priceDivError"> price Not Valid.</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="addToCart" class="btn btn-primary">Add to Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Add Product Modal -->
            
            <!-- start page title -->
        </div> <!-- end card -->
    </div><!-- end col-->
</div> <!-- end row-->

        </div> <!-- container -->
    </div> <!-- content -->

    <!-- Footer Start -->
    <?php include "footer.php"; ?>
    <!-- end Footer -->
    
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Theme Settings -->


    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Datatables js -->
    <script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
    
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> -->
  <script src="js/sweetalert.js"></script>
  

    <!-- Datatable Demo Aapp js -->
    <script src="assets/js/pages/demo.datatable-init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    <script>
        $('#brand').change(function() {
        var brandId = $(this).val();
        
        if (brandId === "") {
            $('#modelName').html('<option value="">--Select the Model--</option>'); // Clear the course dropdown
            return; // No university selected, exit the function
        }

        $.ajax({
            url: "action/actBill.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { brand: brandId },
            dataType: 'json',
            success: function(response) {
                
                var options = '<option value="">--Select the Model--</option>';
                
                 // Loop through each course in the response and append to options
                 $.each(response, function(index, course) {
                    options += '<option value="' + course.mod_id + '">' + course.mod_name + '</option>';
                });
                $('#modelName').html(options); // Update the course dropdown
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });


    $('#productName').change(function() {
        var brandId = $(this).val();
        
        if (brandId === "") {
            $('#productType').html('<option value="">--Select the Model--</option>'); // Clear the course dropdown
            return; // No university selected, exit the function
        }

        $.ajax({
            url: "action/actBill.php", // URL of the PHP script to handle the request
            type: "POST",
            data: { pro_id: brandId },
            dataType: 'json',
            success: function(response) {
                
                var options = '<option value="">--Select the Model--</option>';
                
                 // Loop through each course in the response and append to options
                 $.each(response, function(index, course) {
                    options += '<option value="' + course.mod_id + '">' + course.mod_name + '</option>';
                });
                $('#productType').html(options); // Update the course dropdown
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed: " + status + ", " + error);
            }
        });
    });



    $('#productType').change(function() {
    var typeId = $(this).val();
    var modelId = $('#modelName').val();
    var brandId = $('#brand').val();
    var productId = $('#productName').val();

    // Hide all error messages by default
    $('#productInvalid').hide();
    $('#modelBrandInvalid').hide();

    if (!productId) {
        $('#productInvalid').show(); // Show product selection error if not selected
        return;
    }

    if (!brandId || !modelId) {
        $('#modelBrandInvalid').show(); // Show model and brand error if not selected
        return;
    }
    if (!typeId) {
        $('#productTypeInvalid').show(); // Show product selection error if not selected
        return;
    }

    $.ajax({
        url: "action/actBill.php",
        type: "POST",
        data: { brandId: brandId,
                modelId: modelId,
                productId: productId,
                productTypeId: typeId
             },
        dataType: 'json',
        success: function(response) {
            if (response.product_price) {
                // $('#productPrice').val(response.product_price);
                $('#actualPrice').val(response.product_price);
                $('#details').val(response.details);
                $('#priceDivError').hide(); // Show model and brand error if not selected
            } else {
                // $('#productPrice').val('');
                $('#actualPrice').val('');
                // alert(response.message || 'No price data available');
                $('#priceDivError').show(); // Show model and brand error if not selected
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed: " + status + ", " + error);
        }
    });
});



$('#productQuantity').on('input', function() {
    var quantity = parseInt($('#productQuantity').val()) || 0; // Convert to integer
    var productId = $('#productName').val();
    var modelId = $('#modelName').val();
    var brandId = $('#brand').val();
    var productType = $('#productType').val();

    // Check if product, model, and brand are selected
    if (!productId || !modelId || !brandId) {
        $('#quantityError').hide(); // Hide error if necessary fields are not selected
        return;
    }

    // Make AJAX call to check stock availability
    $.ajax({
        url: "action/actBill.php", // Your PHP script to check stock
        type: "POST",
        data: { brandIdQty: brandId, modelId: modelId, productId: productId , productType: productType },
        dataType: 'json',
        success: function(response) {

            if (response) {
                var availableStock = response.stock;
                var pricePerUnit = response.price; // Price per unit
                var totalPrice = quantity * pricePerUnit; // Total price calculation

                // Update price input field
                // $('#productPrice').val(pricePerUnit);

                 // Update total price field dynamically
                 $('#productPrice').val(totalPrice.toFixed(2)); // Ensure 2 decimal places

                // Check if quantity exceeds available stock
                if (quantity > availableStock) {
                    $('#quantityError').show();
                } else {
                    $('#quantityError').hide();
                }
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed: " + status + ", " + error);
        }
    });
});



   
    </script>
    <script>
    document.getElementById('submitBilling').addEventListener('click', function (event) {
        const emptyCartAlert = document.getElementById('emptyCartAlert');
        const form = document.getElementById('billingForm');

        // Show Bootstrap alert if the cart is empty
        if (cart.length === 0) {
            emptyCartAlert.style.display = 'block'; // Show the alert
            return;
        } else {
            emptyCartAlert.style.display = 'none'; // Hide the alert
        }

        // Trigger HTML5 form validation
        if (!form.checkValidity()) {
            event.preventDefault(); // Prevent submission
            event.stopPropagation(); // Stop further propagation
            form.classList.add('was-validated'); // Add Bootstrap validation styles
            return;
        }

        // Retrieve form inputs
        const customerName = document.getElementById('customerName').value;
        const customerPhone = document.getElementById('customerPhone').value;
        const billingAddress = document.getElementById('billingAddress').value;

        <?php
        // PHP Code to generate the GST number
        $prefix = "SA";
        $currentYear = date("y");
        $newBillNumber = "";

        // Query the database for the latest bill number
        $query = "SELECT gst_no FROM invoice_tbl WHERE gst_no LIKE '$prefix$currentYear%' ORDER BY gst_no DESC LIMIT 1";
        $result = $conn->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            $lastBillNumber = $row['gst_no'];
            $lastSequence = (int)substr($lastBillNumber, -4);
            $newSequence = str_pad($lastSequence + 1, 4, "0", STR_PAD_LEFT);
            $newBillNumber = $prefix . $currentYear . $newSequence;
        } else {
            $newBillNumber = $prefix . $currentYear . "0001";
        }
        ?>
        
        const gstNumber = "<?php echo $newBillNumber; ?>";
        const totalAmount = cart.reduce((acc, product) => acc + product.total, 0); // Calculate total
        const productsJSON = JSON.stringify(cart); // Convert cart products to JSON
        // Prepare billing data
        const billingData = {
            customerName: customerName,
            customerPhone: customerPhone,
            billingAddress: billingAddress,
            products: productsJSON,
            totalPrice: totalAmount,
            gstNo: gstNumber
        };

        // Send data to the server via AJAX
        $.ajax({
            url: "action/actBill.php",
            type: "POST",
            data: billingData,
            success: function (response) {
                try {
                    const jsonResponse = JSON.parse(response);
                    if (jsonResponse.success) {
                        // Success notification
                        Swal.fire({
                            title: 'Success!',
                            text: jsonResponse.message,
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: true
                        }).then(() => {
                            // Reset form and cart
                            form.reset();
                            form.classList.remove('was-validated');
                            cart = [];
                            updateCartTable();
                        });
                    } else {
                        // Error notification
                        Swal.fire({
                            title: 'Error!',
                            text: jsonResponse.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Invalid server response.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong while submitting the billing data.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>

    <script>
    let cart = [];

    // Function to add product to cart
    document.getElementById('addToCart').addEventListener('click', function () {
        const brandId = document.getElementById('brand').value;
    const modelId = document.getElementById('modelName').value;
    const productId = document.getElementById('productName').value;
    const productType = document.getElementById('productType').value;
    const productQuantity = parseInt(document.getElementById('productQuantity').value);
    const actualPrice = parseFloat(document.getElementById('actualPrice').value);
    const productPrice = parseFloat(document.getElementById('productPrice').value);
    const details = document.getElementById('details').value;
        // Reset validation states (hide all validation error messages first)
    $('.invalid-feedback').hide(); // Hide all invalid-feedback messages
    let formValid = true;  // Track form validity

    // Validate Brand field
    if (!brandId) {
        $('#brand').next('.invalid-feedback').show();
        formValid = false;
    }

    // Validate Model field
    if (!modelId) {
        $('#modelName').next('.invalid-feedback').show();
        formValid = false;
    }

    // Validate Product field
    if (!productId) {
        $('#productInvalid').show();
        formValid = false;
    }

    // Validate Quantity field
    if (!productQuantity || productQuantity <= 0) {
        $('#productQuantity').next('.invalid-feedback').show();
        formValid = false;
    }

    // Validate Price field
    if (!productPrice || productPrice <= 0) {
        $('#productPrice').next('.invalid-feedback').show();
        formValid = false;
    }

    // If the form is not valid, prevent submission
    if (!formValid) {
        return;  // Stop the function here if form is invalid
    }


    // AJAX call to fetch product details based on selected IDs
    $.ajax({
        url: "action/actBill.php",  // Adjust the URL as necessary
        type: "POST",
        data: {
            brand_id: brandId,
            model_id: modelId,
            product_id: productId,
            productType: productType,
        },
        success: function (response) {
            const productData = JSON.parse(response);
            const totalPrice = productQuantity * productPrice;
            const actualtotalPrice = productQuantity * productPrice;
            const product = {
                brand: productData.brand_name,
                model: productData.mod_name,
                model_id: productData.model_id,
                product_id: productData.product_id,
                brand_id: productData.brand_id,
                product: productData.product_name,
                product_type_id: productData.product_type_id,
                product_type: productData.product_type_name,
                quantity: productQuantity,
                price: productPrice,
                acutaltotal: actualtotalPrice,
                total: totalPrice,
                details: productData.details
            };
        cart.push(product);

        updateCartTable();
        // $('#addProductModal').modal('hide');
        document.getElementById('addProductForm').reset();
    },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ' + error);
            alert('Failed to fetch product details.');
        }
    });
    });

    // Function to update the cart table
    function updateCartTable() {
        const cartTableBody = document.getElementById('cartTableBody');
        cartTableBody.innerHTML = ''; // Clear previous data
        let totalAmount = 0;

        cart.forEach((product, index) => {
            const row = `<tr>
                <td>${index + 1}</td>
                <td>${product.brand + ' '+product.model +' '+ product.product_type}</td>
                <td>${product.product}</td>
                <td>${product.quantity}</td>
                <td>${product.price.toFixed(2)}</td>
                <td>${product.total.toFixed(2)}</td>
                <td><button class="btn btn-danger btn-sm" onclick="removeProduct(${index})">Remove</button></td>
            </tr>`;
            cartTableBody.innerHTML += row;
            totalAmount += product.total;
        });

        document.getElementById('totalAmount').innerText = totalAmount.toFixed(2);
    }

    // Function to remove product from cart
    function removeProduct(index) {
        cart.splice(index, 1); // Remove product from cart array
        updateCartTable(); // Update table after removal
    }

   

    // Bootstrap validation
    (function () {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
    

</body>

</html>



