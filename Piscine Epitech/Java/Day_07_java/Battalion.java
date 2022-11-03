import java.util.ArrayList;
import java.util.List;

public class Battalion {

    List<Character> characters = new ArrayList<>();

    public Battalion() {

    }

    public void add(List<? extends Character> newCharacters) {
        for (Character chara : newCharacters) {
            if (!characters.contains(chara)) {
                characters.add(chara);
            }
        }

    }

    public void display() {
        for (Character chara : characters) {
            System.out.println(chara.getName());
        }
    }

    public boolean fight() {
        Character fighter1 = characters.get(0);
        Character fighter2 = characters.get(1);

        if (fighter1 == null || fighter2 == null) {
            return false;
        } else {
            if(fighter1.compareTo(fighter2) == 0){
                characters.remove(fighter1);
                characters.remove(fighter2);
            }

            else if(fighter1.compareTo(fighter2) > 0){
                characters.remove(fighter2);
            }

            else if(fighter1.compareTo(fighter2) < 0){
                characters.remove(fighter1);
            }

            return true;
        }

    }

}
