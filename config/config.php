<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once "connexion.php";

define("SITE_NAME", "SMARTFINANCE");

define(
    "SITE_URL",
    "http://localhost/SMARTFINANCE/"
);

date_default_timezone_set("Africa/Porto-Novo");

?>