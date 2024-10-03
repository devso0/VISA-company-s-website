<?php
session_start();
include ('./conn/conn.php');

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch the user's name from the database
    $stmt = $conn->prepare("SELECT `name` FROM `userlogin_db` WHERE `user_id` = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $user_name = $row['name'];
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage</title>
        
        
    </head>
    <body> <div class="main">

<div class="title-container">

    <h1>Welcome User</h1>
    <h2> <?= $user_name ?></h2>

    <a href="http://localhost/website/Homepage.html">Homepage</a>
   
</div>
</body>
    </html>
    
    <?php
} else {
    header("Location: http://localhost/website/login/Userlogin.php");
}

?>

