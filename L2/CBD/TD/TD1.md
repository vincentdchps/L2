
# TD 1 Redondance, Anomalies de mise à jour, Dépendances Fonctionnelles

## Exercice 1 :

### Cette relation contient-elle des redondances? Si oui lesquelles? Justi ez votre réponse.

On observe que dans le tableau, dès que A vaut 0 , D vaut 10. 
On observe aussi que dès que A vaut 1, D vaut 20.
Cela indique donc une dépendance fonctionelle probable entre A et D : A -> D
Donc oui il y a une redondance.  En cas de modification (ex: A=0 implique désormais D=15),
il faudrait modifier 5 lignes, ce qui crée un risque d'incohérence (anomalie de modification).

## Exercice 2 :
