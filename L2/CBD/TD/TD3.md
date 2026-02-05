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

- Analyse du problème : La table actuelle n'est pas correcte (pas en 3FN) car il y a une "dépendance transitive". L'information de la Salle dépend du Club, et non directement de l'élève (Matricule). On a le chemin : Matricule -> Club -> Salle. Si on laisse comme ça, on répète la salle du club pour chaque élève, ce qui crée de la redondance.

- Solution : Il faut couper la table en deux pour séparer les sujets.

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

La clé primaire est NumE. La relation est en 1FN . Elle est en 2FN . Elle n'est PAS en 3FN car pas de dépendance transitive : NumE donne Département, et Département donne Bâtiment. Le bâtiment dépend du département, pas directement de l'employé.
