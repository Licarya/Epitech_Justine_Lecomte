public class BlueShark extends Shark{

    protected BlueShark(String newName) {
        super(newName);
    }

    @Override
    public void canEat(Animal type){
        if(this == type || type.getType() != "fish"){
            this.can = false;
        } else {
            this.can = true;
        }
        System.out.println(can);
    }
 


}
