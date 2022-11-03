import java.util.*;
public class Example {
    public static void main(String[] args) {
        Unit toto = new Unit("toto", 100, 20) {
        };
        SpaceMarine titi = new SpaceMarine("titi", 15, 45) {
        };
        toto.attack(titi);
    }
}
