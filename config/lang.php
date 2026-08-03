<?php

/*
|--------------------------------------------------------------------------
| Moteur de traduction SmartFinance
|--------------------------------------------------------------------------
| N'importe quel visiteur, de n'importe quel pays, peut choisir sa langue
| via le sélecteur dans la navbar. Le choix est mémorisé en session, avec
| une détection automatique de la langue du navigateur pour un premier
| visiteur qui n'a encore rien choisi.
*/

define("LANGUES_DISPONIBLES", [
    "fr" => "Français",
    "en" => "English",
    "de" => "Deutsch",
    "es" => "Español",
]);

if (!isset($_SESSION['lang'])) {
<<<<<<< HEAD
    $_SESSION['lang'] = 'de';
=======

    // Détection automatique via la langue du navigateur (Accept-Language)
    $langueNavigateur = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'fr', 0, 2);

    $_SESSION['lang'] = array_key_exists($langueNavigateur, LANGUES_DISPONIBLES)
        ? $langueNavigateur
        : 'fr';

>>>>>>> 785691553ce273d604f66e7abf5d092c6e1f60b9
}

$GLOBALS['__traductions'] = require __DIR__ . "/../lang/" . $_SESSION['lang'] . ".php";


/**
 * Retourne le texte traduit correspondant à la clé, dans la langue
 * actuelle du visiteur. Si la clé n'existe pas, elle est renvoyée telle
 * quelle (pour repérer facilement les oublis de traduction).
 */
function t($cle){

    return $GLOBALS['__traductions'][$cle] ?? $cle;

}

?>
