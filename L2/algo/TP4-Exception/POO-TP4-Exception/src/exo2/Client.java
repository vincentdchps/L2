/**
 * 
 */
package exo2;

/**
 * @author nmessai
 *
 */
public class Client {

	private int numCourant;
	private String nom;
	private String prenom;
	private Banque banque;
	/**
	 * 
	 */
	public Client(int no, String nom, String prenom, Banque banque) {
		this.numCourant = no;
		this.nom = nom;
		this.prenom = prenom;
		this.banque =banque;
	}
	
	public void retraitCB(int montant) throws CompteInexistantException, PasAssezArgentException{
		banque.debit(this.numCourant, montant);
	}
	
	public void depotEspece(int montant) throws IllegalArgumentException, CompteInexistantException{
		banque.credit(this.numCourant, montant);
	}
}
