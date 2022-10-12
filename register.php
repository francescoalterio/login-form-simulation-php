<?php
$dsn = "mysql:host=127.0.0.1;dbname=login-simulation";
    $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    

    if($_POST) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeat-password'];

        if($password === $repeatPassword) {
            $sql = "INSERT INTO `user` (`id`, `email`, `password`) VALUES (NULL, ?, ?);";

            try {
                $connection = new PDO($dsn, 'root', '', $options);

                $stmt = $connection->prepare('SELECT * FROM user WHERE email = ?');
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                if(!$user) {
                    $connection->prepare($sql)->execute([$email, $password]);
                    header("Location: login.php");
                    exit();
                }

                
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <h1>Register</h1>
        <div class="input-box">
            <span>Email:</span>
        <input type="email" name="email" id="">
        </div>
        <div class="input-box">
            <span>Password:</span>
            <input type="password" name="password" id="">
        </div>
         <div class="input-box">
            <span>Repeat password:</span>
            <input type="password" name="repeat-password" id="">
        </div>
        <a href="login.php">Do you already have an account?</a>
        <button>Register</button>
    </form>
</body>
</html>