public class Warrior extends Character {

    public Warrior(String name) {
        super(name, "Warrior");
        this.name = name;
        this.life = 100;
        this.strength = 10;
        this.agility = 8;
        this.wit = 3;
        System.out.println(this.getName() + ": My name will go down in history!");
    }

    @Override
    public void attack(String weapon) throws WeaponException {
        if (weapon == "hammer" || weapon == "sword") {
            super.attack(weapon);
            System.out.println(this.getName() + ": I'll crush you with my " + weapon + "!");
        } else {
            tryToAttack(weapon);
        }
    }

    @Override
    public void moveBack() {
      System.out.println(this.getName() + ": moves back like a bad boy.");
    }
    
    @Override
    public void moveForward() {
        System.out.println(this.getName() + ": moves forward like a bad boy.");
    
    }
    
    @Override
    public void moveLeft() {
        System.out.println(this.getName() + ": moves left like a bad boy.");
    
    }
    
    @Override
    public void moveRight() {
        System.out.println(this.getName() + ": moves right like a bad boy.");
    
    }


}
