package tp7.dao;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;

public abstract class DAO<T> {
	protected Connection connect;
	protected Statement stmt;

	public DAO() {
		open();
	}

	public void open() {
		try {
			connect = SingleConnection.getInstance();
			stmt = connect.createStatement(
				ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_UPDATABLE);

		} catch (Exception e) {
			System.out.println(" === ERREUR OPEN DAO === ");
			e.printStackTrace();
		}
	}

	public void close() {
		try {
			SingleConnection.close();
		} catch (Exception e) {
			System.out.println(" === ERREUR CLOSE DAO === ");
			e.printStackTrace();
		}
	}

	
	public abstract T create(T obj);
	public abstract T update(T obj);
	public abstract void delete(T obj);
}
