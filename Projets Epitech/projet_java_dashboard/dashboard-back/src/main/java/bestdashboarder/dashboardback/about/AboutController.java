package bestdashboarder.dashboardback.about;

import com.google.common.net.HttpHeaders;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestHeader;
import org.springframework.web.bind.annotation.RestController;

import java.util.*;

@RestController
public class AboutController {
    private Map<String, String> client = new HashMap<>();
    private ServerModel server;
    private List<ServiceModel> services = new ArrayList<>();

    @GetMapping("/about.json")
    public ApplicationModel aboutDashboard(@RequestHeader(HttpHeaders.HOST) String host) throws InstantiationException, IllegalAccessException {
        client = new HashMap<>();
        services = new ArrayList<>();
        ServiceModel deezerService = new ServiceModel("deezer");
        ServiceModel githubService = new ServiceModel("github");
        ServiceModel rssFluxService = new ServiceModel("rssFlux");
        ServiceModel weatherService = new ServiceModel("weather");

        WidgetModel deezerWidget1 = new WidgetModel(
                "research",
                "Search titles from Deezer site",
                Arrays.asList(new ParamsModel("search", "String")));
        WidgetModel deezerWidget2 = new WidgetModel(
                "researchAlbums",
                "Search albums from Deezer site",
                Arrays.asList(new ParamsModel("search", "String")));
        WidgetModel githubWidget1 = new WidgetModel(
                "githubOverview",
                "Get an overview of all repositories of any user",
                Arrays.asList(new ParamsModel("username","String"), new ParamsModel("githubSessionId","String")));
        WidgetModel githubWidget2 = new WidgetModel(
                "githubOneRepos",
                "Get all content of a repository",
                Arrays.asList(new ParamsModel("idRepos", "int")));
        WidgetModel rssFluxWidget1 = new WidgetModel(
                "GetNews0",
                "Get the most recent news of the newsletter : Le Monde Informatique",
                null);
        WidgetModel rssFluxWidget2 = new WidgetModel(
                "GetNews1",
                "Get the most recent news of the newsletter : Sciences et Avenir",
                null);
        WidgetModel weatherWidget1 = new WidgetModel(
                "getActualWeather",
                "Get actual weather of the day",
                Arrays.asList(new ParamsModel("city", "String")));
        WidgetModel weatherWidget2 = new WidgetModel(
                "hourlyDataList",
                "Get weather hour per hour",
                Arrays.asList(new ParamsModel("city", "String")));

        deezerService.addWidgets(deezerWidget1);
        deezerService.addWidgets(deezerWidget2);
        githubService.addWidgets(githubWidget1);
        githubService.addWidgets(githubWidget2);
        rssFluxService.addWidgets(rssFluxWidget1);
        rssFluxService.addWidgets(rssFluxWidget2);
        weatherService.addWidgets(weatherWidget1);
        weatherService.addWidgets(weatherWidget2);

        client.put("host", host);
        services.add(deezerService);
        services.add(githubService);
        services.add(rssFluxService);
        services.add(weatherService);
        server = new ServerModel(System.currentTimeMillis()/1000L, services);

        ApplicationModel applicationModel = new ApplicationModel(client, server);
        return applicationModel;
    }
}
