CREATE DATABASE IF NOT EXISTS smartfinance;
USE smartfinance;

-- ===========================
-- TABLE DES UTILISATEURS
-- ===========================
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telephone VARCHAR(20),
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('client','admin') DEFAULT 'client',
    statut ENUM('actif','inactif') DEFAULT 'actif',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===========================
-- TABLE DES DEMANDES
-- ===========================
CREATE TABLE demandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    montant DECIMAL(12,2) NOT NULL,
    duree INT NOT NULL,
    taux DECIMAL(5,2) NOT NULL,
    mensualite DECIMAL(12,2),
    objet TEXT,
    document VARCHAR(255),
    revenu_mensuel DECIMAL(12,2),
    statut ENUM('En attente','Approuvé','Refusé') DEFAULT 'En attente',
    date_demande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- ===========================
-- TABLE DES DOCUMENTS
-- ===========================
CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    type_document VARCHAR(100),
    fichier VARCHAR(255),
    date_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- ===========================
-- TABLE DES REMBOURSEMENTS
-- ===========================
CREATE TABLE remboursements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    demande_id INT,
    montant DECIMAL(12,2),
    date_paiement DATE,
    statut ENUM('Payé','En attente') DEFAULT 'En attente',
    FOREIGN KEY (demande_id) REFERENCES demandes(id)
);

-- ===========================
-- TABLE DES MESSAGES DE CONTACT
-- ===========================
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    sujet VARCHAR(200),
    contenu TEXT,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===========================
-- ADMIN PAR DÉFAUT
-- Mot de passe : admin123
-- ===========================
INSERT INTO utilisateurs
(nom, prenom, email, telephone, mot_de_passe, role)
VALUES
(
'Administrateur',
'SmartFinance',
'admin@smartfinance.com',
'0102030405',
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
'admin'
);