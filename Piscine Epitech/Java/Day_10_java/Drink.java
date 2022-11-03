public abstract class Drink implements Food{
    protected boolean aCan = false;
protected float price;
protected int calories;

 public boolean isACan() {
     return aCan;
 }

    public Drink(float price, int calories, boolean aCan){
        this.price = price;
        this.calories = calories;
        this.aCan = aCan;
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
