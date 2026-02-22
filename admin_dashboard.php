<?php 
include 'config.php'; 

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT id, name, email, role, voted FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Registered Users</h2>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
            
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Voted Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><span class="badge bg-primary"><?php echo $row['role']; ?></span></td>
                        <td>
                            <?php echo ($row['voted'] == 1) ? 
                                '<span class="text-success">Voted</span>' : 
                                '<span class="text-muted">Not Voted</span>'; 
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Back to Main Panel</a>
        </div>
    </div>
    
</body>
</html>