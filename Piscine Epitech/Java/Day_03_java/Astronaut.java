import chocolate.*;
import planet.*;
public class Astronaut {
    static int count = 0;
    private String name;
    private int snacks = 0;
    private static String destination = null;
    private int id = 0;

   public Astronaut(String newName) {
        this.name = newName;
        this.id = count;
        count = id + 1;
        System.out.println(this.name + " ready for launch!");
    }
    public String getName(){
        return name;
}
    public String getDestination(){
        return destination;
}
    public int getSnacks() {
        return snacks;
    }

    public int getId() {
        return id;
    }


   public void doActions() {
       System.out.println(this.getName() + ": Nothing to do.");
       System.out.println(this.getName() + ": I may have done nothing, but I have " + this.getSnacks()+ " Mars to eat at least!");
   }

    public void doActions(planet.Mars start){
        System.out.println(this.getName() + ": Started a mission!");
        destination = start.getLandingSite();
    }

    public void doActions(chocolate.Mars start){
        snacks++;
        System.out.println(this.getName() + ": Thanks for this mars number " + start.getId());
        System.out.println(this.getName() + ": I may have done nothing, but I have " + this.getSnacks()+ " Mars to eat at least!");

    }


}