public abstract class Menu<T1 extends Food, T2 extends Food> implements Food {
    protected T1 drink;
    protected T2 meal;

    public Menu(T1 drink, T2 meal) {
        this.drink = drink;
        this.meal = meal;
    }

    public T1 getDrink() {
        return drink;
    }

    public T2 getMeal() {
        return meal;
    }

    @Override
    public int getCalories() {
        return 0;
    }

    @Override
    public float getPrice() {
        return (float) ((drink.getPrice() + meal.getPrice()) * 0.9);
    }

}
