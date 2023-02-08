<?php
include '../connect.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Settings</title>

        <link href="../img/settings.svg" rel="icon">
    </head>

    <body>
        <?php
        if (isset($_COOKIE['error_msg'])) {
            echo "<p>" . $_COOKIE['error_msg'] . "</p>";
        }

        echo "<p>User ID: " . $_COOKIE['userID'] . "</p>";

        //Get user data
        $stmt = $dbh->prepare("SELECT * FROM users WHERE userID = '" . $_COOKIE['userID'] . "'");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = $results[0];

        echo "
        <form action='update.php' method='post'>
            Name: <input type='text' name='name' value='" . $result['name'] . "'> <br>
            Email: <input type='text' name='email' value='" . $result['email'] . "'> <br>
            Address: <input type='text' name='address' value='" . $result['adress'] . "'> <br>
            Postal code: <input type='text' name='pc' value='" . $result['postal_code'] . "'> <br>
            City: <input type='text' name='city' value='" . $result['city'] . "'> <br>
            Date of birth: <input type='date' name='DoB' value='" . $result['birthday'] . "'> <br>
            
            <input type='submit' name='update' value='update'>
        </form>
        "
        ?>
    </body>
</html>
