import java.util.Arrays;
import java.util.List;

public class Panini extends Sandwich{
    
    protected static List<String> ingredients = Arrays.asList("tomato", "salad", "cucumber", "avocado" , "cheese");

    public Panini() {
        super((float) 3.50, 120, true, ingredients);
    }

 
}
