/**
 * 
 */
package exo2;

/**
 * @author nmessai
 *
 */
public class BanqueCCI {

	/**
	 * @param args
	 * @throws CompteExistantException 
	 */
	public static void main(String[] args) {
		
		// créer une banque :
		Banque bCCI = new Banque();
		
		// créer des comptes
		Compte c1 = new Compte(1);
		Compte c2 = new Compte(2);
		Compte c3 = new Compte(3);
		
		// créer des clients
		Client u1 = new Client(1,"nU1","pU1",bCCI);
		Client u2 = new Client(2,"nU2","pU2",bCCI);
		Client u3 = new Client(3,"nU3","pU3",bCCI);
		
		// ajouter les clients ? il faut une méthode dans Banque.
		
		// ajouter les compte à bCCI
		try{
			bCCI.ajouter(c1);
			System.out.println("L'ajout s'est bien déroulé pour C1");
		}
		catch(CompteExistantException e){
			System.out.println(e.getMessage());
			System.out.println("L'ajout n'a pas eu lieu");
		}
		try{
			bCCI.ajouter(c1);
			System.out.println("L'ajout s'est bien déroulé pour C1");
		}
		catch(CompteExistantException e){
			System.out.println(e.getMessage());
			System.out.println("L'ajout n'a pas eu lieu");
		}
		try{
			bCCI.ajouter(c2);
			System.out.println("L'ajout s'est bien déroulé pour C2");
		}
		catch(CompteExistantException e){
			System.out.println(e.getMessage());
			System.out.println("L'ajout n'a pas eu lieu");
		}
		try{
			bCCI.ajouter(c3);
			System.out.println("L'ajout s'est bien déroulé pour C3");
		}
		catch(CompteExistantException e){
			System.out.println(e.getMessage());
			System.out.println("L'ajout n'a pas eu lieu");
		}
		
		// tester les méthodes debit et credit
		//exemple : le client u1 procède à un retrait de 10
		try {
			u1.retraitCB(10);
		} catch (CompteInexistantException e) {
			System.out.println(e.getMessage());
		} catch (PasAssezArgentException e) {
			System.out.println(e.getMessage());
		}
		// u1 depose 20 et recommence le retrait de 10
		try {
			u1.depotEspece(20);
			System.out.println("dépot de 20 effectué");
			u1.retraitCB(10);
			System.out.println("retrait 10 effectué");
		} catch (IllegalArgumentException e) {
			e.printStackTrace();
		} catch (CompteInexistantException e) {
			e.printStackTrace();
		} catch (PasAssezArgentException e) {
			e.printStackTrace();
		}
		
		// supprimer c3
		try {
			bCCI.supprimer(3);
			System.out.println("suppression c3 OK");
		} catch (CompteInexistantException e) {
			System.out.println(e.getMessage());
		}
		
		try {
			bCCI.supprimer(3);
			System.out.println("suppression c3 OK");
		} catch (CompteInexistantException e) {
			System.out.println(e.getMessage());
		}
		
		// dépôt espece sur c3
		try {
			u3.depotEspece(20);
			System.out.println("dépôt de 20 effectué sur c3");
		} catch (IllegalArgumentException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (CompteInexistantException e) {
			System.out.println("dépôt de 20 non effectué sur c3 car : ");
			System.out.println(e.getMessage());
		}
		
	}

}
