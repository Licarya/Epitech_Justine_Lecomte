import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class Stock {
    Map<Class<? extends Food>, Integer> numberOf = new HashMap<>();
    List<Class<? extends Food>> miam = Arrays.asList(AppleSmoothie.class, CheeseCake.class, Coke.class, Cookie.class,
            FrenchBaguette.class, HamSandwich.class, Panini.class, SoftBread.class);

    public Stock() {
        for (Class<? extends Food> key : miam) {
            numberOf.put(key, 100);
        }
    }

    public int getNumberOf(Class<? extends Food> food) {
        return numberOf.get(food);
    }

    public boolean add(Class<? extends Food> food) throws NoSuchFoodException {
        if(numberOf.containsKey(food)){
            int temp = numberOf.get(food);
                temp++;
                numberOf.replace(food, temp);
                return true;
        }else {
        throw new NoSuchFoodException("No such food type: " + food + ".");
        }
    }

    public boolean remove(Class<? extends Food> food) throws NoSuchFoodException{
       if(numberOf.containsKey(food)){
           int temp = numberOf.get(food);
   
           if (temp > 0) {
               temp--;
               numberOf.replace(food, temp);
               return true;
           }
       }else {
           throw new NoSuchFoodException("No such food type: " + food + ".");
       }
        return false;
    }

    public boolean contains(Drink drink) {
        return false;
    }
}
