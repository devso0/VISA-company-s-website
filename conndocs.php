<?php 

$servername = "localhost";
$username = "root";
$password = "";
$db = "Documentation_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $name, $text);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}


?>