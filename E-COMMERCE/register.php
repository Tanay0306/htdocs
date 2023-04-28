<?php
include "lib/connection.php";
$result = "";
if (isset($_POST['u_submit'])) {
    $f_name = $_POST['u_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['c_pass'];

    if ($password == $confirm_password) {
        // Hash the password securely with bcrypt algorithm
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL query
        $insertSql = "INSERT INTO users(f_name, l_name, email, pass) VALUES ('$f_name', '$l_name', '$email', '$hashed_password')";

        // Execute the query
        if ($conn->query($insertSql)) {
            $result = "Account created successfully";
            header("location: login.php");
        } else {
            die($conn->error);
        }
    } else {
        $result = "Passwords do not match";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>411</title>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    <span><?php echo $result; ?></span>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="u_name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="l_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="pass">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="c_pass">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" name="u_submit">Register Account</button>
                                <hr>
                                <div class="text-center">
                                    

                                    <a class="small" href="login.html">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            // Generate a random CSRF token
            var csrf_token = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

            // Set the CSRF token in the hidden input field
            document.getElementById("csrf_token").value = csrf_token;

            // Listen for the submit event of the form
            document.querySelector("form").addEventListener("submit", function(event) {
                // Set the CSRF token in the hidden input field before submitting the form
