package bestdashboarder.dashboardback.mongo.mongocontrollers;

import org.springframework.web.bind.annotation.RestController;
import org.bson.Document;
import org.bson.types.ObjectId;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PatchMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;

import bestdashboarder.dashboardback.mongo.mongomodels.User;
import bestdashboarder.dashboardback.JWTService;
import bestdashboarder.dashboardback.mongo.mongomodels.ConnectionProvider;
import bestdashboarder.dashboardback.mongo.utils.EncryptionUtils;
import bestdashboarder.dashboardback.mongo.mongoservices.UserService;

import java.util.HashMap;
import java.util.Map;

import javax.servlet.http.HttpSession;

@RestController
public class UsersController {
    private UserService userService;

    UsersController() {
        this.userService = new UserService();
    }
    
    @PostMapping("/users")
    public ResponseEntity<Object> createUser(
        @RequestBody Map<String, String> reqBody
    ) {
        if (
            reqBody.get("name") == null || 
            reqBody.get("email") == null || 
            reqBody.get("password") == null
        )
            return new ResponseEntity<>(
                "Some needed information are missing.", 
                HttpStatus.BAD_REQUEST
            );

        Document userFound = this.userService.getUserByEmail(reqBody.get("email"));
        if (userFound != null)
            return new ResponseEntity<>(
                "User already registered",
                HttpStatus.CONFLICT
            );

        User newUser = new User(
            reqBody.get("name"), 
            reqBody.get("email"),
            reqBody.get("avatar_url"),
            ConnectionProvider.LOCAL
        );
        newUser.setPassword(EncryptionUtils.encryptSHA256(
            reqBody.get("password")
        ));

        ObjectId insertedId = this.userService.insertIfNotPresent(newUser);
        if (insertedId != null) {
            return new ResponseEntity<>(
                JWTService.generateJWT(insertedId.toString()), 
                HttpStatus.OK
            );
        }
        else
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
    }

    @PostMapping("/login")
    public ResponseEntity<Object> login(
        @RequestBody Map<String, String> reqBody
    ) {
        String email = reqBody.get("email");
        String password = reqBody.get("password");
        if (email == null || password == null)
            return new ResponseEntity<>(
                "Some needed information are missing.",
                HttpStatus.BAD_REQUEST
            );

        Document user = this.userService.getUserByEmail(email);
        if (user == null)
            return new ResponseEntity<>(
                "Wrong email or password.",
                HttpStatus.NOT_FOUND
            );
        
        String encryptedPassword = EncryptionUtils.encryptSHA256(password);
        if (!user.getString("password").equals(encryptedPassword))
            return new ResponseEntity<>(
                "Wrong email or password.",
                HttpStatus.NOT_FOUND
            );
        return new ResponseEntity<>(
            JWTService.generateJWT(user.getObjectId("_id").toString()),
            HttpStatus.OK
        );
    }

    @GetMapping("/users/{id}")
    public ResponseEntity<Object> getUserById(
        @PathVariable("id") String id
    ) {
        Document userFound = this.userService.getUserById(new ObjectId(id));
        if (userFound == null)
            return new ResponseEntity<>(
                "User not found", 
                HttpStatus.NOT_FOUND
            );
        return new ResponseEntity<>(
            userFound, 
            HttpStatus.OK
        );
    }

    @GetMapping("/users/current")
    public ResponseEntity<Object> getCurrentUser(
        @RequestParam String jwt
    ) {
        String userId = JWTService.getUserIdFromJWT(jwt);
        if (userId == null)
            return new ResponseEntity<>(
                "Invalid JWT",
                HttpStatus.UNAUTHORIZED
            );

        Document userFound = this.userService.getUserById(new ObjectId(userId));
        if (userFound == null)
            return new ResponseEntity<>(
                "User not found", 
                HttpStatus.NOT_FOUND
            );

        userFound.remove("github_api_key");
        return new ResponseEntity<>(
            userFound, 
            HttpStatus.OK
        );
    }

    @PatchMapping("/users")
    public ResponseEntity<Object> updateUser(
        @RequestBody Map<String, Object> reqBody
    ) {
        if (reqBody.get("jwt") == null)
            return new ResponseEntity<>(HttpStatus.UNAUTHORIZED);

        if (
            reqBody.get("name") == null &&
            reqBody.get("github_api_key") == null &&
            reqBody.get("services") == null &&
            reqBody.get("password") == null
        )
            return new ResponseEntity<>(
                "No updates to apply",
                HttpStatus.BAD_REQUEST
            );

        String userId = JWTService.getUserIdFromJWT((String)reqBody.get("jwt"));
        if (userId == null)
            return new ResponseEntity<>(
                "Invalid JWT",
                HttpStatus.UNAUTHORIZED
            );

        Map<String, Object> updates = new HashMap<>();
        if (reqBody.get("name") != null)
            updates.put("name", reqBody.get("name"));
        if (reqBody.get("github_api_key") != null)
            updates.put("github_api_key", reqBody.get("github_api_key"));
        if (reqBody.get("services") != null)
            updates.put("services", reqBody.get("services"));
        if (reqBody.get("password") != null)
            updates.put(
                "password", 
                EncryptionUtils.encryptSHA256((String)reqBody.get("password"))
            );

        ObjectId updatedUserId = this.userService.updateById(
            new ObjectId(userId), 
            updates
        );
        if (updatedUserId == null)
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        return new ResponseEntity<>(userId, HttpStatus.OK);
    }

    @PostMapping("/users/services")
    public ResponseEntity<Object> addUserService(
        @RequestBody Map<String, String> reqBody
    ) {
        if (reqBody.get("jwt") == null)
            return new ResponseEntity<>(HttpStatus.UNAUTHORIZED);
        
        if (reqBody.get("service") == null)
            return new ResponseEntity<>(
                "No service to add",
                HttpStatus.BAD_REQUEST
            );

        String userId = JWTService.getUserIdFromJWT(reqBody.get("jwt"));
        if (userId == null)
            return new ResponseEntity<>(
                "Invalid JWT",
                HttpStatus.UNAUTHORIZED
            );

        boolean res = this.userService.addUserService(
            new ObjectId(userId), 
            reqBody.get("service")
        );

        if (!res)
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        return new ResponseEntity<>(userId, HttpStatus.OK);
    }

    @DeleteMapping("/users/services")
    public ResponseEntity<Object> removeUserService(
        @RequestBody Map<String, String> reqBody
    ) {
        if (reqBody.get("jwt") == null)
            return new ResponseEntity<>(HttpStatus.UNAUTHORIZED);
        
        if (reqBody.get("service") == null)
            return new ResponseEntity<>(
                "No service to remove",
                HttpStatus.BAD_REQUEST
            );

        String userId = JWTService.getUserIdFromJWT(reqBody.get("jwt"));
        if (userId == null)
            return new ResponseEntity<>(
                "Invalid JWT",
                HttpStatus.UNAUTHORIZED
            );

        boolean res = this.userService.removeUserService(
            new ObjectId(userId), 
            reqBody.get("service")
        );

        if (!res)
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        return new ResponseEntity<>(userId, HttpStatus.OK);
    }
}
