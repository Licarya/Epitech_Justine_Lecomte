package bestdashboarder.dashboardback.rssFlux;

import io.swagger.annotations.ApiOperation;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;
import org.xml.sax.SAXException;

import javax.xml.parsers.ParserConfigurationException;
import java.io.IOException;
import java.net.URL;
import java.util.List;

@RestController
public class RSSController {

    @ApiOperation(
        value = "Get list of news", 
        notes = "Return current news from the newsletter [Le Monde Informatique](https://www.lemondeinformatique.fr/)"
    )
    @GetMapping("/news/lemonde")
    public ResponseEntity<List<RSSModel>> getNewsLeMonde() throws ParserConfigurationException, IOException, SAXException {
        URL url = new URL("https://www.lemondeinformatique.fr/flux-rss/thematique/toutes-les-actualites/rss.xml");
        List<RSSModel> articles = new RSSReader().GetRSSFlux(
            url,
            "item",
            "title",
            "description",
            "link",
            "dc:date"
        );
        return new ResponseEntity<>(
            articles,
            HttpStatus.OK
        );
    }

    @ApiOperation(
        value = "Get list of news", 
        notes = "Return current news from the newsletter [Sciences et Avenir](https://www.sciencesetavenir.fr/)"
    )
    @GetMapping("/news/sciences")
    public ResponseEntity<List<RSSModel>> getNewsSciences() throws 
        ParserConfigurationException, IOException, SAXException {
        URL url = new URL("https://www.sciencesetavenir.fr/high-tech/rss.xml");
        List<RSSModel> articles = new RSSReader().GetRSSFlux(
            url,
            "item",
            "title",
            "description",
            "link",
            "pubDate"
        );
        return new ResponseEntity<>(
            articles,
            HttpStatus.OK
        );
    }
}
