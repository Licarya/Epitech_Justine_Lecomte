package bestdashboarder.dashboardback.rssFlux;

public class RSSModel {
    private String title;
    private String description;
    private String link;
    private String date;

    public RSSModel(String title, String description, String link, String date) {
        this.title = title;
        this.description = description;
        this.link = link;
        this.date = date;
    }

    public String getTitle() {
        return title;
    }
    public String getDescription() {
        return description;
    }
    public String getLink() {
        return link;
    }
    public String getDate() {
        return date;
    }
}
