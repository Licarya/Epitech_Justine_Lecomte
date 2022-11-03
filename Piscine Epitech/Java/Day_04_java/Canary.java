public class Canary extends Animal {

private int eggs;


public int getEggsCount() {
    return eggs;
}

    protected Canary(String newName) {
        super(newName, 2, Type.BIRD);
        this.eggs = 0;

        System.out.println("Yellow and smart? Here I am!");
    }
    
public void layEgg(){
    this.eggs++;
}

}
