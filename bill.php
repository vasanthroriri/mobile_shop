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

                <!-- Cart Table -->
                <h4 class="mt-4">Cart</h4>
                <table class="table table-bordered" id="cartTable">
                    <thead>
                        <tr>
                            <th>#</th>
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
                            <th colspan="4" class="text-end">Total:</th>
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
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="productName" required>
                                    <div class="invalid-feedback">Please enter product name.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="productQuantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="productQuantity" required>
                                    <div class="invalid-feedback">Please enter quantity.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="productPrice" required>
                                    <div class="invalid-feedback">Please enter price.</div>
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
        document.getElementById('submitBilling').addEventListener('click', function () {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    const customerName = document.getElementById('customerName').value;
    const customerPhone = document.getElementById('customerPhone').value;
    const billingAddress = document.getElementById('billingAddress').value;

    if (!customerName || !customerPhone || !billingAddress) {
        alert('Please fill in all fields.');
        return;
    }

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
    $.ajax({
        url: "action/actBill.php",  // URL of the PHP script that handles the submission
        type: "POST",
        data: billingData,
        success: function (response) {
            const jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
                alert('Billing submitted successfully!');
                // Reset the form and cart
                document.getElementById('billingForm').reset();
                cart = [];
                updateCartTable();
            } else {
                alert('Error: ' + jsonResponse.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ' + error);
        }
    });
});
    </script>
    <script>
    let cart = [];

    // Function to add product to cart
    document.getElementById('addToCart').addEventListener('click', function () {
        const productName = document.getElementById('productName').value;
        const productQuantity = parseInt(document.getElementById('productQuantity').value);
        const productPrice = parseFloat(document.getElementById('productPrice').value);

        if (!productName || !productQuantity || !productPrice) {
            alert('Please fill all fields');
            return;
        }

        const totalPrice = productQuantity * productPrice;

        const product = {
            name: productName,
            quantity: productQuantity,
            price: productPrice,
            total: totalPrice
        };
        cart.push(product);

        updateCartTable();
        $('#addProductModal').modal('hide');
        document.getElementById('addProductForm').reset();
    });

    // Function to update the cart table
    function updateCartTable() {
        const cartTableBody = document.getElementById('cartTableBody');
        cartTableBody.innerHTML = ''; // Clear previous data
        let totalAmount = 0;

        cart.forEach((product, index) => {
            const row = `<tr>
                <td>${index + 1}</td>
                <td>${product.name}</td>
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

    // Handle billing submission
    document.getElementById('submitBilling').addEventListener('click', function () {
        if (cart.length === 0) {
            alert('Your cart is empty!');
            return;
        }

        const customerName = document.getElementById('customerName').value;
        const customerPhone = document.getElementById('customerPhone').value;
        const billingAddress = document.getElementById('billingAddress').value;

        const billingData = {
            customerName,
            customerPhone,
            billingAddress,
            cart
        };

        console.log(billingData); // Here you would send the data to your server

        alert('Billing submitted successfully!');

        // Reset the form and cart
        document.getElementById('billingForm').reset();
        cart = [];
        updateCartTable();
    });

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
    

  <script>

    
    $(document).ready(function () {

     

      $('#addStaffBtn').click(function() {

      $('#addStaff').removeClass('was-validated');
      $('#addStaff').addClass('needs-validation');
      $('#username').removeClass('is-invalid is-valid');
      $('#addStaff')[0].reset(); // Reset the form

      });

      $('#backButton').click(function() {
        $('#staffView').addClass('d-none');
        $('#StaffContent').show();
    });
  
  $('#addStaff').off('submit').on('submit', function(e) {
    if (!isUsernameValid) {
        e.preventDefault();
        $('#username').focus(); // Set focus to the invalid input
        return false;
    }

    e.preventDefault(); 

    var form = this; // Get the form element
            if (form.checkValidity() === false) {
                // If the form is invalid, display validation errors
                form.reportValidity();
                return;
            }

            var formData = new FormData(form);

    $.ajax({
      url: "action/actStaff.php",
      method: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(response) {
        // Handle success response
        console.log(response);
        if (response.success) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message,
            timer: 2000
          }).then(function() {
            $('#addStaffModal').modal('hide');
            $('#scroll-horizontal-datatable').load(location.href + ' #scroll-horizontal-datatable > *', function() {
              $('#scroll-horizontal-datatable').DataTable().destroy();
              $('#scroll-horizontal-datatable').DataTable({
                "paging": true, // Enable pagination
                "ordering": true, // Enable sorting
                "searching": true // Enable searching
              });
            });
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.message
          });
        }
      },
      error: function(xhr, status, error) {
        // Handle error response
        console.error(xhr.responseText);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'An error occurred while adding Staff data.'
        });
        // Re-enable the submit button on error
        $('#submitBtn').prop('disabled', false);
      }
    });
  });


 

});







</script>
    

</body>

</html>



