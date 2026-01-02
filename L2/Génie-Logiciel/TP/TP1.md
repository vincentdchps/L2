## Exercice 1

## 1. UML
<img width="708" height="436" alt="image" src="https://github.com/user-attachments/assets/91e58982-9a9b-4230-b9ec-2b01bc014ba2" />

## 2. Code 

```java
public class Exercice1 {
    private String _statut;
    public Exercice1(String ch) {
        // statut par défaut
        this.setStatutPair();
        // initialisation de la machine
        int state = 1;
        int rang = -1;
        while (state!=3) {
            switch (state) {
                case 1: // etat pair
                    rang++;
                    this.setStatutPair();
                    if (rang >= ch.length()) state=3;
                    else {
                        if (ch.charAt(rang) == '1') state=2;
                        else state=1;
                    }
                    break;
                case 2 : // etat impair
                    rang++;
                    this.setStatutImpair();
                    if (rang >= ch.length()) state=3;
                    else {
                        if (ch.charAt(rang) == '1') state=1;
                        else state=2;
                    }
                    break;
            }
        }
    }
    public String getStatut() {
        return this._statut;
    }
    private void setStatutPair() {
        this._statut = "pair";
    }
    private void setStatutImpair() {
        this._statut = "impair";
    }
    public static void main(String[] args) {
        String demo = "0011010010101";
        Exercice1 objet = new Exercice1(demo);
        System.out.println("La chaine [" + demo + "] contient un 
nombre de 1 " + objet.getStatut());
    }
}
```

## Exercice 2 
### 1.UML
<img width="934" height="549" alt="image" src="https://github.com/user-attachments/assets/860ffdb7-5c20-4952-80be-7e403bae630d" />

### 2.Code

```java
public class Exercice2 {
    private String _statut;
    private int _nbMaj = 0;
    private int _nbChiffres = 0;

    public Exercice2(String mdp) {
        int state = 1; // 1: Analyse, 2: Décision, 3: Terminé
        int rang = 0;

        // Vérification immédiate de la longueur
        if (mdp.length() < 4 || mdp.length() > 12) {
            this.setStatutErreur();
            state = 3;
        }

        while (state != 3) {
            switch (state) {
                case 1: // État ANALYSE
                    if (rang >= mdp.length()) {
                        state = 2; // Fin de chaîne -> Décision
                    } else {
                        char c = mdp.charAt(rang);
                        if (Character.isUpperCase(c)) {
                            _nbMaj++;
                        } else if (Character.isDigit(c)) {
                            _nbChiffres++;
                        } else if (!Character.isLowerCase(c)) {
                            this.setStatutErreur(); // Caractère interdit
                            state = 3;
                        }
                        rang++;
                    }
                    break;

                case 2: // État DECISION
                    // Critères : >= 1 majuscule et >= 2 chiffres
                    if (_nbMaj >= 1 && _nbChiffres >= 2) {
                        this.setStatutValide();
                    } else {
                        this.setStatutErreur();
                    }
                    state = 3;
                    break;
            }
        }
    }

    public String getStatut() { return this._statut; }
    private void setStatutValide() { this._statut = "valide"; }
    private void setStatutErreur() { this._statut = "erreur"; }
}

```

```java
import static org.junit.jupiter.api.Assertions.*;
import org.junit.jupiter.api.Test;

class Exercice2Test {
    @Test
    void testMotDePasse() {
        Exercice2 mdp1 = new Exercice2("Pass1234");
        assertEquals("valide", mdp1.getStatut());

        Exercice2 mdp2 = new Exercice2("P12");
        assertEquals("erreur", mdp2.getStatut());

        Exercice2 mdp3 = new Exercice2("Password1");
        assertEquals("erreur", mdp3.getStatut());

        Exercice2 mdp4 = new Exercice2("Pass12!!");
        assertEquals("erreur", mdp4.getStatut());
    }
}
```


### Exercice 3 

## Code.

```java
public class Exercice3 {
    private String _nombreExtrait;

    public Exercice3(String texte) {
        // Initialisation
        this._nombreExtrait = ""; 
        StringBuilder buffer = new StringBuilder(); 
        
        int state = 1; // 1: RECHERCHE, 2: ENTIER, 3: DECIMAL, 4: FIN
        int rang = 0;

        while (state != 4) {
            if (rang >= texte.length()) {
                state = 4;
                break;
            }

            char c = texte.charAt(rang);

            switch (state) {
                case 1:
                    if (Character.isDigit(c)) {
                        buffer.append(c);
                        state = 2;
                    }
                    break;

                case 2: 
                    if (Character.isDigit(c) || c == ' ') {
                        buffer.append(c); 
                    } else if (c == '.' || c == ',') {
                        buffer.append(c);
                        state = 3;
                    } else {
                        state = 4;
                    }
                    break;

                case 3: 
                    if (Character.isDigit(c) || c == ' ') {
                        buffer.append(c);
                    } else {
                        state = 4; 
                    }
                    break;
            }
            rang++;
        }
        
        this._nombreExtrait = buffer.toString().trim(); 
    }

    public String getNombre() {
        return this._nombreExtrait;
    }
}

```
```java
import static org.junit.jupiter.api.Assertions.*;
import org.junit.jupiter.api.Test;

class Exercice3Test {

    @Test
    void testExtractionSimple() {
        Exercice3 ex = new Exercice3("Le prix est de 150 euros");
        assertEquals("150", ex.getNombre());
    }

    @Test
    void testExtractionDecimale() {
        Exercice3 ex1 = new Exercice3("Valeur: 12.50");
        assertEquals("12.50", ex1.getNombre());

        Exercice3 ex2 = new Exercice3("Valeur: 12,99");
        assertEquals("12,99", ex2.getNombre());
    }

    @Test
    void testDoubleSeparateur() {
        Exercice3 ex = new Exercice3("Version 12.5.6");
        assertEquals("12.5", ex.getNombre());
    }

    @Test
    void testEspaces() {
        Exercice3 ex = new Exercice3("Code 1 000 200 fin");
        assertEquals("1 000 200", ex.getNombre());
    }
}
```

### Exercice 4 

```java
import java.util.Vector;

public class Exercice4 {
    private Vector<Integer> _occurrences;
    private String _motCible;

    public Exercice4(String texte, String mot) {
        this._motCible = mot;
        this._occurrences = new Vector<Integer>();

        if (texte == null || mot == null || texte.length() == 0 || mot.length() == 0) {
            return;
        }
        int state = 0; 

        // Parcours du texte source
        for (int i = 0; i < texte.length(); i++) {
            char c = texte.charAt(i);
            
            if (c == _motCible.charAt(state)) {
                state++; 
                if (state == _motCible.length()) {
                    this._occurrences.add(positionDebut);
                    state = 0; 
                }
            } else {
                if (c == _motCible.charAt(0)) {
                    state = 1;
                } else {
                    state = 0;
                }
            }
        }
    }

    public int getNombreOccurrences() {
        return this._occurrences.size();
    }

    public Vector<Integer> getPositions() {
        return this._occurrences;
    }
}
```
