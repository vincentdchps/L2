/**
 * 
 */
package exo2;

import java.util.ArrayList;

/**
 * @author nmessai
 *
 */
public class Banque {
	
	ArrayList<Compte> lesComptes;
	ArrayList<Client> lesClients;
	
	public Banque(){
		lesComptes = new ArrayList<Compte>();
		lesClients = new ArrayList<Client>();
	}
	 
	public void ajouter(Compte c) throws CompteExistantException {
		if(lesComptes.contains(c))
			throw new CompteExistantException("Ce compte existe déjà");
		this.lesComptes.add(c);
	 }
	
	public void supprimer(int noCompte) throws CompteInexistantException{
		boolean trouve = false;
		for(Compte c : lesComptes){
			if(c.getNumero()==noCompte){
				trouve = true;
				lesComptes.remove(c);
				break;
			}
		}
		if(!trouve)
			throw new CompteInexistantException("Pas de compte avec ce numero");
	}
	
	public void debit(int noCompte, int montant) throws CompteInexistantException, PasAssezArgentException{
		boolean trouve = false;
		for(Compte c : lesComptes){
			if(c.getNumero()==noCompte){
				trouve = true;
				c.debit(montant);
				break;
			}
		}
		if(!trouve)
			throw new CompteInexistantException("Pas de compte avec ce numero");
	}
	
	public void credit(int noCompte, int montant) throws CompteInexistantException, IllegalArgumentException{
		boolean trouve = false;
		for(Compte c : lesComptes){
			if(c.getNumero()==noCompte){
				trouve = true;
				c.credit(montant);
				break;
			}
		}
		if(!trouve)
			throw new CompteInexistantException("Pas de compte avec ce numero");
	}

}
