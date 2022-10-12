<?php
    if(!$_GET) {
        header("Location: login.php");
        exit();
    }
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box-presentation">
        <?php 
            $dsn = "mysql:host=127.0.0.1;dbname=login-simulation";
            $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                $connection = new PDO($dsn, 'root', '', $options);
                $stmt = $connection->prepare('SELECT * FROM user WHERE id = ?');
                $stmt->execute([$_GET['userId']]);
                $user = $stmt->fetch();
                $userEmail = $user["email"];
                echo "<h1>Welcome $userEmail</h1>";
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        ?>
    </div>

    <div class="box-presentation">
        <p>
            This project has the objective of practicing the login and registration system using PHP and MySQL.
        </p>
    </div>
   
</body>
</html>