# SMARTFINANCE

Application web PHP simple pour la gestion de demandes de prêt, de simulateur financier et d'administration.

## Structure

- Front-office : accueil, inscription, connexion, tableau de bord, demandes, simulateur, profil, contact
- Back-office : administration des clients, demandes, utilisateurs, remboursements et paramètres
- Base de données : SQLite via le fichier database/smartfinance.sqlite

## Utilisation

1. Placer le projet dans un serveur PHP local.
2. Ouvrir la page d'accueil.
3. Utiliser l'identifiant admin@smartfinance.test avec le mot de passe admin123 pour accéder à l'administration.

---

## Configuration des notifications par email

Pour activer l'envoi d'email au propriétaire (nouvelle inscription, nouvelle demande, nouveau message de contact),
ouvrir `config/mail.php` et remplir :

- `PROPRIETAIRE_EMAIL` : l'adresse email qui doit recevoir les notifications
- `PROPRIETAIRE_TELEPHONE` : le numéro du propriétaire (à afficher sur le site si besoin)
- `MAIL_UTILISATEUR` et `MAIL_MDP` : les identifiants SMTP utilisés pour ENVOYER les emails
  (peut être une adresse Gmail avec un "mot de passe d'application", ou un service comme Brevo/Mailgun)

Tant que `MAIL_UTILISATEUR` et `MAIL_MDP` ne sont pas renseignés, le site continue de fonctionner
normalement (inscriptions, demandes, messages de contact enregistrés en base) — seuls les emails
ne sont simplement pas envoyés.

## Langues disponibles

Le site est disponible en français, anglais et allemand. Le sélecteur se trouve dans la barre de
navigation (icône globe). Pour ajouter une langue, dupliquer un fichier dans `lang/` (ex: `es.php`)
et l'ajouter dans `LANGUES_DISPONIBLES` dans `config/lang.php`.
