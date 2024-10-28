<?php
session_start();

if (isset($_POST['envoyer'])) {
    redigerDemande();
}

function redigerDemande()
{
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../../Models/databaseConnexion.php';

    if (
        isset($_POST['titre'], $_POST['description'], $_POST['motivation'], $_FILES['image'], $_FILES['cv']) &&
        !empty($_POST['titre']) && !empty($_POST['description']) && 
        !empty($_FILES['image']['name']) && !empty($_FILES['cv']['name']) && 
        !empty($_POST['motivation'])
    ) {
        $titre = htmlspecialchars($_POST['titre']);
        $motivation = htmlspecialchars($_POST['motivation']);
        $description = htmlspecialchars($_POST['description']);

        // Traitement de l'image
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];

        // Vérification du type de fichier
        $allowed_extensions = ["image/jpeg", "image/jpg", "image/png"];
        if (!in_array($image_type, $allowed_extensions)) {
            $_SESSION['message'] = 'Erreur : Seules les images JPEG, JPG et PNG sont autorisées.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Vérification de la taille du fichier (10 Mo maximum)
        if ($image_size > 10 * 1024 * 1024) {
            $_SESSION['message'] = 'Erreur : La taille du fichier dépasse la limite autorisée de 10 Mo.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Traitement du CV
        $cv_name = $_FILES['cv']['name'];
        $cv_size = $_FILES['cv']['size'];
        $cv_tmp = $_FILES['cv']['tmp_name'];
        $cv_type = $_FILES['cv']['type'];

        // Vérification du type de fichier CV
        if ($cv_type !== 'application/pdf') {
            $_SESSION['message'] = 'Erreur : Seuls les fichiers PDF sont autorisés.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Vérification de la taille du fichier CV
        if ($cv_size > 10 * 1024 * 1024) {
            $_SESSION['message'] = 'Erreur : La taille du fichier dépasse la limite autorisée de 10 Mo.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Déplacement des fichiers vers le dossier "upload"
        $upload_dir = "../../views/upload/";
        $image_path = $upload_dir . basename($image_name);
        $cv_path = $upload_dir . basename($cv_name);

        if (!move_uploaded_file($image_tmp, $image_path)) {
            $_SESSION['message'] = 'Erreur lors du téléchargement de l\'image.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        if (!move_uploaded_file($cv_tmp, $cv_path)) {
            $_SESSION['message'] = 'Erreur lors du téléchargement du CV.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Récupérer l'ID du demandeur depuis la session
        if (isset($_SESSION['demandeur_id'])) {
            $idDemandeur = $_SESSION['demandeur_id'];

            // Insérer la demande dans la table `demande`
            $reqDemande = $pdo->prepare('INSERT INTO demande (id_demandeur, titre, description, image, cv, motivation) VALUES (?, ?, ?, ?, ?, ?)');
            $result = $reqDemande->execute([$idDemandeur, $titre, $description, basename($image_name), basename($cv_name), $motivation]);

            if ($result) {
                $_SESSION['message'] = 'Votre demande a été envoyée avec succès.';
                header('Location: ../../Views/demandeur/navbar.demandeur.view.php');
                exit();
            } else {
                $_SESSION['message'] = "Erreur lors de l'insertion dans la table demande.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            $_SESSION['message'] = 'Aucun demandeur trouvé. Veuillez vous connecter.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['message'] = 'Tous les champs requis doivent être présents.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}