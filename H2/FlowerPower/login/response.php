<?php
include "../connect.php";

setcookie('error_msg', '', time() + 10);

//hash the pass
$hash_pass = hash('sha256', $_POST['pass']);

if (isset($_POST['SignUp'])) {
    //Return if the user forgets to fill in all field
    foreach ($_POST as $item) {
        if ($item == "") {
            header("Location: ./sign_up.php");
            setcookie('error_msg', 'Looks like you forgot some important data', time() + 10);
            exit();
        }
    }

    //Give a random users ID and check if it isn't already in use
    $userID = rand();
    $unique = false;
    while (!$unique) {
        $stmt = $dbh->prepare("SELECT count(userID) FROM users WHERE userID = :variable");
        $stmt->bindParam(':variable', $userID);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $unique = true;
        }
    }

    //Check if the email is unique
    $unique_mail = $dbh->prepare("SELECT count(email) FROM users WHERE email = :email");
    $unique_mail->bindParam(':email', $_POST['email']);
    $unique_mail->execute();
    $count = $unique_mail->fetchColumn();

    if ($count != 0) {
        header('Location: ./sign_up');
        setcookie('error_msg', 'That email already exists', time() + 10);
        exit();
    }

    //Make entry in the database
    $insert = $dbh->prepare("INSERT INTO users (name, pass, email, adress, postal_code, city, birthday, userID) VALUES (:name, :pass, :email, :address, :postal_code, :city, :birthday, :userID)");

    $insert->bindParam(':name', $_POST['name']);
    $insert->bindParam(':pass', $hash_pass);
    $insert->bindParam(':email', $_POST['email']);
    $insert->bindParam(':address', $_POST['adress']);
    $insert->bindParam(':postal_code', $_POST['pc']);
    $insert->bindParam(':city', $_POST['city']);
    $insert->bindParam(':birthday', $_POST['DoB']);
    $insert->bindParam(':userID', $userID);

    $insert->execute();
    header('Location: ./login.php');
} else if (isset($_POST['Login'])) {
    //Check if the user has filled in all fields
    foreach ($_POST as $item) {
        if ($item = "") {
            header('Location: ./login.php');
            setcookie('error_msg', 'Looks like you forgot some important data', time() + 10);
            exit();
        }
    }

    //Check if the email and password are correct
    $query = $dbh->prepare("SELECT pass FROM users WHERE email = :email");
    $query->bindParam(':email', $_POST['email']);
    $query->execute();
    $pass = $query->fetchColumn();

    if ($hash_pass == $pass) {
        header('Location: ../');
        setcookie('logged_in', true, time() + (3600 * 72), '/');

        //user ID as cookie
        $user_query = $dbh->prepare("SELECT userID FROM users WHERE email = :email");
        $user_query->bindParam(':email', $_POST['email']);
        $user_query->execute();
        $id = $user_query->fetchColumn();

        setcookie('userID', $id, time() + (3600 * 72), '/');
    } else {
        header('Location: ./login.php');
        setcookie('error_msg', 'Incorrect email or password', time() + 10);
    }
} else {
    setcookie('logged_in', false, time() - 3600, '/');
    header('Location: ../');
}
exit();
