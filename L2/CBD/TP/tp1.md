# TP 1 – SQL

## Travail à faire : 
### 1. Evaluer les requêtes en SQL de difficulté (a), (b) et (c)  

### 1. (a)  
Quelles équipes ont obtenu la première place de leurs groupes en 2010 ?   

```sql
SELECT firstPlace 
FROM A_GROUPS 
WHERE cup = 2010
```

### 2. (b) Quelles équipes se sont classifiées pour la deuxième phase en 2010 ? (i.e. ceux qui ont obtenu la première et la deuxième place de leurs groupes) 

```sql
SELECT firstPlace AS equipe FROM A_GROUPS WHERE cup = 2010
UNION
SELECT secondPlace AS equipe FROM A_GROUPS WHERE cup = 2010;
```

### 3. (b) Quelles sont les équipes du groupe H en 2010 ?

```sql
SELECT firstPlace, secondPlace, thirdPlace, fourthPlace
FROM A_GROUPS
WHERE cup = 2010 AND groupId = 'H';
```

### 4. (b) Dans quel groupe joue la France en 2010 ?

```sql
SELECT groupId 
FROM A_GROUPS 
WHERE cup = 2010
AND (firstPlace = 'France' OR secondPlace = 'France' 
OR thirdPlace = 'France' OR fourthPlace = 'France')
```

### 5. (b) Dans quel groupe joue l’organisateur (host) de la coupe 2010 ? 

```sql
SELECT G.groupId
FROM A_GROUPS G, A_TOP T
WHERE G.cup = 2010 AND T.cup = 2010
  AND (G.firstPlace = T.host OR G.secondPlace = T.host 
       OR G.thirdPlace = T.host OR G.fourthPlace = T.host);
```

### 6. (b) Quelles équipes ont joué le 22/6/2010 ?

```sql
SELECT team1 FROM A_MATCHES WHERE cup = 2010 AND matchDate = '22/6'
UNION
SELECT team2 FROM A_MATCHES WHERE cup = 2010 AND matchDate = '22/6';
```

### 7. (c) Quelles équipes ont marqué des buts le 22/6/2010 ?

```sql
SELECT team1 
FROM A_MATCHES 
WHERE cup = 2010 AND matchDate = '22/6' 
  AND CAST(SUBSTRING_INDEX(goals, ':', 1) AS UNSIGNED) > 0
UNION
SELECT team2 
FROM A_MATCHES 
WHERE cup = 2010 AND matchDate = '22/6' 
  AND CAST(SUBSTRING_INDEX(goals, ':', -1) AS UNSIGNED) > 0;
```

### 8. (c) Quelles équipes ont gagné les matches du 22/6/2010 ?

```sql
SELECT CASE 
    WHEN CAST(SUBSTRING_INDEX(goals, ':', 1) AS UNSIGNED) > CAST(SUBSTRING_INDEX(goals, ':', -1) AS UNSIGNED) THEN team1
    WHEN CAST(SUBSTRING_INDEX(goals, ':', -1) AS UNSIGNED) > CAST(SUBSTRING_INDEX(goals, ':', 1) AS UNSIGNED) THEN team2
END as Winner
FROM A_MATCHES
WHERE cup = 2010 AND matchDate = '22/6'
HAVING Winner IS NOT NULL;
```

### 9. (c) Quelles équipes ont marqué plus de 3 buts dans un match ?

```sql
SELECT team1 
FROM A_MATCHES 
WHERE CAST(SUBSTRING_INDEX(goals, ':', 1) AS UNSIGNED) > 3
UNION
SELECT team2 
FROM A_MATCHES 
WHERE CAST(SUBSTRING_INDEX(goals, ':', -1) AS UNSIGNED) > 3;
```

### 10. (c) Dans quelles villes a joué la France en 2010 ?

```sql
SELECT DISTINCT SUBSTRING_INDEX(stadium, ',', -1) as Ville
FROM A_MATCHES
WHERE cup = 2010 AND (team1 = 'France' OR team2 = 'France');
```
### 11. (a) Quelles équipes ont gagné au moins une fois une coupe ?

```sql
SELECT DISTINCT winner FROM A_TOP;
```
