<?php

/*
|--------------------------------------------------------------------------
| Configuration des notifications email
|--------------------------------------------------------------------------
|
| À COMPLÉTER avec les vraies informations du propriétaire du site
| (email + identifiants SMTP pour l'envoi).
|
| Pour Gmail par exemple :
|   - MAIL_HOTE     = smtp.gmail.com
|   - MAIL_PORT     = 587
|   - MAIL_UTILISATEUR = l'adresse gmail complète
|   - MAIL_MDP      = un "mot de passe d'application" (pas le mot de passe
|                      Gmail normal — à générer dans les paramètres Google)
|
*/

define("PROPRIETAIRE_EMAIL", "Christina.Pacholski@web.de");
define("PROPRIETAIRE_TELEPHONE", "+33 7 74 89 29 57");

define("MAIL_HOTE", "smtp.web.de");
define("MAIL_PORT", 587);
define("MAIL_UTILISATEUR", "Christina.Pacholski@web.de");   // <-- adresse d'envoi, ex: Christina.Pacholski@web.de
define("MAIL_MDP", "");           // <-- mot de passe de cette adresse (ou mot de passe d'application)
define("MAIL_EXPEDITEUR_NOM", "SmartFinance");


require_once __DIR__ . "/../lib/Exception.php";
require_once __DIR__ . "/../lib/PHPMailer.php";
require_once __DIR__ . "/../lib/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;


/**
 * Envoie une notification par email au propriétaire du site.
 * Ne bloque jamais le reste du script en cas d'échec (ex: pas encore configuré).
 */
function notifierProprietaire($sujet, $messageHtml){

    // Si les identifiants SMTP ne sont pas encore renseignés, on n'essaie pas d'envoyer
    if(MAIL_UTILISATEUR === "" || MAIL_MDP === ""){
        return false;
    }

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = MAIL_HOTE;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_UTILISATEUR;
        $mail->Password = MAIL_MDP;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = MAIL_PORT;
        $mail->CharSet = "UTF-8";

        $mail->setFrom(MAIL_UTILISATEUR, MAIL_EXPEDITEUR_NOM);
        $mail->addAddress(PROPRIETAIRE_EMAIL);

        $mail->isHTML(true);
        $mail->Subject = $sujet;
        $mail->Body = $messageHtml;

        $mail->send();

        return true;

    } catch (PHPMailerException $e) {

        error_log("Erreur envoi email notification : " . $mail->ErrorInfo);
        return false;

    }

}

?>
