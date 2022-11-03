public class RadScorpion extends Monster {
    protected int id = 1;

    protected RadScorpion() {
        super("RadScorpion", 80, 50);
        this.name += (" #" + id);
        this.id += 1;
        System.out.println(this.name + ": Crrr!");
        this.apcost = 8;
    }

    @Override
    public boolean attack(Fighter fighter) {
        if (fighter instanceof AssaultTerminator) {
            this.damage = 25;
        } else {
            this.damage = 50;
        }
        return super.attack(fighter);
    }

}
