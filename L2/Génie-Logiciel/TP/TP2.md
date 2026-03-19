# TP2 – Documentation

## Exercice 1 :


```java
/**
 * Représente le comportement générique d'un véhicule motorisé.
 * <p>
 * Cette interface définit les opérations de base pour contrôler la vitesse
 * d'un véhicule, en respectant des contraintes physiques strictes :
 * <ul>
 * <li>La vitesse est toujours comprise entre <b>0 et 180</b>.</li>
 * <li>L'accélération se fait avec un incrément positif.</li>
 * <li>Le freinage se fait avec un décrément négatif.</li>
 * </ul>
 */
public interface Vehicule {

    /**
     * Augmente la vitesse du véhicule.
     * <p>
     * La nouvelle vitesse ne pourra pas dépasser la vitesse maximale autorisée de <b>180</b>.
     * Si l'ajout de l'incrément dépasse ce seuil, la vitesse est plafonnée à 180.
     * * @param increment La valeur à ajouter à la vitesse actuelle. 
     * Ce paramètre doit être strictement <b>positif</b>.
     */
    void accelerer(int increment);

    /**
     * Diminue la vitesse du véhicule.
     * <p>
     * La nouvelle vitesse ne pourra pas être inférieure à <b>0</b> (l'arrêt).
     * Si le freinage est trop fort, la vitesse est ramenée à 0.
     * * @param decrement La valeur à soustraire algébriquement à la vitesse actuelle.
     * Ce paramètre doit être strictement <b>négatif</b> 
     * (ex: -10 pour freiner de 10 km/h).
     */
    void freiner(int decrement);

    /**
     * Obtient la vitesse instantanée du véhicule.
     * * @return La vitesse actuelle sous forme d'entier, garantie d'être comprise 
     * entre 0 et 180 inclus.
     */


    int getVitesseActuelle();

}

```

## Exercice 2 :

```java
/**
 * Cette classe est capable de réaliser des calculs sécurisés sur des nombres entiers signés.
 * <p>
 * Elle garantit que les opérations ne dépassent pas les capacités de stockage d'un entier
 * (débordement de capacité ou "overflow"). La classe s'appuie sur les constantes 
 * {@link Integer#MAX_VALUE} et {@link Integer#MIN_VALUE} pour valider les résultats.
 * </p>
 * * @author Etudiant
 */
public class Calculatrice {

    /**
     * Effectue l'addition de deux nombres entiers.
     * <p>
     * Avant de réaliser l'opération, la méthode vérifie si le résultat peut être représenté
     * par un entier signé (compris entre -2^31 et 2^31 - 1).
     * La logique de vérification est : si {@code MAX - a >= b}, alors l'addition est sûre.
     * </p>
     *
     * @param a Le premier terme de l'addition.
     * @param b Le second terme de l'addition.
     * @return La somme de {@code a} et {@code b}.
     * @throws ComputingErrorException Si le résultat dépasse la capacité maximale ou minimale d'un entier (overflow/underflow).
     */
    public int additionner(int a, int b) throws ComputingErrorException {
        // Logique décrite dans l'énoncé pour l'addition positive
        if (b > 0 && a > Integer.MAX_VALUE - b) {
            throw new ComputingErrorException();
        }
        // Logique pour l'addition négative
        if (b < 0 && a < Integer.MIN_VALUE - b) {
            throw new ComputingErrorException();
        }
        return a + b;
    }

    /**
     * Effectue la soustraction de deux nombres entiers.
     * <p>
     * Vérifie que le résultat de la soustraction ne provoque pas de dépassement de capacité.
     * </p>
     *
     * @param a Le premier terme (minuende).
     * @param b Le terme à soustraire (subtrahende).
     * @return Le résultat de {@code a - b}.
     * @throws ComputingErrorException Si le résultat dépasse les bornes d'un entier signé.
     */
    public int soustraire(int a, int b) throws ComputingErrorException {
        // Pour soustraire, on peut vérifier l'opposé ou utiliser la logique de soustraction
        if ((b > 0 && a < Integer.MIN_VALUE + b) || (b < 0 && a > Integer.MAX_VALUE + b)) {
            throw new ComputingErrorException();
        }
        return a - b;
    }
}




```


## Exercice 3 :

```java

/**
 * Énumération représentant les planètes principales du système solaire.
 * <p>
 * Chaque constante de cette énumération correspond à une planète et permet de récupérer
 * sa masse relative par rapport à la Terre.
 * </p>
 *
 * <h3>Liste des masses relatives (Terre = 1.0) :</h3>
 * <ul>
 * <li>{@link #MERCURE} : 0.055</li>
 * <li>{@link #VENUS}   : 0.815</li>
 * <li>{@link #TERRE}   : 1.000</li>
 * <li>{@link #MARS}    : 0.107</li>
 * <li>{@link #JUPITER} : 317.8 (Voir <a href="https://fr.wikipedia.org/wiki/Jupiter_(plan%C3%A8te)">Wikipedia</a>)</li>
 * <li>{@link #SATURNE} : 95.16</li>
 * <li>{@link #URANUS}  : 14.53</li>
 * <li>{@link #NEPTUNE} : 17.15</li>
 * </ul>
 *
 * @see java.lang.Enum
 * @author Etudiant
 */
public enum Planete {

    MERCURE, VENUS, TERRE, MARS, JUPITER, SATURNE, URANUS, NEPTUNE;

    /**
     * Retourne la masse de la planète relative à celle de la Terre.
     *
     * @return La masse relative (1.0 pour la Terre). Retourne 0 par défaut si la planète n'est pas définie.
     */
    public double masseRelativeTerre() {
        switch (this) {
            case MERCURE: return 0.055;
            case VENUS:   return 0.815;
            case TERRE:   return 1.0;
            case MARS:    return 0.107;
            case JUPITER: return 317.8;
            case SATURNE: return 95.16;
            case URANUS:  return 14.53;
            case NEPTUNE: return 17.15;
            default:      return 0;
        }
    }
}
```


## Exercice 4 : 

```java
package com.covoiturage.utils;

/**
 * Service utilitaire responsable de la génération des codes QR.
 * Utilisé principalement pour générer les billets virtuels des passagers après réservation.
 * * @author TonNom
 * @version 1.0
 */
public class GenerateurQRCode {

    /**
     * Génère une image de QR Code à partir d'une chaîne de caractères (ex: un ID de réservation).
     * <p>
     * <b>Exemple de rendu :</b><br>
     * * <img src="doc-files/qrcode_exemple.png" alt="Exemple de QR Code généré" width="150" height="150">
     * </p>
     * * @param donnees Le texte ou l'URL à encoder dans le QR Code. Ne doit pas être null.
     * @param largeur La largeur souhaitée de l'image en pixels.
     * @param hauteur La hauteur souhaitée de l'image en pixels.
     * @return Un tableau d'octets (byte[]) représentant l'image au format PNG.
     * @throws IllegalArgumentException si les données sont nulles ou vides.
     */
    public byte[] generer(String donnees, int largeur, int hauteur) throws IllegalArgumentException {
        if (donnees == null || donnees.trim().isEmpty()) {
            throw new IllegalArgumentException("Les données du QR Code ne peuvent pas être vides.");
        }
==
        return new byte[0]; // Bouchon pour la compilation
    }
}


```


## Exercice 5 

```java
package com.covoiturage.stats;

import java.util.List;

/**
 * Service de calculs statistiques pour l'application de covoiturage.
 * Permet d'analyser les notes des conducteurs et les tendances de prix.
 */
public class Statistiques {

    /**
     * Calcule la médiane d'une liste de prix de trajets.
     * La médiane est la valeur séparant la moitié supérieure de la moitié inférieure d'un échantillon.
     * <p>
     * <b>Exemples d'exécution :</b>
     * <table border="1" cellpadding="5" style="border-collapse: collapse;">
     * <caption>Résultats attendus selon l'entrée</caption>
     * <tr>
     * <th>Valeurs en entrée (List&lt;Double&gt;)</th>
     * <th>Résultat attendu (Médiane)</th>
     * <th>Explication</th>
     * </tr>
     * <tr>
     * <td>[10.0, 15.0, 20.0]</td>
     * <td>15.0</td>
     * <td>Taille impaire, on prend la valeur centrale.</td>
     * </tr>
     * <tr>
     * <td>[10.0, 20.0, 30.0, 40.0]</td>
     * <td>25.0</td>
     * <td>Taille paire, moyenne des deux valeurs centrales (20+30)/2.</td>
     * </tr>
     * <tr>
     * <td>[] (Liste vide)</td>
     * <td>Double.NaN</td>
     * <td>Impossible de calculer une médiane sans données.</td>
     * </tr>
     * </table>
     * </p>
     * * @param prix Une liste de nombres décimaux représentant les prix.
     * @return La valeur médiane, ou {@code Double.NaN} si la liste est vide.
     * @throws NullPointerException si la liste passée en paramètre est nulle.
     */
    public double calculerMediane(List<Double> prix) {
        if (prix == null) {
            throw new NullPointerException("La liste de prix ne peut pas être nulle.");
        }
        if (prix.isEmpty()) {
            return Double.NaN;
        }
        
        return 0.0; // Bouchon
    }
}
```

## Exercice 6 

```java
/**
 * Utilitaire mathématique permettant la résolution d'équations du second degré
 * de la forme ax² + bx + c = 0.
 * * @author TonNom
 * @version 1.0
 */
public class Exo6 {

    /**
     * Méthode principale exécutant un test de résolution.
     * * @param args Les arguments de la ligne de commande (non utilisés ici).
     */
    public static void main(String[] args) {
        resoudre(-2, 2, 3);
    }

    /**
     * Calcule et affiche les solutions réelles de l'équation du second degré.
     * * @param a Le coefficient de x² (doit être différent de 0).
     * @param b Le coefficient de x.
     * @param c Le terme constant.
     */
    public static void resoudre(double a, double b, double c) {
        double d = delta(a, b, c);
        
        if (d < 0) {
            System.out.println("pas de solutions");
        }

        if (d == 0.0) {
            double s = -b / (2 * a);
            System.out.println("une solution : " + s);
        }

        if (d > 0) {
            double s1 = (-b - Math.sqrt(d)) / (2 * a);
            double s2 = (-b + Math.sqrt(d)) / (2 * a);
            System.out.println("solution 1 : " + s1);
            System.out.println("solution 2 : " + s2);
        }
    }

    /**
     * Calcul delta de l'équation.
     * * @param a Le coefficient de x².
     * @param b Le coefficient de x.
     * @param c Le terme constant.
     * @return La valeur du discriminant (b² - 4ac).
     */
    private static double delta(double a, double b, double c) {
        return (b * b - 4 * a * c);
    }
}
```

## Exercice 7 

```java
import java.util.Arrays;

/**
 * Représente un tableau d'entiers à deux dimensions avec des valeurs aléatoires.
 * Permet d'effectuer diverses opérations de recherche et de comptage.
 * <p>
 * <b>Architecture de la classe (Diagramme UML) :</b><br>
 * <img src="doc-files/classe.png" alt="Diagramme UML de Exo7" />
 * </p>
 * * @author TonNom
 * @version 1.0
 */
public class Exo7 {

    /** Le tableau d'entiers à deux dimensions. */
    private int[][] tab;

    /**
     * Construit un tableau de dimensions spécifiées et le remplit
     * avec des valeurs aléatoires comprises entre 1 et 10.
     * * @param nbLignes Le nombre de lignes du tableau.
     * @param nbColonnes Le nombre de colonnes du tableau.
     */
    public Exo7(int nbLignes, int nbColonnes) {
        tab = new int[nbLignes][nbColonnes];

        for (int l = 0; l < nbLignes; l++) {
            for (int c = 0; c < nbColonnes; c++) {
                tab[l][c] = (int) (Math.random() * 10) + 1;
            }
        }
    }

    /**
     * Affiche le contenu du tableau dans la console.
     */
    public void affiche() {
        System.out.println(Arrays.deepToString(tab));
    }

    /**
     * Recherche la présence d'un entier dans le tableau.
     * * @param n L'entier à rechercher.
     * @return {@code true} si l'entier est présent, {@code false} sinon.
     */
    public boolean recherche1(int n) {
        boolean trouve = false;
        int l = 0;
        
        while (l < tab.length) {
            int c = 0;
            while (c < tab[0].length) {
                if (tab[l][c] == n) {
                    trouve = true;
                }
                c++;
            }
            l++;
        }
        return trouve;
    }

    /**
     * Compte le nombre d'occurrences d'un entier dans le tableau.
     * * @param n L'entier à compter.
     * @return Le nombre d'occurrences trouvées.
     */
    public int compte(int n) {
        int nombre = 0;
        for (int[] ligne : tab) { 
            for (int elem : ligne) { 
                if (elem == n) {
                    nombre++;
                }
            } 
        }
        return nombre;      
    }

    /**
     * Localise toutes les positions d'un entier dans le tableau.
     * * @param n L'entier à localiser.
     * @return Un tableau 2D contenant les coordonnées [ligne, colonne] de chaque occurrence.
     */
    public int[][] localise(int n) {
        int nombre = compte(n);
        int[][] pos = new int[nombre][2];
        int k = 0;
        int l = 0;
        
        for (int[] ligne : tab) {
            int c = 0;
            for (int elem : ligne) {
                if (elem == n) {
                    pos[k][0] = l;
                    pos[k][1] = c;
                    k++;
                }
                c++;
            }
            l++;
        }
        return pos;
    }

    /**
     * Point d'entrée pour tester la classe.
     * * @param args Arguments de la ligne de commande (non utilisés).
     */
    public static void main(String[] args) {
        Exo7 t = new Exo7(3, 5);
        t.affiche();

        if (t.recherche1(5)) {
            System.out.println(" -> 5 est dans le tableau");
        } else {
            System.out.println(" -> 5 n'est pas dans le tableau");
        }

        if (t.recherche1(5)) {
            System.out.println(" -> 5 est présent " + t.compte(5) + " fois");
        }

        if (t.recherche1(5)) {
            System.out.println(" -> position(s) du 5 : " + Arrays.deepToString(t.localise(5)));
        }
    }
}
```
