<?php

require_once "config/config.php";
require_once "config/fonctions.php";

$langueDemandee = $_GET['lang'] ?? 'fr';

if (array_key_exists($langueDemandee, LANGUES_DISPONIBLES)) {
    $_SESSION['lang'] = $langueDemandee;
}

$retour = $_SERVER['HTTP_REFERER'] ?? SITE_URL;

header("Location: " . $retour);
exit;
