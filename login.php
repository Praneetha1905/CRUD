<?php 
include 'config.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && $password == $user['password']){
        $_SESSION['user'] = $user;
        if($user['role'] == "admin"){
            header("Location: admin_dashboard.php");
        } else {
            header("Location: voter_dashboard.php");
        }
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Invalid Login!</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4 shadow-sm" style="width: 400px;">
            <h3 class="text-center mb-4">Login</h3>
            <form method="POST">
                <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                <button name="login" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>
</body>
</html>