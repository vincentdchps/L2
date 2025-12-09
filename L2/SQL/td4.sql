--ex1

--1
CREATE TABLE CATEGORIE (
    NumCategorie INT AUTO_INCREMENT,
    Libelle VARCHAR(50),
    CONSTRAINT pk_categorie PRIMARY KEY (NumCategorie)
);

--2
CREATE TABLE LIGNE_CAHIER (
    NumCahier INT,
    NumLigneCahier INT,
    DescriptionLigneCahier VARCHAR(500),
    CONSTRAINT pk_lignecahier PRIMARY KEY (NumCahier, NumLigneCahier),
    CONSTRAINT fk_lignecahier_cahier FOREIGN KEY (NumCahier) REFERENCES CAHIER(NumCahier)
);

--3
CREATE TABLE CLIENT (
    NumClient INT AUTO_INCREMENT,
    NomClient VARCHAR(80) NOT NULL,
    AdresseClient VARCHAR(500),
    EmailClient VARCHAR(100) UNIQUE,
    ContactClient VARCHAR(100),
    CategorieClient INT, 
    CONSTRAINT pk_client PRIMARY KEY (NumClient),
    CONSTRAINT fk_client_categorie FOREIGN KEY (CategorieClient) REFERENCES CATEGORIE(NumCategorie)
);


--4
ALTER TABLE CAHIER
ADD CONSTRAINT ck_montant_positif CHECK (MontantCahier > 0);


--5
ALTER TABLE APPEL
ALTER COLUMN DateAppel SET DEFAULT (CURDATE());

-6
ALTER TABLE CAHIER
DROP CHECK ck_montant_positif;

--7
CREATE INDEX idx_date_cahier ON CAHIER(DateCahier);

--8
DROP INDEX idx_date_cahier ON CAHIER;

--9
DROP TABLE CLIENT;

--10
ALTER TABLE EMPLOYE
DROP COLUMN AdresseEmploye;