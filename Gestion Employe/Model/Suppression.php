<?php
session_start();
$leye = $_SESSION['tache'];
$_SESSION['id'] = $_SESSION['stock'];
$l = $_SESSION['id'];
$f = $_SESSION['user'];
$_SESSION['nomV'] = $leye[$l]['nom'];
$lop = $_SESSION['nomV'];
include('../Controller/Function.php');
if (empty($_SESSION)) {
    header('location:../Model/First.php');
}



if (isset($_POST['fin'])) {
    foreach ($leye[0] as $key => $value) {
        if ($key === "nom" && $value === $lop) {
            FiNTache($value);
        }
    }
 
}
if (isset($_POST['sup'])) {
    foreach ($leye[0] as $key => $value) {
        if ($key === "nom" && $value === $lop) {
            SupprimeTache($value);
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Gestion de Mes Tâches</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }



        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            /* Ajoutez d'autres styles au besoin, par exemple, pour la couleur de fond ou le texte. */
        }

        .lop {
            margin-left: 19%;
        }

        .return {
            margin-left: 40%;
        }

        .navbar {
            background-color: green;
            text-align: center;
            padding: 20px 0;
        }

        .task-container {
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 60%;
        }

        .leye {
            color: white;
        }

        .task-container h1 {
            font-size: 24px;
        }

        .task-container p {
            font-size: 16px;
        }


        .task-container button {

            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .fall {
            background-color: green;
        }

        .red {
            margin-left: 25%;
            background-color: red;
        }

        /* Style du formulaire */
    </style>
</head>

<body>
    <div class="navbar">
        <h1 class="leye">Gestion de Mes Tâches</h1>
        <h3><?php echo $f[0]['nomUser'] ?></h3>
    </div>

    <form action="" method="POST">
        <div class="task-container">
            <h1 class="lp"><?php $lop = $leye[$l]['nom'];
                            echo $leye[$l]['nom']; ?></h1>
            <p>Priorité: <?php echo $leye[$l]['priorite']; ?></p>
            <p>Statut: <?php echo $leye[$l]['etat']; ?></p>
            <p><?php echo $leye[$l]['descriptions']; ?></p>
            <div class="inline-elements">
                <button class="fall" name="fin">Marquer Comme Terminer</button> <button class="red" name="sup">Supprimer tache</button>
            </div>
        </div>
    </form>
    <a href="" class="return"> Retourner à la liste des tâche</a>

</body>

</html>