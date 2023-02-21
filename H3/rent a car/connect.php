<?php
try {
    $user = "rent_a_car";
    $pass = "VroemVroem";

    $dbh = new PDO('mysql:host=localhost;dbname=rent_a_car', $user, $pass);

    //get all user data
    if (isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] != null) {
        $query = $dbh->prepare('SELECT * FROM user WHERE user_id = :id');
        $query->bindParam('id', $_COOKIE['logged_in']);
        $query->execute();

        $user_data = $query->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}