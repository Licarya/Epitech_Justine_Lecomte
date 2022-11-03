import java.util.Arrays;
import java.util.List;

public class HamSandwich extends Sandwich{
protected static List<String> ingredients = Arrays.asList("tomato", "salad", "cheese", "ham" , "butter");

    public HamSandwich() {
        super((float) 4.00, 230, false, ingredients);
    }

}
