package bestdashboarder.dashboardback.mongo.mongomodels;

public enum WidgetType {
    GIT_ONE_REPO,
    GIT_REPOS,
    WEATHER_DAY,
    WEATHER_HOURS,
    DEEZER_TITLES_SEARCH,
    DEEZER_ALBUMS_SEARCH,
    GOOGLE_SEE_EMAILS,
    GOOGLE_SEND_EMAIL,
    NEWS_LE_MONDE,
    NEWS_SCIENCE;

    public static WidgetType getWidgetTypeFromString(String type) {
        switch (type.toLowerCase()) {
            case "git_one_repo":
                return GIT_ONE_REPO;
            case "git_repos":
                return GIT_REPOS;
            case "weather_day":
                return WEATHER_DAY;
            case "weather_hours":
                return WEATHER_HOURS;
            case "deezer_titles_search":
                return DEEZER_TITLES_SEARCH;
            case "deezer_albums_search":
                return DEEZER_ALBUMS_SEARCH;
            case "google_see_emails":
                return GOOGLE_SEE_EMAILS;
            case "google_send_email":
                return GOOGLE_SEND_EMAIL;
            case "news_le_monde":
                return NEWS_LE_MONDE;
            case "news_science":
                return NEWS_SCIENCE;
            default:
                return null;
        }
    }
}
