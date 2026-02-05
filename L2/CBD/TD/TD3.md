# TD 3 Dépendances Fonctionnelles (DF), DF élémentaire (DFE), Fermétude Transitive de DFE, Couverture Minimale de DFE, Graphe de DFE, Clés de relations (suite), Normalisation


## Exercice 1 : 

### Que signifie chaque DF?

- Matricule -> Nom, Age : Cela signifie que le numéro de matricule est unique pour chaque élève. Si on connaît le matricule, on connaît forcément le nom et l'âge de la personne.

- Matricule -> Club : Cela signifie qu'un élève est inscrit dans un seul club. Il ne peut pas avoir deux clubs en même temps.

- Club -> Salle : Cela signifie que chaque club est affecté à une salle précise et unique. Par exemple, le club Echecs est toujours en salle 12.

### Quelle(s) est(sont) la(les) clé(s) de la relation?.

- La clé est l'attribut qui permet de retrouver toutes les autres informations de la table. Ici, c'est le Matricule. Démonstration :

- Si j'ai le Matricule, j'obtiens le Nom et l'Age .

- Si j'ai le Matricule, j'obtiens le Club .

- Une fois que j'ai le Club, j'obtiens la Salle (règle 3). Conclusion : Avec le Matricule, j'ai accès à toute la ligne. C'est donc la clé primaire.

### Mettre ces informations dans un ensemble de schémas de relations en 3FN.

 La table actuelle n'est pas correcte car il y a une dépendance transitive. L'information de la Salle dépend du Club, et non directement de l'élève. On a le chemin : Matricule -> Club -> Salle, crée une redondance. Il faut donc diviser en table

- Table 1 : ELEVE Elle contient les infos directes de l'étudiant.

    - Matricule (PRIMARY KEY)
    
    - Nom
    
    - Age

    - Club (FOREIGN KEY)

- Table 2 : ACTIVITE Elle contient les infos propres au club.

    - Club (PRIMARY KEY)
    
    - Salle


## Exercice 2 : 

### Identification des Dépendances Fonctionnelles (DF) :


- Cours donne Module. Donc dans les règles où "Module" est à gauche avec "Cours", "Module" ne sert à rien


- Mle-Etud -> Nom-Etud, Classe

- No-Ens -> Nom-Ens

- Cours -> Module, Nb-h

- Classe, Cours -> No-Ens

- Mle-Etud, Cours -> Note

### 2. Quelle(s) est(sont) la(les) clé(s) de la relation?

- Mle-Etud nous donne Nom-Etud et Classe.

- Cours nous donne Module et Nb-h.

- Avec No-Ens, on obtient Nom-Ens.

- Avec Mle-Etud et Cours, on obtient la Note.

- La clé primaire est donc (Mle-Etud, Cours).

### 3. Normalier la relation en 3FN

- Table ETUDIANT 

    - Mle-Etud (PRIMARY KEY)
    
    - Nom-Etud
    
    - Classe

- Table MATIERE 

    - Cours (PRIMARY KEY)
    
    - Module
    
    - Nb-h

- Table ENSEIGNANT 
  
    - No-Ens (PRIMARY KEY)
    
    - Nom-Ens

- Table AFFECTATION 

    - Classe (PRIMARY KEY)
    
    - Cours (PRIMARY KEY)
    
    - No-Ens (FOREIGN KEY)

- Table BULLETIN 

    - Mle-Etud (PRIMARY KEY)
    
    - Cours (PRIMARY KEY)
    
    - Note

## Exercice 3.
### Soit la relation suivante (auto-explicative) qui concerne les employés d'une société implantée sur plusieurs bâtiments?
### 1. Déterminer les dépendances fonctionnelles (voir TD1).

NumE -> Nom, Salaire, Département Un employé est identifié par son numéro ; il a un seul nom, un seul salaire et travaille dans un seul département.

Département -> Bâtiment Un département est localisé dans un seul bâtiment spécifique.

### 2. En quelle FN elle est?

La clé primaire est NumE. La relation est en 1FN . Elle est en 2FN . Elle n'est PAS en 3FN car il y a une dépendance transitive, NumE donne Département, et Département donne Bâtiment. Le bâtiment dépend du département, pas directement de l'employé.

- Table 1 : EMPLOYE

    - NumE (PRIMARY KEY)
    
    - Nom
    
    - Salaire
    
    - Département (FOREIGN KEY)

- Table 2 : LIEU_TRAVAIL

- Département (PRIMARY KEY)

- Bâtiment

## Exercice 4 

### Déterminer les dépendances fonctionnelles

NumCom -> DateCom, NumCli. Une commande a une date unique et appartient à un seul client.

NumCli -> AdrCli. Un client réside à une seule adresse.

NumProd -> Prix. Un produit a un prix unique. 

NumCom, NumProd -> Qte. La quantité dépend de la commande et du produit.

### Quelle(s) est (sont) la (les) clé(s) de cette relation ?

La clé est le couple (NumCom, NumProd). NumCom -> DateCom, NumCli. NumCli -> AdrCli. NumProd -> Prix. (NumCom, NumProd) -> Qte. On a donc tous les attributs avec ce couple.

### En quelle forme normale elle est ?

Elle est en 1FN car les attributs sont atomiques. Elle n'est pas en 2FN. Certains attributs non-clés dépendent seulement d'une partie de la clé. NumCom -> DateCom, NumCli (dépendance partielle). NumProd -> Prix (dépendance partielle). Pour être en 2FN, tout doit dépendre du couple (NumCom, NumProd) entier.

### La mettre en 3FN le cas échéant

Il faut décomposer pour supprimer les dépendances partielles.

- Table CLIENT
    -  NumCli (PRIMARY KEY)
    -  AdrCli

- Table COMMANDE
    -  NumCom (PRIMARY KEY)
    -  DateCom
    -   NumCli (FOREIGN KEY)

- Table PRODUIT
- NumProd (PRIMARY KEY)
- Prix

- Table LIGNE_COMMANDE
-  NumCom (Clé partielle)
-  NumProd (Clé partielle )
-  Qte

## Exercice 5

### Déterminer les dépendances fonctionnelles

NoFilm -> TitreFilm, DuréeFilm. Un numéro de film permet de retrouver son titre et sa durée.

NoSalle -> CapacitéSalle. Une salle a une capacité fixe définie.

TypePlace -> PrixPlace. Le prix est déterminé uniquement par le type de place (étudiant, normal, etc.).

NoSalle, DateProjection, HeureDeb -> NoFilm. Pour une salle donnée, à une date et une heure précises, il n'y a qu'un seul film projeté.

### Quelle(s) est (sont) la (les) clé(s) de cette relation ?

La clé est l'ensemble (NoSalle, DateProjection, HeureDeb, TypePlace).

- (NoSalle, DateProjection, HeureDeb) permet d'identifier la séance et donc le NoFilm, qui donne ensuite TitreFilm et DuréeFilm.
- NoSalle permet d'avoir CapacitéSalle
- TypePlace permet d'avoir PrixPlace.

Il faut ajouter TypePlace à la clé de la séance pour pouvoir déterminer le prix unique associé à cette ligne.

### En quelle forme normale elle est ?

Elle est en 1FN. Elle n'est pas en 2FN car il y a des dépendances partielles :
- NoFilm dépend d'une partie de la clé (NoSalle, DateProjection, HeureDeb).
- CapacitéSalle dépend d'une partie de la clé (NoSalle).
- PrixPlace dépend d'une partie de la clé (TypePlace).

Pour être en 2FN, les attributs non-clés devraient dépendre de la totalité de la clé composée.

### La mettre en 3FN le cas échéant

Il faut décomposer pour séparer les entités indépendantes.

- Table FILM
    - NoFilm (PRIMARY KEY)
    - TitreFilm
    - DuréeFilm

- Table SALLE
    - NoSalle (PRIMARY KEY)
    - CapacitéSalle

- Table TARIF
    - TypePlace (PRIMARY KEY)
    - PrixPlace

- Table SEANCE
    - NoSalle (PRIMARY KEY, FOREIGN KEY)
    - DateProjection (PRIMARY KEY)
    - HeureDeb (PRIMARY KEY)
    - NoFilm (FOREIGN KEY)


## Exercice 6

### Donner la liste des attributs nécessaires et dire quelles sont les dépendances fonctionnelles
NumCli -> Nom, Solde. Un client possède un nom et un solde uniques.

NumCom -> DateCom, NumCli, AdrLiv. Une commande a une date, un client et une adresse de livraison uniques.

NumProd -> Nom, QteStock, SeuilMin. Un produit a des caractéristiques uniques.

NumFourn -> Nom, Adr. Un fournisseur a un nom et une adresse uniques.

NumCom, NumProd -> Qte. La quantité commandée dépend de la commande et du produit.

NumProd, NumFourn -> Prix. Le prix d'achat dépend du produit et du fournisseur.

### En déduire un schéma de relations en 3FN

Il faut décomposer pour respecter la 3FN et gérer les listes (adresses, fournisseurs).

- Table CLIENT

    - NumCli (PRIMARY KEY)
    
    - Nom
    
    - Solde

- Table ADRESSE_CLIENT

    - NumCli (PRIMARY KEY, FOREIGN KEY)
    
    - Adresse (PRIMARY KEY)

- Table COMMANDE

    - NumCom (PRIMARY KEY)
    
    - DateCom
    
    - AdrLiv
    
    - NumCli (FOREIGN KEY)

- Table PRODUIT

    - NumProd (PRIMARY KEY)
    
    - Nom
    
    - QteStock
    
    - SeuilMin

- Table FOURNISSEUR
    
    - NumFourn (PRIMARY KEY)
    
    - Nom
    
    - Adr

- Table DETAIL_COMMANDE

    - NumCom (PRIMARY KEY, FOREIGN KEY)
    
    - NumProd (PRIMARY KEY, FOREIGN KEY)
    
    - Qte

- Table APPROVISIONNEMENT

    - NumProd (PRIMARY KEY, FOREIGN KEY)
    
    - NumFourn (PRIMARY KEY, FOREIGN KEY)
    
    - Prix
