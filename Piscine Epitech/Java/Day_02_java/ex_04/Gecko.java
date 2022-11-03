public class Gecko {
private String name = "Unknown";
private int age;
    public String getName(){
        return name;
    }

    public int getAge(){ return age;}

    public void setAge(int newAge){ age = newAge; }

    Gecko(String newName, int newAge){
       age = newAge;
        name = newName;
        System.out.println("Hello " + name +"!");
    }

    Gecko(String newName) {
        name = newName;
        System.out.println("Hello " + name + "!");
    }

    Gecko(){System.out.println("Hello!"); }

    public void status(){
        switch(age){
            case 0:
                System.out.println("Unborn Gecko");
                break;

            case 1,2:
                System.out.println("Baby Gecko");
                break;

                case 3,4,5,6,7,8,9,10:
                    System.out.println("Adult Gecko");
                    break;

                    case 11,12,13:
                        System.out.println("Old Gecko");
                        break;
            default:
                System.out.println("Impossible Gecko");
                break;

        }
    }

/*
    public static void main (String[] args) {
        Gecko arthur = new Gecko("Arthur",0);

        Gecko yasmine = new Gecko("Arthur",8);
        Gecko herbert = new Gecko("Arthur",15);
        Gecko benjy = new Gecko();
        arthur.status();
        yasmine.status();
        herbert.status();
        benjy.status();
    }*/
}