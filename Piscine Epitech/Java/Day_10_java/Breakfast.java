public class Breakfast<T1 extends Drink, T2 extends Bread> extends Menu<T1,T2> {

    public Breakfast(T1 drink, T2 meal) {
        super(drink, meal);
    }


    
}
