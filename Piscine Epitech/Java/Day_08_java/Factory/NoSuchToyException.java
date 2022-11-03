package Factory;

public class NoSuchToyException extends Exception{
    public NoSuchToyException(String error){
        super(error);
    }
}
