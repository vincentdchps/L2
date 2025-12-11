package exemple;

public class Counter {
    private int i=0;
    public int getValue() { return i; }
    public int dec() { return --i; }
    public int inc() { return ++i; }
	public int reset() {
		i = 0;
		return i ;
	}
}
