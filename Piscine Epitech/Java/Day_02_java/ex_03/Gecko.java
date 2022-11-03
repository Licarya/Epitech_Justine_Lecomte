public class Gecko {
private String name = "Unknown";
    public String getName(){
        return name;
    }

   Gecko(String newName){
        name = newName;
        System.out.println("Hello " + name +"!");
   }

   Gecko(){
        System.out.println("Hello!");
           }

      /*  public static void main (String[] args) {
            Gecko arthur = new Gecko("Arthur");
            Gecko yasmine = new Gecko("yasmine");
            Gecko herbert = new Gecko("herbert");

            Gecko benjy = new Gecko();

            System.out.println(arthur.getName());
            System.out.println(yasmine.getName());
            System.out.println(herbert.getName());

            System.out.println(benjy.getName());
    }*/
}