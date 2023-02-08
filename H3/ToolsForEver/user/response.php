<?php
include "../connect.php";

try {
    foreach ($_POST as $item) {
        if (!isset($item)) {
            if (isset($_POST['login'])) {
                header('Location: login.php');
            } else {
                header('Location: sign_up.php');
            }
            exit();
        }
    }

    if (isset($_POST['login'])) {
        $query = $dbh->prepare('SELECT pass FROM user WHERE email = :email');
        $query->bindParam(':email', $_POST['email']);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);
        $pass = $result['pass'];

        if (password_verify($_POST['pass'], $pass)) {
            setcookie('logged_in', $_POST['email'], time() + (3600 * 24), '/');
            header('Location: ../index.php');
        } else {
            header('Location: login.php');
        }
    } else if (isset($_POST['sign_up'])) {
        header('Location: login.php');
        $id = uniqid();

        //hash the pass
        $options = [
            'cost' => 12,
        ];
        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT, $options);

        //make and execute the query
        $query = $dbh->prepare('INSERT INTO user (user_id, email, name, pass) VALUES (:id, :email, :name, :pass)');
        $query->bindParam(':id', $id);
        $query->bindParam(':email', $_POST['email']);
        $query->bindParam(':name', $_POST['name']);
        $query->bindParam(':pass', $pass);

        $query->execute();
    }

    exit();
} catch (PDOException $e) {
    echo "Something went wrong, please try again";
}
