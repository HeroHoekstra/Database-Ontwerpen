<?php
try {
    $user = "flower_power";
    $pass = "power_flower";

    $dbh = new PDO('mysql:host=localhost;dbname=flower_power', $user, $pass);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
