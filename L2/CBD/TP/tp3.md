# TP 3 – Normalisation et migration

## Partie I – Création du jeu de données

## Partie II – Normalisation en Première forme normale

### 1. Expliquez pourquoi la table ne respecte pas la 1NF.

La table actuelle ne respecte pas la première forme normale car la colonne horairesProjection contient
plusieurs valeurs regroupées. Par exemple pour le film Interstellar, on retrouve la chaîne de caractères
"14:00,17:30,20:45". Une table est en 1FN si toutes les colonnes contiennent des valeurs atomique , ce qui
signifie que chaque case de la table doit contenir une information unique, ce qui n’est pas le cas ici.

### 2. Trouver une solution pour la normaliser en 1NF, et appliquez la en utilisant des requêtes SQL


La solution pour la normaliser en 1NF est de créer une nouvelle structure où chaque
horaire possède sa propre ligne, avec un type time.

CREATE TABLE cinema_1nf (
idCinema int(11),
nomCinema varchar(100),

adresseCinema varchar(200),
telCinema varchar(15),
numSalle int(11),
capaciteSalle int(11),
numFilm int(11),
titreFilm varchar(200),
realFilm varchar(100),
anneeFilm int(11),
dureeFilm int(11),
genre varchar(50),
dateProjection date,
horaireProjection time,
tarifNormal decimal(5,2),
tarifReduit decimal(5,2)
);
INSERT INTO cinema_1nf
SELECT idCinema, nomCinema, adresseCinema, telCinema, numSalle,
capaciteSalle, numFilm,
titreFilm, realFilm, anneeFilm, dureeFilm, genre, dateProjection,
SUBSTRING_INDEX(horairesProjection, ',', 1),
tarifNormal, tarifReduit
FROM cinema;
INSERT INTO cinema_1nf
SELECT idCinema, nomCinema, adresseCinema, telCinema, numSalle,
capaciteSalle, numFilm,
titreFilm, realFilm, anneeFilm, dureeFilm, genre, dateProjection,
SUBSTRING_INDEX(SUBSTRING_INDEX(horairesProjection, ',', 2), ',', -1),
tarifNormal, tarifReduit
FROM cinema
WHERE horairesProjection LIKE '%,%';
INSERT INTO cinema_1nf
SELECT idCinema, nomCinema, adresseCinema, telCinema, numSalle,
capaciteSalle, numFilm,
titreFilm, realFilm, anneeFilm, dureeFilm, genre, dateProjection,
SUBSTRING_INDEX(SUBSTRING_INDEX(horairesProjection, ',', 3), ',', -1),
tarifNormal, tarifReduit
FROM cinema
WHERE horairesProjection LIKE '%,%,%';


## Partie III – Normalisation en Troisième forme normale

### 1. Listez les dépendances fonctionnelles qui se déduisent de la description de la table en 1NF.

idCinema -> nomCinema, adresseCinema, telCinema, tarifNormal, tarifReduit L'identifiant du cinéma
détermine son nom, ses coordonnées et ses tarifs.
numFilm -> titreFilm, realFilm, anneeFilm, dureeFilm, genre L'identifiant du film détermine l'ensemble
de ses caractéristiques cinématographiques.
idCinema, numSalle -> capaciteSalle La capacité de la salle dépend de son cinéma et de son numéro de
salle dans ce cinéma.
idCinema, numSalle, dateProjection, horaireProjection -> numFilm Un lieu physique défini à un instant T
précis ne peut accueillir qu'une seule projection d'un film.

### 2. Déterminer la ou les clé(s) de la relation.

La clé primaire de la table est idCinema, numSalle, dateProjection,
horaireProjection car elle permet de déterminer l’ensemble attributs de la table.

### 3. Appliquez l’algorithme de normalisation en 3NF SPI et SPD
CINEMA idCinema, nomCinema, adresseCinema, telCinema, tarifNormal, tarifReduit
SALLE idCinema, numSalle, capaciteSalle
FILM numFilm, titreFilm, realFilm, anneeFilm, dureeFilm, genre
PROJECTION idCinema, numSalle, dateProjection, horaireProjection, numFilm

### 4. Créer des tables pour mettre le schéma en 3NF avec toutes les contraintes nécessaires

CREATE TABLE CINEMA (
idCinema int(11) PRIMARY KEY,
nomCinema varchar(100),
adresseCinema varchar(200),
telCinema varchar(15),
tarifNormal decimal(5,2),
tarifReduit decimal(5,2)
);

CREATE TABLE SALLE (
idCinema int(11),
numSalle int(11),
capaciteSalle int(11),

PRIMARY KEY (idCinema, numSalle),
FOREIGN KEY (idCinema) REFERENCES CINEMA(idCinema)
);

CREATE TABLE FILM (
numFilm int(11) PRIMARY KEY,
titreFilm varchar(200),
realFilm varchar(100),
anneeFilm int(11),
dureeFilm int(11),
genre varchar(50)
);

CREATE TABLE PROJECTION (
idCinema int(11),
numSalle int(11),
dateProjection date,
horaireProjection time,
numFilm int(11),
PRIMARY KEY (idCinema, numSalle, dateProjection, horaireProjection),
FOREIGN KEY (idCinema, numSalle) REFERENCES SALLE(idCinema, numSalle),
FOREIGN KEY (numFilm) REFERENCES FILM(numFilm)
);

### 5. Migrez les données vers les nouvelles tables.
INSERT INTO CINEMA (idCinema, nomCinema, adresseCinema, telCinema,
tarifNormal, tarifReduit)
SELECT DISTINCT idCinema, nomCinema, adresseCinema, telCinema,
tarifNormal, tarifReduit
FROM cinema_1nf;
INSERT INTO SALLE (idCinema, numSalle, capaciteSalle)
SELECT DISTINCT idCinema, numSalle, capaciteSalle
FROM cinema_1nf;
INSERT INTO FILM (numFilm, titreFilm, realFilm, anneeFilm, dureeFilm, genre)
SELECT DISTINCT numFilm, titreFilm, realFilm, anneeFilm, dureeFilm, genre
FROM cinema_1nf;

INSERT INTO PROJECTION (idCinema, numSalle, dateProjection,
horaireProjection, numFilm)
SELECT idCinema, numSalle, dateProjection, horaireProjection, numFilm
FROM cinema_1nf;

## Partie IV – Critique


### 1. Repérez, dans les données initiales (de la relation en 1NF), les redondances et problèmes de modélisation

La table en première forme normale regroupe toutes les données au même endroit, ce qui provoque des redondances. En effet, les informations du cinéma comme le nom, l'adresse ou le téléphone sont répétées à chaque fois qu'un film est programmé. De même, les détails du film comme le réalisateur, l'année ou la durée sont copiés sur chaque ligne d'horaire. Cette modélisation empêche de gérer les films et les cinémas de manière indépendante et cause des anomalies de modification, d'insertion et de suppression. Il y a donc un risque d'incohérence dans la base de donnée. 


### 2. Pour chaque problème, écrire des commandes de mise à jour sur le schéma en 1NF, qui causent des anomalies et montrer que le SGBD ne signale pas d’erreur.

Si on modifie le genre du film 1 uniquement pour le cinéma 2, le SGBD exécute la commande sans erreur. Le film se retrouve donc avec le genre "Action" au cinéma 2 et "Science-Fiction" au cinéma 1, créant une incohérence

UPDATE cinema_1nf SET genre = 'Action' WHERE numFilm = 1 AND idCinema = 2;

