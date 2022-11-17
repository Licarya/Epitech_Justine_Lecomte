package bestdashboarder.dashboardback.rssFlux;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;
import org.xml.sax.SAXException;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import java.io.IOException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

public class RSSReader {
    public List<RSSModel> GetRSSFlux(URL url, String itemTag, String titleTag, String descriptionTag, String linkTag, String dateTag) throws ParserConfigurationException, IOException, SAXException {
        DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
        factory.setNamespaceAware(true);
        DocumentBuilder builder = factory.newDocumentBuilder();
        Document doc = builder.parse(url.openStream());

        String title;
        String description;
        String link;
        String date;
        NodeList nodes = doc.getElementsByTagName(itemTag);
        List<RSSModel> rssModelList = new ArrayList<>();
        for(int i = 0; i < nodes.getLength(); i++){
            Element element = (Element) nodes.item(i);

            title = element.getElementsByTagName(titleTag).item(0)
                    .getTextContent().trim().replace("\n", "");
            description = element.getElementsByTagName(descriptionTag).item(0)
                    .getTextContent().trim().replace("\n", "");
            link = element.getElementsByTagName(linkTag).item(0)
                    .getTextContent().trim().replace("\n", "");
            date = element.getElementsByTagName(dateTag).item(0)
                    .getTextContent().trim().replace("\n", "");

            RSSModel rssModel = new RSSModel(
                    title,
                    description,
                    link,
                    date
            );
            rssModelList.add(rssModel);
        }
        return rssModelList;
    }
}
