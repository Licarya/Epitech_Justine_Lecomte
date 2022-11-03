package Observer;

public class Customer implements Observer {

public Customer(){

}

    @Override
    public void update(Observable obs) {
        if(obs instanceof Order){
            System.out.println("Position (" + ((Order) obs).getPosition() +"), " + ((Order) obs).getTimeBeforeArrival() +" minutes before arrival at " + ((Order) obs).getDestination() +".");
            
        }
    }

}
