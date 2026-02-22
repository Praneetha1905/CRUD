<?php 
include 'config.php';

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "voter"){
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

$result = $conn->query("SELECT * FROM parties");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voter Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Welcome, <?php echo $user['name']; ?>!</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <hr>

        <?php if($user['voted'] == 1): ?>
            <div class="alert alert-success text-center py-5">
                <h1 class="display-4">✅ Vote Recorded</h1>
                <p class="lead">You have already cast your vote. You cannot vote again.</p>
            </div>
        <?php else: ?>
            <h4 class="text-center text-secondary mb-4">Please Select a Party to Vote</h4>
            
            <div class="row text-center">
                <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm p-3">
                        <img src="images/<?php echo $row['id']; ?>.jpg" 
                             class="card-img-top mx-auto" 
                             style="width:120px; height:120px; object-fit:contain;" 
                             alt="Party Logo">
                        
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['party_name']; ?></h5>
                            
                            <form action="vote_logic.php" method="POST">
                                <input type="hidden" name="party_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="vote_btn" class="btn btn-primary w-100 mt-3">
                                    Vote for <?php echo $row['party_name']; ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>