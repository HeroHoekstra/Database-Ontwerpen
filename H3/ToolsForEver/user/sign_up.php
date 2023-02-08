<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
</head>
<body>
    <form action="response.php" method="post">
        Email: <input type="email" name="email"> <br>
        Name: <input type="text" name="name"> <br>
        Password: <input type="password" name="pass"> <br>
        <br>
        <input type="submit" value="Sign up" name="sign_up">
    </form>
    <a href="login.php">Already have an account?</a>
</body>
</html>