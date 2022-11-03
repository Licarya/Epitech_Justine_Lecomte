public class Lunch<T1 extends Drink, T2 extends Sandwich> extends Menu<T1,T2>{

    public Lunch(T1 drink, T2 meal) {
        super(drink, meal);
    }

    
}
