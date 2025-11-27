//ex1 

import java.util.ArrayList;
import java.util.List;
import java.util.function.Consumer;

public class MaListe {
    private List<Coord> liste = new ArrayList<>();


    public void add(Coord c) {
        liste.add(c);
    }

   
    public void afficher(Consumer<Coord> action) {
        
        for (Coord c : liste) {
            action.accept(c); 
        }
    }
}


i public class Main {
    public static void main(String[] args) {

        MaListe ml = new MaListe();

        ml.add(new Coord(3.0, 2.0));
        ml.add(new Coord(1.0, 4.0));
        ml.add(new Coord(2.0, 5.0));

        final int[] compteur = {1};

        ml.afficher(coord -> {
            System.out.println(" " + compteur[0] + ". Coordonnées " 
                + coord.getX() + ", " + coord.getY());
            compteur[0]++;
        });
    }
}


//ex2


import java.util.Arrays;

public class MainEx2 {
    public static void main(String[] args) {
       
        int t[][] = {{1,2}, {1,4}, {3,2}, {1,2}};

               Arrays.stream(t) 
              .map(tab -> new Coord(tab[0], tab[1])) 
              .forEach(c -> System.out.println(c)); 
    }
}

//ex3

@Override
public int hashCode() {
    final int prime = 31;
    int result = 1;
    long temp;
    temp = Double.doubleToLongBits(x);
    result = prime * result + (int) (temp ^ (temp >>> 32));
    temp = Double.doubleToLongBits(y);
    result = prime * result + (int) (temp ^ (temp >>> 32));
    return result;
}

@Override
public boolean equals(Object obj) {
    if (this == obj) return true;
    if (obj == null) return false;
    if (getClass() != obj.getClass()) return false;
    Coord other = (Coord) obj;
    if (Double.doubleToLongBits(x) != Double.doubleToLongBits(other.x)) return false;
    if (Double.doubleToLongBits(y) != Double.doubleToLongBits(other.y)) return false;
    return true;
}
