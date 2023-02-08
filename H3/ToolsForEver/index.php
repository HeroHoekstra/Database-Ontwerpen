<?php
include "connect.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tools For Ever</title>

    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div id="content">
        <?php
        if (!isset($_COOKIE['logged_in'])) {
            echo "
            <a href='user/sign_up'>Sign up</a>
            <a href='user/login.php'>Log in</a>
            ";
        } else {
        ?>
            <div class="main">
                <?php
                $query = $dbh->query("SELECT name FROM user WHERE email = '" . $_COOKIE['logged_in'] . "'");
                $query->execute();
                $result = $query->fetch();
                $name = $result['name'];

                echo "<p id='name'>Name: " . $name . "</p>"
                ?>
                <h1 style="margin: 0;">Tools For Ever stock</h1>
                <p>Choose a product</p>
                <div class="product_select">
                    <form action="fetch%20tool.php" method="get">
                        <select name="location">
                            <option name="null">---</option>
                            <option value="Rotterdam">Rotterdam</option>
                            <option value="Almere">Almere</option>
                            <option value="Eindhoven">Eindhoven</option>
                        </select>
                        <select name="tool">
                            <option name="null">---</option>
                            <option name="Accuboorhamer">Accuboorhamer</option>
                            <option name="schuurmachine">4-in-1 schuurmachine</option>
                            <option name="Verstekzaag">Verstekzaag</option>
                            <option name="Alleszuiger">Alleszuiger</option>
                            <option name="Accuboormachine">Accuboormachine</option>
                            <option name="33-delige borenset">33-delige borenset</option>
                            <option name="Workmate">Workmate</option>
                            <option name="Kruislijnlaserset">Kruislijnlaserset</option>
                        </select>

                        <br>

                        <input type="submit" value="Submit" name="submit">
                        <input type="submit" value="Log out" name="log_out">
                    </form>
                </div>

                <br>

                <div>
                    <div class="product">
                        <p>Location</p> <p>Product</p> <p>Type</p> <p>Factory</p> <p>In stock</p> <p>Sell price</p>
                        <?php
                        if (isset($_COOKIE['product'])) {
                            $product_info = unserialize($_COOKIE['product']);
                            foreach ($product_info as $item) {
                                echo "<p>" . $item . "</p>";
                            }
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($product_info[0])) {
                        echo "<p>Location: " . $product_info[0] . "</p>";
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
