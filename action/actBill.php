<?php
session_start();
include "../class.php"; // Ensure your database connection is included here

if (isset($_POST['customerName']) && $_POST['customerName'] != '') {
    $customerName = mysqli_real_escape_string($conn, $_POST['customerName']);
    $customerPhone = mysqli_real_escape_string($conn, $_POST['customerPhone']);
    $billingAddress = mysqli_real_escape_string($conn, $_POST['billingAddress']);
    $products = mysqli_real_escape_string($conn, $_POST['products']);  // This will be a JSON string
    $totalPrice = (int)$_POST['totalPrice'];
    $gstNo = (int)$_POST['gstNo'];
    $date=date('Y-m-d');

    // Prepare the SQL query to insert data into the invoice table
    $query = "INSERT INTO invoice_tbl 
        (customer_name, customer_phone, billing_address, products, total_price,invoice_date, gst_no)
        VALUES ('$customerName', '$customerPhone', '$billingAddress', '$products', $totalPrice,'$date', $gstNo)";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Success response
        $response = array('success' => true, 'message' => 'Invoice created successfully.');

        // Decode the JSON products to an associative array
        $productDetails = json_decode($_POST['products'], true);
        
        // Check if JSON decoding was successful and the result is an array
        if (is_array($productDetails)) {
            // Loop through each product to update stock
            foreach ($productDetails as $product) {
                $productId = $product['product_id'];
                $quantity = $product['quantity'];
                $brandId = $product['brand_id']; // Get brand ID
                $modelId = $product['model_id']; // Get model ID

                // Prepare the SQL query to update stock quantity
                $updateQuery = "UPDATE stock_tbl SET product_quantity = product_quantity - $quantity 
                WHERE brand_id = $brandId AND product_id = $productId AND model_id = $modelId";
                mysqli_query($conn, $updateQuery); // Execute the update query
            }
        } else {
            // If JSON decoding failed, add an error response
            $response = array('success' => false, 'message' => 'Error: Invalid product data format.');
        }
    } else {
        // Error response for query execution
        $response = array('success' => false, 'message' => 'Error: ' . mysqli_error($conn));
    }

    // Return JSON response
    echo json_encode($response);
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

    // product select

    // brand select

    if (isset($_POST['brandId']) && !empty($_POST['brandId'])) {
        $brandId = $_POST['brandId'];
        $modelId = $_POST['modelId'];
        $productId = $_POST['productId'];
        $productTypeId = $_POST['productTypeId'];
    
        $price_Query = "SELECT `product_price` FROM `stock_tbl` 
                        WHERE brand_id = $brandId AND model_id = $modelId 
                        AND product_id = $productId AND product_type_id = $productTypeId AND stock_status = 'Active'";
                        
        $price_result = mysqli_query($conn, $price_Query);
    
        header('Content-Type: application/json'); // Set JSON response header
    
        if ($price_result) {
            if (mysqli_num_rows($price_result) > 0) {
                $row = mysqli_fetch_assoc($price_result);
                $response = ['product_price' => $row['product_price']];
                echo json_encode($response);
            } else {
                $response = ['message' => 'No price found for the selected brand, model, and product.'];
                echo json_encode($response);
            }
        } else {
            $response = ['message' => 'Error fetching Price details: ' . mysqli_error($conn)];
            echo json_encode($response);
        }
    
        exit();
    }


    // quantity check

    if (isset($_POST['brandIdQty']) && !empty($_POST['brandIdQty'])) {
        $brandId = $_POST['brandIdQty'];
        $modelId = $_POST['modelId'];
        $productId = $_POST['productId'];
    
        $price_Query = "SELECT `product_quantity` FROM `stock_tbl` 
                        WHERE brand_id = $brandId AND model_id = $modelId 
                        AND product_id = $productId AND stock_status = 'Active'";
        $price_result = mysqli_query($conn, $price_Query);
    
    
        if ($price_result && $row = mysqli_fetch_assoc($price_result)) {
            echo json_encode(['stock' => $row['product_quantity']]);
        } else {
            echo json_encode(['stock' => 0]);
        }
    
        exit();
    }


    
    if (isset($_POST['brand_id']) && !empty($_POST['brand_id'])) {
        $brandId = $_POST['brand_id'];
        $modelId = $_POST['model_id'];
        $productId = $_POST['product_id'];
    
        $price_Query = "SELECT
                        b.brand_name,
                        c.mod_name,
                        d.product_name,
                        a.brand_id,
                        a.model_id,
                        a.product_id
                    FROM
                        `stock_tbl` AS a
                    LEFT JOIN brand_tbl AS b
                    ON
                        a.brand_id = b.brand_id
                    LEFT JOIN model_tbl c ON
                        a.model_id = c.mod_id
                    LEFT JOIN product_tbl d ON
                        a.product_id = d.product_id
                    WHERE
                        a.brand_id = $brandId AND a.model_id = $modelId AND a.product_id = $productId AND a.stock_status = 'Active';";
        $price_result = mysqli_query($conn, $price_Query);
    
    
      // Check if product found
        if ($price_result->num_rows > 0) {
            $product = $price_result->fetch_assoc();
            echo json_encode($product); // Return product details as JSON
        } else {
            echo json_encode(['error' => 'Product not found']);
        }
    
        exit();
    }

    if (isset($_POST['pro_id']) && $_POST['pro_id'] != '') {
    
        $brandId = $_POST['pro_id'];
    
    
        $courseQuery = "SELECT `id`
        ,`name` FROM `product_type_tbl` WHERE pro_id = $brandId AND `status` = 'Active';";
        $courseResult = mysqli_query($conn, $courseQuery);
        $type = array(); 
        if ($courseResult) {
            while ($row = mysqli_fetch_assoc($courseResult)) {
                // Push each course as an object into the courses array
                $course = array(
                    'mod_id' => $row['id'],
                    'mod_name' => $row['name']
                );
                $type[] = $course;
            }
    
            echo json_encode($type);
        } else {
            $response['message'] = "Error fetching paroduct Type details: " . mysqli_error($conn);
            echo json_encode($response);
        }
    
        exit(); 
        }






        
            // Default response if no action specified
            $response['message'] = "Invalid action specified.";
            echo json_encode($response);
            exit();
