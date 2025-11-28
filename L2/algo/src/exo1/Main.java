package exo1;

public class Main {
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