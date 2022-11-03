package Composite;

public class Word implements Sentence {

    public String str;

    public Word(String str) {
        this.str = str;
    }

    @Override
    public void print() {
        System.out.println(this.str);
    }

}
