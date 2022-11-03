package Composite;

import java.util.ArrayList;
import java.util.List;

public class SentenceComposite implements Sentence {

    List<Sentence> childSentence = new ArrayList<>();

    @Override
    public void print() {
        for (Sentence key : childSentence) {
            key.print();
        }
    }

    public void add(Sentence sentence) {
        if(childSentence.contains(sentence) == false){
            childSentence.add(sentence);
        }
    }

    public void remove(Sentence sentence){
        childSentence.remove(sentence);
    }

}
