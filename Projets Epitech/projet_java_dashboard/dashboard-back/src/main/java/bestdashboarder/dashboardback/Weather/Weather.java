package bestdashboarder.dashboardback.Weather;

import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class Weather {
    public static String ville = "Paris";

    public static String getVille() {
        return ville;
    }

    public void setVille(String ville) {
        Weather.ville = ville;
    }
    
}
