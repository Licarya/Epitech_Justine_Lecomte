package Observer;

import java.util.ArrayList;
import java.util.List;

public class Order implements Observable {

    private String position;
    private String destination;
    private int timeBeforeArrival;
    private List<Observer> observers = new ArrayList<>();

    public String getDestination() {
        return destination;
    }

    public String getPosition() {
        return position;
    }

    public int getTimeBeforeArrival() {
        return timeBeforeArrival;
    }

    public void setData(String position, String destination, int time) {
        this.position = position;
        this.destination = destination;
        this.timeBeforeArrival = time;
        notifyObservers();
    }

    @Override
    public void addObserver(Observer obs) {
        observers.add(obs);
    }

    @Override
    public boolean notifyObservers() {
        for (Observer key : observers) {
            key.update(this);
        }
        return false;
    }

}
