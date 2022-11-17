package bestdashboarder.dashboardback.about;

import java.util.ArrayList;
import java.util.List;

public class ServerModel {
    private long current_time;
    private List<ServiceModel> services = new ArrayList<>();

    public ServerModel(long current_time, List<ServiceModel> services) {
        this.current_time = current_time;
        this.services = services;
    }

    public long getCurrent_time() {
        return current_time;
    }

    public List<ServiceModel> getServices() {
        return services;
    }
}
