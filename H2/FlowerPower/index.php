<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Flower Power</title>

        <link href="../img/tyfus%20bloem.png" rel="icon">
    </head>

    <body>
        <div class="header">
            <div id="headerText">
                <p>Welcome to Flower Power</p>
            </div>
        </div>

        <div class="login">
            <?php if (!isset($_COOKIE['logged_in'])) {?>
            <a href="login/sign_up.php">Sign up</a>
            <a href="./login/login.php">Login</a>
            <?php } else { ?>
                <a href="./login/response.php">Log out</a>
                <a href="./user">Settings</a>
            <?php }?>
        </div>
    </body>
</html>