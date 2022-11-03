public class Gecko {
    private String name = "Unknown";
    private int age = 25;
    private int energy = 100;

    public String getName() {
        return name;
    }

    public int getAge() {
        return age;
    }
    public void setAge(int newAge) {
        age = newAge;
    }

    public int getEnergy(){
        return energy;}

    public void setEnergy(int newEnergy){
      this.energy = newEnergy;
    }


    Gecko(String newName, int newAge) {
        age = newAge;
        name = newName;
        System.out.println("Hello " + name + "!");
    }

    Gecko(String newName) {
        name = newName;
        System.out.println("Hello " + name + "!");
    }

    Gecko() {
        System.out.println("Hello!");
    }

    public void status() {
        switch (age) {
            case 0:
                System.out.println("Unborn Gecko");
                break;

            case 1, 2:
                System.out.println("Baby Gecko");
                break;

            case 3, 4, 5, 6, 7, 8, 9, 10:
                System.out.println("Adult Gecko");
                break;

            case 11, 12, 13:
                System.out.println("Old Gecko");
                break;
            default:
                System.out.println("Impossible Gecko");
                break;

        }
    }

    public void hello(String call) {
        System.out.println("Hello " + call + ",  I'm " + name + "!");
    }

    
    public void hello(int repet) {
        while (repet != 0) {
            System.out.println("Hello,  I'm " + name + "!");
            repet--;
        }
    }


    public void eat(String miam){
        miam = miam.toUpperCase();
        if(miam.matches("MEAT")){
            energy += 10;
            if(energy > 100){
                this.setEnergy(100);
            }
            System.out.println("Yummy!");
        } else if(miam.matches("VEGETABLE")){
            energy -= 10;
            if(energy < 0){
                this.setEnergy(0);
            }
            System.out.println("Erk!");
        } else{
            System.out.println("I can't eat this!");
        }
    }

    public void work(){
        if(this.energy >= 25 ){
            System.out.println("I'm working T.T");
            energy -= 9;
        } else if (this.energy < 25){
            System.out.println("Heyyy I'm too sleepy, better take a nap!");
            energy += 50;
        }

    }

    public void fraternize(Gecko friend){
        if(this.getEnergy() > 30 && friend.getEnergy() > 30){
            this.energy -= 30;
            friend.energy -= 30;
            System.out.println("I'm going to drink with " + friend.getName()+"!");
            System.out.println("I'm going to drink with " + this.getName()+"!");
        } else if (friend.getEnergy() < 30 && this.getEnergy() < 30) {
            System.out.println("Not today!");
            System.out.println("Not today!");
        }else if(this.getEnergy() < 30){
            System.out.println("Sorry "+ friend.getName()+", I'm too tired to go out tonight.");
            System.out.println("Oh! That's too bad, another time then!");
        } else if (friend.getEnergy() < 30) {
            System.out.println("Sorry "+ this.getName()+", I'm too tired to go out tonight.");
            System.out.println("Oh! That's too bad, another time then!");
        }
    }

      public static void main (String[]args){
            Gecko mimi = new Gecko("mimi");
            Gecko arthur = new Gecko("Arthur");
          mimi.fraternize(arthur);
        }
}