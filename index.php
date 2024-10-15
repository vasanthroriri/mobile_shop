
<?php 
session_start();
    include("class.php");

if(isset($_SESSION['user']) && $_SESSION['user'] != '')
    {
        header("Location:dashboard.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>JENO Study Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    
    <!-- Theme Config Js -->
    <script src="assets/js/config.js"></script>

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins';
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            width: 80%;
            max-width: 1200px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }
        .left, .right {
            flex: 1;
            padding: 40px;
        }
        .left {
            background-color: #fff;
        }
        .header {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 40px;
        }
        .login-tab {
            background: linear-gradient(90deg, #ae43ef, #d78bfd);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 19px;
            cursor: pointer;
        }
        .login-tab:hover {
            background: linear-gradient(90deg, #d78bfd, #ae43ef);
        }
        .welcome-message {
            text-align: center;
        }
        .welcome-message h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
        }
        .welcome-message p {
            font-size: 18px;
            color: #d78bfd;
            margin-bottom: 28px;
            font-size: 16px;
        }
        .login-form {
            text-align: center;
        }
        .login-form h2 {
            font-size: 15px;
            margin-bottom: 20px;
            font-weight: normal;
        }
        form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }
        label {
            font-size: 14px;
            color: #666;
            text-align: left;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .password-container {
            position: relative;
            width: 100%;
            max-width: 300px;
        }
        .password-container .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        button[type="submit"] {
            background-color: #ae43ef;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            max-width: 300px;
        }
        .right {
            background: linear-gradient(90deg, #ae43ef, #d78bfd);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 10px;
        }
        .image-container h1 {
            font-size: 66px;
            margin-bottom: 10px;
            letter-spacing: 10px;
        }
        .image-container p {
            font-size: 18px;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }
        .image-container img {
            width: 100%;
            max-width: 400px;
            height: auto;
            zoom: 4;
        }
        .show-password {
            margin-left: -30px;
            cursor: pointer;
            font-size: 24px;
            position: relative;
            top: -3px;
        }
        .error-message {
            text-align: left;
            color: red;
            font-size: 0.9em;
            display: none; /* Hide by default */
        }
        .session-message {
            color: red;
            padding: 5px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .session-message.success {
            background-color: #28a745;
        }
        .session-message.error {
            /* background-color: #dc3545; */
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .image-container h1 {
                font-size: 36px;
            }
            .image-container p {
                font-size: 16px;
            }
            .footer {
                text-align: center;
            }
        }
    </style>
</head>
<body class="authentication-bg position-relative">
    <div class="container">
            <div class="left">
                <div class="header">
                    <button class="login-tab">Login</button>
                </div>
                <div class="welcome-message">
                    <h1>Welcome Back!</h1>
                    <p>Glad to see you again</p>
                </div>
                <div class="login-form">
                    <h2>Login With Your Account Below</h2>
                      <!-- Display session message -->
                <?php
                
                if (isset($_SESSION['message'])) {
                    $message_type = $_SESSION['message_type']; // success or error
                    echo "<div class='session-message {$message_type}'>{$_SESSION['message']}</div>";
                    // Unset session message after displaying
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                }
                ?>
                    <form id="loginForm" action="actLogin.php" method="POST" onsubmit="return validateForm()">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter username...">
                        <span class="error-message" id="usernameError"></span>
                        
                        <label for="password">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" placeholder="Enter password...">
                            <span class="show-password"><i class='bx bx-show'></i></span>
                        </div>
                        <span class="error-message" id="passwordError"></span>

                        <label for="location">Location</label>
                        <select id="location" name="location">
                            <option value="">----select----</option>
                            <?php 
                                     $location_result = getLocation(); // Call the function to fetch universities 
                                     while ($row = $location_result->fetch_assoc()) {
                                     $id = $row['loc_id']; 
                                    $name = $row['loc_short_name'];    
                        
                                      ?>
                        
                            <option value="<?php echo $id;?>"><?php echo $name;?></option>

                        <?php } ?>

                        </select>
                        <span class="error-message" id="locationError"></span>

                        <label for="role">Privilege</label>
                        <select id="role" name="role">
                            <option value="">----select----</option>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                        </select>
                        <span class="error-message" id="privilegeError"></span>

                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
            <div class="right">
                <div class="image-container">
                    <h1>JENO</h1>
                    <p><b>EDUCATIONAL ORGANIZATION</b></p>
                    <img src="assets/images/logo/Lock1.png" alt="Illustration">
                </div>
            </div>
        </div>

    

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>
    
    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.show-password').on('click', function() {
                let passwordInput = $('#password');
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    $(this).html('<i class="bx bx-hide"></i>');
                } else {
                    passwordInput.attr('type', 'password');
                    $(this).html('<i class="bx bx-show"></i>');
                }
            });
        });

        function validateForm() {
            // Clear previous error messages
            document.getElementById('usernameError').style.display = 'none';
            document.getElementById('passwordError').style.display = 'none';
            document.getElementById('locationError').style.display = 'none';
            document.getElementById('privilegeError').style.display = 'none';

            // Get form values
            var username = document.getElementById('username').value.trim();
            var password = document.getElementById('password').value.trim();
            var location = document.getElementById('location').value;
            var role = document.getElementById('role').value;

            // Check if fields are empty and display error messages
            var valid = true;

            if (username === "") {
                document.getElementById('usernameError').textContent = "Username is required.";
                document.getElementById('usernameError').style.display = 'inline';
                valid = false;
            }

            if (password === "") {
                document.getElementById('passwordError').textContent = "Password is required.";
                document.getElementById('passwordError').style.display = 'inline';
                valid = false;
            }

            if (location === "") {
                document.getElementById('locationError').textContent = "Please select a location.";
                document.getElementById('locationError').style.display = 'inline';
                valid = false;
            }

            if (role === "") {
                document.getElementById('privilegeError').textContent = "Please select a privilege.";
                document.getElementById('privilegeError').style.display = 'inline';
                valid = false;
            }

            return valid;
        }
    </script>
</body>
</html>
