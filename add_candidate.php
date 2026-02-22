<?php include 'config.php';

if(isset($_POST['add'])){
    $name=$_POST['name'];
    $party=$_POST['party'];
    $stmt=$conn->prepare("INSERT INTO candidates(name,party) VALUES(?,?)");
    $stmt->bind_param("ss",$name,$party);
    $stmt->execute();
    header("Location: admin_dashboard.php");
}
?>

<form method="POST">
<input type="text" name="name" placeholder="Candidate Name" required>
<input type="text" name="party" placeholder="Party" required>
<button name="add">Add</button>
</form>