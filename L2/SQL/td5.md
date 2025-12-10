
---
Question 1-1

```sql
DELIMITER $$

CREATE TRIGGER supprLigne
AFTER DELETE ON detailCommande
FOR EACH ROW
BEGIN
    DECLARE mtCde DECIMAL(16, 2) DEFAULT 0;
    DECLARE nbLignesRestantes INT DEFAULT 0;

    -- 1. Compter combien de lignes restent pour cette commande
    -- Note : Comme on est en AFTER DELETE, la ligne supprimée n'existe déjà plus dans la table.
    SELECT COUNT(*) INTO nbLignesRestantes
    FROM detailCommande
    WHERE noCommande = OLD.noCommande;

    -- 2. Si plus aucune ligne, on supprime la commande mère
    IF nbLignesRestantes = 0 THEN
        DELETE FROM commande
        WHERE noCommande = OLD.noCommande;
    ELSE
        -- 3. Sinon, on recalcule le montant total de la commande
        -- Utilisation de IFNULL pour éviter les erreurs si un prix est vide
        SELECT SUM(IFNULL(prixUnitaire, 0) * IFNULL(qteCommande, 0)) 
        INTO mtCde
        FROM detailCommande
        WHERE noCommande = OLD.noCommande;

        -- Mise à jour de la commande
        UPDATE commande
        SET montantTotal = mtCde
        WHERE noCommande = OLD.noCommande;
    END IF;

    -- 4. Remise en stock de l'article (toujours effectué)
    -- On utilise OLD.qteCommande car c'est la valeur qui vient d'être supprimée
    UPDATE article
    SET qteStock = qteStock + OLD.qteCommande
    WHERE refArticle = OLD.refArticle;

END $$

DELIMITER ;

````

---
Question 1-2

```sql
DELIMITER $$

CREATE TRIGGER modifLigne
BEFORE UPDATE ON detailCommande -- "BEFORE" est nécessaire pour modifier NEW.prixUnitaire
FOR EACH ROW
BEGIN
    DECLARE pu DECIMAL(10,2);

    -- 1. Vérification : On empêche le changement de numéro de commande (intégrité)
    IF NEW.noCommande <> OLD.noCommande THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Il est interdit de modifier la valeur de la clé étrangère noCommande';
    END IF;

    -- 2. Récupération et correction du Prix Unitaire
    -- L'énoncé dit : "Le prixUnitaireVente doit correspondre au prixUnitaire de l'article"
    SET pu = NULL;
    SELECT prixUnitaire INTO pu
    FROM article
    WHERE refArticle = NEW.refArticle;

    IF pu IS NOT NULL THEN
        SET NEW.prixUnitaire = pu; -- On force le bon prix dans la nouvelle ligne
    END IF;

    -- 3. Mise à jour du Stock (Table Article)
    -- Logique : On remet l'ancienne quantité en rayon (+ OLD) et on retire la nouvelle (- NEW)
    UPDATE article
    SET qteStock = qteStock + OLD.qteCommande - NEW.qteCommande
    WHERE refArticle = NEW.refArticle;

    -- 4. Mise à jour du Montant Total (Table Commande)
    -- Logique : On soustrait l'ancien montant de la ligne et on ajoute le nouveau calculé
    UPDATE commande
    SET montantTotal = montantTotal 
                       - (OLD.qteCommande * OLD.prixUnitaire) 
                       + (NEW.qteCommande * NEW.prixUnitaire)
    WHERE noCommande = NEW.noCommande;

END $$

DELIMITER ;
```


---
Question 2-1a

```sql

DELIMITER $$

CREATE FUNCTION nbJoursTotalPondere (noPrj INT) RETURNS DECIMAL(10, 2)
DETERMINISTIC -- Bonnes pratique pour les fonctions de lecture
BEGIN
    DECLARE duree TacheDuree INT; -- Variable tampon pour le curseur
    DECLARE nbJoursTotal DECIMAL(10, 2) DEFAULT 0; -- IMPORTANT : Initialiser à 0
    DECLARE fin BOOLEAN DEFAULT FALSE;

    -- Déclaration du curseur pour parcourir les tâches du projet
    DECLARE curTache CURSOR FOR
        SELECT dureeJour
        FROM tache
        WHERE noProjet = noPrj;

    -- Gestionnaire de fin de curseur
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = TRUE;

    OPEN curTache;

    boucle_tache: LOOP
        FETCH curTache INTO duree;
        
        IF fin THEN
            LEAVE boucle_tache;
        END IF;

        -- Logique de pondération
        IF duree > 20 THEN
            SET nbJoursTotal = nbJoursTotal + (duree * 1.1);
        ELSE
            SET nbJoursTotal = nbJoursTotal + duree;
        END IF;
    END LOOP;

    CLOSE curTache;

    RETURN nbJoursTotal;
END $$

DELIMITER ;
```


---
Question 2-1b

```sql 
SELECT 
    nom, 
    datedebut, 
    datefin, 
    coutglobal, 
    nbJoursTotalPondere(noProjet) AS nbJoursPondere -- Appel de la fonction créée
FROM projet
WHERE YEAR(datedebut) = 2025; -- Filtre sur l'année
```

---
Exercice 2-2a

```sql
DELIMITER $$

CREATE PROCEDURE majNomPrenomIntervenant()
BEGIN
    -- Variables pour les compteurs
    DECLARE nbSalaries INT DEFAULT 0;
    DECLARE nbIndependant INT DEFAULT 0;
    DECLARE nbIntervenantsTotal INT DEFAULT 0;

    -- Variables pour parcourir le curseur
    DECLARE v_intervID INT;
    DECLARE v_nom VARCHAR(100);
    DECLARE v_prenom VARCHAR(100);
    
    DECLARE fin BOOLEAN DEFAULT FALSE;

    -- Curseur sur TOUS les intervenants
    DECLARE curIntervenant CURSOR FOR
        SELECT intervenantId, nom, prenom FROM intervenant;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = TRUE;

    -- Compter le total avant de commencer (pour l'affichage final)
    SELECT COUNT(*) INTO nbIntervenantsTotal FROM intervenant;

    OPEN curIntervenant;

    boucle_sync: LOOP
        FETCH curIntervenant INTO v_intervID, v_nom, v_prenom;

        IF fin THEN
            LEAVE boucle_sync;
        END IF;

        -- Vérifier si c'est un salarié
        IF EXISTS (SELECT 1 FROM salarie WHERE intervenantId = v_intervID) THEN
            UPDATE salarie 
            SET nom = v_nom, prenom = v_prenom 
            WHERE intervenantId = v_intervID;
            
            SET nbSalaries = nbSalaries + 1;

        -- Sinon, vérifier si c'est un indépendant
        ELSEIF EXISTS (SELECT 1 FROM independant WHERE intervenantId = v_intervID) THEN
            UPDATE independant 
            SET nom = v_nom, prenom = v_prenom 
            WHERE intervenantId = v_intervID;
            
            SET nbIndependant = nbIndependant + 1;

        -- Sinon, ce n'est ni l'un ni l'autre : LOG
        ELSE
            INSERT INTO logsInterv (intervenantId, nom, prenom, dateLog)
            VALUES (v_intervID, v_nom, v_prenom, NOW());
        END IF;

    END LOOP;

    CLOSE curIntervenant;

    -- Affichage du bilan
    SELECT 
        nbSalaries AS "Salariés mis à jour", 
        nbIndependant AS "Indépendants mis à jour", 
        nbIntervenantsTotal AS "Total Intervenants traités";
END $$

DELIMITER ;
```

---
Question 3

```sql
DELIMITER $$

CREATE TRIGGER majIntervenantFromSalarie
AFTER UPDATE ON salarie
FOR EACH ROW
BEGIN
    -- On vérifie si le nom ou le prénom a changé pour éviter des updates inutiles
    IF (NEW.nom <> OLD.nom OR NEW.prenom <> OLD.prenom) THEN
        UPDATE intervenant
        SET nom = NEW.nom, prenom = NEW.prenom
        WHERE intervenantId = OLD.intervenantId; -- On utilise l'ID pour retrouver le père
    END IF;
END $$

DELIMITER ;
```

---
Question 4

```sql
DELIMITER $$

CREATE TRIGGER checkChefProjet
BEFORE UPDATE ON projet
FOR EACH ROW
BEGIN
    -- Si le chef de projet change
    IF NEW.intervenantId <> OLD.intervenantId THEN
        -- On vérifie s'il existe dans la table PARTICIPER pour ce projet
        IF NOT EXISTS (
            SELECT 1 
            FROM participer 
            WHERE noProjet = NEW.noProjet 
            AND intervenantId = NEW.intervenantId -- Ici NEW.intervenantId est le chef de projet (c'est une FK implicite selon le MCD)
        ) THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Erreur : Le chef de projet doit être un participant du projet.';
        END IF;
    END IF;
END $$

DELIMITER ;
```

---
question 5 

```sql 
DELIMITER $$

CREATE TRIGGER checkExclusionSalarie
BEFORE INSERT ON salarie
FOR EACH ROW
BEGIN
    -- On regarde si cet ID existe déjà dans la table INDEPENDANT
    IF EXISTS (SELECT 1 FROM independant WHERE intervenantId = NEW.intervenantId) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Erreur : Cet intervenant est déjà enregistré comme Indépendant.';
    END IF;
END $$

DELIMITER ;
```

---
Question 6

```sql
DELIMITER $$

CREATE TRIGGER archivageProjet
BEFORE DELETE ON projet
FOR EACH ROW
BEGIN
    -- 1. Archiver le projet
    INSERT INTO projethisto (noProjet, nom, datedebut, datefin, coutglobal)
    VALUES (OLD.noProjet, OLD.nom, OLD.datedebut, OLD.datefin, OLD.coutglobal);

    -- 2. Archiver les tâches liées à ce projet
    -- On insère en masse toutes les tâches correspondant au projet supprimé
    INSERT INTO tachehisto (noTache, noProjet, nophase, noordre, designation, dureejour)
    SELECT noTache, noProjet, nophase, noordre, designation, dureejour
    FROM tache
    WHERE noProjet = OLD.noProjet;

    -- Note : Pas besoin de DELETE les tâches de la table originale ici,
    -- le SGBD le fera probablement via la contrainte ON DELETE CASCADE si elle est configurée.
    -- Sinon, il faudrait les supprimer manuellement après l'archivage.
END $$

DELIMITER ;
```

