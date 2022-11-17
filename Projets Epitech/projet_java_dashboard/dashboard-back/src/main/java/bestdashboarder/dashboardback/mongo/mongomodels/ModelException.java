package bestdashboarder.dashboardback.mongo.mongomodels;

public class ModelException extends Exception {
    public ModelException(
        final String entityName,
        final String fieldName
    ) {
        super(String.format(
            "Invalid model for the entity: %s\n" +
            "The field: %s is not valid.\n",
            entityName,
            fieldName
        ));
    }
}
