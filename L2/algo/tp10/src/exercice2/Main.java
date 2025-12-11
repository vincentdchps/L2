package exercice2;

import javafx.application.Application;
import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
import javafx.stage.Stage;

public class Main extends Application {
	public static void main(String[] args) {
		launch(args);
	}
	@Override
	public void start(Stage primaryStage) {
		Converter converter = new Converter();
		GridPane gridPane = new GridPane();
		TextField euroField = new TextField();
		Label label1 = new Label("EUR");
		TextField yenField = new TextField();
		Label label2 = new Label("JPY");
		gridPane.setAlignment(Pos.CENTER);
		gridPane.setHgap(4);
		gridPane.setVgap(4);
		gridPane.add(euroField, 0, 0);
		gridPane.add(label1, 1, 0);
		gridPane.add(yenField, 0, 1);
		gridPane.add(label2, 1, 1);
		euroField.textProperty().addListener(new ChangeListener<String>() {
			@Override
			public void changed(ObservableValue<? extends String> observable, String oldValue, String newValue) {
				if (euroField.isFocused()) {
					try {
						double euro = Double.parseDouble(newValue);
						yenField.setText(String.valueOf(converter.euroToYen(euro)));
					} catch (NumberFormatException exception) { // Infinity is possible
						yenField.setText("");
					}
				}
			}
		});
		yenField.textProperty().addListener(new ChangeListener<String>() {
			@Override
			public void changed(ObservableValue<? extends String> observable, String oldValue, String newValue) {
				if (yenField.isFocused()) {
					try {
						double yen = Double.parseDouble(newValue);
						euroField.setText(String.valueOf(converter.yenToEuro(yen)));
					} catch (NumberFormatException exception) { // Infinity is possible
						euroField.setText("");
					}
				}
			}
		});
		Scene scene = new Scene(gridPane, 185, 64);
		primaryStage.setScene(scene);
		primaryStage.show();
	}
}