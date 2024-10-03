<?php 
include ('../conn/conn.php');

if (isset($_POST['name'], $_POST['role'], $_POST['username'], $_POST['email'],$_POST['password'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try {
        $stmt = $conn->prepare("SELECT `name` FROM `userlogin_db` WHERE `name` =  :name ");
        $stmt->execute(['name' => $name]);

        $nameExist =  $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($nameExist)) {
            $conn->beginTransaction();

            $insertStmt = $conn->prepare("INSERT INTO `userlogin_db` (`name`, `role`, `username`, `email`, `password`) VALUES (:name, :role, :username, :email, :password)");
            $insertStmt->bindParam('name', $name, PDO::PARAM_STR);
            $insertStmt->bindParam('role', $role, PDO::PARAM_STR);
            $insertStmt->bindParam('username', $username, PDO::PARAM_STR);
            $insertStmt->bindParam('email', $email, PDO::PARAM_STR);
            $insertStmt->bindParam('password', $password, PDO::PARAM_STR);

            $insertStmt->execute();

            $conn->commit(); 

            echo "
            <script>
                alert('Registered Successfully!');
                window.location.href = 'http://localhost/website/Userlogin.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Account Already Exist!');
                window.location.href = 'http://localhost/website/Userlogin.php';
            </script>
            ";
        }

    }  catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }

}

?>


