package bestdashboarder.dashboardback.Deezer;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.json.simple.JSONObject;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.client.RestTemplate;

@SpringBootApplication
@RestController
public class DeezerController {

    @GetMapping("/deezer")
    public ResponseEntity<Object> research(@RequestParam String search) {
        if (search.trim().isEmpty())
            return new ResponseEntity<>(
                "Nothing to search for",
                HttpStatus.BAD_REQUEST
            );

        String urlSearch = "https://api.deezer.com/search?q=" + search;
        RestTemplate restTemplate = new RestTemplate();
        JSONObject resultSearch = restTemplate.getForObject(urlSearch, JSONObject.class);
        List<JSONObject> data = (List<JSONObject>) resultSearch.get("data");

        List<Object> allTitre = new ArrayList<>();
        List<Object> id_album = new ArrayList<>();
        List<Object> allAlbum = new ArrayList<>();
        Map<String, Object> allData = new HashMap<>();

        for (int i = 0; i < data.size(); i++) {
            JSONObject data2 = new JSONObject(data.get(i));
            Object title = data2.get("title");
            Integer duration = (Integer) data2.get("duration") / 60;

            JSONObject album = new JSONObject((Map) data2.get("album"));
            Object cover = album.get("cover");
            Object id = album.get("id");

            if (!(id_album.contains(id))) {
                id_album.add(id);
            }

            JSONObject artist = new JSONObject((Map) data2.get("artist"));
            Object name = artist.get("name");

            List<Object> titre = Arrays.asList(name, title, duration, cover);

            allTitre.add(titre);
        }

        for (int j = 0; j < id_album.size(); j++) {
            String urlAlbum = "https://api.deezer.com/album/" + id_album.get(j);
            JSONObject resAlbum = restTemplate.getForObject(urlAlbum, JSONObject.class);
            Object cover = resAlbum.get("cover_medium");
            Object titleAlbum = resAlbum.get("title");
            Object nb_tracks = resAlbum.get("nb_tracks");
            Object id = resAlbum.get("id");

            JSONObject artist = new JSONObject((Map) resAlbum.get("artist"));
            Object name = artist.get("name");

            List<Object> titreAlbum = Arrays.asList(id, name, titleAlbum, nb_tracks, cover);
            allAlbum.add(titreAlbum);
        }

        allData.put("titles", allTitre);
        allData.put("albums", allAlbum);
        return new ResponseEntity<>(
            allData,
            HttpStatus.OK
        );
    }

}
