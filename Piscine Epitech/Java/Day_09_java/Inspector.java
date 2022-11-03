import java.lang.reflect.Field;
import java.lang.reflect.InvocationTargetException;
import java.lang.reflect.Method;

public class Inspector<T> {
    private Class<T> inspectedClass;

    Inspector(Class<T> insp){
        this.inspectedClass = insp;
    }

    public void displayInformations() {
        System.out.println("Information of the " + '"' + inspectedClass.getName() + '"' + " class:");
        System.out.println("Superclass: " + inspectedClass.getSuperclass().getName());
        System.out.println(inspectedClass.getDeclaredMethods().length + " methods:");
        for (Method key : inspectedClass.getDeclaredMethods()) {
            System.out.println("- " + key.getName());
        }

        System.out.println(inspectedClass.getDeclaredFields().length + " fields:");
        for (Field key : inspectedClass.getDeclaredFields()) {
            System.out.println("- " + key.getName());
        }
    }
    public T createInstance() throws SecurityException, NoSuchFieldException, InstantiationException, IllegalAccessException, IllegalArgumentException, InvocationTargetException, NoSuchMethodException{
         return inspectedClass.getDeclaredConstructor().newInstance();
    }

}
