public class AssaultTerminator extends SpaceMarine{

    protected AssaultTerminator(String name) {
        super(name, 150, 30);
        PowerFist fist = new PowerFist();
        this.equip(fist);
        System.out.println(this.name + " has teleported from space.");

    }
    
@Override
public void receiveDamage(int newDamage) {
    if((newDamage - 3) < 1){
       super.receiveDamage(1);
    } else {
        super.receiveDamage(newDamage -3);
    }
}


}
