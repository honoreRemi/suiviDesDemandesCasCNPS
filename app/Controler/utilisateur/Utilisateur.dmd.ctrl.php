<?php
session_start();

class Utilisateur{
    protected $nom;
    protected $prenom;
    protected $fonction;
    protected $phone;
    protected $email;
    protected $dateCreation;
    protected $deconnection;
    protected $password;
    
    // Constructeur par défaut
    public function __construct() {
        $this->nom = "";
        $this->prenom = "";
        $this->fonction = "";
        $this->phone = "";
        $this->email = "";
        $this->dateCreation = "";
        $this->deconnection = "";
        $this->password = "";
    }

    // Getter pour la propriété nom, prenom, fonction, phone, email, date de creation, et déconnection
    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }
    
     public function getFonction(){
        return $this->fonction;
    }

     public function getPhone(){
        return $this->phone;
    }
    
    public function getEmail(){
        return $this->email;
    }

    public function getDateCreation(){
        return $this->dateCreation;
    }

    public function getDeconnection(){
        return $this->deconnection;
    }

    public function getPassword(){
        return $this->password;
    }

    //setters pour la propriété nom, prenom, fonction, phone, email, date de creation, et déconnection
    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->nom = $prenom;
    }
  
    public function setFonction($fonction){
        $this->nom = $fonction;
    }

    
    public function setPhone($phone){
        $this->nom = $phone;
    }

    
    public function setEmail($email){
        $this->nom = $email;
    }

    
    public function setDateCreation($dateCreation){
        $this->nom = $dateCreation;
    }

    
    public function setDeconncetion($deconnection){
        $this->nom = $deconnection;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function seConnecter(){
        require dirname(__DIR__) . '../../Models/databaseConnexion.php'; //connection à la base de donnée
        if(isset($_POST['connexion'])){ //verifions si le user a pressé sur le bouton connexion
            if(isset($_POST['email']) && isset($_POST['password'])){
                if(!empty($_POST['email']) && !empty($_POST['password'])){
                    $nom = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']); 
    
    
                }
            }
        }
    }

}