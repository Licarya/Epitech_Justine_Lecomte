package bestdashboarder.dashboardback.about;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class ApplicationModel {
    private Map<String, String> client = new HashMap<>();
    private ServerModel serverModel;

    public ApplicationModel(Map<String, String> client, ServerModel serverModel) {
        this.client = client;
        this.serverModel = serverModel;
    }

    public Map<String, String> getClient() {
        return client;
    }
    public ServerModel getServer() {
        return serverModel;
    }
}
