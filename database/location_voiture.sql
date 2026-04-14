DROP DATABASE IF EXISTS location_voiture;
CREATE DATABASE location_voiture CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE location_voiture;

- CLIENT -
CREATE TABLE client (
  id_client INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(50) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  telephone VARCHAR(20),
  num_permis VARCHAR(30) NOT NULL,
  date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

- VEHICULE -
CREATE TABLE vehicule (
  id_vehicule INT AUTO_INCREMENT PRIMARY KEY,
  marque VARCHAR(50) NOT NULL,
  modele VARCHAR(50) NOT NULL,
  categorie VARCHAR(30) NOT NULL,       
  energie VARCHAR(20) NOT NULL,         
  transmission VARCHAR(20) NOT NULL,    
  nb_places TINYINT NOT NULL,
  prix_jour DECIMAL(10,2) NOT NULL,
  caution DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  disponible BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

- RESERVATION -
CREATE TABLE reservation (
  id_reservation INT AUTO_INCREMENT PRIMARY KEY,
  id_client INT NOT NULL,
  id_vehicule INT NOT NULL,
  date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  date_debut DATE NOT NULL,
  date_fin DATE NOT NULL,
  statut ENUM('en_attente','confirmee','annulee','terminee') NOT NULL DEFAULT 'en_attente',
  total_estime DECIMAL(10,2) NOT NULL DEFAULT 0.00,

  CONSTRAINT fk_res_client
    FOREIGN KEY (id_client) REFERENCES client(id_client),

  CONSTRAINT fk_res_vehicule
    FOREIGN KEY (id_vehicule) REFERENCES vehicule(id_vehicule),

  CONSTRAINT chk_dates
    CHECK (date_fin > date_debut)
) ENGINE=InnoDB;

- OPTION -
CREATE TABLE option_location (
  id_option INT AUTO_INCREMENT PRIMARY KEY,
  libelle VARCHAR(80) NOT NULL,
  prix_jour DECIMAL(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB;

- LIGNE_OPTION -
CREATE TABLE ligne_option (
  id_reservation INT NOT NULL,
  id_option INT NOT NULL,
  quantite INT NOT NULL DEFAULT 1,

  PRIMARY KEY (id_reservation, id_option),

  CONSTRAINT fk_lo_reservation
    FOREIGN KEY (id_reservation) REFERENCES reservation(id_reservation)
    ON DELETE CASCADE,

  CONSTRAINT fk_lo_option
    FOREIGN KEY (id_option) REFERENCES option_location(id_option),

  CONSTRAINT chk_quantite
    CHECK (quantite > 0)
) ENGINE=InnoDB;

-- =========================================
Données de test
-- =========================================
INSERT INTO client (nom, prenom, email, telephone, num_permis)
VALUES
('Dupont','Alice','alice.dupont@mail.com','0612345678','FR-AD123456'),
('Martin','Yanis','yanis.martin@mail.com','0699988877','FR-YM987654');

INSERT INTO vehicule (marque, modele, categorie, energie, transmission, nb_places, prix_jour, caution, disponible)
VALUES
('Peugeot','208','citadine','essence','manuelle',5,39.90,800.00,TRUE),
('Renault','Clio','citadine','diesel','manuelle',5,37.50,800.00,TRUE),
('Tesla','Model 3','berline','electrique','auto',5,89.90,1500.00,TRUE);

INSERT INTO option_location (libelle, prix_jour)
VALUES
('GPS', 5.00),
('Siege enfant', 4.00),
('Assurance premium', 12.00);

INSERT INTO reservation (id_client, id_vehicule, date_debut, date_fin, statut, total_estime)
VALUES
(1, 1, '2026-03-01', '2026-03-05', 'confirmee', 0.00);

INSERT INTO ligne_option (id_reservation, id_option, quantite)
VALUES
(1, 1, 1),
(1, 3, 1);

