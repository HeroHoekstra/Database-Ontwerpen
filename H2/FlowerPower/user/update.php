<?php
include '../connect.php';

if (isset($_POST['update'])) {
    header('Location: ./');
    foreach ($_POST as $item) {
        if ($item == '') {
            setcookie('error_msg', "You can't leave any fields blank", time() + 10, '/');
            exit();
        }
    }

    $query = $dbh->prepare("UPDATE users SET `name`=:name, `adress`=:adress,`postal_code`=:postal_code,`city`=:city,`birthday`=:bday,`email`=:email");
    $query->bindParam(':name', $_POST['name']);
    $query->bindParam(':adress', $_POST['address']);
    $query->bindParam(':postal_code', $_POST['pc']);
    $query->bindParam(':city', $_POST['city']);
    $query->bindParam(':bday', $_POST['DoB']);
    $query->bindParam(':email', $_POST['email']);
    $query->execute();

    exit();
} else if ()