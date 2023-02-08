<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
    </head>

    <body>
        <?php
        if (isset($_COOKIE['error_msg'])) {
            echo "<p>" . $_COOKIE['error_msg'] . "</p>";
        }
        ?>

        <form action="response.php" method="post">
            Email: <input type="text" name="email"> <br>
            Password: <input type="password" name="pass"> <br>

            <input type="submit" name="Login" value="Login">
        </form>

        <a href="./sign_up.php">Don't have an account</a>
        <a href="../index.php">Home</a>
    </body>
</html>
