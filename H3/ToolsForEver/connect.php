<?php
try {
    $user = "tools_for_ever";
    $pass = "super_epische_gangster_tools";

    $dbh = new PDO('mysql:host=localhost;dbname=toolsforever', $user, $pass);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}