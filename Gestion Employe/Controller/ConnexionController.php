<?php
include('Function.php');
session_start();
$_SESSION['user'] = array();
if (empty($_SESSION)) {
    header('location:../Model/First.php');
}
if (isset($_POST['connect'])) {
    $email = $_POST['email'];
    $pas = $_POST['motpasse'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $users = verifUser($email);
        if ($users && md5($pas) === $users[0]['motdepasse']) {
            $_SESSION['user'] = $users;
            echo "leye";
            header('location:../Model/GestinTache.php');
        }
    }
}
