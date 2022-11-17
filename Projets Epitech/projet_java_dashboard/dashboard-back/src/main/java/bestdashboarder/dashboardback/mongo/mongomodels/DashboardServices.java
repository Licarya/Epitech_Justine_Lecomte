package bestdashboarder.dashboardback.mongo.mongomodels;

public enum DashboardServices {
    WEATHER, GITHUB, GOOGLE, DEEZER, NEWS;

    public static DashboardServices getServiceOfProvider(
        ConnectionProvider provider
    ) {
        if (provider == ConnectionProvider.LOCAL)
            return null;
        return provider == ConnectionProvider.GITHUB ?
            GITHUB : GOOGLE;
    }
}
