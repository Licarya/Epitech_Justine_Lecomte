package bestdashboarder.dashboardback.about;

import java.util.ArrayList;
import java.util.List;

public class ServiceModel {
    private String name;
    private List<WidgetModel> widgets = new ArrayList<>();

    public ServiceModel(String name){
        this.name = name;
    }

    public ServiceModel(String name, List<WidgetModel> widgets) {
        this.name = name;
        this.widgets = widgets;
    }

    public String getName() {
        return name;
    }

    public List<WidgetModel> getWidgets() {
        return widgets;
    }

    public void addWidgets(WidgetModel widget) {
        this.widgets.add(widget);
    }
}
