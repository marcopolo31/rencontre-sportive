<?php

require_once '../functions/functions.php';


$name = security($_POST['name']);
$firstname = security($_POST['firstname']);
$department = security($_POST['department']);
$username = security($_POST['username']);
$password = security($_POST['password']);
$gender = $_POST['sexe'];
$sport = $_POST['sport'];
$level = $_POST['level'];
$fileName = basename($_FILES["image"]["name"]);


if(isset($name) && !empty($name) && isset($firstname) && !empty($firstname) && isset($department) && !empty($department) && isset($username) && !empty($username) && isset($password) && !empty($password)
&& isset($gender) && !empty($gender) && isset($fileName) && !empty($fileName)&& isset($sport) && !empty($sport) && isset($level) && !empty($level))
{


$targetDir = "../assets/images/uploads/";
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes))
        {
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
             
            $password_crypt = password_hash($password, PASSWORD_DEFAULT);

            queryMySql("INSERT INTO user (lastname, firstname, department, username, password, image_cover, gender, id_niveau, id_sport) 
            VALUES('$name', '$firstname', '$department', '$username', '$password_crypt', '$fileName', '$gender', '$level', '$sport')");

            
            }
            require("../class/session.class.php");
            $session = new Session();
            $session->setFlash('Votre inscription a été prise en compte', 'success');
            header("location: ../login.php");
        }
        
}
else if($gender == "m" && empty($fileName) && isset($name) && !empty($name) && isset($firstname) && !empty($firstname) && isset($department) && !empty($department) && isset($username) && !empty($username) && isset($password) && !empty($password)
&& isset($sport) && !empty($sport) && isset($level) && !empty($level))
{
    $filename = "masculin_default.jpg";
    
    $password_crypt = password_hash($password, PASSWORD_DEFAULT);
    
    
    queryMySql("INSERT INTO user (lastname, firstname, department, username, password, image_cover, gender, id_niveau, id_sport)
     VALUES('$name', '$firstname', '$department', '$username', '$password_crypt', '$filename', '$gender', '$level', '$sport')");
    require("../class/session.class.php");
    $session = new Session();
    $session->setFlash('Votre inscription a été prise en compte', 'success');
    header("location: ../login.php");

}
else if($gender == "f" && empty($fileName) && isset($name) && !empty($name) && isset($firstname) && !empty($firstname) && isset($department) && !empty($department) && isset($username) && !empty($username) && isset($password) && !empty($password)
&& isset($sport) && !empty($sport) && isset($level) && !empty($level))
{
        $fileName = "feminin_default.jpg";
        
        $password_crypt = password_hash($password, PASSWORD_DEFAULT);
    
            queryMySql("INSERT INTO user (lastname, firstname, department, username, password, image_cover, gender, id_niveau, id_sport)
             VALUES('$name', '$firstname', '$department', '$username', '$password_crypt', '$fileName', '$gender', '$level', '$sport')");
            require("../class/session.class.php");
            $session = new Session();
            $session->setFlash('Votre inscription a été prise en compte', 'success');
            header("location: ../login.php");

}
else
{
    require("../class/session.class.php");
    $session = new Session();
    $session->setFlash('ERREUR ! SVP Veuillez remplir tous les champs du formulaire d\'inscription');
    
    header("location: ../ajout.php");

}
    
        
    