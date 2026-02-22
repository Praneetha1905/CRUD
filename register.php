<?php
include 'config.php';

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "voter"; // default role

    // Check if email already exists
    $check = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check);

    if($result->num_rows > 0){
        echo "<script>alert('Email already registered!');</script>";
    } else {

        $sql = "INSERT INTO users (name,email,password,role) 
                VALUES ('$name','$email','$password','$role')";

        if($conn->query($sql)){
            echo "<script>alert('Registration Successful!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error occurred!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="col-md-6 mx-auto">
        <h2 class="text-center mb-4">Register</h2>

        <form method="POST">
            <input type="text" name="name" class="form-control mb-3" placeholder="Enter Name" required>

            <input type="email" name="email" class="form-control mb-3" placeholder="Enter Email" required>

            <input type="password" name="password" class="form-control mb-3" placeholder="Enter Password" required>

            <button type="submit" name="register" class="btn btn-success w-100">
                Register
            </button>
        </form>

        <p class="mt-3 text-center">
            Already have an account? 
            <a href="login.php">Login here</a>
        </p>
    </div>

</body>
</html>