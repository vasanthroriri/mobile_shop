<?php 
include("db/dbConnection.php");


function getLocation() {
    global $conn; // Assuming $conn is your database connection variable


   // Query to retrieve course name based on course_id
   $location_query = "SELECT `loc_id`, `loc_name`, `loc_short_name` FROM `jeno_location` WHERE loc_status='Active';";

   // Execute the query
   $location_result = $conn->query($location_query);

   // Check if query was successful
   if ($location_result) {
       // Fetch the course name
       

       return $location_result;
   } else {
       // Query execution failed
       return "Query failed: " . $conn->error;
   }
}



        // brand select table 

        function brandTable() {
            global $conn; // Assuming $conn is your database connection variable
        
        
           // Query to retrieve course name based on course_id
           $brand_query = "SELECT `brand_id`, `brand_name` FROM `brand_tbl` WHERE brand_status = 'Active';";
        
           // Execute the query
           $brand_result = $conn->query($brand_query);
        
           // Check if query was successful
           if ($brand_result) {
               // Fetch the course name
               
        
               return $brand_result;
           } else {
               // Query execution failed
               return "Query failed: " . $conn->error;
           }
        }

        function rackTable() {
            global $conn; // Assuming $conn is your database connection variable
        
        
           // Query to retrieve course name based on course_id
           $brand_query = "SELECT `rack_id`, `rack_no`, `rack_name` FROM `rack_tbl` WHERE status = 'Active';";
        
           // Execute the query
           $brand_result = $conn->query($brand_query);
        
           // Check if query was successful
           if ($brand_result) {
               // Fetch the course name
               
        
               return $brand_result;
           } else {
               // Query execution failed
               return "Query failed: " . $conn->error;
           }
        }

        // product select table 

        function productTable() {
            global $conn; // Assuming $conn is your database connection variable
        
        
           // Query to retrieve course name based on course_id
           $product_query = "SELECT product_id, product_name FROM product_tbl WHERE product_status='Active'";
        
           // Execute the query
           $product_result = $conn->query($product_query);
        
           // Check if query was successful
           if ($product_result) {
               // Fetch the course name
               
        
               return $product_result;
           } else {
               // Query execution failed
               return "Query failed: " . $conn->error;
           }
        }
        // stock select table 

        function stockTable() {
            global $conn; 
        
            if (!$conn) {
                die("Database connection failed.");
            }
        
                $stock_query = "SELECT
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
                                    d.mod_name,
                                    e.name
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
                                    LEFT JOIN product_type_tbl AS e ON a.product_type_id = e.id
                                WHERE
                                    a.stock_status = 'Active';";
                                        
            $stock_result = $conn->query($stock_query);
        
            if ($stock_result) {
               
                if ($stock_result->num_rows > 0) {
                   
                    return $stock_result;
                } else {
                    
                    return "No products found.";
                }
            } else {
                return "Query failed: " . $conn->error;
            }
        }


        // model table function 

        function modelTable() {
            global $conn; // Assuming $conn is your database connection variable
        
        
           // Query to retrieve course name based on course_id
           $model_query = "SELECT
                    a.mod_id,   
                    a.mod_name,
                    b.brand_name
                FROM
                    `model_tbl` AS a LEFT JOIN brand_tbl AS b ON a.mod_brand_id =b.brand_id
                WHERE
                    a.mod_status = 'Active';";
        
           // Execute the query
           $model_result = $conn->query($model_query);
        
           // Check if query was successful
           if ($model_result) {
               // Fetch the course name
               
        
               return $model_result;
           } else {
               // Query execution failed
               return "Query failed: " . $conn->error;
           }
        }




        // brand select table 

        function prodectTable() {
            global $conn; // Assuming $conn is your database connection variable
        
        
           // Query to retrieve course name based on course_id
           $product_query = "SELECT `product_id`, `product_name` FROM `product_tbl` WHERE product_status = 'Active';";
        
           // Execute the query
           $product_result = $conn->query($product_query);
        
           // Check if query was successful
           if ($product_result) {
               // Fetch the course name
               
        
               return $product_result;
           } else {
               // Query execution failed
               return "Query failed: " . $conn->error;
           }
        }


        // sales funtion
            
        function salesTable() {
            global $conn; 
        
            if (!$conn) {
                die("Database connection failed.");
            }
        
                $stock_query = "SELECT
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
                                    a.stock_status = 'Active';";
                                        
            $stock_result = $conn->query($stock_query);
        
            if ($stock_result) {
               
                if ($stock_result->num_rows > 0) {
                   
                    return $stock_result;
                } else {
                    
                    return "No products found.";
                }
            } else {
                return "Query failed: " . $conn->error;
            }
        }

        // invoice select table 

        function reportTable() {
            global $conn; // Assuming $conn is your database connection variable
        
            // Check if a specific date is selected from the form (via GET request)
            if (isset($_GET['reportDate']) && !empty($_GET['reportDate'])) {
                $selectedDate = $_GET['reportDate'];
            } else {
                // If no date is selected, use the current date
                $selectedDate = date('Y-m-d');
            }
        
            // Query to retrieve reports based on the selected date
            $product_query = "SELECT invoice_id,
                                     customer_name,
                                     customer_phone,
                                     billing_address,
                                     products,
                                     total_price,
                                     gst_no,
                                     invoice_date
                              FROM invoice_tbl
                              WHERE invoice_status = 'Active'
                              AND invoice_date = '$selectedDate'";
        
            // Query to calculate the total amount for the selected date
            $total_amount_query = "SELECT SUM(total_price) AS total_amount 
                                   FROM invoice_tbl 
                                   WHERE invoice_status = 'Active' 
                                   AND invoice_date = '$selectedDate'";
        
            // Execute the report query
            $product_result = $conn->query($product_query);
        
            // Execute the total amount query
            $total_result = $conn->query($total_amount_query);
        
            // Fetch the total amount (default to 0 if no records are found)
            $total_amount = 0;
            if ($total_result && $total_row = $total_result->fetch_assoc()) {
                $total_amount = $total_row['total_amount'] ?? 0;
            }
        
            // Check if the report query was successful
            if ($product_result) {
                // Return both the report result and the total amount
                return ['result' => $product_result, 'total_amount' => $total_amount];
            } else {
                // Query execution failed
                return "Query failed: " . $conn->error;
            }
        }


          // product Type select table 

          function productTypeTable() {
            global $conn; // Assuming $conn is your database connection variable
        
        
           // Query to retrieve course name based on course_id
           $product_query = "SELECT `id`, `name` FROM product_type_tbl WHERE status='Active'";
        
           // Execute the query
           $product_result = $conn->query($product_query);
        
           // Check if query was successful
           if ($product_result) {
               // Fetch the course name
               
        
               return $product_result;
           } else {
               // Query execution failed
               return "Query failed: " . $conn->error;
           }
        }


        // product table ------------
        function productTypeAll() {
            global $conn; // Assuming $conn is your database connection variable
        
        
           // Query to retrieve course name based on course_id
           $model_query = "SELECT
                    a.id,   
                    a.name,
                    b.product_name
                FROM
                    `product_type_tbl` AS a LEFT JOIN product_tbl AS b ON a.pro_id =b.product_id
                WHERE
                    a.status = 'Active';";
        
           // Execute the query
           $model_result = $conn->query($model_query);
        
           // Check if query was successful
           if ($model_result) {
               // Fetch the course name
               
        
               return $model_result;
           } else {
               // Query execution failed
               return "Query failed: " . $conn->error;
           }
        }


         // product Type select table 

         function prodectTypeList() {
            global $conn; // Assuming $conn is your database connection variable
        
        
           // Query to retrieve course name based on course_id
           $product_query = "SELECT `product_id`, `product_name`  FROM `product_tbl` WHERE `product_status` = 'Active';";
        
           // Execute the query
           $product_result = $conn->query($product_query);
        
           // Check if query was successful
           if ($product_result) {
               // Fetch the course name
               
        
               return $product_result;
           } else {
               // Query execution failed
               return "Query failed: " . $conn->error;
           }
        }
        
        
?>
