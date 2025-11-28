package exo1;


import java.util.Arrays;

public class MainEx2 {
    public static void main(String[] args) {
    	Coord t[] = { new Coord(3,2),
    			new Coord(1,4),
    			new Coord(3,2)
    			};
        Arrays.stream(t)
        .distinct()
        .map(c -> c.getX() + " ; " + c.getY())
        .forEach(c -> System.out.println(c));
    }
}