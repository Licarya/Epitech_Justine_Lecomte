import java.lang.reflect.InvocationTargetException;

public class Example {
    public static void main(String[] args) throws SecurityException, NoSuchFieldException, InstantiationException,
            IllegalAccessException, IllegalArgumentException, InvocationTargetException, NoSuchMethodException {

        TestRunner test = new TestRunner();
        test.runTests(A.class);
    }
}
