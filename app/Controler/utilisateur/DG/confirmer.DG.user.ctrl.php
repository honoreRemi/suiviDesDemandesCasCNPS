<?php
session_start();

// Vérifier si l'ID de demande est spécifié et est un entier positif
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    // Récupérer l'id de la demande à mettre à jour
    $id = $_GET['id'];

    // Connexion à la base de données
    require dirname(__DIR__) . '../../../Models/databaseConnexion.php';

    // Mettre à jour la valeur de la colonne dans la table 'demande'
    $stmt = $pdo->prepare("UPDATE demande SET confirm = 1 WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Rediriger vers la page précédente
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $_SESSION['message'] = 'Une erreur est survenue lors de la mise à jour.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    $_SESSION['message'] = 'ID de demande invalide.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}