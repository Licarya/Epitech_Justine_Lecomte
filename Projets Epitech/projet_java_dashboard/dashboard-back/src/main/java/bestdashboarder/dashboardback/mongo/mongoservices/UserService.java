package bestdashboarder.dashboardback.mongo.mongoservices;

import java.util.ArrayList;
import java.util.List;
import java.util.Map;

import org.bson.Document;
import org.bson.conversions.Bson;
import org.bson.types.ObjectId;

import com.mongodb.client.MongoCollection;
import com.mongodb.client.model.Filters;
import com.mongodb.client.model.Updates;
import com.mongodb.client.result.InsertOneResult;
import com.mongodb.client.result.UpdateResult;
import com.mongodb.MongoBulkWriteException;
import com.mongodb.MongoException;
import com.mongodb.MongoQueryException;

import bestdashboarder.dashboardback.mongo.mongomodels.User;

public class UserService {
    private MongoCollection<Document> usersCollection;

    public UserService() {
        this.usersCollection = DBManager.getDatabase().getCollection("users");
    }

    /**
     * Try to insert the given user inside the database if not present.
     * @param userToInsert the configured user to insert.
     * @return the inserted id if the operation was successful, null otherwise.
     */
    public ObjectId insertIfNotPresent(User userToInsert) {
        if (getUserByEmail(userToInsert.getEmail()) != null)
            return null;

        Document doc = new Document()
                        .append("name", userToInsert.getName())
                        .append("email", userToInsert.getEmail())
                        .append("password", userToInsert.getPassword())
                        .append(
                            "connectionProvider", 
                            userToInsert.getConnectionProvider()
                        )
                        .append("avatarUrl", userToInsert.getAvatarUrl())
                        .append("services", userToInsert.getServices())
                        .append("github_api_key", userToInsert.getGithubAPIKey());

        try {
            InsertOneResult res = this.usersCollection.insertOne(doc);
            if (res.wasAcknowledged())
                return res.getInsertedId().asObjectId().getValue();
            else
                return null;
        } catch (MongoBulkWriteException e) {
            System.err.println(
                "An error occured trying to insert a new user: " +
                e.getMessage()
            );
            return null;
        }
    }

    /**
     * Try to find the user with the corresponding given email.
     * @param email the email of the user to find.
     * @return the user if found, null otherwise.
     */
    public Document getUserByEmail(String email) {
        Bson filter = Filters.all("email", email);

        try {
            Document userFound = this.usersCollection.find(filter).first();
            if (userFound != null)
                return userFound;
            return null;
        } catch (MongoQueryException e) {
            System.err.println(
                "An error occured while trying to find a user: " +
                e.getMessage()
            );
            return null;
        }
    }

    /**
     * Try to find the user with the corresponding given id.
     * @param userId the id of the user to find.
     * @return the user if found, null otherwise.
     */
    public Document getUserById(ObjectId userId) {
        Bson filter = Filters.all("_id", userId);

        try {
            Document userFound = this.usersCollection.find(filter).first();
            if (userFound != null)
                return userFound;
            return null;
        } catch (MongoQueryException e) {
            System.err.println(
                "An error occured while trying to find a user: " +
                e.getMessage()
            );
            return null;
        }
    }

    /**
     * Try to update the user with the given id with the given updates.
     * @param userId the id of the user to update.
     * @param updates the updates to apply.
     * @return the id of the user if the update was successful, null otherwise.
     */
    public ObjectId updateById(ObjectId userId, Map<String, Object> updates) {
        Bson filter = Filters.all("_id", userId);

        List<Bson> updatesList = new ArrayList<>();
        if (updates.containsKey("github_api_key"))
            updatesList.add(
                Updates.set("github_api_key", updates.get("github_api_key"))
            );
        if (updates.containsKey("name"))
            updatesList.add(
                Updates.set("name", updates.get("name"))
            );
        if (updates.containsKey("password"))
            updatesList.add(
                Updates.set("password", updates.get("password"))
            );
        if (updates.containsKey("services"))
            updatesList.add(
                Updates.set("services", updates.get("services"))
            );
        
        Bson updateObj = Updates.combine(updatesList);
        try {
            UpdateResult res = this.usersCollection.updateOne(filter, updateObj);
            if (res.wasAcknowledged())
                return userId;
            return null;
        } catch (MongoException e) {
            System.err.println(
                "An error occured trying to update a user: " +
                e.getMessage()
            );
            return null;
        }
    }

    /**
     * Try to add the given service to the user with the corresponding given id.
     * @param userId the id of the user to update.
     * @param service the dashboard service to add.
     * @return true if the update was successful, false otherwise.
     */
    public boolean addUserService(ObjectId userId, String service) {
        Bson filter = Filters.all("_id", userId);
        Bson updateObj = Updates.push("services", service.toString());
        
        try {
            UpdateResult res = this.usersCollection.updateOne(filter, updateObj);
            return res.wasAcknowledged();
        } catch (MongoException e) {
            System.err.println(
                "An error occured trying to update a user services: " +
                e.getMessage()
            );
            return false;
        }
    }

    /**
     * Try to remove the given service to the user with the corresponding given id.
     * @param userId the id of the user to update.
     * @param service the dashboard service to remove.
     * @return true if the update was successful, false otherwise.
     */
    public boolean removeUserService(ObjectId userId, String service) {
        Bson filter = Filters.all("_id", userId);
        Bson updateObj = Updates.pull("services", service.toString());
        
        try {
            UpdateResult res = this.usersCollection.updateOne(filter, updateObj);
            return res.wasAcknowledged();
        } catch (MongoException e) {
            System.err.println(
                "An error occured trying to update a user services: " +
                e.getMessage()
            );
            return false;
        }
    }
}
