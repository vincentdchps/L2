/**
 * 
 */
package exo1;

/**
 * @author nmessai
 *
 */
public class Value {

	/**
	 * 
	 */
	private String name; 
	private int value; 
	
	public Value(String n, int v) {
		this.name = n;
		this.value = v;
	}
	
	@Override
	public String toString(){
		return "<"+this.name+";"+this.value+">";
	}
}
