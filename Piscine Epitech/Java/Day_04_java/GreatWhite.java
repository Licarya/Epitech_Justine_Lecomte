public class GreatWhite extends Shark{
    
    protected GreatWhite(String newName) {
        super(newName);
    }

    @Override
    public void canEat(Animal type){
        if(this == type || type instanceof Canary){
            System.out.println(this.getName() + ": Next time you try to give me that to eat, I'll eat you instead.");
            can = false;
        } else if (type instanceof Shark){
            System.out.println(this.getName() + ": The best meal one could wish for.");
            can = true;
        }
    
    }
   
    
}
