package exemple ;

import javafx.application.Application;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.HBox;
import javafx.stage.Stage;

public class Main extends Application {
	public static void main(String[] args) {
		launch(args);
	}
	@Override
	public void start(Stage primaryStage) {
		Counter counter = new Counter();
		GridPane gridPane = new GridPane();
		Button btnDecrement = new Button("-");
		Label label1 = new Label("0");
		HBox btnBox = new HBox(0);
		Button btnIncrement = new Button("+");
		Button btnReset = new Button("reset");
		btnBox.getChildren().addAll(btnIncrement, btnReset);
		gridPane.setAlignment(Pos.CENTER);
		gridPane.setHgap(16);
		gridPane.setVgap(16);
		gridPane.add(btnDecrement, 0, 0);
		gridPane.add(label1, 1, 0);
		gridPane.add(btnBox, 2, 0);
		btnDecrement.setOnAction(a -> label1.setText(String.valueOf(counter.dec())));
		btnIncrement.setOnAction(ev -> label1.setText(String.valueOf(counter.inc())));
		btnReset.setOnAction(ev -> label1.setText(String.valueOf(counter.reset())));
		Scene scene = new Scene(gridPane, 140, 36);
		primaryStage.setScene(scene);
		primaryStage.show();
	}
}