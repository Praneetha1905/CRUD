<?php include 'config.php';

$user=$_SESSION['user'];

if($user['voted']==1){
    die("You already voted!");
}

$id=$_GET['id'];

$conn->query("UPDATE candidates SET votes=votes+1 WHERE id=$id");
$conn->query("UPDATE users SET voted=1 WHERE id=".$user['id']);

header("Location: voter_dashboard.php");
?>