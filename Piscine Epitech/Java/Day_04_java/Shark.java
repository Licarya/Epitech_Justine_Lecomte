public class Shark extends Animal{

private Boolean frenzy = false;
protected Boolean can;

    protected Shark(String newName) {
        super(newName, 0, Type.FISH);

        System.out.println("A KILLER IS BORN");
    }
    
public void smellBlood(Boolean bool){
    this.frenzy = bool;
}

public void status(){
    if(this.frenzy == true){
        System.out.println(this.getName() + " is smelling blood and wants to kill.");
    } else {
        System.out.println(this.getName() + " is swimming peacefully.");
    }
}

public void canEat(Animal type){
    if(this == type){
        can = false;
    } else {
        can = true;
    }

}

public void eat(Animal type){
    if(this.can == true){
        System.out.println(this.getName() + " ate a " + type.getType() + " named " + type.getName());
        frenzy = false;
    } else {
        System.out.println(this.getName() + ": It's not worth my time.");
    }
}

}
