public class SuperMutant extends Monster {
    protected int id = 1;

    protected SuperMutant() {
        super("SuperMutant", 170, 20);
        this.name += (" #" + id);
        this.id += 1;
        System.out.println(this.name + ": Roaarrr!");
        this.apcost = 20;
        this.damage = 60;
    }

    @Override
    public void recoverAP() {
        this.hp += 10;
        if(hp >= 170){
            this.hp =170;
        }
        super.recoverAP();
    }

}
