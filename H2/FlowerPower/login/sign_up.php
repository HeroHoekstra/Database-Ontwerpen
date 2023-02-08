<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sign Up</title>
    </head>

    <body>
        <?php
        if (isset($_COOKIE['error_msg'])) {
            echo "<p>" . $_COOKIE['error_msg'] . "</p>";
        }
        ?>

        <form action="response.php" method="post">
            Name: <input type="text" name="name"> <br>
            Password: <input type="password" name="pass"> <br>
            Email: <input type="text" name="email"> <br>
            Adress: <input type="text" name="adress"> <br>
            Postal Code: <input type="text" name="pc"> <br>
            City: <input type="text" name="city"> <br>
            Date of Birth: <input type="date" name="DoB"> <br>

            <input type="submit" name="SignUp" value="Sign Up">
        </form>

        <a href="login.php">Already have an account?</a>
        <a href="../index.php">Home</a>
    </body>
</html>
