<?php
include '../connect.php';

$query = $dbh->query('SELECT * FROM rent');
$query->execute();
$cars = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cars</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
foreach ($cars as $car) {
    echo "
       <div class='cars'>
           <p>Car</p>
           <p>Rent ID</p>
           <p>Needs to be ready at</p>
           <p>Need to be returned at</p>
       
           <p>" . $car['licence_plate'] . "</p>
           <p>" . $car['rent_id'] . "</p>
           <p>" . $car['reserve_day'] . "</p>
           <p>" . $car['reserve_end'] . "</p>
       </div>
       <br>
       ";
}
?>

<a href="../">Home</a>
</body>
</html>