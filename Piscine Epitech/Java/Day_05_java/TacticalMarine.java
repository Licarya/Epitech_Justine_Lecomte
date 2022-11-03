public class TacticalMarine extends SpaceMarine {
    
    protected TacticalMarine(String name) {
        super(name, 100, 20);
        PlasmaRifle rifle = new PlasmaRifle();
        this.equip(rifle);
        System.out.println(this.name + " on duty.");
    }


    @Override
    public void recoverAP() {
        this.ap += 3;
        super.recoverAP();
    }


    
}
