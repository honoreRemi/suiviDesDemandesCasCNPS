<?php

/*require dirname(__DIR__) . '../../Models/databaseConnexion.php';

class RegisterRequest
{
    private $nom;
    private $prenom;
    private $etablissement;
    private $filiere;
    private $typeStage;
    private $email;
    private $phone;
    private $dateDebut;
    private $dateFin;
    private $duree;
    private $password;
    private $conf_password;

    public function __construct()
    {
        $this->nom = '';
        $this->prenom = '';
        $this->etablissement = '';
        $this->filiere = '';
        $this->typeStage = '';
        $this->email = '';
        $this->phone = '';
        $this->dateDebut = '';
        $this->dateFin = '';
        $this->duree = '';
        $this->password = '';
        $this->conf_password = '';
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    } 
    
    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getEtablissement()
    {
        return $this->etablissement;
    }

    public function setEtablissement($etablissement)
    {
        $this->etablissement = $etablissement;
    }

    public function getFiliere()
    {
        return $this->filiere ;
    }

    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;
    }

    public function getTypeStage()
    {
        return $this->typeStage;
    }

    public function setTypeStage($typeStage)
    {
        $this->typeStage = $typeStage;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin()
    {
        return $this->dateFin;
    }

    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    public function getDuree()
    {
        return $this->duree;
    }

    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getConf_password()
    {
        return $this->conf_password;
    }

    public function setConf_password($conf_password)
    {
        $this->conf_password = $conf_password;
    }
}

class DemandeurDAO
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertDemandeur(RegisterRequest $request)
    {
        //verifier l'unicité de l'email
        $existingEmail = $this->pdo->prepare('SELECT COUNT(*) FROM demandeur WHERE email = :email');
        $existingEmail->execute(['email' => $request->getEmail()]);
        $emailCount = $existingEmail->fetchColumn();

        if($emailCount > 0){
            echo 'cette addresse existe deja';
            header('Location: RegisterRequester.php');
            exit;
        }

        //verifier l'unicité du mot de passe
        $existingPassword = $this->pdo->prepare('SELECT COUNT(*) FROM demandeur WHERE password = :password');
        $existingPassword->execute(['password' => $request->getPassword()]);
        $passwordCount = $existingPassword->fetchColumn();

        if($passwordCount > 0){
            echo 'Ce mot de passe existe deja.';
            header('Location: RegisterRequester.php');
            exit;
        }

        
        $hashedPassword = password_hash($request->getPassword(), PASSWORD_DEFAULT);
        // Préparer la requête d'insertion
        $stmt = $this->pdo->prepare("INSERT INTO demandeur (nom, prenom, établissement, filière, typeStage, email, phone, dateDebut, dateFin, password, conf_password) VALUES (:nom, :prenom, :etablissement, :filiere, :typeStage, :email, :phone, :dateDebut, :dateFin, :password, :conf_password)");

        // Exécuter la requête avec les valeurs liées
        $stmt->execute([
            'nom' => $request->getNom(),
            'prenom' => $request->getPrenom(),
            'etablissement' => $request->getEtablissement(),
            'filiere' => $request->getFiliere(),
            'typeStage' => $request->getTypeStage(),
            'email' => $request->getEmail(),
            'phone' => $request->getPhone(),
            'dateDebut' => $request->getDateDebut(),
            'dateFin' => $request->getDateFin(),
            'password' => $hashedPassword ,
            'conf_password' => $request->getConf_password()
        ]);

        // Vérifier si l'insertion a réussi
        if ($stmt->rowCount() > 0) {
            echo "Demandeur inséré avec succès.";
        } else {
            echo "Erreur lors de l'insertion du demandeur.";
        }
    }
}

try {

    // Création d'une instance de RegisterRequest avec les données du formulaire
    $request = new RegisterRequest();
    $request->setNom(htmlspecialchars($_POST['nom']));
    $request->setPrenom(htmlspecialchars($_POST['prenom']));
    $request->setEtablissement(htmlspecialchars($_POST['établissement']));
    $request->setFiliere(htmlspecialchars($_POST['filière']));
    $request->setTypeStage(htmlspecialchars($_POST['typeStage']));
    $request->setEmail(htmlspecialchars($_POST['email']));
    $request->setPhone(htmlspecialchars($_POST['phone']));
    $request->setDateDebut(htmlspecialchars($_POST['dateDebut']));
    $request->setDateFin(htmlspecialchars($_POST['dateFin']));
    $request->setPassword(htmlspecialchars($_POST['password']));
    $request->setConf_password(htmlspecialchars($_POST['conf_password'] ));

    // Création d'une instance de DemandeurDAO avec la connexion PDO
    $demandeurDAO = new DemandeurDAO($pdo);

    // Insertion du demandeur
    $demandeurDAO->insertDemandeur($request);

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}*/