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
        <title>Monthly calendar</title>
    <link rel="stylesheet" href="CLstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital@1&display=swap" rel="stylesheet">
</head>
<body>
    <div class="title-container">

    <h1>Welcome Guest</h>
    <h2> <?= $user_name ?></h2>


    <a href="http://localhost/website/calendarclient.php.php">Calendar</a>

    </div>
    
</body>
</html>

    <?php
} else {
    header("Location: http://localhost/website/login/Userlogin.php");
}

?>

