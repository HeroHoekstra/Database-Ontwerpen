<?php
include '../../connect.php'
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings</title>
</head>
<body>
    <?php
    $user_id = (string) $_COOKIE['logged_in'];

    $query = $dbh->prepare("SELECT user_id, email, name, pass FROM user WHERE user_id = ?");
    $query->bindValue(1, $user_id);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $item) {
        echo "
            <p>User ID: " . $item['user_id'] . "</p>
            <form action='update.php' method='post'>
                Email: <input type='email' name='email' value='" . $item['email'] . "'> <br>
                Name: <input type='text' name='name', value='" . $item['name'] . "'> <br>
                Pass: <input type='password' name='pass', value='12345678'> <br>
                Repeat pass: <input type='password' name='pass2'> <br>
                
                <input type='submit' name='update' value='Update info'>
            </form>
        ";
    }
    ?>
    <a href="../../">Home</a>
</body>
</html>
