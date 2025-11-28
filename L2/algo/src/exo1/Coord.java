package exo1;


class Coord {
	private double x;
	private double y;
	Coord(double x, double y) { this.x = x; this.y = y; }
	double getX() { return x; }
	double getY() { return y; }
	
	@Override public boolean equals(Object obj) {
		Coord c = (Coord)obj;
		return  c.x == this.x && c.y == this.y;
			

	}
		@Override public int hashCode() {
		return (int)(this.x + this.y*31);
		/*return 1*/
	/*	return (int)(Math.random() * 10000);*/
		}
		
	
}

