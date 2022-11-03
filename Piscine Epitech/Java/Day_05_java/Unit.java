abstract class Unit implements Fighter {
    protected String name;
    protected int hp;
    protected int ap;
    protected boolean alive;

    protected Unit(String name, int hp, int ap) {
        this.name = name;
        this.hp = hp;
        this.ap = ap;
    }

    @Override
    public String getName() {
        return name;
    }

    @Override
    public int getHp() {
        return hp;
    }

    @Override
    public int getAp() {
        return ap;
    }

    @Override
    public void receiveDamage(int newDamage) {
        this.hp = this.hp - newDamage;
        if (this.hp <= 0) {
            this.alive = false;
            this.hp = 0;
        }

    }

    @Override
    public boolean moveCloseTo(Fighter fighter) {
        if(fighter == this){
            return false;
        } else if(fighter != this && fighter.moveCloseTo(fighter)){
            return false;
        } else if(fighter != this && fighter.moveCloseTo(fighter) == false){
            System.out.println(this.name + ": is moving closer to " + fighter.getName() + ".");
            return true;
        } else {
            return false;
        }
    }

    @Override
    public void recoverAP() {
        this.ap += 7;
        if(this.hp <= 0){
            this.hp = 0;
        }
        if(this.ap >= 50){
            this.ap = 50;
        }
    }

    @Override
    public boolean equip(Weapon weapon) {
        return false;
    }

    @Override
    public boolean attack(Fighter fighter) {
        return false;
    }

}
