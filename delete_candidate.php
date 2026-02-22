<?php include 'config.php';
$id=$_GET['id'];
$conn->query("DELETE FROM candidates WHERE id=$id");
header("Location: admin_dashboard.php");
?>