<?php
session_start();
include('../Controller/Function.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST)) {
        $email = $_POST['email'];
        $passw = $_POST['motdepasse'];
        $passwver = $_POST['confirmationMotdepasse'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($passw === $passwver) {
                $leye = md5($passw);


                ForgetPassword($email, $leye);
            } else {
                echo "erreur";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;

        }

        input {
            width: 60%;
        }

        .navbar {
            background-color: green;
            text-align: center;
            padding: 20px 0;
        }

        .navbar h1 {
            color: white;
            margin: 0;
            font-size: 24px;
        }

        .container {

            justify-content: center;
            margin: 20px;
            width: 50%;
            margin-left: 25%;

        }

        .form-container {
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 45%;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 60%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: darkgreen;
        }

        .login-form {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>Mot de passe oublié</h1>
    </div>
    <div class="container">

    </div>

    <div class="form-container">
        <h2>Reinitialiser votre mot de passe</h2>
        <form action="" method="POST">
            <div>
                <label for="email">Email :</label> <br>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="motdepasse">Mot de passe :</label> <br>
                <input type="password" id="motdepasse" name="motdepasse">
            </div>
            <div>
                <label for="confirmationMotdepasse">Confirmation Mot de passe :</label> <br>
                <input type="password" id="confirmationMotdepasse" name="confirmationMotdepasse">
            </div>
            <button type="submit">Mise A Jour</button> <br> <br>

        </form>
    </div>
    </div>
</body>

</html>