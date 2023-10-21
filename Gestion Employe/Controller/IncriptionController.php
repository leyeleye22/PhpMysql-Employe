<?php
include ('Function.php');
if (!empty($_POST)) {
    $nomUser = htmlspecialchars($_POST['nomUser'], ENT_QUOTES, 'UTF-8');
    $email = $_POST['email'];
    $passw = $_POST['motdepasse'];
    $confPAs = $_POST['confirmationMotdepasse'];
    $pattern = '/\d/';
    preg_match_all($pattern, $nomUser, $matches);
    if ((count($matches[0]) == 0) && (strlen($nomUser) >= 2)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (strlen($passw) >= 8 && $passw == $confPAs) {
                $password = md5($passw);
                User($nomUser, $email, $password);
            }
        }
    }
}
