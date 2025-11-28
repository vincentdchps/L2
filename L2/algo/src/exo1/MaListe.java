package exo1;

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


