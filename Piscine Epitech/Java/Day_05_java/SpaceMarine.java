abstract class SpaceMarine extends Unit {

    protected Weapon weapon = null;

    public Weapon getWeapon() {
        return this.weapon;
    }


    @Override
    public boolean equip(Weapon weapon) {
       if(this.weapon == null){
           this.weapon = weapon;
           System.out.println(this.getName() + " has been equiped with a " + weapon.getName() + ".");
           return true;
       } else {
        return false;
       }
    }

    @Override
    public boolean attack(Fighter fighter) {
        if(this.weapon == null){
            System.out.println(this.getName() + ": Hey, this is crazy. I'm not going to fight this empty-handed.");
        } else if(weapon.isMelee() == true && this.moveCloseTo(fighter) == false){
            System.out.println(this.getName() + ": I'm too far away from " + fighter.getName() + ".");
        } else if(weapon.isMelee() == false || weapon.isMelee() == true && this.moveCloseTo(fighter) == true){
            if(fighter.getAp() > weapon.getApcost()){
                this.ap -= weapon.getApcost();
                System.out.println(this.getName() + " attacks " + fighter.getName()+ " with a " + weapon.getName() + ".");
                this.weapon.attack();
                fighter.receiveDamage(weapon.getDamage());
            }
        }
        return false;
    }

    @Override
    public boolean moveCloseTo(Fighter fighter) {
        if(weapon.isMelee() == true){
            return super.moveCloseTo(fighter);
        }else {
            return false;
        }
    }

    @Override
    public void recoverAP() {
        this.ap += 2;
        super.recoverAP();
    }

    protected SpaceMarine(String name, int hp, int ap) {
        super(name, hp, ap);
    }

}
