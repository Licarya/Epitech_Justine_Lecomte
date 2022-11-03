import java.util.ArrayList;
import java.util.List;

public abstract class Sandwich  implements Food{
    protected boolean vegetarian = false;
    protected List<String> ingredients = new ArrayList<>();
    protected float price;
    protected int calories;
    
        public Sandwich(float price, int calories, boolean vegetarian, List<String> ingredients){
            this.price = price;
            this.calories = calories;
            this.vegetarian = vegetarian;
            this.ingredients = ingredients;
        }

    public boolean isVegetarian() {
        return vegetarian;
    }
    public List<String> getIngredients() {
        return ingredients;
    }

    @Override
    public float getPrice() {
        return price;
    }

    @Override
    public int getCalories() {
        return calories;
    }

    
}
