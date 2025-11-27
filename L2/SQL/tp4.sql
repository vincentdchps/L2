CREATE PROCEDURE inscription_congrès (IN id_congres INT,IN  id_participant INT)   
BEGIN 
DECLARE v_count int;
DECLARE v_id INT;

SELECT COUNT(*) INTO v_count 
FROM inscription
WHERE congresid = id_congres
AND participantid = id_participant ;
IF v_count > 0 THEN SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Erreur';
ELSE
SELECT IFNULL(MAX(inscriptionid), 0) + 1 INTO v_id 
FROM inscription
WHERE congresid = id_congres;
INSERT INTO
	inscription (
		congresid,
		inscriptionid,
		participantid,
		dateinscription,
		etat
	)
VALUES
	(
		id_congresid,
		v_id,
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
FROM autheur
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


