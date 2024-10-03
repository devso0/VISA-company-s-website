<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <label> Username: </label><br>
        <input type = "text" name="Username"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br>
        email:<br>
        <input type = "text" name="email"><br>
        <input type="submit" value="Log in">
    </form>
</body>
</html>
<?php

include("database.php");


    $sql ="INSERT INTO users (user, password, email) VALUES ('Spongebob', 'pineapple1')";

    mysqli_query($conn, $sql);

    mysqli_close($conn);

    
    setcookie("User_Timetable", "Time_status", time()+ 86400*2, "/") ;
    setcookie("User_Notes", "Recent_Documents", time()+ 86400*10, "/") ;

    foreach($_COOKIE as $key => $value) {
        echo"{$key} = {$value} <br>" ;
    }

    if(isset($_COOKIE["User_Timetable"])){
        echo "Check your {$COOKIE["User_Timetalbe"]}";
    }

    else{
        echo "Your status is lost";
    }

    if(isset($_POST["Log in"])){

        $username = filter_input(INPUT_POST, "Username", FILTER_SANITIZE_SPECIAL_CHARS);

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        echo "Hello {$username} and you will be contacted through {$email}!";
    }

?>