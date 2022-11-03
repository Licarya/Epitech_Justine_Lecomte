public class Snake {
    private String name = "Unknown";
    private int energy = 100;
    Snake(String newName) {
        name = newName;
    }
    public int getEnergy(){
        return energy;}
    public void setEnergy(int newEnergy){
        this.energy = newEnergy;
    }
    public void fraternize(Snake enemy) {
        if (this.energy >= 10){
            System.out.println("LET'S RUN AWAY!!!");
            this.setEnergy(0);
        } else {
            System.out.println("...");
        }
    }

    public static void main (String[]args){
        Snake mimi = new Snake("mimi");
        Snake arthur = new Snake("Arthur");
        arthur.fraternize(mimi);
        arthur.fraternize(mimi);

    }
}
