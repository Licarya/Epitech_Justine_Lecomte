package bestdashboarder.dashboardback.about;

public class ParamsModel {
    private String name;
    private String type;

    public ParamsModel(String name, String type) {
        this.name = name;
        this.type = type;
    }

    public String getName() {
        return name;
    }

    public String getType() {
        return type;
    }
}
