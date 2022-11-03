abstract class Monster extends Unit {

    protected Monster(String name, int hp, int ap) {
        super(name, hp, ap);
    }

    protected int damage = 0;

    protected int apcost = 0;

    public int getDamage() {
        return damage;
    }

    public int getApcost() {
        return apcost;
    }

    @Override
    public boolean equip(Weapon weapon) {
        System.out.println("Monsters are proud and fight with their own bodies");
        return false;
    }

    @Override
    public boolean attack(Fighter fighter) {
        if (this.moveCloseTo(fighter) == false) {
            System.out.println(this.getName() + ": I'm too far away from " + fighter.getName() + ".");
        } else {
            if(this.getAp() > this.apcost){
                this.ap -= apcost;
                fighter.receiveDamage(damage);
                System.out.println(this.getName() + " attacks " + fighter.getName()+ ".");
            }
        }
        return false;
    }
}
