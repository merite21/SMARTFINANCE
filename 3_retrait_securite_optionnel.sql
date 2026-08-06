-- Optionnel : à exécuter seulement si tu veux nettoyer complètement la base.
-- Sans risque de garder ces colonnes si tu ne veux pas y toucher, elles seront juste inutilisées.

ALTER TABLE utilisateurs
DROP COLUMN fiche_paie,
DROP COLUMN revenu_verifie,
DROP COLUMN code_2fa,
DROP COLUMN code_2fa_expire;
