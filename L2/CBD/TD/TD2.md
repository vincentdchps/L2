# Dépendances Fonctionnelles (DF), Axiomes d'Armstrong, DF élémentaire (DFE), Fermétude Transitive de DFE, Couverture Minimale de DFE, Graphe de DFE, Clés de relation

## Exercice 1.
### L'axiome de pseudo-transitivité nous dit que si X −→ Y et YW −→ Z, alors XW −→ Z. Démontrer cet axiome à l'aide des autres axiomes d'Armstrong

- X->Y alors XW->YW (accroissement)
- XW->YW et YW->Z alors XW->Z (transitivité)

## Exercice 2.
### En utilisant les axiomes d'Armstrong, démontrer que si X −→ Y Z et Z −→ CW alors X −→ YZC.

- Z->CW alors Z->CWZ (accroissement)
- Z->CWZ alors YZ->CWZY (accroissement)
- X->YZ et YZ->CWZY donc X->CWZY(transitivité)
- X->CWZY donc X->CZY (projectivité)

## Exercice 3.
### Soit R(A,B,C,D,E,G,H) F = {AB −→ C,B −→ D,CD −→ E,CE −→ GH,G −→ A}. En utilisant les axiomes d'Armstrong, montrer que l'on peut déduire de cet ensemble :

### 1. AB −→E;

- B-> D donc AB -> D par augmentation
- AB -> C et AB -> D donc AB -> CD par union
- AB -> CD et CD -> E donc AB -> E par transitivité.

### 2. BG−→C;

- G -> A donc BG -> A par augmentation
- BG -> BG donc BG -> B par projection,
- BG -> A et BG -> B donc BG -> AB par union,
- BG -> AB et AB -> C donc BG -> C par transitivité.

### 3.AB −→G.

- AB -> C et AB-> E donc AB -> CE par union,
- CE -> GH donc AB -> GH par transitivité
- AB -> GH donc AB -> G par projection

  
## Exercice 4.

### Soit la relation R(A,B,E,G,H,I,J) avec les Dfs F = {AB −→ E,AG −→ J,BE −→ I,E −→ G,GI −→ H}. En utilisant les axiomes d'Armstrong, montrer que l'on peut déduire de cet ensemble :

### 1. ABG -> EGJ

- AB - > E donc ABG -> EG par augmentation ,
- AG - > J donc ABG -> GJ par additivité,
- ABG -> EGJ par union

### 2. AB -> GH

- AB -> E et E -> G, par transitivité AB -> G
- AB -> E, par augmentation AB -> BE
- AB -> BE et BE -> I, par transitivité AB -> I
- AB -> G et AB -> I, par union AB -> GI
- AB -> GI et GI -> H, par transitivité AB -> H
- AB *> G et AB *> H, par union AB ->GH

### BE −→H 

- E -> G donc BE -> G par augmentation 
- BE -> G et BE -> I donc BE -> GI par union 
- BE -> GI et GI -> H donc BE -> H par transitivité


## Exercice 5.

### 1. ABC −→E

- AB -> C donc ABC -> CC par augmentation et donc ABC -> C
- B -> D donc AB -> AD par augmentation et AB -> D par décomposition
- AB -> D et ABC -> C donc ABC -> CD par union
- ABC -> CD et CD -> E donc ABC -> E par transitivité

### 2. BG -> C

- G -> A donc BG -> AB par augmentation
- BG -> AB et AB -> C donc BG -> C par transitivité

### 3. BG−→GH

- B -> D donc BG -> D
- BG -> C et BG -> D donc BG -> CD
- CD -> E donc CD -> CE
- BG -> CD et CD -> CE donc BG -> CE

### 4. GBCE −→GH;

- G -> A donc GB ->AB
- GB -> AB et AB -> C donc GB -> C
- GB -> C et CD ->E donc GBC -> E
- GBC -> E donc GBCE -> CE
- GBCE -> CE et CE -> GH donc GBCE -> GH

### 5. AB −→GH.

- B -> D donc AB -> D
- AB -> D et AB -> C donc AB -> CD
- CD -> E donc CD -> CE
- AB -> CD et CD -> CE donc AB -> CE
- AB -> CE et CE -> GH donc AB -> GH

# 2 Propriétés des Dépendances Fonctionnelles

## Exercice 6 

### Soit la relation R(A,B,C,D,E,F) avec les Dfs F = {A −→ BC,E −→ CF,B −→ E,CD −→ EF}. Calculer la fermeture {A,B}+ de l'ensemble des attributs {A,B} pour cet ensemble de Df F.

- Etape 0 : {A, B}

-   Etape 1 :
      -  A - > BC donc { A, B, C}
      - E -> CF donc { A, B, C }
      -  B -> E donc { A, B, C , E}
      -  CD -> EF donc { A, B, C , E}
 
- Etape 2 :
   - E -> CF donc { A, B, C , E, F}
   - CD -> EF donc { A, B, C , E, F}
 
$$\{A, B}^+ = \{A, B, C, E, F\}$$


## Exercice 7 

### Soit la relation R(A,B,C,D,E,F,G) avec les Dfs F = {AC −→ B,BC −→ DE,AEF −→ G} Calculer la fermeture {A,C}+ de l'ensemble des attributs {A,C} pour cet ensemble de Df F.

- Etape 0 : {A, C}
  
- Etape 1 :
    - AC -> B donc { A,B,C}
    - BC -> DE donc { A, B, C , D , E }
    - AEF -> G donc { A, B, C , D , E }
 
  $$\{A, C\}^+ = \{A, B, C, D, E\}$$

  ## Exercice 8

  ### Soit la relation R(A,B,C,D,E) avec les Dfs F = {A −→ CD,C −→ BDE,D −→ CE} 1. Donner deux couvertures minimales de F

 - Etape 1 : Decomposition de F
    - A -> C
    - A -> D
    - C -> B
    - C -> D
    - C -> E
    - D -> C
    - D -> E

- Etape 2 : Rechercher redondance
    - On a A -> C et C -> D donc A -> D inutile
    - On a A -> D et D -> C donc A -> C inutile
    - On a C -> et D -> E donc C -> E inutile
    - On a D -> C et -> C-> E donc D -> E inutile

- Solution 1 : Chemin par C 
    - On garde A-> C et on supprime A-> D , retrouvable via A-> C -> D
    - On garde C -> E et on supprime D -> E ,retrouvable via D-> C -> E
    -  Couverture minimale 1 : { A -> C , C-> B , C -> D , C -> E, D -> C}

- Solution 2 : Chemin par D
  - On garde A -> D et on supprime A -> C , retrouvable via A -> D -> C
  - On garde D -> E et on supprime C -> E , retrouvable via C-> D -> E
  -  Couverture minimale 2 : { A -> D, C -> B, C -> C -> D , D-> C, D -> E}

## Exercice 9.

### Soit la relation R(A,B,C,D) avec les Dfs F = {A −→ B,AB −→ CD} 1. Produisez une couverture minimale pour F ;

- Etape 1 : atomisation :
  - A -> B
  - AB -> CD devient deux règles : AB -> C et AB -> D 
 
- Etape  2 : Supresssion attributs étranger
  - AB -> C et A -> B donc A -> C (car A détermine B)
  - AB -> D et A -> B donc A -> D
  - Couvertur minimale { A -> B , A-> C , A -> D }
 
### 2. Quelles sont les clés candidates de la relation R?.

L'attribut A n'apparait jamais à droite donc c'est forcément lui qui détermine tout : 

$A^+ = \{A, B, C, D\}$

## Exercice 10 
### Soit la relation R(A,B,C,D) avec les Dfs F = {A −→ B,B −→ C,C −→ B,A −→ C} 1. Produisez une couverture minimale pour F ;

- Etape 1 : Décomposition de F :
  - A -> B
  - B -> C
  - C -> B
  - A -> C
 
- Etape 2 : Chercher redondance :
  - A -> B et C -> B donc A -> C inutile
  - A -> C et C -> B donc A -> B inutile 
  - Couverture minimale 1 : { B -> C , C -> B , A -> C }
  - Couverture minimale 2 : { A -> B , B -> C , C -> B }
 

## Exercice 11
### Soit la relation R(A,B,C,D) avec les Dfs F = {A −→ B,B −→ A,B −→ C,A −→ C} 1. Produisez une couverture minimale pour F ;


- Etape 1 : atomisation
  - A -> B
  - B -> A
  - B -> C
  - A -> C
 
- Etape 2 : Recherche redondance
  - On a A -> B et B -> C donc A -> C inutile
  - On a B -> A et A -> C donc B -> C inutile
  - Couverture minimale 1 : { A-> B ,B -> A , B -> C }
  - Couverture minimale 2 : { A-> B ,B -> A , A -> C }


### 2. La dépendance AB −→ C est-elle pleine?

Une DF X -> Y est pleine si Y dépend de tout X , et pas seulement d'une partie de X.
On a A -> C et B -> C donc non C ne dépend pas de tout AB. 
Dépendance donc pas pleine

### 3. La dépendance A −→ AC est-elle élémentaire?

Une DF est élémentaire si :

- La partie droite est un attribut unique.

- La partie droite n'est pas incluse dans la partie gauche .

- La dépendance est pleine.

la partie droite est A -> C. Elle contient A, qui est déjà à gauche. C'est une dépendance partiellement trivial .De plus, la partie droite n'est pas atomique.
Donc non élémentaire

### 4. La dépendance A −→ C est-elle élémentaire?

Partie droite C est un attribut unique. C n'est pas dans A .Partie gauche A est un singleton, on ne peut pas faire plus petit, donc la dépendance est forcément pleine. Donc oui, elle est élémentaire.



### 5. Calculez {A}+, {B}+;

- Etape 0 : {A} 
  - A -> B donc { A, B }
  - B -> C donc { A, B , C }
   - {A}+ = { A, B , C }

- Etape 0 : { B }
- A -> B donc {B}
- B -> A donc { B ,A }
- B -> C donc { A , B , C }
  -  {B}+ = { A, B , C }

    
### 6. Déterminer si F |= A −→ BC

- {A}+ = { A, B , C } donc A détermine BC
- Donc oui F implique  A -> BC

## Exercice 12.
### Soit la relation R(A,B,C,D,E,G) avec les Dfs F = {AB −→ C,C −→ A,BC −→ D,ACD −→ B,D −→ EG,BE −→C,CG−→BD,CE −→AG} 1. Montrer que les Dfs CE −→ A et CG −→ B sont redondantes;

- CE -> A
  - C -> A donc E inutile dans CE-> A donc oui CE -> A est redondant

- CG -> B
  - On calcule {C ,G } +
  - On a C -> A donc { C, G, A }
  - On CG -> BD donc { C,G, A, D }
  - On a ACD -> B donc { C, G, A , D }
  - Donc puisque on a réussi à obtenir B avec le chemin CG -> D et ACD -> B , CG -> B est redondant.

### 2. En déduire une couverture minimale de F ;

- Atomisation :
  - AB -> C
  - C -> A
  - BC -> D
  - ACD -> B
  - D -> E
  - D -> G
  - BE -> C
  - CG -> D
  - CE -> G
 
  ### 3. Montrer qu'il y a un attribut superflu dans ACD −→ B;

On regarde la règle ACD ->  B. On se demande si A, C, ou D est inutile à gauche.Testons si A est inutile : On calcule $\{C, D\}^+$ pour voir si on peut récupérer A ou déclencher la règle sans lui.On a C -> A.Donc, si j'ai {C, D} j'obtiens automatiquement A. Mon ensemble devient {A, C, D}.Une fois que j'ai {A, C, D}, la règle ACD -> B se déclenche.Conclusion : Puisque C suffit à déterminer A, écrire A dans la partie gauche de ACD -> B est une répétition.L'attribut A est superflu . La règle se simplifie en CD -> B.

### 4. Donner une couverture minimale de F ;

Nouvelle couverture :{AB -> C, C -> A, BC -> D, CD -> B, D -> E, D -> G, BE -> C, CG -> D, CE -> G}
  
### 5. En reprenant F montrer que CG −→ D est redondante ainsi que ACD −→ B;

 Calculer { C , G }+
 - Etape 1 : { C , G }
  - CG -> BD donc CG -> B donc { C, G , B }
  - BC -> D donc CG -> BC -> D donc CG -> B -> D donc { C, G, B , D }
  - Donc CG est redondant

Calculer { A, C, D }+
  - Etape 1 : { A, C, D}
   - D -> EG donc { A , C , D , G }
   - CG -> B donc { A , C , D , G , E }


### 6. En déduire une couverture minimale ayant moins d'éléments que la première.

Couverture minimale optimale : { AB -> C, C-> A , BC -> D, D -> E , D -> G, BE -> C, CG -> B , CE -> G }



 

  


  
 
  
 
      
        

  

  
    





    

  




  

  
