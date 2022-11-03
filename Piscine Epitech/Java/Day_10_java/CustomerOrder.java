import java.util.ArrayList;
import java.util.List;

public class CustomerOrder {

    public Stock stock;
    public float sum;
    List<Food> order = new ArrayList<>();

    CustomerOrder(Stock stock) {
        this.stock = stock;
    }

    public boolean addItem(Food food) throws NoSuchFoodException {
        if (stock.getNumberOf(food.getClass()) > 0) {
            order.add(food);
            stock.remove(food.getClass());
            return true;
        }
        return false;
    }

    public boolean removeItem(Food food) throws NoSuchFoodException {
        if (order.contains(food)) {
            order.remove(food);
            stock.add(food.getClass());
            return true;
        }
        return false;
    }

    public float getPrice() {
        sum = 0;
        for (Food key : order) {
            sum += key.getPrice();
        }

        return sum;
    }

    public <T1 extends Food, T2 extends Food> boolean addMenu(Menu<T1, T2> menu) throws NoSuchFoodException {
        if ((stock.remove(menu.getDrink().getClass()) && (stock.remove(menu.getMeal().getClass())))) {
            order.add(menu);
            return true;
        }
        return false;
    }

    public <T1 extends Food, T2 extends Food> boolean removeMenu(Menu<T1, T2> menu) throws NoSuchFoodException {
        if ((stock.add(menu.getDrink().getClass()) && (stock.add(menu.getMeal().getClass())))) {
            order.remove(menu);
            return true;
        }
        return false;
    }

    public void printOrder() {
        System.out.println("Your order is composed of:");
        for (Food key : order) {
            if (key instanceof Menu<?, ?>) {
                System.out.println("- " + key.getClass().getName() + " menu (" + key.getPrice() + " euros)");
                System.out.println("-> drink: " + ((Menu<?, ?>) key).getDrink().getClass().getName());
                System.out.println("-> meal: " + ((Menu<?, ?>) key).getMeal().getClass().getName());
            }
            
        }
       for(Food key : order){
        if(!(key instanceof Menu<?,?>)){
            System.out.println("- " + key.getClass().getName() + " (" + key.getPrice() + " euros)");
        }
       }

       System.out.println("For a total of " + getPrice() + " euros.");
    }

}
