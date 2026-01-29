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




  

  
