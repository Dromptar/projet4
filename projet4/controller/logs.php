<?php

require_once("model/LogsManager.php");
require_once("model/CommentManager.php");
require_once("controller/blogPosts.php");
require_once("controller/blogComments.php");

function registerForm() 
{
    require_once("view/registerView.php");
}

function myAdminSpace() 
{
    $commentManager = new CommentManager();
    $allComments = $commentManager->allComments();
    require_once("view/adminView.php");    
}

function signUp()
{
    $logsManager = new LogsManager();
    $newMember = $logsManager->addMember();

    myAdminSpace();

}

function registerCheck() 
{
    $logsManager = new LogsManager();
    $isValid = $logsManager->logsCheck();

    if (isset($_POST['pseudo']) && !empty($_POST['pseudo']) && htmlspecialchars($_POST['pseudo'])
        && !empty($_POST['pass1']) && !empty($_POST['pass2'])
        && isset($_POST['email']) && htmlspecialchars($_POST['email'])) {
           
        if ($isValid -> fetch())
        {
            require_once("view/registerView.php");
            echo "<script>alert(\"'Pseudonyme et/ou email déjà utilisé.\")</script>";
            die();
        }
        
            if (($_POST['pass1'] == $_POST['pass2'])
                && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {  
                    
                    signUp();
                             
                } else {
                    require_once("view/registerView.php");
                    echo "<script>alert(\"Les mots de passes ne correspondent pas et/ou l\'adresse mail n\'est pas valide.\")</script>";
                }

        } else {
            require_once("view/registerView.php");
            echo "<script>alert(\"Veuillez remplir tous les champs.\")</script>";
        }    
} 



function logIn(){

    $logsManager = new LogsManager();
    
    $resultat = $logsManager->connectMember();
    
    $score = $resultat->fetch();
    $isPasswordCorrect = password_verify($_POST['pass'], $score['pass']);
    
    if ($isPasswordCorrect) {
               
            $pseudo = ($_POST['pseudo']);
            $_SESSION['id'] = $score['id'];
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['connected'] = $_POST['pseudo'] ;
            myAdminSpace();
        }
            else {
                require_once("view/connectView.php");
                echo "<script>alert(\"Mauvais identifiant et/ou mot de passe !\")</script>";
            }
}


function logOut() {

   

    // Suppression des variables de session et de la session
    $_SESSION = array();
    session_destroy();
    header('Location: ' .$GLOBALS['nomDeDomaine']. '?url=connection');


    // Suppression des cookies de connexion automatique
   /* setcookie('login', '');
    setcookie('pass_hache', '');*/

}




