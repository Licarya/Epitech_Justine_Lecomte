import java.lang.reflect.InvocationTargetException;
import java.lang.reflect.Method;

public class TestRunner<T> {
    public void runTests(Class<T> anno) throws IllegalAccessException, IllegalArgumentException, InvocationTargetException, SecurityException, NoSuchFieldException, InstantiationException, NoSuchMethodException {
        Inspector<T> inst = new Inspector<>(anno);
        
        for(Method bef : anno.getDeclaredMethods()){
            if(bef.isAnnotationPresent(BeforeClass.class)){
                bef.invoke(inst.createInstance());
            }
        }

        for(Method meth : anno.getDeclaredMethods()){

            if(meth.isAnnotationPresent(Before.class)){
                meth.invoke(inst.createInstance());
            }

            if(meth.isAnnotationPresent(Test.class) && meth.getAnnotation(Test.class).enabled()){
                System.out.println(meth.getAnnotation(Test.class).name());
                meth.invoke(inst.createInstance());

            }
            if(meth.isAnnotationPresent(After.class)){
                meth.invoke(inst.createInstance());
            }

        }

        for(Method aft : anno.getDeclaredMethods()){
            if(aft.isAnnotationPresent(AfterClass.class)){
                aft.invoke(inst.createInstance());
            }
        }
    }
}

