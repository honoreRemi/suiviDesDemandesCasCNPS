<?php

 function emptyInputSignup($nom, $prenom, $school, $filiere, $stageVoulu, $Email,
     $number, $dateDebut, $dateFin, $durée, $password, $conf_password){
       
        if(empty($nom) || empty($prenom)  || empty($prenom) || empty($school) || empty($filiere)  
            || empty($stageVoulu) || empty($Email) || empty($number) || empty($dateDebut) 
            || empty($dateFin) || empty($durée) || empty($password) /*|| empty($conf_password)*/){
            
                return true;
        }else{
            return false;
        }
 }
 
 function invalidNom($nom){
       
        if(!preg_match('/^[A-Za-z0-9]*$/', $nom)){
            
                return true;
        }else{
            return false;
        }
 }
  
 function invalidPrenom($prenom){
       
    if(!preg_match('/^[A-Za-z0-9]*$/', $prenom)){
        
            return true;
    }else{
        return false;
    }
}
  
function invalidEmail($Email){
       
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        
            return true;
    }else{
        return false;
    }
}
  
/*function PasswordMatch($password, $conf_password){

    if($password != $conf_password){
        
            return true;
    }else{
        return false;
    }
}*/
  
function userExists($pdo, $nom, $Email){
       
    $sql = 'SELECT * FROM demandeur WHERE nom = ? OR email = ?;';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $Email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        header('Location: ../../..Views/demandeur/Register.php?error=passwordsdontmatch');
        exit();
        return true;
    } else {
        // L'utilisateur n'existe pas
        return false;
    }
}

function createUser($pdo, $nom, $prenom, $school, $filiere, $stageVoulu, $Email, $number, $dateDebut, $dateFin, $durée, $hash) {
    $sql = 'INSERT INTO demandeur(nom, prenom, établissement, filière, typeStage, email, phone, dateDebut, dateFin, durée, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$nom, $prenom, $school, $filiere, $stageVoulu, $Email, $number, $dateDebut, $dateFin, $durée, $hash]);

    if ($result !== false) {
        return true;
    } else {
        // L'utilisateur n'a pas pu être inséré
        return false;
    }
}
