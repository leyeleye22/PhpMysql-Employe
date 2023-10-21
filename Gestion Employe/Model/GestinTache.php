<?php
session_start();
include('../Controller/Function.php');
if (empty($_SESSION)) {
    header('location:../Model/First.php');
}
$error = [];
$leye = $_SESSION['user'];
$idUser = $leye[0]['id'];
$fall = ListerTache($idUser);
$_SESSION['tache'] = array();
$_SESSION['tache'] = $fall;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $_SESSION['stock'];
    if (isset($_POST['idBouton'])) {
        $_SESSION['stock'] = $_POST['idBouton'];
        header('location:../Model/Suppression.php');
    }
    // if (isset($_POST)) {
    //     $titre = $_POST['titre'];
    //     $priorite = $_POST['priorite'];
    //     $statut = $_POST['Statut'];
    //     $description = $_POST['description'];
    //     $date = $_POST['date'];

    //     AjoutTache($titre, $description, $date, $idUser, $priorite, $statut);
    // }

    if ($_POST['leye']) {
        $titre = htmlspecialchars($_POST['titre'], ENT_NOQUOTES, 'UTF-8');
        $priorite = $_POST['priorite'];
        $statut = $_POST['Statut'];
        $description = htmlspecialchars($_POST['description'], ENT_NOQUOTES, 'UTF-8');
        $date = $_POST['date'];
        if (empty($priorite)) {
            $error[] = "Le Champs priorité doit etre rempli";
        }
        if (empty($statut)) {
            $error[] = "Veuillez Remplier le Champs Priorités";
        }
        if (empty($description)) {
            $error[] = "Veuillez Donner Une description svp!!!!";
        }
        if (empty($date)) {
            $error[] = "Veuillez Donner Une date si c'est pas trop demander";
        }

        $dateActu = time();
        $dateN = strtotime($date);
        if ($dateN !== false) {
            if ($dateN < $dateActu) {
                $error[] = "la date d'echeance ne doit pas etre inferieur à aujourd'hui";
            }
        }
        if (strtotime($date) == false) {
            $error[] = "la date est incorrect";
        }

        if (count($error) == 0) {
            AjoutTache($titre, $description, $date, $idUser, $priorite, $statut);
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

        .lps {
            margin-left: 25%;
        }

        .error {
            color: red;
            /* Ajoutez d'autres styles CSS selon vos préférences */
        }

        .lop {
            margin-left: 19%;
        }

        .navbar {
            background-color: green;
            text-align: center;
            padding: 20px 0;
            display: flex;
            justify-content: space-around;
        }

        .navbar h3 {
            color: white;
            font-style: italic;
            font-size: 150%;
        }

        .task-container {
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 60%;
        }

        h1 {
            display: flex;
            justify-content: start;
            align-items: center;
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

        .task-container .inline-elements {
            display: flex;
            justify-content: start;
            align-items: center;
        }

        .task-container .inline-elements p {
            margin: 0px 20px 0px 0px;
        }

        .task-container button {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style du formulaire */
        .task-form {
            margin-top: 20px;
            text-align: left;
            width: 61%;
            margin-left: 19%;
        }

        .task-form label {
            font-size: 18px;
        }

        .task-form select,
        .task-form input[type="text"],
        .task-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .task-form input[type="submit"] {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .error-box {
            background-color: #fff;

            padding: 10px;

            box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);

            border: 1px solid #f00;

            border-radius: 5px;
            margin: 10px 0;

        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1 class="leye">Gestion de Vos Tâches </h1>
        <h2 class="leye">Welcome Employe N°<?php echo $leye[0]['id'] ?></h2>
        <h3><?php echo $leye[0]['nomUser'] ?></h3>
    </div>
    <?php
    echo ' <h1 class="lps">Aujourdhui vous Avez   :' . count($fall) . ' Tâche à accomplir </h1>';
    foreach ($fall as $key => $task) {
    ?>
        <form action="" method="POST">
            <div class="task-container">

                <h1 class="lp"><?php echo $task['nom']; ?></h1>
                <p><?php echo $task['descriptions']; ?></p>

                <input type="hidden" name="idBouton" value="<?= $key ?>">
                <div class="inline-elements">
                    <p>Priorité: <?php echo $task['priorite']; ?></p>
                    <p>Statut: <?php echo $task['etat']; ?></p>
                    <button>Voir les détails</button>
                </div>
            </div>
        </form>
    <?php
    }
    ?>

    <h1 class="lop">Ajouter une Nouvelle Tâche</h1>
    <div class="task-form">
        <?php if (count($error) != 0) : ?>

            <?php foreach ($error as $e) : ?>
                <div class="error-box">
                    <div class="error"><?php echo $e; ?></div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <form action="" method="POST">
            <label for="titre">Titre:</label>
            <input type="text" id="titre" name="titre">
            <label for="date">Date Echeance</label>
            <input type="date" id="date" name="date">
            <label for="priorite">Priorité:</label>
            <select id="priorite" name="priorite">
                <option value=""></option>
                <option value="elevee">Haute</option>
                <option value="moyenne">Moyenne</option>
                <option value="faible">Basse</option>
            </select>
            <label for="statut">Statut:</label>
            <select id="Statut" name="Statut">
                <option value=""></option>
                <option value="a_faire">A Faire</option>
                <option value="en_cours">En cours</option>
                <option value="terminee">Terminer</option>
            </select>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4"></textarea>
            <input type="submit" value="envoyer" name="leye">
        </form>
    </div>
</body>

</html>