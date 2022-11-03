package chocolate;

public class Mars {
    static int count = 0;
    private int id = 0;

    public Mars(){
        this.id = count;
        count = id + 1;
    }

    public int getId(){
        return id;
    }



   /* public static void main(String[] args){
        Mars rocks = new Mars();
        Mars lite = new Mars();
        Mars snack = new Mars();
      System.out.println(rocks.getId());
      System.out.println(lite.getId());
    System.out.println(snack.getId());
    }*/


}