<?php
include '../../connect.php';

$user_id = (string) $_COOKIE['logged_in'];

$query = $dbh->prepare("SELECT user_id, name, pass FROM user WHERE user_id = ?");
$query->bindValue(1, $user_id);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $item) {
    if ($_POST['pass'] != '12345678' && $_POST['pass'] == $_POST['pass2']) {
        //hash the pass
        $options = [
            'cost' => 12,
        ];
        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT, $options);
        $stmt = $dbh->prepare("UPDATE `user` SET `pass` = :pass WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
    }

    if ($_POST['email'] != '' || $_POST['name'] != '') {
        $stmt = $dbh->prepare("UPDATE `user` SET `email` = :email, `name` = :name WHERE user_id = :user_id");
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
}

header('Location: index.php');
exit();