abstract class Character implements Comparable<Character>, Movable{
    protected String name;
    protected int life = 50;
    protected int agility = 2;
    protected int strength = 2;
    protected int wit = 2;
    protected final String RPGClass;
    protected int capacity = 0;

    public int getAgility() {
        return agility;
    }

    public int getLife() {
        return life;
    }

    public String getName() {
        return name;
    }

    public String getRPGClass() {
        return RPGClass;
    }

    public int getStrength() {
        return strength;
    }

    public int getWit() {
        return wit;
    }

    public Character(String name, String RPGClass, int capacity) {
        this.name = name;
        this.RPGClass = RPGClass;
        this.capacity = capacity;
    }

    public Character(String name, String RPGClass) {
        this.name = name;
        this.RPGClass = RPGClass;
    }

    public void attack(String att) {
        System.out.println(this.getName() + ": Rrrrrrrrr....");
    }


@Override
public void moveBack() {
    System.out.println(this.getName() + ": moves back");
}

@Override
public void moveRight() {
    System.out.println(this.getName() + ": moves right");
}

@Override
public void moveLeft() {
    System.out.println(this.getName() + ": moves left");
}

@Override
public void moveForward() {
    System.out.println(this.getName() + ": moves forward");
}

final void unsheathe(){
    System.out.println(this.getName() + ": unsheathes his weapon.");
}

public int getCapacity() {
    return capacity;
}

@Override
public int compareTo(Character character) {
    if(this != character){
        if (this.RPGClass == character.getRPGClass()) {
            if (this.getCapacity() == character.getCapacity()) {
                return 0;
            } else {
                return 1;
            }
        } else if(this.RPGClass == "Warrior" && character.RPGClass == "Mage"){
            return (this.capacity % character.capacity) == 0 ? -1 : 1;
        } else if(this.RPGClass == "Mage" && character.RPGClass == "Warrior"){
            return (character.capacity % this.capacity) == 0 ? -1 : 1;
        } else {
            return 1;
        }

    } else {
        return 0;
    }
    

}

}
