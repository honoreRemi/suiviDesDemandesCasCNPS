<?php
session_start();

if (isset($_POST['Creer'])) {
    Decision();
}

function Decision()
{
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../../../Models/databaseConnexion.php';

    // Vérifier si les champs requis existent
    if (
        isset($_POST['decision']) && isset($_POST['dateJ']) 
    ) {

        // Vérifier si les champs requis ne sont pas vides
        if (
            !empty($_POST['nom'])
        ) {

            $nom = htmlspecialchars($_POST['decision']);
            $prenom = htmlspecialchars($_POST['dateJ']);

         

            if (!empty($phone) && !preg_match("#^[0-9]+$#", $phone)) {
                echo 'Veuillez renseigner un numéro de téléphone correct.';
                exit;
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
