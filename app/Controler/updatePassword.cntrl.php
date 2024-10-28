<?php
session_start();


 // Soumission du formulaire d'e-mail
 if(isset($_POST['submit_email'])){
    recupererEmail();
 }

 function recupererEmail(){

    //recuperer la connexion a labase de donnee
 require dirname(__DIR__) . 'Models/databaseConnexion.php';

    if(isset($_POST['email']) && !empty($_POST['email'])){
        $Email = htmlspecialchars($_POST['email']);

        // Vérifier le format de l'e-mail (exemple de validation)
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = 'L\'email n\'est pas valide.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

         // Vérification si l'e-mail existe dans la base de données
    $stmt = $pdo->prepare('SELECT * FROM demande WHERE email = ?');
    $stmt->execute([$Email]);
    $demande = $stmt->fetch();

    if ($demande) {
        // Génération d'un token unique
        $token = bin2hex(random_bytes(32));

        // Enregistrement du token et de l'adresse e-mail dans la table "password_reset"
        $stmt = $pdo->prepare('INSERT INTO password_reset (email, token) VALUES (?, ?)');
        $stmt->execute([$Email, $token]);

        // Envoi de l'e-mail contenant le lien de réinitialisation du mot de passe
        $resetLink = 'http://example.com/reset_password.php?token=' . $token; // Remplacez "example.com" par votre propre domaine
        $message = "Bonjour,\n\nVous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le lien suivant pour choisir un nouveau mot de passe :\n\n$resetLink";
        mail($Email, 'Réinitialisation du mot de passe', $message);

        echo "Un e-mail a été envoyé à votre adresse avec des instructions pour réinitialiser votre mot de passe.";
    } else {
        echo "L'adresse e-mail fournie n'est pas associée à un compte.";
    }
    }else{
        $_SESSION['message'] = 'Veuillez remplir tous les champs.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

 }