<?php
include 'config.php';

if(isset($_POST['vote_btn'])){
    
    $party_id = $_POST['party_id'];
    $user_id = $_SESSION['user']['id'];

    $check_user = $conn->query("SELECT voted FROM users WHERE id = '$user_id'");
    $userData = $check_user->fetch_assoc();

    if($userData['voted'] == 0) {
        
        $update_party = $conn->query("UPDATE parties SET votes_count = votes_count + 1 WHERE id = '$party_id'");
        
        $update_user = $conn->query("UPDATE users SET voted = 1 WHERE id = '$user_id'");

        if($update_party && $update_user) {
            $_SESSION['user']['voted'] = 1;

            echo "<script>
                    alert('Success! Your vote has been recorded.');
                    window.location='voter_dashboard.php';
                  </script>";
        } else {
            echo "Database Error: " . $conn->error;
        }

    } else {
        echo "<script>
                alert('Invalid Request: You have already voted.');
                window.location='voter_dashboard.php';
              </script>";
    }

} else {
    header("Location: voter_dashboard.php");
    exit();
}
?>