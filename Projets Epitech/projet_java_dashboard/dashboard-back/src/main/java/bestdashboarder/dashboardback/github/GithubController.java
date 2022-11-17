package bestdashboarder.dashboardback.github;

import bestdashboarder.dashboardback.JWTService;
import bestdashboarder.dashboardback.mongo.mongoservices.UserService;
import io.swagger.annotations.ApiOperation;

import org.bson.Document;
import org.bson.types.ObjectId;
import org.springframework.http.HttpEntity;
import org.springframework.http.HttpHeaders;
import org.springframework.http.HttpStatus;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.client.RestTemplate;

import java.util.ArrayList;
import java.util.Collections;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

@RestController
public class GithubController {
    @ApiOperation(
        value = "Get all repositories of a user", 
        notes = "Return a list of all repositories of one user"
    )
    @GetMapping("/github/{username}")//widget 1
    public ResponseEntity<Object> githubOverview(
        @PathVariable String username, 
        @RequestParam String jwt
    )  {
        String userId = JWTService.getUserIdFromJWT(jwt);
        if (userId == null)
            return new ResponseEntity<>(
                "Invalid JWT",
                HttpStatus.UNAUTHORIZED
            );
        Document user = new UserService().getUserById(new ObjectId(userId));
        String githubAPIKey = user.getString("github_api_key");
        
        HttpHeaders headers = new HttpHeaders();
        headers.setAccept(Collections.singletonList(MediaType.APPLICATION_JSON));
        headers.set("Authorization", "Bearer " + githubAPIKey);
        HttpEntity<String> entity = new HttpEntity<>("", headers);
        String reposURl = "https://api.github.com/users/" + username + "/repos";
        RestTemplate restTemplate = new RestTemplate();
        List<Map<String, String>> fullRepos = restTemplate.getForObject(
            reposURl, 
            List.class,
            entity
        );

        List<Map<String, String>> repos = new ArrayList<>();
        for (Map<String, String> repo : fullRepos) {
            Map<String, String> finalInfos = new HashMap<>();
            finalInfos.put("name", repo.get("name"));
            finalInfos.put("url", repo.get("html_url"));
            repos.add(finalInfos);
        }

        return new ResponseEntity<>(
            repos,
            HttpStatus.OK
        );
    }

    @ApiOperation(
        value = "Get one repository", 
        notes = "Return some key information about a repository"
    )
    @GetMapping("/github/{username}/{repoName}")
    public ResponseEntity<Object> githubOneRepos(
        @PathVariable("username") String username,
        @PathVariable("repoName") String repoName, 
        @RequestParam String jwt
    ) {
        String userId = JWTService.getUserIdFromJWT(jwt);
        if (userId == null)
            return new ResponseEntity<>(
                "Invalid JWT",
                HttpStatus.UNAUTHORIZED
            );
        Document user = new UserService().getUserById(new ObjectId(userId));
        String githubAPIKey = user.getString("github_api_key");

        String url = String.format(
            "https://api.github.com/repos/%s/%s",
            username,
            repoName
        );
        
        HttpHeaders headers = new HttpHeaders();
        headers.setAccept(Collections.singletonList(MediaType.APPLICATION_JSON));
        headers.set("Authorization", "Bearer " + githubAPIKey);
        HttpEntity<String> entity = new HttpEntity<>("", headers);
        RestTemplate restTemplate = new RestTemplate();
        Map<String, String> fullRepo = restTemplate.getForObject(
            url, 
            Map.class,
            entity
        );

        Map<String, Object> repo = new HashMap<>();
        repo.put("name", fullRepo.get("name"));
        repo.put("url", fullRepo.get("html_url"));
        repo.put("description", fullRepo.get("description"));
        repo.put("creation_date", fullRepo.get("created_at"));
        repo.put("stars_count", fullRepo.get("stargazers_count"));
        repo.put("watchers_count", fullRepo.get("watchers"));
        repo.put("language", fullRepo.get("language"));
        repo.put("visibility", fullRepo.get("visibility"));

        return new ResponseEntity<>(
            repo,
            HttpStatus.OK
        );
    }
}
