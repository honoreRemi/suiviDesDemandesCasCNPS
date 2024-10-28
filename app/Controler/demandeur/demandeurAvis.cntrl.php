<?php
session_start();

if (isset($_POST['envoyer'])) {
    DonnerAvis();
}

function DonnerAvis()
{
    require dirname(__DIR__) . '../../Models/databaseConnexion.php';

    if (isset($_POST['libelé']) && !empty(trim($_POST['libelé']))) {
        
        $libelé = htmlspecialchars(trim($_POST['libelé']));
       
        
        if (isset($_SESSION['demandeur_id'])) {
            $idDemandeur = $_SESSION['demandeur_id'];
           
            try {
                $reqDemande = $pdo->prepare('INSERT INTO avisdemandeur (id_demandeur, libelé) VALUES (?, ?)');
                $result = $reqDemande->execute([$idDemandeur, $libelé]);

                if ($result) {
                    $_SESSION['message'] = 'Votre demande a été envoyée avec succès.';
                    header('Location: ../../Views/demandeur/navbar.demandeur.view.php');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de l'insertion dans la table demande.";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            } catch (PDOException $e) {
                echo "Erreur lors de l'insertion : " . $e->getMessage(); // Affiche l'erreur
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