package exo4;

public class IterateurDesPairs implements IterateurTabInt {
	
	private int [] tab;
	private int pos;
	
	public IterateurDesPairs(int [] tab){
		this.tab=tab;
		this.pos = -1;
	}
	
	@Override
	public int suivant() throws ArrayIndesOutOfBoundsCCI {
		pos = indiceDuSuivant();
		if(pos==-1){
			throw new ArrayIndesOutOfBoundsCCI("Attention vous êtes en dehors du tableau");
		}
		return tab[pos];
	}
	@Override
	public int indiceDuSuivant() {
		for(int i=pos+1;i<tab.length;i++)
			if(tab[i]%2==0)
				return i;
		return -1;
	}
	@Override
	public boolean aUnSuivant() {
		for(int i=pos+1;i<tab.length;i++)
			if(tab[i]%2==0)
				return true;
		return false;
	}

}
