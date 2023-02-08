<?php
include "connect.php";

if (isset($_GET['submit'])) {
    try {
        $location = $_GET['location'];
        $tool = $_GET['tool'];

        $sql = "SELECT location.naam AS location, product.naam AS product_name, product.type, product.fabriek, location_product.aantal, location_product.verkoopprijs
FROM location
JOIN location_product ON location.naam = location_product.location_naam
JOIN product ON product.product_id = location_product.product_product_id
WHERE location.naam = :location AND product.naam = :tool";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':tool', $tool);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            $product_info = [];

            foreach ($result as $row) {
                array_push($product_info, $row['location'], $row["product_name"], $row["type"], $row["fabriek"], $row["aantal"], $row["verkoopprijs"]);
            }

            $serialize_product = serialize($product_info);
            setcookie('product', $serialize_product, time() + 10, '/');
        } else {
            $product_info = [];
            $serialize_product = serialize($product_info);
            setcookie('product', $serialize_product, time() + 10, '/');
        }

        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        header('Location: index.php');
        echo "Something went wrong";
    }
}
else {
    setcookie('logged_in', null, time() - 3600, '/');
    header('Location: index.php');
}

exit();