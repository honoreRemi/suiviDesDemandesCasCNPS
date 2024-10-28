<?php
session_start();
ob_start();


if (isset($_POST['login'])) {

    demandeurlogin();
}

function demandeurlogin()
{
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../Models/databaseConnexion.php';

    // Vérifier si les champs requis existent
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $Email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            // echo("email". $Email."password". $password );exit;
            // Requête pour le demandeur
            $demandeurRequest = $pdo->prepare("SELECT * FROM `demandeur` WHERE email = ?");
            $demandeurRequest->execute([$Email]);
            $demandeur = $demandeurRequest->fetch(PDO::FETCH_ASSOC);

            if ($demandeur && password_verify($password, $demandeur['password'])) {
                $_SESSION['demandeur_id'] = $demandeur['id']; // on stocke les informations du demandeur
                // Connexion réussie pour le demandeur, rediriger vers la page appropriée
                header('Location: ../views/demandeur/navbar.demandeur.view.php');
                exit();
            }
        } else {
            $_SESSION['message'] = 'une erreur est survenue!!!'; //we warm the user.
            header('location:' . $_SERVER['HTTP_REFERER']); //back to the previous page
        }
    } else {
        $_SESSION['message'] = 'une erreur est survenue!!!'; //we warm the user.
        header('location:' . $_SERVER['HTTP_REFERER']); //back to the previous page
    }
}

if (isset($_POST['login'])) {
  loginAdmin();
}

function loginAdmin()
{
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../Models/databaseConnexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier si les champs requis existent
        if (isset($_POST['email']) && isset($_POST['password'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $Email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                // Requête pour l'administrateur
                $adminRequest = $pdo->prepare("SELECT * FROM `administrateur` WHERE email = ?");
                $adminRequest->execute([$Email]);
                $admin = $adminRequest->fetch(PDO::FETCH_ASSOC);

                if ($admin && password_verify($password, $admin['password'])) {
                    // Connexion réussie pour l'administrateur, rediriger vers la page appropriée
                    $_SESSION['id'] = $admin['id']; // Stocker l'ID de l'administrateur dans la session
                    header('Location: ../Views/admin/dashbord.view.admin.php');
                    exit();
                } else {
                    // Authentification échouée, afficher un message d'erreur
                    $_SESSION['message'] = 'Identifiants invalides.';
                    header('location:' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            } else {
                $_SESSION['message'] = 'une erreur est survenue!!!';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            $_SESSION['message'] = 'une erreur est survenue!!!';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['message'] = 'une erreur est survenue!!!';
        header('location:' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

if (isset($_POST['login'])) {
        loginUtilisateur();
}

function loginUtilisateur()
{
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../Models/databaseConnexion.php';

    // Vérifier si les champs requis existent
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            // Requête avec jointure pour récupérer les informations de l'utilisateur et de son rôle
            $sql = "
                    SELECT 
                    u.email,
                    u.password,
                    r.nom_role
                    FROM utilisateur u
                    JOIN role r ON u.id_role = r.id
                    WHERE u.email = :email
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier les informations de connexion
            if ($user && password_verify($password, $user['password'])) {

                // Connexion réussie, démarrer la session et rediriger l'utilisateur en fonction de son rôle
                $_SESSION['role'] = $user['nom_role']; //on affecte à la variable session le nom_role recupéré dans la table rle 
                //var_dump( $_SESSION['role']);die;
                switch ($_SESSION['role']) {
                    case 'DG':
                        header('Location: ../Views/DG/dashboard.view.DG.php');
                        break;
                    case 'DRH':
                        header('Location: ../Views/DRH/dashboard.DRH.view.php');
                        break;
                    case 'DSI':
                        header('Location: ../Views/DSI/dashboard.view.DSI.php');
                        break;
                    case 'SFR':
                        header('Location: ../Views/SFR/dashboard.view.SFR.php');
                        break;

                    default:
                        // Rediriger vers une page d'erreur ou afficher un message
                        $_SESSION['message'] = 'Rôle non reconnu.';
                        header('location:' . $_SERVER['HTTP_REFERER']);
                        exit();
                }
                exit();
            } else {
                // Informations de connexion invalides
                $_SESSION['message'] = 'Identifiants invalides.';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            $_SESSION['message'] = 'Une erreur est survenue !';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['message'] = 'Une erreur est survenue !';
        header('location:' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

if (isset($_POST['Déconnexion'])) {
    logout();
}

function logout()
{
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../Models/databaseConnexion.php';


    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['id'])) {
        // Supprimer toutes les variables de session
        $_SESSION = array();

        // Détruire la session
        session_destroy();
        // Rediriger vers la page de connexion ou afficher un message d'erreur
        header('Location: ../../index.php');
        exit();
    }

    // Vérifier le rôle ou l'autorisation de l'utilisateur
    if ($_SESSION['role'] !== 'administrateur') {
        // Rediriger vers une page d'erreur ou une autre page appropriée
        header('Location: ../../index.php');
        exit();
    }
}
