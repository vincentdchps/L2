CREATE
OR REPLACE PROCEDURE inscription_congrès (IN id_congres INT,IN  id_participant INT, IN dateIns INT)
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
SET dateIns = CURDATE();
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

