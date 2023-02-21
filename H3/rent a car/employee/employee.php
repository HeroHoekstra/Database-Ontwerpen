<?php
include "../connect.php";

$query = $dbh->query('SELECT * FROM user');
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="add_employee.php" method="get">
<?php
foreach ($result as $user) {
    $value = '';
    if ($user['employee'] == 1) {
        $value = 'checked';
    }
    echo "
        <div class='add_employee_table'>
            <p>" . $user['name'] . "</p>
            <p>" . $user['email'] . "</p>
            <p>employee status: <input type='checkbox' name='" . $user['user_id'] . "' value='on' $value></p>
        </div>
    ";
}
?>
    <br>
    <input type="submit" value="Add / Remove employee" name="">
</form>
<br><br>
<a href="../">Home</a>
</body>
</html>