public class Mage extends Character {
    public Mage(String name) {
        super(name, "Mage");
        this.name = name;
        this.life = 70;
        this.strength = 3;
        this.agility = 10;
        this.wit = 10;
        System.out.println(this.getName() + ": May the gods be with me.");

    }

    @Override
    public void attack(String weapon) throws WeaponException {
        if (weapon == "magic" || weapon == "wand") {
            super.attack(weapon);
            System.out.println(this.getName() + ": Feel the power of my " + weapon + "!");
        }
        else{
            tryToAttack(weapon);
        }
    }

    @Override
    public void moveBack() {
        System.out.println(this.getName() + ": moves back furtively.");
    }

    @Override
    public void moveForward() {
        System.out.println(this.getName() + ": moves forward furtively.");

    }

    @Override
    public void moveLeft() {
        System.out.println(this.getName() + ": moves left furtively.");

    }

    @Override
    public void moveRight() {
        System.out.println(this.getName() + ": moves right furtively.");

    }


}

