<?php
include "../connect.php";

$employees_add = [];

foreach ($user_data as $user) {
    foreach ($_GET as $user_id => $item) {
        array_push($employees_add, $user_id);
    }
}

if ($employees_add != []) {
    foreach ($employees_add as $item) {
        $query = $dbh->prepare("UPDATE `user` SET `employee` = 1 WHERE `user`.`user_id` = :user_id");
        $query->bindParam(':user_id', $item);
        $query->execute();
    }
}

$query = $dbh->query('SELECT user_id, employee FROM user');
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    if ($user['employee'] == 1 && !in_array($user['user_id'], $employees_add)) {
        $query = $dbh->prepare("UPDATE `user` SET `employee` = null WHERE `user`.`user_id` = :user_id");
        $query->bindParam(':user_id', $user['user_id']);
        $query->execute();
    }
}

header('Location: ../');
exit();