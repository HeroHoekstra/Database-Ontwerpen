<?php
include 'connect.php';

if (isset($user_data)) {
    $name = '';
    foreach ($user_data as $item) {
        $name = $item['name'];
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rent A Car</title>
</head>

<body>
    <p style="font-size: xx-small">I am not feeling like CSS so imagine it</p>
    <?php
    try {
        if (!isset($_COOKIE['logged_in']) || $_COOKIE['logged_in'] == null) {
            echo "
                <a href='user/sign_up.php'>Sign up</a> <br>
                <a href='user/login.php'>Login</a> <br>";
        } else {
    ?>
        <a href="user/settings">Settings</a>
        <a href="user/response.php">Log out</a>
        <a href="rent">Rent</a>
    <?php
            echo "<p>Welcome " . $name . "</p>";
        }

        if (isset($user_data) && $user_data[0]['employee'] == 1) {
            echo "
                <div>
                    <a href='employee/employee.php'>Add employees</a>
                    <a href='employee/cars.php'>See rented cars</a>
                </div>
            ";
        }
    } catch (PDOException $e) {
        echo "Something went wrong. Please reload the page";
    }
    ?>
</body>
</html>
