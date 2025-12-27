### Quel est le chemin critique ? 

Le chemin critique est la suite des taches ou le flottement est nul. 
Flottement = (date fin au plus tard – date début au plus tôt) - durée
Sur le schéma, date de fin au plus tot et au plus tard sont identiques pour les étapes 1,3,4 et 5. 
Donc chemin critique : B-> D -> E
Durée : 13 u. temps 

### Donner les caractéristiques de la tâche A dans cette planification.

Durée : 3
Date de début au plus tot: 0
Date de fin au plus tot : 3
Date de fin au plus tard : 7
Flottement : (7-0)-3 = 4 

### Quelles sont les conséquences sur la durée du projet si

### • A dure 6 unité de temps ?

Augmenter A de 6 unité de temps n'a aucun impact car le flottement sera toujours positif :
-Flottement: (7 - 0) - 6  = 1

### • C dure 6 unité de temps ?

Puisque l'étape 4 est une point de convergence des étapes C et D, on calcule la date au plus tot ainsi: 
*Date etape = max( Fin au plus tot de C, fin au plus tot de D).*
Et puisque D fini largement plus tard que C (11), alors changer la durée de C n'a aucun impact car on continue de prendre la date de fin au plus tot de D qui est supérieur (6+3 = 9 < 11).
### • C dure 2 unité de temps ?

Idem ici , nouvelle fin de C  (3+2 = 5 )< fin de D (11).

### • B dure 2 unité de temps ?

Ici, réduire la durée de B de 6 à 2 touche au chemin critique. En effet, initialement le chemin critique passe par B et D car ils n'ont aucune marge (flottement nul). 
Mais si on reduit B alors : 
D peut commencer à t=2.
Sa date de fin au plus tot devient donc  : 5 + 2 =7.
Pour rappel la date de fin au plus tot de c est 7 aussi : 4 + 3 = 7.
Ainsi, la date de fin au plus tot de l'étape 4, convergence de C et D, devient 7.
Ainsi, la date de fin au plus tot et au plus tard de l'étape 5 devient 9 : 
7 (fin au plus tard de l'étape 4) + 2 (Durée de E) = 9. 
On gagne donc 4 u. de temps 
