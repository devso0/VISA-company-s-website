<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-size: cover;
            background-repeat: no-repeat;
            background-color:antiquewhite;
            background-attachment: fixed;        
            overflow: hidden;
            height: 100vh;
        }
        
        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: wheat;
            height: 100vh;
        }

        .login-container, .registration-container {
            width: 500px;
            align-items: center;
            justify-content: center;
            box-shadow: papayawhip;
            border-radius: 10px;
            background-color: beige;
            padding: 30px;
            color: gray;
        }

        .title-container > h1 {
            font-size: 90px !important;
            color: burlywood;
            text-shadow: 2px 4px 2px rgba(200,200,200,0.6);
        }

        .show-form {
            color: darkblue;
            text-decoration: underline;
            cursor: pointer;
        }

        .show-form:hover {
            color: darkblue;
        }
    </style>
</head>
<body>
    
    <div class="main row">


        <div class="main-container col-4">
        <!-- Login Form -->
        <div class="login-container" id="loginForm">
            <h2 class="text-center">Welcome Back!</h2>
            <p class="text-center">Please enter your login details.</p>
            <div class="login-form">
                <form action="./login/endpoint/login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    
                    <div class="row m-auto">
                    <div class="form-group form-check col-6">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember Password</label>
                    </div>
                    <small class="show-form col-6 text-center pl-4" onclick="showForm()">No Account? Register Here.</small>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary login-btn form-control">Login</button>
                </form>
            </div>
        </div>


        <!-- Registration Area -->
        <div class="registration-container" id="registrationForm" style="display:none;">
            <h2 class="text-center">Register Your Account!</h2>
            <p class="text-center">Please enter your personal details.</p>
            <div class="registration-form">
            <form action="./login/endpoint/add-user.php" method="POST">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role">
                        <option>-select-</option>
                        <option value="user">User</option>
                        <option value="guest">Guest</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="registerUsername">Username:</label>
                    <input type="text" class="form-control" id="registerUsername" name="username">
                </div>  
                
                <div class="form-group">
                    <label for="registerEmail">Email:</label>
                    <input type="text" class="form-control" id="registerEmail" name="email">
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password:</label>
                    <input type="password" class="form-control" id="registerPassword" name="password">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                </div>
               
                <div class="form-group float-right">
                    <small class="show-form" onclick="showForm()">Already have an account? Login Here.</small>
                </div>
                <button type="submit" class="btn btn-primary login-register form-control">Register</button>
            </form>

            </div>

        </div>
        </div>


    </div>

    <!-- Bootstrap 4 JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <script>
        function showForm() {
            const loginForm = document.getElementById('loginForm');
            const registrationForm = document.getElementById('registrationForm');

            if (registrationForm.style.display == 'none') {
                loginForm.style.display = 'none';
                registrationForm.style.display = '';
            } else {
                loginForm.style.display = '';
                registrationForm.style.display = 'none';
            }
        }
    </script>
</body>
</html>

<?php

if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}