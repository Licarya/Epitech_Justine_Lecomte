public class Example {
    public static void main(String[] args){
        Cat isidore = new Cat("Isidore", "orange");
        Canary titi = new Canary("Titi");
        Shark willy = new Shark("Willy");
        BlueShark rex = new BlueShark("Rex");
        GreatWhite tom = new GreatWhite("Tom");


        rex.status();
        rex.canEat(titi);
        rex.eat(titi);
  
        tom.status();
        tom.canEat(tom);
        tom.eat(tom);
        tom.status();

        tom.canEat(titi);
        tom.eat(titi);
        tom.status();

tom.canEat(willy);
tom.eat(willy);

tom.canEat(isidore);
tom.eat(isidore);

       
    }
}
