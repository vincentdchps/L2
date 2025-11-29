CREATE
OR REPLACE PROCEDURE inscription_congrès (IN id_congres INT,IN  id_participant INT, IN dateIns DATE)
BEGIN
DECLARE v_count int;
DECLARE inscription_id INT;
SELECT COUNT(*) INTO v_count
FROM congres
WHERE congresid = id_congres
IF v_count = 0 THEN SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Erreur';
END IF;
SELECT COUNT(*) INTO v_count
FROM participant
WHERE congresid = id_congres
AND Participantid = id_participant ;
IF v_count = 0 THEN SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Erreur';
END IF;
IF dateInsc IS NULL THEN
SET dateInsc = CURDATE();
END IF
SELECT COUNT(*) INTO v_count
FROM inscription
WHERE congresid = id_congres
AND Participantid = id_participant ;
IF v_count > 0 THEN SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Erreur';
ELSE
SELECT IFNULL(MAX(Participantid), 0) INTO inscription
FROM inscription
WHERE congresid = id_congres;
INSERT INTO
	inscription (
		congresid,
		inscriptionid,
		personneid,
		dateinscription,
		etat
	)
VALUES
	(
		id_congresid,
		inscriptionid,
		id_participant
		CURDATE(),
		'VALIDE'
	);
SELECT v_id AS message;
END IF;
END
$$

DELIMITER;

--2.b
CALL inscription_congres(1, 1);
CALL inscription_congres(1, 1);

--3

SELECT nom, prenom , personne_id, COUNT(article_id)
FROM auteur
GROUP BY personneid,
nom,
prenom ;

--3b
DELIMITER
$$
CREATE
OR REPLACE FONCTION nb_articles(this_auteur_id) RETURNS INT
BEGIN
DECLARE
v_count INT;
SELECT
	COUNT(articleid) INTO v_count
FROM
	rediger
WHERE
	auteurid = this_auteurs_id;
RETURN v_count;
END
$$
DELIMITER;

--3c

SELECT nom, prenom , personne_id, CALL nb_articles(personnes_id)
FROM autheur


--4a
DELIMITER
$$
CREATE
OR REPLACE TRIGGER congres_date_insertion BEFORE
INSERT
	ON congres FOR EACH ROW
BEGIN
IF NEW.datedebut <= NEW.datefin THEN SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Erreur';
END IF
END
$$
DELIMITER;


--4b

DELIMITER
$$
CREATE
OR REPLACE TRIGGER congres_date_modification BEFORE
UPDATE
	ON congres FOR EACH ROW
BEGIN
IF NEW.datedebut <= NEW.datefin THEN SIGNAL SQLSTATE '45000'
SET
	MESSAGE_TEXT = 'Erreur';
END IF;
END
$$
DELIMITER;

--4c
INSERT INTO
	congres (
		domaineid,
		batimentid,
		nom,
		datedebut,
		datefin,
		prixSejourHT
	)
VALUES
	(
		1,
		12,
		'ICPR',
		'2025-12-31',
		'2025-01-01',
		751
	);
);
UPDATE
    congres
SET
    datedebut = '2025-01-01'
WHERE
    congresid = 1;
BEGIN


	congres (
		congresid,
		domaune,
		personneid,
		dateinscription,
		etat
	)
VALUES
	(
		id_congresid,
		inscriptionid,
		id_participant
		CURDATE(),
		'VALIDE'
	);
IF  datedebut < date session < datefin THEN SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Erreur';



--4d
ALTER TABLE
	congres
ADD
	CONSTRAINT chk_congres_date CHECK (datedebut >= datefin);

--5
$$
DELIMITER
CREATE
OR REPLACE TRIGGER trigg_date_session BEFORE
	ON session FOR EACH ROW
	INSERT
	DECLARE
	v_datedebut DATE;
	DECLARE
	v_datefin DATE;
	DECLARE
	CONTINUE HANDLER FOR NOT FOUND
	BEGIN
	SIGNAL SQLSTATE '45000'
	SET
		MESSAGE_TEXT = 'Erreur';
	END;
	SELECT
		datedebut,
		datefin INTO v_datedebut,
		v_datefin
	FROM
		congres
	WHERE
		congresid = NEW.congresid;
	IF DATE(NEW.datehrsession) NOT BETWEEN v_datedebut AND v_datefin THEN SIGNAL SQLSTATE '45000'
	SET
		MESSAGE_TEXT = 'Erreur';
	END IF;
	END
	$$

	$$
	DELIMITER
	CREATE
	OR REPLACE TRIGGER trigg_date_session BEFORE
		ON session FOR EACH ROW
		UPDATE
		DECLARE
		v_datedebut DATE;
		DECLARE
		v_datefin DATE;
		DECLARE
		CONTINUE HANDLER FOR NOT FOUND
		BEGIN
		SIGNAL SQLSTATE '45000'
		SET
			MESSAGE_TEXT = 'Erreur';
		END;
		SELECT
			datedebut,
			datefin INTO v_datedebut,
			v_datefin
		FROM
			congres
		WHERE
			congresid = NEW.congresid;
		IF DATE(NEW.datehrsession) NOT BETWEEN v_datedebut AND v_datefin THEN SIGNAL SQLSTATE '45000'
		SET
			MESSAGE_TEXT = 'Erreur';
		END IF;
		END
		$$


--6a
DELIMITER
$$
CREATE
OR REPLACE TRIGGER participant_insert BEFORE
INSERT
	ON participant FOR EACH ROW
BEGIN
INSERT INTO
	personne (nom, prenom, email)
VALUES
	(NEW.nom, NEW.prenom, NEW.email);
SET
	NEW.personneid = LAST_INSERT_ID();
END
$$

--6b
DELIMITER
$$
CREATE
OR REPLACE TRIGGER participant_insert BEFORE
UPDATE
	ON participant FOR EACH ROW
BEGIN
UPDATE
	personne
	SET
	nom = NEW.nom,
	prenom = NEW.prenom,
	email = NEW.email);
	WHERE
	personneid = OLD.personneid;
END
$$
DELIMITER;

--6c
DELIMITER
$$
CREATE
OR REPLACE TRIGGER participant_delete
AFTER
	DELETE ON participant FOR EACH ROW
BEGIN
DELETE FROM
	personne
WHERE
	personneid = OLD.personneid;
END
$$
DELIMITER;
	$$
	DELIMITER
	CREATE
	OR REPLACE TRIGGER trigg_date_session BEFORE
		ON session FOR EACH ROW
		UPDATE
		DECLARE
		v_datedebut DATE;
		DECLARE
		v_datefin DATE;
		DECLARE
		CONTINUE HANDLER FOR NOT FOUND
		BEGIN
		SIGNAL SQLSTATE '45000'
		SET
			MESSAGE_TEXT = 'Erreur';
		END;
		SELECT
			datedebut,
			datefin INTO v_datedebut,
			v_datefin
		FROM
			congres
		WHERE
			congresid = NEW.congresid;
		IF DATE(NEW.datehrsession) NOT BETWEEN v_datedebut AND v_datefin THEN SIGNAL SQLSTATE '45000'
		SET
			MESSAGE_TEXT = 'Erreur';
		END IF;
		END
		$$


--6a
DELIMITER
$$
CREATE
OR REPLACE TRIGGER participant_insert BEFORE
INSERT
	ON participant FOR EACH ROW
BEGIN
INSERT INTO
	personne (nom, prenom, email)
VALUES
	(NEW.nom, NEW.prenom, NEW.email);
SET
	NEW.personneid = LAST_INSERT_ID();
END
$$

--6b
DELIMITER
$$
CREATE
OR REPLACE TRIGGER participant_insert BEFORE
UPDATE
	ON participant FOR EACH ROW
BEGIN
UPDATE
	personne
	SET
	nom = NEW.nom,
	prenom = NEW.prenom,
	email = NEW.email);
	WHERE
	personneid = OLD.personneid;
END
$$
DELIMITER;

--6c
DELIMITER
$$
CREATE
OR REPLACE TRIGGER participant_delete
AFTER
	DELETE ON participant FOR EACH ROW
BEGIN
DELETE FROM
	personne
WHERE
	personneid = OLD.personneid;
END
$$
DELIMITER;


--6d

INSERT INTO participant (
    villeid, noemployeur, adresse, nom, prenom, email
)
VALUES (
    14522, 1, '17 bd heurteloup', 'DUPONT', 'Pierre', 'pierre.dupont@test.fr'
);


SELECT * FROM personne
WHERE email = 'pierre.dupont@test.fr';


UPDATE participant
SET nom = 'DURAND'
WHERE email = 'pierre.dupont@test.fr';


SELECT * FROM personne
WHERE email = 'pierre.dupont@test.fr';

DELETE FROM participant
WHERE email = 'pierre.dupont@test.fr';

SELECT * FROM personne
WHERE email = 'pierre.dupont@test.fr';
--7a

DELIMITER $$

CREATE OR REPLACE TRIGGER maj_nbArt_insert
AFTER INSERT ON rediger
FOR EACH ROW

    UPDATE auteur
    SET nbArt = nbArt + 1 
    WHERE personneid = NEW.auteurid; 
END $$

DELIMITER ;

DELIMITER $$

CREATE OR REPLACE TRIGGER maj_nbArt_delete
AFTER DELETE ON rediger
FOR EACH ROW
BEGIN

    UPDATE auteur
    SET nbArt = nbArt - 1 
    WHERE personneid = OLD.auteurid; 
END $$

DELIMITER ;

DELIMITER $$

CREATE OR REPLACE TRIGGER maj_nbArt_update
AFTER UPDATE ON rediger
FOR EACH ROW
BEGIN
    IF OLD.auteurid <> NEW.auteurid THEN
        UPDATE auteur
        SET nbArt = nbArt - 1
        WHERE personneid = OLD.auteurid;
        UPDATE auteur
        SET nbArt = nbArt + 1
        WHERE personneid = NEW.auteurid;
        
    END IF;
END $$

DELIMITER ;

--7c

SELECT personneid, nom, nbArt FROM auteur WHERE personneid = 1;

INSERT INTO rediger (auteurid, articleid) VALUES (1, 100);

SELECT personneid, nom, nbArt FROM auteur WHERE personneid = 1;

DELETE FROM rediger WHERE auteurid = 1 AND articleid = 100;

SELECT personneid, nom, nbArt FROM auteur WHERE personneid = 1;

-- Prérequis : On remet l'article à l'auteur 1
INSERT INTO rediger (auteurid, articleid) VALUES (1, 100);

-- Étape 1 : ACTION -> On change l'auteur (1 devient 2)
UPDATE rediger 
SET auteurid = 2 
WHERE auteurid = 1 AND articleid = 100;


SELECT personneid, nbArt FROM auteur WHERE personneid = 1;

SELECT personneid, nbArt FROM auteur WHERE personneid = 2;

--8a

DELIMITER
$$
CREATE
OR REPLACE TRIGGER presenter_insert BEFORE
INSERT
	ON presenter FOR EACH ROW
BEGIN
DECLARE
v_count INT;
SELECT
	COUNT(*) INTO v_count
FROM
	assister
WHERE
	participantid = NEW.participantid
	AND nosession = NEW.nosession;
IF v_count = 0 THEN SIGNAL SQLSTATE '45000'
SET
	MESSAGE_TEXT = 'Erreur';
END IF;
END
$$
CREATE
OR REPLACE TRIGGER presenter_update BEFORE
UPDATE
	ON presenter FOR EACH ROW
BEGIN
DECLARE
v_count INT;
SELECT
	COUNT(*) INTO v_count
FROM
	assister
WHERE
	participantid = NEW.participantid
	AND nosession = NEW.nosession;
IF v_count = 0 THEN SIGNAL SQLSTATE '45000'
SET
	MESSAGE_TEXT = 'Erreur';
END IF;
END
$$
DELIMITER;


-- ` ;` instead of `;`
INSERT INTO
	presenter (participantid, nosession)
VALUES
	(2, 1);



--8b
DELIMITER $$

CREATE OR REPLACE TRIGGER assister_delete
BEFORE DELETE ON assister 
FOR EACH ROW
BEGIN
    DECLARE v_count INT;

    SELECT COUNT(*) INTO v_count
    FROM presenter
    WHERE participantid = OLD.participantid
      AND nosession = OLD.nosession;
   IF v_count > 0 THEN 
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Erreur : Impossible de supprimer une personne qui présente un article';
    END IF;

END $$

CREATE OR REPLACE TRIGGER assister_update
BEFORE UPDATE ON assister 
FOR EACH ROW
BEGIN
    DECLARE v_count INT;

    SELECT COUNT(*) INTO v_count
    FROM presenter
    WHERE participantid = OLD.participantid 
      AND nosession = OLD.nosession;
  IF v_count > 0 THEN 
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Erreur : Ce participant présente dans cette session, il ne peut pas la quitter.';
    END IF;
END $$

DELIMITER ;

DELETE FROM assister
WHERE participantid = 1 AND nosession = 3;

UPDATE assister
SET nosession = 4
WHERE participantid = 1 AND nosession = 3;


--9

CREATE OR REPLACE TRIGGER session_insert
BEFORE INSERT ON session
FOR EACH ROW
BEGIN
    IF NEW.chairmanid IS NOT NULL THEN 
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Erreur : Impossible de définir un Chairman à la création de la session. Mettez NULL.';
    END IF;
END $$

CREATE OR REPLACE TRIGGER session_update
BEFORE UPDATE ON session
FOR EACH ROW
BEGIN
    DECLARE v_count INT;

  
    IF NEW.chairmanid IS NOT NULL THEN

        SELECT COUNT(*) INTO v_count
        FROM presenter
        WHERE participantid = NEW.chairmanid 
          AND nosession = NEW.nosession;     
        IF v_count = 0 THEN 
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Erreur : Ce participant ne présente aucun article dans cette session. Il ne peut pas être Chairman.';
        END IF;

    END IF;
END $$

--10a

DELIMITER $$

CREATE OR REPLACE PROCEDURE afficher_programme(
    IN p_congresid INT 
)
BEGIN
    DECLARE v_existe INT;

    SELECT COUNT(*) INTO v_existe
    FROM congres
    WHERE congresid = p_congresid;

    IF v_existe = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Erreur : Ce congrès n existe pas.';
    END IF;

SELECT
	(
		SELECT
			COUNT(*)
		FROM
			session
		WHERE
			congresid = p_congresid
	),
    SELECT 
        s.nosession AS "N° Session",
        DATE(s.datehrsession) AS "Date",    
        TIME(s.datehrsession) AS "Heure",   
        s.duree AS "Durée (min)",
        a.titre AS "Article Présenté",
        p.nom AS "Nom Chairman",
        p.prenom AS "Prénom Chairman"
    FROM session s
    JOIN article a ON s.articleid = a.articleid 
    LEFT JOIN participant part ON s.chairmanid = part.participantid
    LEFT JOIN personne p ON part.personneid = p.personneid
    
    WHERE s.congresid = p_congresid
    ORDER BY s.datehrsession ASC; 

END $$

DELIMITER ;

--10b
CALL afficher_programme(1); 

--11a
DELIMITER $$

CREATE OR REPLACE FUNCTION nb_sessions_congres(
    p_congresid INT
) 
RETURNS INT
READS SQL DATA
BEGIN
    DECLARE v_nb INT;

    SELECT COUNT(*) INTO v_nb
    FROM session
    WHERE congresid = p_congresid;
    RETURN v_nb;
END $$

DELIMITER ;

--11b

SELECT 
    congresid,
    nom,
    nb_sessions_congres(congresid) AS "Nombre de Sessions"
FROM congres
WHERE YEAR(datedebut) = 2025; 


--12a

DELIMITER $$

CREATE OR REPLACE FUNCTION formater_identite(
    p_personneid INT
) 
RETURNS VARCHAR(200)
READS SQL DATA
BEGIN
    DECLARE v_identite VARCHAR(200);

    SELECT CONCAT(UPPER(nom), ' ', prenom) INTO v_identite
    FROM personne
    WHERE personneid = p_personneid;

    RETURN v_identite;
END $$

DELIMITER ;

--12b

SELECT DISTINCT 
    formater_identite(p.personneid) AS "Participant"
FROM assister a
JOIN session s ON a.nosession = s.nosession
JOIN congres c ON s.congresid = c.congresid
JOIN participant part ON a.participantid = part.participantid
JOIN personne p ON part.personneid = p.personneid
WHERE c.nom = 'ICPR';


--13a

DELIMITER
$$
CREATE
OR REPLACE TRIGGER auteur_insert BEFORE
INSERT
	ON auteur FOR EACH ROW
BEGIN
INSERT INTO
	personne (nom, prenom, email)
VALUES
	(NEW.nom, NEW.prenom, NEW.email);
SET
	NEW.personneid = LAST_INSERT_ID();
END
$$
DELIMITER;


INSERT INTO
	auteur (telephone, nom, prenom, email)
VALUES
	(
		'1425789124',
		'AZERTY',
		'Stephane',
		'stephane.qwerty@univ-tours.fr'
	);
SELECT
	*
FROM
	personne
WHERE
	email = 'stephane.qwerty@univ-tours.fr';

	--13b
	DELIMITER $$

CREATE OR REPLACE TRIGGER auteur_update
BEFORE UPDATE ON auteur
FOR EACH ROW
BEGIN
    IF OLD.personneid <> NEW.personneid THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Interdit de modifier l ID de la personne !';
    END IF;
    UPDATE personne
    SET 
        nom = NEW.nom,
        prenom = NEW.prenom,
        email = NEW.email
    WHERE 
        personneid = OLD.personneid;

END $$

DELIMITER ;

--13c

DELIMITER $$

CREATE OR REPLACE TRIGGER auteur_delete
AFTER DELETE ON auteur
FOR EACH ROW
BEGIN
    DELETE FROM personne
    WHERE personneid = OLD.personneid; 
END $$

DELIMITER ;
