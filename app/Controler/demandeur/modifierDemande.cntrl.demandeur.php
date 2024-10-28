<?php
session_start();

if (isset($_POST['envoyer'])) {
    modifierDemande();
}

function modifierDemande()
{
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../../Models/databaseConnexion.php';

    if (
        isset($_POST['titre'], $_POST['description'], $_POST['motivation'], $_FILES['image'], $_FILES['cv']) &&
        !empty($_POST['titre']) && !empty($_POST['description']) && !empty($_FILES['image']['name']) &&
        !empty($_FILES['cv']['name']) && !empty($_POST['motivation'])
    ) {
        $titre = htmlspecialchars($_POST['titre']);
        $motivation = htmlspecialchars($_POST['motivation']);
        $description = htmlspecialchars($_POST['description']);

        // Traitement de l'image
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];
        $nomphoto = htmlspecialchars($image_name);

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
        $nomfilePdf = htmlspecialchars($cv_name);

        // Vérification du type et de la taille du fichier CV
        if ($cv_type !== 'application/pdf') {
            $_SESSION['message'] = 'Erreur : Seuls les fichiers PDF sont autorisés.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

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

        // Récupérer l'ID du demandeur existant
        $reqDemandeur = $pdo->query('SELECT id FROM demandeur');
        $demandeurs = $reqDemandeur->fetchAll(PDO::FETCH_ASSOC);

        if ($demandeurs) {
            // Utiliser l'ID du premier demandeur (ou modifiez selon votre logique)
            $idDemandeur = $demandeurs[0]['id'];

            // Mettre à jour les informations dans la table `demande`
            $reqUpdate = $pdo->prepare("
                UPDATE demande
                SET titre = :titre,
                    description = :description,
                    image = :image,
                    cv = :cv,
                    motivation = :motivation
                WHERE id = :id
            ");

            // Assurez-vous de passer l'ID du demandeur comme paramètre
            $reqUpdate->execute([
                'titre' => $titre,
                'description' => $description,
                'image' => $nomphoto,
                'cv' => $nomfilePdf,
                'motivation' => $motivation,
                'id' => $idDemandeur
            ]);

            if ($reqUpdate->rowCount() > 0) {
                // La mise à jour a réussi
                $_SESSION['message'] = 'Votre demande a été modifiée avec succès.';
                header('Location: ../../Views/demandeur/navbar.demandeur.view.php');
                exit();
            } else {
                // La mise à jour a échoué
                $_SESSION['message'] = "Erreur lors de la mise à jour de la table demande.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            $_SESSION['message'] = 'Aucun demandeur trouvé dans la table demandeur.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['message'] = 'Tous les champs requis doivent être présents.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}