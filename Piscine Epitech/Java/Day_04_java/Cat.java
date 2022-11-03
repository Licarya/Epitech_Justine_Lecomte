public class Cat extends Animal{
 
private String color = "grey";

public String getColor() {
    return color;
}

public Cat(String name, String newColor){
    super(name, 4, Type.MAMMAL);
    color = newColor;

    System.out.println(this.getName() + ": MEEEOOWWWW");
}

public Cat(String name){
    super(name, 4, Type.MAMMAL);

    System.out.println(name + ": MEEEOOWWWW");
}

public void meow(){
    System.out.println(this.getName() + " the " + getColor() + " kitty is meowing." );
}


}

