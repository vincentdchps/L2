package exo2;

import java.util.ArrayList;

public class Etudiant {
    private String nom;
    private String prenom;
    private ArrayList<Double> notes;

    public Etudiant(String nom, String prenom) {
        this.nom = nom;
        this.prenom = prenom;
        this.notes = new ArrayList<>();
    }

    public void add(double note) {
        this.notes.add(note);
    }

    public double moyenne() {
        return this.notes.stream()          
            .mapToDouble(x -> x)          
            .average()                      
            .orElse(0.0);                   
    }
    @Override
    public String toString() {
        return prenom + " " + nom + " : Moyenne = " + moyenne();
    }
}