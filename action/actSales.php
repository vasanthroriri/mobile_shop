<?php
include("../db/dbConnection.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a product
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addProductId') {
    $productName = $_POST['productName'];
    $model = $_POST['modelName'];
    $brandName=$_POST['brand'];
    $productQuantity=$_POST['quantity'];
    $productPrice=$_POST['price'];
    $place=$_POST['place'];
    $emiNo=$_POST['emiNo'];


    // Check if the product name already exists
    $check_sql = "SELECT COUNT(*) AS count FROM stock_tbl WHERE product_id='$productName' AND model_id='$model'";
    $result = $conn->query($check_sql);
    $row = $result->fetch_assoc();
    $exists = $row['count'] > 0;

    if ($exists) {
        $response['success'] = false;
        $response['message'] = "This Product is already exists!";
    } else {
        // Insert the new Product if it doesn't exist
        
        $university_sql = "INSERT INTO 
                            `stock_tbl`
                            ( `brand_id`, 
                            `product_id`, 
                            `model_id`, 
                            `product_price`,
                            `product_quantity`,
                            `place`,
                            `emi_no`)
                            VALUES 
                            ('$brandName',
                            '$productName',
                            '$model',
                            '$productPrice',
                            '$productQuantity',
                            '$place',
                            '$emiNo')";

        if ($conn->query($university_sql) === TRUE) {
            $response['success'] = true;
            $response['message'] = "Product added successfully!";
        } else {
            $response['message'] = "Error adding Product: " . $conn->error;
        }
    }

    echo json_encode($response);
    exit();
}


// Handle fetching university details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    
    $editId = $_POST['editId'];

    $selQuery = "SELECT
                                a.stock_id,
                                a.brand_id,
                                a.product_id,
                                a.model_id,
                                a.product_price,
                                a.product_quantity,
                                a.place,
                                a.emi_no,
                                a.stock_status,
                                b.product_name,
                                b.product_status,
                                c.brand_name,
                                c.brand_status

                                FROM stock_tbl AS a 
                                LEFT JOIN product_tbl AS b ON b.product_id=a.product_id
                                LEFT JOIN brand_tbl AS c ON c.brand_id=a.brand_id
                                WHERE a.stock_id='$editId'";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Prepare university details array
        $productDetails = [
            'brand_id' => $row['brand_id'],
            'brand_name' => $row['brand_name'],
            'product_name'=>$row['product_name'],
            'product_id'=>$row['product_id'],
            'product_price'=>$row['product_price'],
            'product_quantity'=>$row['product_quantity'],
            'place'=>$row['place'],
            'emiNo'=>$row['emi_no'],
            'model_id'=>$row['model_id'],
            'stock_id'=>$row['stock_id'],

        ];

        echo json_encode($productDetails);
    } else {
        $response['message'] = "Error fetching Brand details: " . mysqli_error($conn);
        echo json_encode($response);
    }

    exit(); 
    }


    // Handle updating student details
        if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addEditId') {
            $editid = $_POST['hdnProductId'];
            $editBrand = $_POST['brandEdit'];
            $editModel = $_POST['modelEdit'];
            $editProductName = $_POST['productNameEdit'];
            $editPrice = $_POST['priceEdit'];
            $editQuantity = $_POST['quantityEdit'];
            $editPlace = $_POST['placeEdit'];
            $editEmiNo = $_POST['emiNoEdit'];
           
  
            
            $editProduct ="UPDATE `stock_tbl` 
                                SET 
                                `brand_id`='$editBrand',
                                `product_id`='$editProductName',
                                `model_name`='$editModel',
                                `product_price`='$editPrice',
                                `product_quantity`='$editQuantity',
                                `place`='$editPlace',
                                `emi_no`='$editEmiNo'
                                WHERE `stock_id`='$editid'";
            
            $productRes = mysqli_query($conn, $editProduct);

                if ($productRes) {
                    $_SESSION['message'] = "Product details Updated successfully!";
                    $response['success'] = true;
                    $response['message'] = "Product details Updated successfully!";
                } 
                else {
                $response['message'] = "Error: " . mysqli_error($conn);
            }
            
            echo json_encode($response);
            exit();
        }


        // // Handle deleting a client
            if (isset($_POST['deleteId'])) {
                $id = $_POST['deleteId'];
                $updatedBy = $_SESSION['userId'];

                $queryDel = "UPDATE `stock_tbl` SET `stock_status`='Inactive' WHERE stock_id = $id;";
                $reDel = mysqli_query($conn, $queryDel);

                if ($reDel) {
                    
                    $_SESSION['message'] = "Product details have been deleted successfully!";
                    $response['success'] = true;
                    $response['message'] = "Product details have been deleted successfully!";
                } else {
                    $_SESSION['message'] = "Unexpected error in deleting Product details!";
                    $response['message'] = "Error: " . mysqli_error($conn);
                }

                echo json_encode($response);
                exit();
            }

            if(isset($_POST['id']) && $_POST['id'] != '') {
                $proId = $_POST['id'];
            
                // Prepare and execute the SQL query
                $selQuery1 = "SELECT
                            a.stock_id,
                            a.brand_id,
                            a.product_id,
                            a.model_id,
                            a.product_price,
                            a.product_quantity,
                            a.place,
                            a.emi_no,
                            a.stock_status,
                            b.product_name,
                            b.product_status,
                            c.brand_name,
                            c.brand_status,
                            d.mod_name
                        FROM
                            stock_tbl AS a
                        LEFT JOIN product_tbl AS b
                        ON
                            b.product_id = a.product_id
                        LEFT JOIN brand_tbl AS c
                        ON
                            c.brand_id = a.brand_id
                        LEFT JOIN model_tbl AS d
                        ON
                            a.model_id = d.mod_id
                        WHERE
                            a.stock_id = '$proId';";
                
                $result1 = $conn->query($selQuery1);
            
                if($result1) {
                    $row = mysqli_fetch_assoc($result1);
                    
                // Prepare university details array
                $productView = [
                       
                        'ProductNameView' => $row['product_name'],
                        'modelView' => $row['mod_name'],
                        'quantityView' => $row['product_quantity'],
                        'priceView' => $row['product_price'],
                        'placeView' => $row['place'],
                        'emiView' => $row['emi_no'],
                        'brandIDView' => $row['brand_id'],
                        'brandNameView' => $row['brand_name'],
                        
                ];
            
                echo json_encode($productView);
                exit();
                      
                } else {
                    echo "Error executing query: " . $conn->error;
                }
            }


            // brand select

            if (isset($_POST['brand']) && $_POST['brand'] != '') {
    
                $brandId = $_POST['brand'];
            
            
                $courseQuery = "SELECT `mod_id`
                , `mod_name` 
                FROM `model_tbl` WHERE mod_brand_id = $brandId AND mod_status = 'Active';";
                $courseResult = mysqli_query($conn, $courseQuery);
            
                if ($courseResult) {
                    while ($row = mysqli_fetch_assoc($courseResult)) {
                        // Push each course as an object into the courses array
                        $course = array(
                            'mod_id' => $row['mod_id'],
                            'mod_name' => $row['mod_name']
                        );
                        $courses[] = $course;
                    }
            
                    echo json_encode($courses);
                } else {
                    $response['message'] = "Error fetching Model Name details: " . mysqli_error($conn);
                    echo json_encode($response);
                }
            
                exit(); 
                }


                // view function

                if (isset($_GET['invoice_id'])) {
                    $invoice_id = (int)$_GET['invoice_id'];
                
                    // Fetch the invoice data
                    $query = "
                        SELECT 
                            customer_name, 
                            customer_phone, 
                            billing_address, 
                            products, 
                            total_price 
                        FROM 
                            invoice_tbl 
                        WHERE 
                            invoice_id = $invoice_id";
                
                    $result = mysqli_query($conn, $query);
                
                    if ($row = mysqli_fetch_assoc($result)) {
                        $customerName = $row['customer_name'];
                        $customerPhone = $row['customer_phone'];
                        $billingAddress = $row['billing_address'];
                        $totalPrice = $row['total_price'];
                        $products = json_decode($row['products'], true);
                
                        // Generate HTML for invoice details
                        echo "<p><strong>Customer Name:</strong> $customerName</p>";
                        echo "<p><strong>Phone:</strong> $customerPhone</p>";
                        echo "<p><strong>Address:</strong> $billingAddress</p>";
                        echo "<p><strong>Total Price:</strong> ₹" . number_format($totalPrice, 2) . "</p>";
                
                        echo "<h5>Products</h5>";
                        echo "<table class='table table-bordered'>";
                        echo "<thead><tr><th>Brand</th><th>Model</th><th>Product</th><th>Quantity</th><th>Price</th></tr></thead>";
                        echo "<tbody>";
                
                        foreach ($products as $product) {
                            echo "<tr>";
                            echo "<td>{$product['brand']}</td>";
                            echo "<td>{$product['model']}</td>";
                            echo "<td>{$product['product']}</td>";
                            echo "<td>{$product['quantity']}</td>";
                            echo "<td>₹" . number_format($product['total'], 2) . "</td>";
                            echo "</tr>";
                        }
                        
                        echo "</tbody></table>";
                    } else {
                        echo "No details found for this invoice.";
                    }
                    exit(); 
                } 
            

           





            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();
