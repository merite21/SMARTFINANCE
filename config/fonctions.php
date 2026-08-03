<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


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



function estAdmin(){

    return utilisateurConnecte()
        && isset($_SESSION['user']['role'])
        && $_SESSION['user']['role'] === 'admin';

}



function obligerAdmin(){

    if(!estAdmin()){

        $accueil = defined('SITE_URL') ? SITE_URL . "connexion.php" : "../connexion.php";
        header("Location: " . $accueil);
        exit;

    }

}



// Echappement pour l'affichage (protection XSS)
function e($valeur){

    return htmlspecialchars($valeur ?? '', ENT_QUOTES, 'UTF-8');

}



// Construit une URL absolue à partir du chemin racine du site
function base_url($chemin = ''){

    $base = defined('SITE_URL') ? SITE_URL : '/SMARTFINANCE/';
    return $base . ltrim($chemin, '/');

}



// Redirige vers une URL (relative au site) puis arrête le script
function redirect($chemin = ''){

    header("Location: " . base_url($chemin));
    exit;

}



// Génère (ou réutilise) un jeton CSRF pour la session en cours
function csrf_token(){

    if(empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];

}



// Affiche le champ caché à insérer dans chaque formulaire POST
function csrf_field(){

    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';

}



// Vérifie le jeton envoyé par un formulaire ; arrête le script si invalide
function verifier_csrf(){

    $token = $_POST['csrf_token'] ?? '';

    if(!hash_equals($_SESSION['csrf_token'] ?? '', $token)){
        http_response_code(403);
        die("Requête invalide (jeton de sécurité expiré). Merci de recharger la page et réessayer.");
    }

}


?>