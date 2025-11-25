
//1

    SELECT
     DISTINCT c.nom 
    FROM captage c INNER JOIN analyseeau a ON c.captageId = a.captageId
    WHERE a.dateAnalyse BETWEEN '2018-01-01' AND '2018-12-31'
    AND c.nom LIKE '%AAC%'
    ORDER BY c.nom ;

//2

SELECT DISTINCT re.reservoirId, re.capaciteMax 
FROM reservoir re INNER JOIN analyseeau a ON re.reservoirId = a.reservoirId 
INNER JOIN releve r ON a.analyseeauId = r.analyseeauId 
INNER JOIN substance s ON r.substanceId = s.substanceId
WHERE re.typeReservoir = 'enterre' AND re.capaciteMax > 15000 AND s.libelle ='nitrates' and r.qteReleve > 20

//3 
SELECT DISTINCT c.nom 
FROM captage c INNER JOIN analyseeau a ON c.captageId = a.captageId
INNER JOIN releve r ON a.analyseeauId = r.analyseeauId 
INNER JOIN substance s ON r.substanceId = s.substanceId
WHERE c.nom LIKE 'AAC%' AND s.libelle ='Atrazine' AND r.qteReleve < 0.065 AND a.dateAnalyse BETWEEN '2019-01-01'
AND '2019-12-31'

//4

SELECT t.nom, t.prenom, a.dateAnalyse, c.nom 
from technicien t INNER JOIN analyseeau a ON t.technicienId = a.technicienId INNER JOIN captage c ON a.captageId = c.captageId 
WHERE a.reservoirId IN ( SELECT a.reservoirId
FROM
			analyseeau a
			INNER JOIN technicien t ON a.technicienId = t.technicienId
		WHERE
			t.nom = 'LABAT'
			AND t.prenom = 'ALEXANDRA')
            AND NOT (t.nom = 'LABAT' AND t.prenom = 'ALEXANDRA');

//5

SELECT c.nom COUNT (a.analyseeauId)
FROM
	captage c
	INNER JOIN analyseeau a ON c.captageId = a.captageId
GROUP BY
	c.nom
HAVING
	COUNT(a.analyseEauId) < 3;


//6

SELECT
	libelle
FROM
	substance
WHERE
	substanceId NOT IN (
		SELECT
			DISTINCT substanceId
		FROM
			releve
	); 

//7

SELECT
	s.libelle,
	r.qteReleve,
	s.qteMax,
	a.dateAnalyse
FROM
	substance s
	LEFT JOIN releve r ON s.substanceId = r.substanceId
	LEFT JOIN analyseeau a ON r.analyseEauId = a.analyseEauId
ORDER BY
	s.libelle;

//8

SELECT MONTH(a.dateAnalyse), AVG(r.qteReleve)
FROM
	releve r
	INNER JOIN substance s ON r.substanceId = s.substanceId
	INNER JOIN analyseeau a ON r.analyseEauId = a.analyseEauId
	INNER JOIN reservoir re ON a.reservoirId = re.reservoirId
WHERE
	s.libelle = 'Nitrates'
	AND a.dateAnalyse BETWEEN '2019-01-01' AND '2019-12-31'
	AND re.typeReservoir = 'enterré'
	AND re.capaciteMax < 20000
GROUP BY
	MONTH(a.dateAnalyse)
ORDER BY
	1;

//9

SELECT t.nom, t.prenom, COUNT(*)
FROM technicien t INNER JOIN analyseeau a ON t.technicienId = a.technicienId
GROUP BY t.nom, t.prenom 
HAVING COUNT(*) >= ALL ( SELECT COUNT(*)
FROM analyseeau 
GROUP BY technicienId
)

//10
SELECT
	s.libelle,
	COUNT(r.analyseEauId)
FROM
	substance s
	INNER JOIN releve r ON s.substanceId = r.substanceId
GROUP BY
	s.libelle
HAVING
	COUNT(r.analyseEauId) <= ALL (
		SELECT
			COUNT(r.analyseEauId)
		FROM
			substance s
			INNER JOIN releve r ON s.substanceId = r.substanceId
		GROUP BY
			s.substanceId
	);

    //11

    SELECT
	r.nom,
	COUNT(DISTINCT a.technicienId)
FROM
	reservoir r
	INNER JOIN analyseeau a ON r.reservoirId = a.reservoirId
WHERE
	r.typeReservoir = 'enterré'
	AND a.dateAnalyse BETWEEN '2018-07-01' AND '2018-12-31'
GROUP BY
	r.reservoirId,
	r.nom;


    -- 21
ALTER TABLE
	technicien
ADD
	telephone VARCHAR(20);
ALTER TABLE
	technicien
ADD
	email VARCHAR(100);
ALTER TABLE
	technicien
ADD
	CONSTRAINT chk_technicien_email CHECK (
		email IS NULL
		OR email LIKE '%@%'
	);
-- 22
ALTER TABLE
	analyseeau
ADD
	commentaire VARCHAR(250) NULL;
-- 23
CREATE INDEX idx_technicien_nom_prenom ON technicien(nom, prenom);