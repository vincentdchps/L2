package exo2;

public class TestEtudiant{
public static void Main(String[] args) {
    Etudiant e1 = new Etudiant("Skywalker", "Luke");
    e1.add(12.5);
    e1.add(15.0);
    e1.add(17.5); 
    System.out.println(e1);

    Etudiant e2 = new Etudiant("Solo", "Han");
    System.out.println(e2);
}
}