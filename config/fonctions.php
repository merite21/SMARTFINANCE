<?php


session_start();


function securiser($data){

    return htmlspecialchars(
        trim($data)
    );

}



function utilisateurConnecte(){

    return isset($_SESSION['user']);

}



function obligerConnexion(){

    if(!utilisateurConnecte()){

        header("Location: connexion.php");
        exit;

    }

}


?>