<?php
include "../connect.php";

foreach ($_GET as $item) {
    if ($item == '') {
        header('Location: ./');
    }
}

$query = $dbh->prepare('SELECT * FROM car');
$query->execute();
$cars = $query->fetchAll(PDO::FETCH_ASSOC);


$user_id = $_COOKIE['logged_in'];
$start_date = $_GET['start'];
$return_date = $_GET['end'];
$total = 0;
$rent_id = "RENT-" . uniqid();

$rented_cars = [];
$rented_cars_all = [];
foreach ($cars as $car) {
    foreach ($_GET as $item => $value) {
        if ($item == $car['licence_plate']) {
            $total += $car['price_per_day'];
            $rented_cars[] = [
                'user_id' => $user_id,
                'licence_plate' => $item,
                'reserve_day' => $start_date,
                'return_day' => $return_date,
                'price' => $car['price_per_day'],
                'rent_id' => $rent_id,
            ];

            $rented_cars_all[] = [
                'rented_cars' => $rented_cars,
                'brand' => $car['merk'],
                'type' => $car['type']
            ];
        }
    }
}

// Then, insert all rented cars into the database in a single query
$query = $dbh->prepare('INSERT INTO `rent` (`user_id`, `licence_plate`, `reserve_day`, `reserve_end`, `total`, `price`, `rent_id`) VALUES (:user_id, :licence_plate, :reserve_day, :return_day, :total, :price, :rent_id)');

foreach ($rented_cars as $rented_car) {
    $rented_car['total'] = $total;
    $query->execute($rented_car);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank you for your order!</title>

    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="content">
    <img src="ccl.jpg" style="width: 50px">

    <?php
    $start = new DateTime($_GET['start']);
    $end = new DateTime($_GET['end']);
    $interval = $start->diff($end);

    echo "<p>" . $user_data[0]['name'] . "<br>" . $user_data[0]['email'] . "<br><br></p>";

    echo "<p>Thank you for renting a car at rent a car for " . $interval->format('%a day(s)') . "</p>";
    ?>

    <p>Your order includes:</p>

    <div class="rented_cars_table">
        <p>Licence plate</p>
        <p>Type</p>
        <p>Brand</p>
        <p>Amount of days</p>
        <p>Price per day</p>
        <p>Total price per car</p>
        <?php
        $total = 0;
        foreach ($rented_cars_all as $value => $car) {
            echo "
                <p>" . $car['rented_cars'][$value]['licence_plate'] . "</p>
                <p>" . $car['type'] . "</p>
                <p>" . $car['brand'] . "</p>
                <p>" . $interval->format('%a day(s)') . "</p>
                <p>" . $car['rented_cars'][$value]['price'] . "</p>
                <p>" . $car['rented_cars'][$value]['price'] * $interval->format('%a') . "</p>
            ";
            $total += $car['rented_cars'][$value]['price'] * $interval->format('%a');
        }

        echo "<p>Total: €" . $total . "</p>";
        ?>
    </div>

    <?php
    echo "<p>Thank you again for your order, the car(s) will be ready on location from 10AM to 8PM on " . $rented_cars[0]['reserve_day'] . " and are expected to be returned on " . $rented_cars[0]['return_day'] . " between 10AM and 8PM <br>
        The invoice will be send to your email adress in 2 - 3 business days</p>";
    ?>
</div>
<br><br>
<a href="../">Home</a>
</body>
</html>
