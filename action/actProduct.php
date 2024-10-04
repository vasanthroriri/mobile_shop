<?php
include("../db/dbConnection.php");


session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a product
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addProductId') {
    $productName = $_POST['productName'];
    $model = $_POST['model'];
    $brandName=$_POST['brand'];
    $productQuantity=$_POST['quantity'];
    $productPrice=$_POST['price'];
    $place=$_POST['place'];
    $emiNo=$_POST['emiNo'];


    // Check if the product name already exists
    $check_sql = "SELECT COUNT(*) AS count FROM product_tbl WHERE product_name='$productName' AND model_name='$model'";
    $result = $conn->query($check_sql);
    $row = $result->fetch_assoc();
    $exists = $row['count'] > 0;

    if ($exists) {
        $response['success'] = false;
        $response['message'] = "This Product is already exists!";
    } else {
        // Insert the new Product if it doesn't exist
        
        $university_sql = "INSERT INTO 
                            `product_tbl`
                            ( `brand_id`, 
                            `product_name`, 
                            `model_name`, 
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
                    a.product_id,
                    a.brand_id,
                    a.product_name,
                    a.model_name,
                    a.product_price,
                    a.place,
                    a.emi_no,
                    a.product_status,
                    a.product_quantity,
                    b.brand_name
                    FROM    
                    product_tbl AS a
                    LEFT JOIN
                    brand_tbl AS b ON a.brand_id=b.brand_id
                    WHERE a.product_id='$editId'";
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
            'model_name'=>$row['model_name'],

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
           
  
            
            $editProduct ="UPDATE `product_tbl` 
                                SET 
                                `brand_id`='$editBrand',
                                `product_name`='$editProductName',
                                `model_name`='$editModel',
                                `product_price`='$editPrice',
                                `product_quantity`='$editQuantity',
                                `place`='$editPlace',
                                `emi_no`='$editEmiNo'
                                WHERE `product_id`='$editid'";
            
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

                $queryDel = "UPDATE `product_tbl` SET `product_status`='Inactive' WHERE product_id = $id;";
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
                                a.product_id,
                                a.brand_id,
                                a.product_name,
                                a.model_name,
                                a.product_price,
                                a.place,
                                a.emi_no,
                                a.product_status,
                                a.product_quantity,
                                b.brand_name
                            FROM    
                                product_tbl AS a
                            LEFT JOIN
                                brand_tbl AS b ON a.brand_id=b.brand_id
                            WHERE a.product_id='$proId';";
                
                $result1 = $conn->query($selQuery1);
            
                if($result1) {
                    $row = mysqli_fetch_assoc($result1);
                    
                // Prepare university details array
                $productView = [
                       
                        'ProductNameView' => $row['product_name'],
                        'modelView' => $row['model_name'],
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
            

           





            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();
