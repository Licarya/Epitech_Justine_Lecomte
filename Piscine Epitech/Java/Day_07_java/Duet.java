public class Duet<T> {

    public Duet() {

    }


    public static <T extends Comparable<T>> T min(T value1, T value2) {
        if (value1.compareTo(value2) <= 0) {
            return value1;
        } else {
            return value2;
        }
    }

    public static <T extends Comparable<T>> T max(T value1, T value2) {
        if (value1.compareTo(value2) <= 0) {
            return value2;
        } else {
            return value1;
        } 
    }

}
