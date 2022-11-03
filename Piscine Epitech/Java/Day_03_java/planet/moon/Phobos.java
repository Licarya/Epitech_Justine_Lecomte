package planet.moon;

import planet.Mars;

public class Phobos {

    private planet.Mars mars;
    private String landingSite;

    public planet.Mars getMars(){
        return mars;
    }

    public String getLandingSite(){
        return landingSite;
    }

    public Phobos(planet.Mars newMars, String landing){
        mars = newMars;
        landingSite = landing;
        System.out.println("Phobos placed in orbit");
    }

    public Phobos(){
        System.out.println("No planet given.");
    }

}
