<?php
session_start();
    include "class.php" ;
    
    $selQuery = "SELECT * FROM `jeno_staff` WHERE stf_status='Active'";
    $resQuery = mysqli_query($conn , $selQuery); 
    
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
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" required>
                            <div class="invalid-feedback">Please enter customer name.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customerPhone" class="form-label">Customer Phone</label>
                            <input type="tel" class="form-control" id="customerPhone" required>
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
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  

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
    var productId = $(this).val();
    var modelId = $('#modelName').val();
    var brandId = $('#brand').val();

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

    $.ajax({
        url: "action/actBill.php",
        type: "POST",
        data: { brandId: brandId, modelId: modelId, productId: productId },
        dataType: 'json',
        success: function(response) {
            if (response.product_price) {
                $('#productPrice').val(response.product_price);
                $('#actualPrice').val(response.product_price);
                $('#priceDivError').hide(); // Show model and brand error if not selected
            } else {
                $('#productPrice').val('');
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
    var quantity = $(this).val();
    var productId = $('#productName').val();
    var modelId = $('#modelName').val();
    var brandId = $('#brand').val();

    // Check if product, model, and brand are selected
    if (!productId || !modelId || !brandId) {
        $('#quantityError').hide(); // Hide error if necessary fields are not selected
        return;
    }

    // Make AJAX call to check stock availability
    $.ajax({
        url: "action/actBill.php", // Your PHP script to check stock
        type: "POST",
        data: { brandIdQty: brandId, modelId: modelId, productId: productId },
        dataType: 'json',
        success: function(response) {
            if (response && response.stock >= quantity) {
                $('#quantityError').hide(); // Hide error if quantity is within stock limit
            } else {
                $('#quantityError').show(); // Show error if quantity exceeds available stock
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed: " + status + ", " + error);
        }
    });
});



   
    </script>
    <script>
        document.getElementById('submitBilling').addEventListener('click', function () {
            const emptyCartAlert = document.getElementById('emptyCartAlert');
    if (cart.length === 0) {
        // Show Bootstrap alert when the cart is empty
        
        emptyCartAlert.style.display = 'block';  // Show the alert
        return;
    }
    // Get the form element
    const form = document.getElementById('billingForm');

    // Trigger HTML5 validation
    if (form.checkValidity() === false) {
        // If the form is invalid, prevent submission and show validation error messages
        event.preventDefault();  // Prevent actual submission if form is invalid
        event.stopPropagation(); // Stop further event propagation
    }
    
    // Add Bootstrap validation class to show invalid-feedback messages
    form.classList.add('was-validated');
    const customerName = document.getElementById('customerName').value;
    const customerPhone = document.getElementById('customerPhone').value;
    const billingAddress = document.getElementById('billingAddress').value;

    // if (!customerName || !customerPhone || !billingAddress) {
    //     alert('Please fill in all fields.');
    //     return;
    // }

    const totalAmount = cart.reduce((acc, product) => acc + product.total, 0);  // Calculate total price
    const gstNumber = 12345;  // For now, hard-code GST number or get it from a field
    const productsJSON = JSON.stringify(cart);  // Convert cart products to JSON

    const billingData = {
        customerName: customerName,
        customerPhone: customerPhone,
        billingAddress: billingAddress,
        products: productsJSON,
        totalPrice: totalAmount,
        gstNo: gstNumber
    };

    // Send data to the server using AJAX
   // Assuming billingData contains your form data for submission
   $.ajax({
    url: "action/actBill.php",  // URL of the PHP script that handles the submission
    type: "POST",
    data: billingData,
    success: function (response) {
        const jsonResponse = JSON.parse(response);
        if (jsonResponse.success) {
            // Display SweetAlert success notification
            Swal.fire({
                title: 'Success!',
                text: jsonResponse.message, // The message returned from the server
                icon: 'success',
                timer: 1000, // Auto-close after 0.5 seconds
                showConfirmButton: true // Hide the OK button since it's auto-closing
            }).then(() => {
                // Reset the form and cart after the alert is closed
                document.getElementById('billingForm').reset();

                // Reset Bootstrap validation styles and hide all error messages
                const billingForm = document.getElementById('billingForm');
                billingForm.classList.remove('was-validated'); // Remove validation class
                
                // Clear any custom error messages or states
                const invalidFeedbackElements = billingForm.querySelectorAll('.invalid-feedback');
                invalidFeedbackElements.forEach(function(feedback) {
                    feedback.style.display = 'none'; // Hide all invalid-feedback messages
                });

                // Clear the cart and update the cart table
                cart = [];
                updateCartTable();
            });
        } else {
            // Display SweetAlert error notification
            Swal.fire({
                title: 'Error!',
                text: jsonResponse.message,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ' + error);
        // Show SweetAlert for any AJAX errors
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
    const productQuantity = parseInt(document.getElementById('productQuantity').value);
    const actualPrice = parseFloat(document.getElementById('actualPrice').value);
    const productPrice = parseFloat(document.getElementById('productPrice').value);
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
            product_id: productId
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
                quantity: productQuantity,
                price: productPrice,
                acutaltotal: actualtotalPrice,
                total: totalPrice
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
                <td>${product.brand + ' '+product.model}</td>
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



