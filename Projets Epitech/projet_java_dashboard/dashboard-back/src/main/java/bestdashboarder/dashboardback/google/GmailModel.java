package bestdashboarder.dashboardback.google;

public class GmailModel {
    private String fromName;
    private String fromEmail;
    private String subject;
    private String snippet;

    public GmailModel(String fromName, String fromEmail, String subject, String snippet) {
        this.fromName = fromName;
        this.fromEmail = fromEmail;
        this.subject = subject;
        this.snippet = snippet;
    }

    public String getFromName() {
        return fromName;
    }
    public String getFromEmail() {
        return fromEmail;
    }
    public String getSubject() {
        return subject;
    }
    public String getSnippet() {
        return snippet;
    }
}