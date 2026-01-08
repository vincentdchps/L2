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
