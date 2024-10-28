<?php

// Récupérer la connexion à la base de données
require 'databaseConnexion.php';

/********************************************/
/** Nous allons créer notre table demandeur ***/
/********************************************/
$pdo->exec("CREATE TABLE demandeur (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    établissement VARCHAR(255) NOT NULL,
    filière VARCHAR(255) NOT NULL,
    typeStage VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    durée VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB");

echo 'TABLE : DEMANDEUR';

/**********************************************/
/** Nous allons créer notre table demande ***/
/********************************************/
$pdo->exec("CREATE TABLE demande (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_demandeur INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255) NOT NULL,
    cv VARCHAR(255) NOT NULL,
    motivation TEXT,
    confirm INT DEFAULT NULL,
    FOREIGN KEY(id_demandeur) REFERENCES demandeur(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB");

echo 'TABLE : DEMANDE';

/**********************************************/
/** Nous allons créer notre table décision ***/
/********************************************/
$pdo->exec("CREATE TABLE decision (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    decision VARCHAR(50) NOT NULL,
    dateJ DATE NOT NULL
) ENGINE=InnoDB");

echo 'TABLE : DECISION';

/**********************************************/
/** Nous allons créer notre table updatePassword ***/
/********************************************/
$pdo->exec("CREATE TABLE updatePassword (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    token INT NOT NULL,
    email VARCHAR(255) NOT NULL
) ENGINE=InnoDB");

echo 'TABLE : UPDATEPASSWORD';

/**********************************************/
/** Nous allons créer notre table rôle ***/
/********************************************/
$pdo->exec("CREATE TABLE role (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nom_role VARCHAR(255) NOT NULL
) ENGINE=InnoDB");

echo 'TABLE : ROLE';

/**********************************************/
/** Nous allons créer notre table utilisateur ***/
/********************************************/
$pdo->exec("CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_role INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    dateCreation DATE NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY(id_role) REFERENCES role(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB");

echo 'TABLE : UTILISATEUR';

/**********************************************/
/** Nous allons créer notre table administrateur ***/
/********************************************/
$pdo->exec("CREATE TABLE administrateur (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_role INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY(id_role) REFERENCES role(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB");

echo 'TABLE : ADMIN';

/**********************************************/
/** Nous allons créer notre table Avis ***/
/********************************************/
$pdo->exec("CREATE TABLE avisDemandeur (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_demandeur INT NOT NULL,
    libelé TEXT NOT NULL,
    FOREIGN KEY(id_demandeur) REFERENCES demandeur(id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB");

echo 'TABLE : AVIS_DEMANDEURS';
?>