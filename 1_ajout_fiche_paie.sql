ALTER TABLE utilisateurs
ADD COLUMN fiche_paie VARCHAR(255) DEFAULT NULL AFTER piece_identite,
ADD COLUMN revenu_verifie ENUM('en_attente','verifie','rejete') DEFAULT 'en_attente' AFTER fiche_paie;
