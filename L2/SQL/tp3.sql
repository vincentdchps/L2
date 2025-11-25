

--8 
SELECT p.libelle, prix, c.libelle,
	(
		SELECT
			AVG(prix)
		FROM
			produits p2
		WHERE
			p2.categorieId = p.categorieId
	) AS prix_moyen_cat
FROM
	produits p
	JOIN categories c ON p.categorieId = c.categorieId
WHERE
	prix > (
		SELECT
			AVG(prix)
		FROM
			produits p2
		WHERE
			p2.categorieId = p.categorieId )


--9 
SELECT c.nom,COUNT(DISTINCT c.commandeId) as nombre_commandes_vendues, SUM(prix * quantite) as total_ventes
FROM clients 
FROM clients c
	JOIN commandes co ON c.clientId = co.clientId
	JOIN detailscommandes d ON co.commandeId = d.commandeId
	JOIN produits p ON d.produitId = p.produitId
GROUP BY nom
ORDER by total_ventes DESC 
LIMIT 5 


--10 
SELECT c.nom ,MAX(dateCommande), DATEDIFF(CURDATE(), MAX(dateCommande)) as nb_jours_derniere_commande, COUNT(commandeId)
FROM clients c INNER JOIN commandes co ON c.clientId = co.clientID
GROUP BY nom 
HAVING
	DATEDIFF(CURDATE(), MAX(dateCommande)) >= 730
ORDER BY nb_jours_derniere_commande DESC

--11
SELECT c.libelle, MONTHNAME(dateCommande), YEAR(dateCommande), SUM(quantite* prix)
FROM categories c JOIN produits p ON c.categorieId = p.categorieId JOIN detailscommandes d ON p.produitId = d.produitId JOIN commandes co ON d.commandeId = co.commandeId
WHERE YEAR(dateCommande) = 2025
GROUP BY c.libelle, c.categorieId, MONTHNAME(dateCommande),YEAR(dateCommande);

--12


SELECT nom, COUNT(commandeId) ,DENSE_RANK() OVER( ORDER BY COUNT(commandeId) DESC )
FROM
	clients c
	JOIN commandes co ON c.clientId = co.clientId
GROUP BY
	nom
ORDER BY
	COUNT(commandeId) DESC


--13

SELECT nom, commandeId, dateCommande , ROW_NUMBER() OVER (PARTITION BY c.clientId	ORDER BY dateCommande)
FROM
	clients c
	JOIN commandes co ON c.clientId = co.clientId
ORDER BY
	nom,
	dateCommande;
    	
--14
SELECT libelle,c.commandeId,dateCommande,quantite, SUM(quantite) OVER (PARTITION BY p.produitId ORDER BY
			c.commandeId
	)
FROM produits p JOIN detailscommandes d ON p.produitId = d.produitId JOIN commandes c ON d.commandeId = c.commandeId
ORDER BY
	libelle,
	c.commandeId;

--15 
SELECT c.nom ,commandeId, CURDATE() , LAG(dateCommande, 1) OVER (
	PARTITION BY c.clientId
		ORDER BY
			dateCommande
	),
	LEAD(dateCommande, 1) OVER (
		PARTITION BY c.clientId
		ORDER BY
			dateCommande
	),
	DATEDIFF(
		dateCommande,
		LAG(dateCommande, 1) OVER (
			PARTITION BY c.clientId
			ORDER BY
				dateCommande
		)
	)
FROM
	clients c
	JOIN commandes co ON c.clientId = co.clientId
ORDER BY
	nom,
	dateCommande;
-- 16

SELECT *
FROM
	(
		SELECT
			c.libelle AS clibelle,
			p.libelle AS plibelle,
			SUM(quantite),
			DENSE_RANK() OVER (
				PARTITION BY c.libelle
				ORDER BY
					SUM(quantite) DESC
			) AS rang
		FROM
			categories c
			JOIN produits p ON c.categorieId = p.categorieId
			JOIN detailscommandes d ON p.produitId = d.produitId
		GROUP BY
			c.libelle,
			p.libelle
	) AS classement
WHERE
	rang <= 3
ORDER BY
	clibelle,
	rang;

--17
SELECT
	DISTINCT nom,
	FIRST_VALUE(dateCommande) OVER (
		PARTITION BY c.clientId
		ORDER BY
			dateCommande ROWS BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING
	),
	LAST_VALUE(dateCommande) OVER (
		PARTITION BY c.clientId
		ORDER BY
			dateCommande ROWS BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING
	),
	COUNT(commandeId) OVER (PARTITION BY c.clientId)
FROM
	clients c
	JOIN commandes co ON c.clientId = co.clientId;


//18 


-- 18
WITH chiffre_affaire AS (
	SELECT
		nom,
		Pays,
		SUM(quantite * prix) AS montant
	FROM
		clients c
		JOIN commandes co ON c.clientId = co.clientId
		JOIN detailscommandes d ON co.commandeId = d.commandeId
		JOIN produits p ON d.produitId = p.produitId
	GROUP BY
		nom,
		Pays
)
SELECT
	nom,
	Pays,
	montant,
	(
		SELECT
			AVG(montant)
		FROM
			chiffre_affaire
	)
FROM
	chiffre_affaire
WHERE
	montant > (
		SELECT
			AVG(montant)
		FROM
			chiffre_affaire
	);
-- 19

WITH tiers AS(
 select noms, pays
 FROM fournisseurs
 UNION 
 SELECT nom, pays
 FROM clients
)

SELECT pays, COUNT(*)
FROM tiers
GROUP BY pays 
ORDER BY pays

--20
WITH moyenne AS (
	SELECT
		p.libelle AS plibelle,
		prix,
		c.libelle AS clibelle,
		AVG(prix) OVER (PARTITION BY c.categorieId) AS moyen
	FROM
		produits p
		JOIN categories c ON p.categorieId = c.categorieId
)
SELECT
	plibelle,
	prix,
	clibelle,
	moyen
FROM
	moyenne
WHERE
	prix > moyen;

--21
