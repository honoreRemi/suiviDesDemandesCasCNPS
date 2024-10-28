<?php
session_start();

if (isset($_POST['Creer'])) {
    AjouterUser();
}

function AjouterUser()
{
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../../Models/databaseConnexion.php';

    // Vérifier si les champs requis existent
    if (
        isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['phone']) &&
        isset($_POST['dateCreation']) && isset($_POST['password']) && isset($_POST['conf_password']) && isset($_POST['nom_role'])
    ) {

        // Vérifier si les champs requis ne sont pas vides
        if (
            !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])  && !empty($_POST['phone']) &&
            !empty($_POST['dateCreation']) && !empty($_POST['password']) && !empty($_POST['conf_password']) && !empty($_POST['nom_role'])
        ) {

            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $phone = htmlspecialchars($_POST['phone']);
            $dateCreation = htmlspecialchars($_POST['dateCreation']);
            $password = htmlspecialchars($_POST['password']);
            $conf_password = htmlspecialchars($_POST['conf_password']);
            $role = htmlspecialchars($_POST['nom_role']);

            // Appliquer la fonction de hachage directement sur le mot de passe
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Vérifier le format de l'e-mail et du numéro de téléphone (exemple de validation)
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['message'] = "L'e-mail n'est pas valide.";
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            /* if (!empty($phone) && !preg_match("#^6[1-68][0-9]{7}$#", $phone)) {
                echo 'Veuillez renseigner un numéro de téléphone correct.';
                exit;
            }*/

            // Vérifier si les mots de passe correspondent
            if ($password !== $conf_password) {
                $_SESSION['message'] = 'Le mot de passe et la confirmation ne sont pas identiques.';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }

            // Vérifier si l'utilisateur existe déjà
            $emailRequest = $pdo->prepare("SELECT * FROM `utilisateur` WHERE email = ?");
            $emailRequest->execute([$email]);
            if ($emailRequest->rowCount() == 0) {

                
                // Insérer le rôle dans la table "role"
                $sqlRole = "INSERT INTO role (nom_role) VALUES (?)";
                $stmtRole = $pdo->prepare($sqlRole);
                $stmtRole->execute([$role]);
                $idRoleInsert = $pdo->lastInsertId();
             
                // Récupérer l'ID du rôle à partir de la table "role"
                $req = $pdo->prepare('SELECT id FROM role WHERE nom_role = ?');
                $req->execute([$role]);
                $roleData = $req->fetch(PDO::FETCH_ASSOC);

                if ($roleData) {
                    $idRoleInsert = $roleData['id'];

                    // Insérer un nouvel utilisateur dans la base de données
                    $req = $pdo->prepare('INSERT INTO utilisateur (id_role, nom, prenom, email, phone, dateCreation, password) VALUES (?, ?, ?, ?, ?, ?, ?)');
                    $req->execute([$idRoleInsert, $nom, $prenom, $email, $phone, $dateCreation, $hash]);

                    if ($req) { // Si la requête a été effectuée avec succès, on fait une redirection
                        header('Location: ../../views/admin/dashbord.view.admin.php');
                        exit();
                    } else {
                        $_SESSION['message'] = 'Une erreur est survenue lors de l\'ajout de l\'utilisateur.';
                        header('location:' . $_SERVER['HTTP_REFERER']);
                        exit();
                    }
                } else {
                    $_SESSION['message'] = 'Le rôle sélectionné n\'existe pas.';
                    header('location:' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            } else {
                $_SESSION['message'] = 'Cet utilisateur existe déjà.';
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            $_SESSION['message'] = 'Veuillez remplir tous les champs obligatoires.';
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['message'] = 'Tous les champs requis doivent être présents.';
        header('location:' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
