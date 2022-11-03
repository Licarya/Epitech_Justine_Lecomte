package Factory;

import java.util.ArrayList;
import java.util.List;

public class Factory {


public Toy create(String toy) throws NoSuchToyException{
    if(toy.equals("teddy")){
        return new TeddyBear();
    } else if(toy.equals("gameboy")){
        return new Gameboy();
    } else{
        throw new NoSuchToyException("No such toy: " + toy + ".");
    }
}

public List<GiftPaper> getPapers(int nb) {
    List<GiftPaper> gift = new ArrayList<>();
    for(int i = 0 ; i < nb ; i++){
        gift.add(new GiftPaper());
    }
    return gift;
}


}
