<?php
session_start();

// Récupérer la connexion à la base de données
require dirname(__DIR__) . '../../Models/databaseConnexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['create_request'])){

    // Vérifier si les champs requis existent
    if (
        isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['établissement']) && isset($_POST['filière']) &&
        isset($_POST['typeStage']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['dateDebut']) &&
        isset($_POST['dateFin']) && isset($_POST['durée']) && isset($_POST['password']) && isset($_POST['conf_password'])
    )
    {
        if (
            !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['établissement']) &&
            !empty($_POST['filière']) && !empty($_POST['typeStage']) && !empty($_POST['email']) &&
            !empty($_POST['phone']) && !empty($_POST['dateDebut']) && !empty($_POST['dateFin']) &&
            !empty($_POST['durée']) && !empty($_POST['password']) && !empty($_POST['conf_password'])
        )
        {
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

            require_once 'register.ctrl.demandeur1.php';

            if(emptyInputSignup($nom, $prenom, $school, $filiere, $stageVoulu, $Email,
                    $number, $dateDebut, $dateFin, $durée, $password, $conf_password) !== false){
                header('Location: ../../..Views/demandeur/Register.php?error=emptyInput');
                exit();
            }

            
            if(invalidNom($nom) !== false){
                header('Location: ../../..Views/demandeur/Register.php?error=invalidNom');
                exit();
            }

            if(invalidPrenom($prenom) !== false){
                header('Location: ../../..Views/demandeur/Register.php?error=invalidPrenom');
                exit();
            }
            
            if(invalidEmail($Email) !== false){
                header('Location: ../../..Views/demandeur/Register.php?error=invalidEmail');
                exit();
            }

            // if(PasswordMatch($password, $conf_password) !== false){
            //     header('Location: ../../..Views/demandeur/Register.php?error=passwordsdontmatch');
            //     exit();
            // }
            
            if(userExists($pdo, $nom, $Email) !== false){
                header('Location: ../../..Views/demandeur/Register.php?error=usernametaken');
                exit();
            }

            createUser($pdo, $nom, $prenom, $school, $filiere, $stageVoulu, $Email, 
                    $number, $dateDebut, $dateFin, $durée, $hash);

            // Vérifier le format de l'e-mail (exemple de validation)
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                echo "L'e-mail n'est pas valide.";
                exit();
            }

        }else{
            header('Location: ../../..Views/demandeur/Register.php');
            echo 'veillez remplir les champs';
            exit();
        }
    }else{
        header('Location: ../../..Views/demandeur/Register.php');
        exit();
    }
 }
}