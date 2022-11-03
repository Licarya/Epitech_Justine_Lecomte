package Observer;

public interface Observable {
    public void addObserver(Observer obs);
    public boolean notifyObservers();

    
}
