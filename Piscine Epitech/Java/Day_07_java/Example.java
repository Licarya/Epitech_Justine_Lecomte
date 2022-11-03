import java.util.ArrayList;
import java.util.List;

public class Example {
    public static void main(String[] args) {
        /*Solo<String> strSolo = new Solo<>("toto");
        String strValue = strSolo.getValue();
        strSolo.setValue("tata");
        System.out.println(strSolo.getValue());

        Solo<Integer> intSolo = new Solo<>(Integer.valueOf(42));
        Integer intValue = intSolo.getValue();
        intSolo.setValue(Integer.valueOf(1337));
        System.out.println(intSolo.getValue());

        Pair<String, Integer> pair = new Pair<>("toto", 25);
        pair.display();*/

        /*Duet.max("get", "guihuoi");
        Duet.min(2, 94);
        Duet.min(2485, 94);
        Duet.min(235, 599);
        Duet.max("toto", "tota");
        Duet.min("toto", "tata");*/

        List<Mage> mages = new ArrayList<>();
        mages.add(new Mage("Merlin", 12));
        mages.add(new Mage("Mandrake", 4));
        mages.add(new Mage("Adele", 70));
        List<Warrior> warriors = new ArrayList<>();
        warriors.add(new Warrior("Achilles", 240));
        warriors.add(new Warrior("Spartacus", 140));
        warriors.add(new Warrior("Clovis", 58));

       Battalion battalion = new Battalion();
        battalion.add(mages);
        battalion.add(warriors);
        System.out.println("combat");
        battalion.fight();
        battalion.display();
        System.out.println("combat");

        battalion.fight();
        battalion.display();
        System.out.println("combat");
        battalion.fight();
        battalion.display();

   



    }
}
