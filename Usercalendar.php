<?php
    $username = "Welcome Emily";
    $username= strtolower($username);
    echo $username;


    $DocName = "$DocName";
    $equals = strcmp($DocName, "Notes");
    echo $equals;
    
    if ($equals == 0) {
        echo "Files don't exist";
    }
    else {
        echo "Look for your file";
    }


?>