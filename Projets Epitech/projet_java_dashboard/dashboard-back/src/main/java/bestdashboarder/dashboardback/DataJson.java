package bestdashboarder.dashboardback;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.lang.reflect.InvocationTargetException;
import java.net.URI;
import java.net.URL;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class DataJson {
    @SuppressWarnings("unchecked")
    public <T1, T2, T3> List<T1> GetDataURLIntoModels(URL url, String githubAPIKey, Class<T1> modelClass, T2... parameters) throws IOException, NoSuchMethodException, InvocationTargetException, InstantiationException, IllegalAccessException, SecurityException, InterruptedException {
        StringBuilder stringBuilder = new StringBuilder();
        List<JSONObject> jsonObjects = new ArrayList<>();
        List<T3> valueParameters = new ArrayList<>();
        List<T1> modelClassList = new ArrayList<>();
        try {
            String build = "";
            if (githubAPIKey == null) {
                build = getDataStreamNoAuth(url);
            } else {
                build = getDataStreamAuth(url, githubAPIKey);
            }
            System.out.println("BUILD : "  + build);
            JSONArray jsonArray;
            if (String.valueOf(build.charAt(0)).equals("[") && String.valueOf(build.charAt(build.length() - 1)).equals("]")) {
                jsonArray = new JSONArray(build);
            } else {
                jsonArray = new JSONArray("[" + build + "]");
            }
            for (int i = 0; i < jsonArray.length(); i++) {
                jsonObjects.add(new JSONObject(jsonArray.get(i).toString()));
            }
            for (JSONObject jsonObject : jsonObjects) {
                for (T2 parameter : parameters) {
                    if (parameter instanceof String) {
                        if (jsonObject.get(parameter.toString()).toString().startsWith("https://api.github.com") && !parameter.toString().equals("url")) {
                            String newURL = "";
                            String jsonValue = jsonObject.get(parameter.toString()).toString();
                            for (int i = 0; i < jsonValue.length(); i++) {
                                if (!String.valueOf(jsonValue.charAt(i)).equals("{")) {
                                    newURL += String.valueOf(jsonValue.charAt(i));
                                } else {
                                    break;
                                }
                            }
                            valueParameters.add((T3) newURL);
                        } else {
                            valueParameters.add((T3) jsonObject.get(parameter.toString()).toString());
                        }
                    } else if (parameter instanceof List<?>) {
                        valueParameters.add((T3) GetValueInsideRecursiveJSONObject(jsonObject, (List<?>) parameter));
                    }
                }
                modelClassList.add(modelClass.getDeclaredConstructor(List.class).newInstance(valueParameters));
                valueParameters.clear();
            }
            return modelClassList;
        } catch (Exception e){
            System.out.println(Arrays.toString(e.getStackTrace()));
            return null;
        }
    }

    public String GetDataURL(URL url) throws IOException {
        InputStream inputStream = url.openStream();
        StringBuilder stringBuilder = new StringBuilder();
        String jsonData;
        try {
            InputStreamReader inputStreamReader = new InputStreamReader(inputStream, StandardCharsets.UTF_8);
            BufferedReader bufferedReader = new BufferedReader(inputStreamReader);
            int c;
            while ((c = bufferedReader.read()) != -1) {
                stringBuilder.append((char) c);
            }
            String build = stringBuilder.toString();
            build = build.replace("[", "");
            build = build.replace("]", "");
            return build;
        }
        finally {
            inputStream.close();
        }
    }

    public String GetValueInsideRecursiveJSONObject(JSONObject jsonObject, List<?> parameters){
        JSONObject key = null;
        String value = "";
        for(int i = 0; i < parameters.size(); i++){
            if(key == null){
                key = (JSONObject) jsonObject.get(parameters.get(i).toString());
            }
            else {
                if(i < parameters.size() - 1) {
                    key = (JSONObject) key.get(parameters.get(i).toString());
                }
                else {
                    value = key.get(parameters.get(parameters.size() - 1).toString()).toString();
                }
            }
        }
        return value;
    }

    public String getDataStreamNoAuth(URL url) throws IOException {
        StringBuilder stringBuilder = new StringBuilder();
        InputStream inputStream = url.openStream();
        InputStreamReader inputStreamReader = new InputStreamReader(inputStream, StandardCharsets.UTF_8);
        BufferedReader bufferedReader = new BufferedReader(inputStreamReader);
        int c;
        while ((c = bufferedReader.read()) != -1) {
            stringBuilder.append((char) c);
        }
        bufferedReader.close();
        String build = stringBuilder.toString();
        return build;
    }

    public String getDataStreamAuth(URL url, String githubAPIKey) throws IOException, InterruptedException {
        // create client
        HttpClient client = HttpClient.newHttpClient();
        // create request
        HttpRequest request = HttpRequest.newBuilder().header("Authorization", "Bearer " + githubAPIKey)
                .uri(URI.create(url.toString()))
                .GET()
                .build();
        HttpResponse<String> response = client
                .send(request, HttpResponse.BodyHandlers.ofString());
        String build = response.body();
        return build;
    }
}