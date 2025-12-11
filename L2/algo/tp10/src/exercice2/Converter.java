package exercice2;

public class Converter {
	private double rate = 120.2;
	public double euroToYen(double euro) {
		return euro * rate;
	}
	public double yenToEuro(double yen) {
		return yen / rate;
	}
}