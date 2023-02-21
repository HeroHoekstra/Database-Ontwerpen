<?php
include '../connect.php';

$query = $dbh->query('SELECT *FROM car');
$query->execute();
$cars = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $dbh->query('SELECT licence_plate FROM rent');
$query->execute();
$rented = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Rent</title>

        <link href="style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
    <form action="./rent.php" method="get">
        <?php
        $query = $dbh->query('SELECT COUNT(*) FROM car');
        $count = $query->fetchColumn();

        $query = $dbh->query('SELECT COUNT(*) FROM rent');
        $unavailable_count = $query->fetchColumn();

        if ($count > $unavailable_count) {
            foreach ($cars as $car) {
                $unavailable = '';
                foreach ($rented as $rent) {
                    if ($car['licence_plate'] == $rent['licence_plate']) {
                        $unavailable = $rent['licence_plate'];
                    }
                }

                if ($unavailable == '') {
                    $license = $car['licence_plate'];
                    echo "
                <div class='car'>
                    <input type='checkbox' name='" . $license . "' id='" . $license . "'>
                    <label for='" . $license . "'>
                        <div class='car_table'>
                            <p>License plate</p>
                            <p>Brand</p>
                            <p>Price per day</p>
                            <p>Type</p>
                        
                            <p>" . $license . "</p>
                            <p>" . $car['merk'] . "</p>
                            <p>€" . $car['price_per_day'] . "</p>
                            <p>" . $car['type'] . "</p>
                        </div>
                    </label>
                </div>
                <br>
                ";
                }
            }

            echo "
                Receive date<input type=\"date\" name=\"start\"><br>
                Return date<input type=\"date\" name=\"end\"><br>
                <input type=\"submit\" value=\"rent\">
            ";
        } else {
            echo "
                <p>We're sorry but we're all out of cars. Come back later</p> <br>
                <a href='../'>Return home</a>";
        }
        ?>
    </form>
    <br><br>
    <a href="../">Home</a>
    </body>
</html>
