<?php

//recuperer la connexion a labase de donnee
require 'databaseConnexion.php';

// Insertion des rôles
$pdo->exec("INSERT INTO role (nom_role) VALUES
    ('Administrateur')
");

echo "Les rôles ont été insérés avec succès.";

// Insertion des utilisateurs
$pdo->exec("INSERT INTO administrateur (id_role, nom, email, password) VALUES
    (1, 'honore remi', 'honore@gmail.com',  '" . password_hash('password123', PASSWORD_DEFAULT) . "')
");

echo "Les utilisateurs ont été insérés avec succès.";
?>