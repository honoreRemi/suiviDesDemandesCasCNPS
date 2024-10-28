<?php

session_start();

if (isset($_POST['create_request'])) {
    create();
}

function create()
{
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../../Models/databaseConnexion.php';

    // Vérifier si les champs requis existent
    if (
        isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['établissement']) && isset($_POST['filière']) &&
        isset($_POST['typeStage']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['dateDebut']) &&
        isset($_POST['dateFin']) && isset($_POST['durée']) && isset($_POST['password']) && isset($_POST['conf_password'])
    ) {

        // Vérifier si les champs ne sont pas vides
        if (
            !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['établissement']) &&
            !empty($_POST['filière']) && !empty($_POST['typeStage']) && !empty($_POST['email']) &&
            !empty($_POST['phone']) && !empty($_POST['dateDebut']) && !empty($_POST['dateFin']) &&
            !empty($_POST['durée']) && !empty($_POST['password']) && !empty($_POST['conf_password'])
        ) {
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $school = htmlspecialchars($_POST['établissement']);
            $filiere = htmlspecialchars($_POST['filière']);
            $stageVoulu = htmlspecialchars($_POST['typeStage']);
            $Email = htmlspecialchars($_POST['email']);
            $number = htmlspecialchars($_POST['phone']);
            $dateDebut = htmlspecialchars($_POST['dateDebut']);
            $dateFin = htmlspecialchars($_POST['dateFin']);
            $durée = htmlspecialchars($_POST['durée']);
            $password = htmlspecialchars($_POST['password']);
            $conf_password = htmlspecialchars($_POST['conf_password']);

            // Appliquer la fonction de hachage directement sur le mot de passe
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Vérifier le format de l'e-mail (exemple de validation)
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['message'] = 'L\'email n\'est pas valide.';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            
            // Vérifier si les mots de passe correspondent
            if ($password != $conf_password) {
                $_SESSION['message'] = 'Les mots de passe ne correspondent pas.';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            $emailRequest = $pdo->prepare("SELECT * FROM `demandeur` WHERE email = ?");
            $emailRequest->execute([$Email]);

            $passwordRequest = $pdo->prepare("SELECT * FROM `demandeur` WHERE password = ?");
            $passwordRequest->execute([$hash]);

            if ($emailRequest->rowCount() == 0 && $passwordRequest->rowCount() == 0) {
                $req = $pdo->prepare('INSERT INTO demandeur (nom, prenom, établissement, filière, typeStage, email, phone, dateDebut, dateFin, durée, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $req->execute(array($nom, $prenom, $school, $filiere, $stageVoulu, $Email, $number, $dateDebut, $dateFin, $durée, $hash));

                if ($req) {
                    // Redirection après une demande réussie
                    header('Location: ../../../index.php');
                    exit();
                } else {
                    $_SESSION['message'] = 'Une erreur est survenue !';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            } else {
                $_SESSION['message'] = 'Une demande a déjà été enregistrée avec cette adresse e-mail !';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

           
        } else {
            $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['message'] = 'Les champs requis n\'existent pas.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}