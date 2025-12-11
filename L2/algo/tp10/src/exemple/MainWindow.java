package exemple;

import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;

public class MainWindow {

    private Counter counter;
    @FXML private Button btnDecrement;
    @FXML private Button btnIncrement;
    @FXML private Label label1;

    MainWindow(Counter counter) {
        this.counter=counter;
    }

    @FXML
    public void initialize() {
        label1.setText(String.valueOf(counter.getValue()));
        btnDecrement.setOnAction(ev -> label1.setText(String.valueOf(counter.dec())));
        btnIncrement.setOnAction(ev -> label1.setText(String.valueOf(counter.inc())));
    }

}
