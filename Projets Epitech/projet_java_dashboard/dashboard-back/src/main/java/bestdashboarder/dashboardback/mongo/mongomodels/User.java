package bestdashboarder.dashboardback.mongo.mongomodels;

import java.util.HashSet;
import java.util.Set;

public class User {
    private String name;
    private String email;
    private String password;
    private ConnectionProvider connectionProvider;
    private String avatarUrl;
    private Set<DashboardServices> services;
    private String githubAPIKey;

    public User(
        String name, 
        String email,
        ConnectionProvider connectionProvider
    ) {
        this.name = name;
        this.email = email;
        this.password = null;
        this.connectionProvider = connectionProvider;
        this.avatarUrl = null;

        this.services = new HashSet<>();
        this.services.add(DashboardServices.WEATHER);
        this.services.add(DashboardServices.DEEZER);
        this.services.add(DashboardServices.NEWS);
    }

    public User(
        String name,
        String email,
        String avatarUrl,
        ConnectionProvider connectionProvider
    ) {
        this.name = name;
        this.email = email;
        this.password = null;
        this.connectionProvider = connectionProvider;
        this.avatarUrl = avatarUrl;

        this.services = new HashSet<>();
        this.services.add(DashboardServices.WEATHER);
        this.services.add(DashboardServices.DEEZER);
        this.services.add(DashboardServices.NEWS);
        DashboardServices service = DashboardServices.getServiceOfProvider(
            connectionProvider
        );
        if (service != null) this.services.add(service);
    }

    public String getName() {
        return this.name;
    }
    public void setName(String name) {
        this.name = name;
    }
    
    public String getEmail() {
        return this.email;
    }
    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return this.password;
    }
    public void setPassword(String password) {
        this.password = password;
    }
    
    public ConnectionProvider getConnectionProvider() {
        return this.connectionProvider;
    }
    public void setConnectionProvider(ConnectionProvider connectionProvider) {
        this.connectionProvider = connectionProvider;
    }

    public String getAvatarUrl() {
        return this.avatarUrl;
    }
    public void setAvatarUrl(String avatarUrl) {
        this.avatarUrl = avatarUrl;
    }

    public Set<DashboardServices> getServices() {
        return this.services;
    }
    public void addService(DashboardServices service) {
        this.services.add(service);
    }
    public void removeService(DashboardServices service) {
        this.services.remove(service);
    }

    public String getGithubAPIKey() {
        return githubAPIKey;
    }
    public void setGithubAPIKey(String githubAPIKey) {
        this.githubAPIKey = githubAPIKey;
    }
}
