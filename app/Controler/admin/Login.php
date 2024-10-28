<?php


require_once 'LoginAdmin.php';
require_once '../../Models/databaseConnexion.php'; // Inclure le fichier de connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST['email']) && isset($_POST['password'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])){
      // Récupérer les valeurs du formulaire
      $email = htmlspecialchars( $_POST['email']);
      $password = htmlspecialchars($_POST['password']);

      // Créer une instance de la classe LoginAdmin
      $admin = new LoginAdmin();

      // Vérifier si les informations d'identification sont valides
      if ($email === $admin->getEmail() && $password === $admin->getPassword()) {
        header('Location: ../Router.php');
        // Informations d'identification valides, l'administrateur est connecté
        echo "Connexion réussie !";
        // Inclure le code pour la connexion à la base de données
        require_once '../../Models/databaseConnexion.php';
        // Effectuer d'autres opérations de base de données ici si nécessaire
        // Fermer la connexion à la base de données si nécessaire
        // $db->close();
      } else {
          // Informations d'identification invalides
          echo "Identifiants incorrects. Veuillez réessayer.";
        }
    }else{
      echo 'Le email et le mot de passe sont vide';
    }
  }else{
    echo 'Veillez remplir les champs requis';
  }
}