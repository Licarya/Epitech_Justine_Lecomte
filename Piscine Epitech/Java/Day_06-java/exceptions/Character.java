abstract class Character implements Movable {
    protected String name;
    protected int life = 50;
    protected int agility = 2;
    protected int strength = 2;
    protected int wit = 2;
    protected final String RPGClass;

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

    public Character(String name, String RPGClass) {
        this.name = name;
        this.RPGClass = RPGClass;
    }

    public void attack(String weapon) throws WeaponException {
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

    final void unsheathe() {
        System.out.println(this.getName() + ": unsheathes his weapon.");
    }

    public void tryToAttack(String weapon) {

        try {
            if (weapon == "" || weapon == null || weapon == " ") {
                System.out.println(this.getName() + ": I refuse to fight with my bare hands.");
            } else if (RPGClass == "Warrior"  && (weapon != "sword" && weapon != "hammer")) {
                System.out.println(this.getName() + ": A " + weapon + "?? What should I do with this?!");
            } else if (RPGClass == "Mage" && (weapon != "magic" && weapon != "wand")) {
                System.out.println(this.getName() + ": I don't need this stupid " + weapon + "! Don't misjudge my powers!");
                } else {
                    attack(weapon);
                }
           
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }

}
