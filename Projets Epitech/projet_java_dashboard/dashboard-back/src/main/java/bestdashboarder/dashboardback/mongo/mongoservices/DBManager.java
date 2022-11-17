package bestdashboarder.dashboardback.mongo.mongoservices;

import com.mongodb.client.MongoClient;
import com.mongodb.client.MongoClients;
import com.mongodb.client.MongoDatabase;

public class DBManager {
    private static DBManager instance = null;
    private MongoClient client = null;
    private MongoDatabase database = null;

    private DBManager() {
        String uri = "mongodb+srv://asparton:dpA2vqQ7PFd5K!hV&2ACA3RHi297iy" +
                     "@cluster0.qgg6qt7.mongodb.net/dashboard";
        this.client = MongoClients.create(uri);
        this.database = this.client.getDatabase("dashboard");
    }

    public static MongoClient getClient() {
        if (DBManager.instance == null)
            DBManager.instance = new DBManager();
            
        return DBManager.instance.client;
    }

    public static MongoDatabase getDatabase() {
        if (DBManager.instance == null)
            DBManager.instance = new DBManager();
            
        return DBManager.instance.database;
    }
}
