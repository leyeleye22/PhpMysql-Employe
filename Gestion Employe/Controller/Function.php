<?php
include('Database.php');
function User($nom, $email, $motdepasse)
{
    global $conn;

    $query = "INSERT INTO users(nomUser, email, motdepasse) VALUES (:nom, :email, :motdepasse)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':motdepasse', $motdepasse);



    if ($stmt->execute()) {
        header("Location:../Model/First.php");
    } else {
        return "Donne non iserr";
    }
}
function verifUser($email)
{
    global $conn;

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':email', $email);

    if ($stmt->execute()) {
        return $stmt->fetchAll();
    } else {
        return false;
    }
}
function AjoutTache($nom, $description, $date_echeance, $idUser, $priorite, $etat)
{
    global $conn;
    $query = "INSERT INTO taches(nom, descriptions, date_echeance,idUser, priorite, etat) VALUES (:nom, :descriptions, :date_echeance,:idUser, :priorite, :etat)";


    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':descriptions', $description);
    $stmt->bindParam(':date_echeance', $date_echeance);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->bindParam(':priorite', $priorite);
    $stmt->bindParam(':etat', $etat);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function ListerTache($idUser)
{
    global $conn;
    $query =  "SELECT * FROM taches WHERE idUser = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $idUser);
    if ($stmt->execute()) {
        return $stmt->fetchAll();
    } else {
        return false;
    }
}
function FiNTache($nom)
{
    global $conn;
    $query = "UPDATE taches SET etat = 'terminee' WHERE nom=:nomT";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nomT', $nom);
    if ($stmt->execute()) {
        header('location:../Model/GestinTache.php');
    } else {
        return false;
    }
}
function SupprimeTache($nom)
{
    global $conn;
    $query = "DELETE FROM taches  WHERE nom=:nomT";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':nomT', $nom);
    if ($stmt->execute()) {
        header('location:../Model/GestinTache.php');
    } else {
        return false;
    }
}
function ForgetPassword($email, $password)
{
    global $conn;

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':email', $email);

    if ($stmt->execute()) {
        $let = $stmt->fetchAll();

        if (!empty($let)) { 
            $userId = $let[0]['id']; 

            $quer = "UPDATE users SET motdepasse = :motpasse WHERE id = :idU";
            $stmtt = $conn->prepare($quer);
            $stmtt->bindValue(':motpasse', $password);
            $stmtt->bindValue(':idU', $userId); 
            if ($stmtt->execute()) {
                header('location:../Model/First.php');
            } else {
                echo "Error";
            }
        } else {
            echo "Aucun utilisateur avec cet e-mail trouvé.";
        }
    } else {
        return false;
    }
}
