package bestdashboarder.dashboardback.about;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class WidgetModel {
    private String name;
    private String description;
    private List<ParamsModel> params = new ArrayList<>();

    public WidgetModel(String name, String description, List<ParamsModel> params) {
        this.name = name;
        this.description = description;
        this.params = params;
    }

    public String getName() {
        return name;
    }

    public String getDescription() {
        return description;
    }

    public List<ParamsModel> getParams() {
        return params;
    }
}
