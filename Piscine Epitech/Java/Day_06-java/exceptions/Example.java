public class Example {
    public static void main(String[] args) {
        Character warrior = new Warrior("Jean-Luc");
        Character mage = new Mage("Robert");

        warrior.tryToAttack("screwdriver");
        mage.tryToAttack("hammer");
        mage.tryToAttack("wand");
        warrior.tryToAttack("hammer");
        mage.tryToAttack(" ");
        warrior.tryToAttack(" ");
        warrior.tryToAttack("sword");

        try {
            mage.attack("");
        } catch (WeaponException e) {
            System.out.println(e.getMessage());
        }
    }
}
