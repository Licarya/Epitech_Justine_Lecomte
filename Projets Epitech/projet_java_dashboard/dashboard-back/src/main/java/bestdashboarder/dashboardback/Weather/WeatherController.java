package bestdashboarder.dashboardback.Weather;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.json.simple.JSONObject;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.client.RestTemplate;

@RestController
public class WeatherController {

	@GetMapping("/weather")
	public ResponseEntity<Object> getActualWeather(@RequestParam String city) {

		String urlAd = "https://api-adresse.data.gouv.fr/search/?q=" + city + "&type=municipality&autocomplete=1";
		RestTemplate restTemplate1 = new RestTemplate();
		JSONObject result1 = restTemplate1.getForObject(urlAd, JSONObject.class);
		List<JSONObject> features = (List<JSONObject>) result1.get("features");
		JSONObject feat = new JSONObject(features.get(0));
		JSONObject geo = new JSONObject((Map) feat.get("geometry"));
		List<Integer> coordinates = (List<Integer>) geo.get("coordinates");
		JSONObject proper = new JSONObject((Map) feat.get("properties"));
		Object label = proper.get("label");

		String url = "https://api.open-meteo.com/v1/forecast?latitude=" + coordinates.get(1) + "&longitude="
				+ coordinates.get(0) + "&current_weather=true";
		RestTemplate restTemplate = new RestTemplate();
		JSONObject result = restTemplate.getForObject(url, JSONObject.class);
		JSONObject current = new JSONObject((Map) result.get("current_weather"));
		Object time = current.get("time");
		time = ((String) time).substring(0, 10);

		Object temperature = current.get("temperature");
		Object windspeed = current.get("windspeed");
		Object winddirection = (Object) current.get("winddirection");
		Integer weathercode = (Integer) current.get("weathercode");

		String picture = "";
		switch (weathercode) {
			case 0:
				picture = "https://img.icons8.com/office/480/null/sun--v1.png";
				break;

			case 1:
				picture = "https://img.icons8.com/color/480/null/partly-cloudy-day--v1.png";
				break;

			case 2:
				picture = "https://img.icons8.com/color/480/null/partly-cloudy-day--v1.png";
				break;

			case 3:
				picture = "https://img.icons8.com/office/480/null/clouds.png";
				break;

			case 45:
				picture = "https://img.icons8.com/office/480/null/fog-day--v1.png";
				break;

			case 61:
				picture = "https://img.icons8.com/office/480/null/downpour.png";
				break;

			case 80:
				picture = "https://img.icons8.com/office/480/null/rain.png";
				break;
		}

		Map<String, Object> condition = new HashMap<>();
		condition.put("city", label);
		condition.put("temperature", temperature);
		condition.put("picWind", winddirection);
		condition.put("windspeed", windspeed);
		condition.put("picture", picture);
		condition.put("time", time);

		return new ResponseEntity<>(condition, HttpStatus.OK);
	}

	@GetMapping("/weatherHourly")
	public ResponseEntity<Object> hourlyDataList(@RequestParam String city) {
		List<Object> condition2 = new ArrayList<>();

		String urlAd = "https://api-adresse.data.gouv.fr/search/?q=" + city + "&type=municipality&autocomplete=1";
		RestTemplate restTemplate1 = new RestTemplate();
		JSONObject result1 = restTemplate1.getForObject(urlAd, JSONObject.class);
		List<JSONObject> features = (List<JSONObject>) result1.get("features");
		JSONObject feat = new JSONObject(features.get(0));
		JSONObject geo = new JSONObject((Map) feat.get("geometry"));
		List<Integer> coordinates = (List<Integer>) geo.get("coordinates");
		JSONObject proper = new JSONObject((Map) feat.get("properties"));
		Object label = proper.get("label");

		String url = "https://api.open-meteo.com/v1/forecast?latitude=" + coordinates.get(1) + "&longitude="
				+ coordinates.get(0) + "&current_weather=true";
		RestTemplate restTemplate = new RestTemplate();
		JSONObject result = restTemplate.getForObject(url, JSONObject.class);
		JSONObject current = new JSONObject((Map) result.get("current_weather"));
		Object time = current.get("time");
		time = ((String) time).substring(0, 10);

		String urlHourly = "https://api.open-meteo.com/v1/forecast?latitude=" + coordinates.get(1) + "&longitude="
				+ coordinates.get(0)
				+ "&hourly=temperature_2m,relativehumidity_2m,precipitation,weathercode,windspeed_10m,winddirection_10m&start_date="
				+ time + "&end_date=" + time;
		restTemplate = new RestTemplate();
		result = restTemplate.getForObject(urlHourly, JSONObject.class);

		JSONObject hourly = new JSONObject((Map) result.get("hourly"));
		List<Object> temperatureH = (List<Object>) hourly.get("temperature_2m");
		List<Object> weathercodeH = (List<Object>) hourly.get("weathercode");
		List<Object> humidity = (List<Object>) hourly.get("relativehumidity_2m");
		List<Object> precipitation = (List<Object>) hourly.get("precipitation");
		List<Object> winddirectionH = (List<Object>) hourly.get("winddirection_10m");
		List<Object> windspeedH = (List<Object>) hourly.get("windspeed_10m");
		List<Object> timeH = (List<Object>) hourly.get("time");

		for (int i = 0; i < timeH.size(); i++) {
			Object temp = temperatureH.get(i);
			Integer weatherCode = (Integer) weathercodeH.get(i);

			String picture = "";
			switch (weatherCode) {
				case 0:
					picture = "https://img.icons8.com/office/480/null/sun--v1.png";
					break;

				case 1:
					picture = "https://img.icons8.com/color/480/null/partly-cloudy-day--v1.png";
					break;

				case 2:
					picture = "https://img.icons8.com/color/480/null/partly-cloudy-day--v1.png";
					break;

				case 3:
					picture = "https://img.icons8.com/office/480/null/clouds.png";
					break;

				case 45:
					picture = "https://img.icons8.com/office/480/null/fog-day--v1.png";
					break;

				case 61:
					picture = "https://img.icons8.com/office/480/null/downpour.png";
					break;

				case 80:
					picture = "https://img.icons8.com/office/480/null/rain.png";
					break;
			}

			Object humid = humidity.get(i);
			Object precip = precipitation.get(i);
			Object winddir = winddirectionH.get(i);
			Object windspe = windspeedH.get(i);
	
			Map<String, Object> condition = new HashMap<>();
			condition.put("city", label);
			condition.put("temperature", temp);
			condition.put("wind direction", winddir);
			condition.put("windspeed", windspe);
			condition.put("picture", picture);
			condition.put("humidity", humid);
			condition.put("precipitation", precip);
			condition2.add(condition);
		}

		return new ResponseEntity<>(condition2, HttpStatus.OK);
	}
}
