/**
 * 
 */
package exo1;

/**
 * @author nmessai
 *
 */
public class TestStack {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		Stack pile = new LIFOStack();
		pile.push(new Value("v1",1));
		
		try {
			System.out.println(pile.pop());
			System.out.println(pile.pop());
		} catch (EmptyStackException e) {
			e.printStackTrace();
		}
		
	}

}
