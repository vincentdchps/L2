/**
 * 
 */
package exo1;

import java.util.ArrayList;

/**
 * @author nmessai
 *
 */
public class LIFOStack implements Stack {

	private ArrayList<Value> values = new ArrayList<Value>();
	
	@Override
	public boolean empty() {
		return this.values.size() == 0;
	}
	@Override
	public void push(Value v) {
		this.values.add(v);
	}
	@Override
	public Value pop() throws EmptyStackException {
		if(this.empty())
			throw new EmptyStackException("Attention la pile est vide");
		//Value last = this.values.get(this.values.size()-1);
		//this.values.remove(this.values.size()-1);
		//return last;
		return this.values.remove(this.values.size()-1);
	}
	@Override
	public Value peek() throws EmptyStackException {
		if(this.empty())
			throw new EmptyStackException("Attention la pile est vide");
		return this.values.get(this.values.size()-1);
	}

}
