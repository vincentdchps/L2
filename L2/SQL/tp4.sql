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